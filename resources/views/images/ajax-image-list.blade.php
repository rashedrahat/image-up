@if(count($data) > 0)
    <div class="row">
        @foreach($data as $img)
            <div class="col-sm-2">
                <div>
                    <a class="preview" href="#"><img
                            class="img-fluid img-thumbnail" src="{{url('/assets/images/'.$img['image_name'])}}"
                            alt="Image" style='width: 222px; height: 111px;' title="Click to preview"></a>
                </div>
                <div class="mt-1 img-title" align="center" style="overflow: hidden;">
                    {{$img['title']}}
                </div>
                <div class="mt-1 mb-2" align="center">
                    <button type="button" class="removeImg btn bg-white btn-sm" data-id="{{$img['id']}}">
                        <i class="fa fa-trash"></i> Remove
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="row" align="center">
        <h1 class="display-4">
            No image to display!
            <i><small class="text-muted">Upload one.</small></i>
        </h1>
    </div>
@endif
