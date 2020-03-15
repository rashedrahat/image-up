<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class ImageController extends Controller
{
    public function imageList()
    {
        $data = array();
        try {
            $filename = public_path('assets/data.json');

            if (file_exists($filename)) {
                $images = file_get_contents($filename);
                $data = json_decode($images, true);
                $data = array_reverse($data);

//            return $data;
            }
        } catch (Exception $e) {
            $data = [];
        }

        return view('images.image-list', compact('data'));
    }

    public function ajaxImageList()
    {
        $data = array();
        try {
            $filename = public_path('assets/data.json');

            if (file_exists($filename)) {
                $images = file_get_contents($filename);
                $data = json_decode($images, true);
                $data = array_reverse($data);

//            return $data;
            }
        } catch (Exception $e) {
            $data = [];
        }

        return view('images.ajax-image-list', compact('data'));
    }

    public function searchImages($query)
    {
        $search_result_data = array();
        try {
            $filename = public_path('assets/data.json');

            if (file_exists($filename)) {
                $images = file_get_contents($filename);
                $data = json_decode($images, true);
//                return $images;

                if (sizeof($data) > 0) {
                    foreach ($data as $key => $value) {
                        if (strpos(strtolower($value['title']), strtolower($query)) !== false) {
                            $search_result_data[] = $value;
                        }
                    }
                }
                $search_result_data = array_reverse($search_result_data);
            }
        } catch (Exception $e) {
            $search_result_data = [];
        }

        return view('images.search-image-list', compact('search_result_data'));
    }

    public function imageStore(Request $request)
    {
        try {
            $image = $request->file('file');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('assets/images'), $imageName);

            return response()->json(['success' => true, 'data' => $imageName]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'data' => null]);
        }
    }

//    public function fileDestroy(Request $request)
//    {
//        try {
//            $filename = $request->get('filename');
//            $path = public_path() . '/assets/images/' . $filename;
//            if (file_exists($path)) {
//                unlink($path);
//            }
//
//            return response()->json(['success' => true]);
//        } catch (Exception $e) {
//            return response()->json(['success' => false]);
//        }
//    }

    public function imageUploadWithTitle(Request $request)
    {
//        return $request->all();

        $filename = public_path('assets/data.json');

        if (file_exists($filename)) {
            try {
                $data = array(
                    'id' => uniqid(),
                    'title' => $request->title,
                    'image_name' => $request->file,
                    'created_at' => date("Y-m-d h:m:s")
                );

                $json_data = file_get_contents($filename);

                $arr_data = json_decode($json_data, true);

                array_push($arr_data, $data);

                $json_data = json_encode($arr_data);

                if (file_put_contents($filename, $json_data)) {
                    return response()->json(['success' => true]);
                }

            } catch (Exception $e) {
                return response()->json(['success' => false]);
            }
        } else {
            $fh = fopen($filename, 'w');
            fwrite($fh, "[]");

            try {
                $data = array(
                    'id' => uniqid(),
                    'title' => $request->title,
                    'image_name' => $request->file,
                    'created_at' => date("Y-m-d h:m:s")
                );

                $json_data = file_get_contents($filename);

                $arr_data = json_decode($json_data, true);

                array_push($arr_data, $data);

                $json_data = json_encode($arr_data);

                if (file_put_contents($filename, $json_data)) {
                    return response()->json(['success' => true]);
                }

            } catch (Exception $e) {
                return response()->json(['success' => false]);
            }
        }

    }

    public function removeImage($id)
    {
        try {
            $filename = public_path('assets/data.json');

            if (file_exists($filename)) {
                $filename_to_delete = '';
                $images = file_get_contents($filename);
                $data = json_decode($images, true);

                foreach ($data as $key => $value) {
                    if ($value['id'] === $id) {
                        $filename_to_delete = $value['image_name'];
                        $path = public_path() . '/assets/images/' . $filename_to_delete;
                        if (file_exists($path)) {
                            unlink($path);
                        }
                        unset($data[$key]);
                        break;
                    }
                }

                $data = json_encode($data, true);

                file_put_contents($filename, $data);

                $file_data = file_get_contents($filename);

                return response()->json(['success' => true, 'data' => $file_data]);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'data' => null]);
        }
    }
}
