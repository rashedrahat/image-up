<!DOCTYPE html>
<html lang="en">
<head>
    <title>Images</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.7/jquery.jgrowl.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jgrowl/1.4.7/jquery.jgrowl.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
    <script src="http://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js"></script>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <style>
        #myProgress {
            width: 100%;
            background-color: #ddd;
        }

        #myBar {
            width: 1%;
            height: 30px;
            background-color: dodgerblue;
        }

        .jGrowl .success {
            background-color: #4BB543;
        }

        .jGrowl .error {
            background-color: red;
        }

        #loader {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 1;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes  spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        button.removeImg:hover {
            border: 1px solid #dc3545 !important;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12"><h4>Your Images</h4></div>
        <div class="col-sm-2 mt-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#upImage">
                Upload Image
            </button>
            <!-- The Modal -->
            <div class="modal fade" id="upImage">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="bg-dark p-2">
                                <h4 style="color: white;">Upload Image</h4>
                            </div>
                            <form method="post" action="<?php echo e(url('images')); ?>" enctype="multipart/form-data"
                                  class="dropzone" id="dropzone">
                                <?php echo csrf_field(); ?>
                            </form>
                            <div class="form-group row mt-2">
                                <label for="imgTitle" class="col-sm-2 col-form-label">Image Title*</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" placeholder="Image Title">
                                </div>
                            </div>
                            <div align="center" class="mt-2">
                                <button type="button" class="btn btn-primary" id="upload">
                                    Upload
                                </button>
                            </div>

                            <div id="myProgress" class="mt-2" style="display: none;">
                                <div id="myBar"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-10 mt-2">
            <input type="text" class="form-control" placeholder="Search" id="search">
        </div>
    </div>
    <hr/>
    <div id="images-data">
        <?php if(count($data) > 0): ?>
            <div class="row">
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-2">
                        <div>
                            <a class="preview" href="#"><img
                                    class="img-fluid img-thumbnail" src="<?php echo e(url('/assets/images/'.$img['image_name'])); ?>"
                                    alt="Image" style='width: 222px; height: 111px;' title="Click to preview"></a>
                        </div>
                        <div class="mt-1 img-title" align="center" style="overflow: hidden;">
                            <?php echo e($img['title']); ?>

                        </div>
                        <div class="mt-1 mb-2" align="center">
                            <button type="button" class="removeImg btn bg-white btn-sm" data-id="<?php echo e($img['id']); ?>">
                                <i class="fa fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="row" align="center">
                <h1 class="display-4">
                    No image to display!
                    <i><small class="text-muted">Upload one.</small></i>
                </h1>
            </div>
        <?php endif; ?>
    </div>
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <img src="" class="imagepreview" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
    <div id="loader" style="display: none;"></div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $(".dz-message").html("<div align='center'><img src='https://cdn.onlinewebfonts.com/svg/img_263259.png' alt='' style='width: 25px; height: 25px;'><p>Drag and drop files or click to select</p></div>");

        animateImageTitle();

        $('#images-data').on('click', '.preview', function () {
            $('.imagepreview').attr('src', $(this).find('img').attr('src'));
            $('#imagemodal').modal('show');
        });

        $('#images-data').on('click', '.removeImg', function () {
            var id = $(this).data("id");
            console.log(id);
            bootbox.confirm({
                message: "Are you sure you want to remove?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            type: "GET",
                            url: "/remove-images/" + id,
                            success: function (data) {
                                // console.log(data);
                                if (data.success) {
                                    $.jGrowl("Removed successfully!", {theme: 'success', life: 5000});
                                    $.ajax({
                                        type: "GET",
                                        url: "/ajax-images",
                                        success: function (result) {
                                            $('#images-data').html(result);
                                            animateImageTitle();
                                        },
                                        error: function (error) {
                                            $.jGrowl("Something went wrong!", {theme: 'error', life: 5000});
                                        }
                                    });
                                }
                            },
                            error: function (error) {
                                $.jGrowl("Something went wrong!", {theme: 'error', life: 5000});
                            }
                        });
                    }
                }
            });
        });

        $('#search').on('keyup', function () {
            var query = $('#search').val();
            // console.log(query);
            var regex_letters = /^[A-Za-z ]+$/;
            if (query.length === 0) {
                document.getElementById("loader").style.display = "block";
                setTimeout(showImageList, 1000);

                function showImageList() {
                    document.getElementById("loader").style.display = "none";
                    $.ajax({
                        type: "GET",
                        url: "/ajax-images",
                        success: function (result) {
                            $('#images-data').html(result);
                            animateImageTitle();
                        },
                        error: function (error) {
                            $.jGrowl("Something went wrong!", {theme: 'error', life: 5000});
                        }
                    });
                }
            } else {
                if (query.match(regex_letters)) {
                    document.getElementById("loader").style.display = "block";
                    setTimeout(showSearchResult, 1000);

                    function showSearchResult() {
                        document.getElementById("loader").style.display = "none";
                        $.ajax({
                            type: "GET",
                            url: "/search-images/" + query,
                            success: function (result) {
                                // console.log(result)
                                $('#images-data').html(result);
                                animateImageTitle();
                            },
                            error: function (error) {
                                $.jGrowl("Something went wrong!", {theme: 'error', life: 5000});
                            }
                        });
                    }
                } else {
                    alert("Invalid letter(s) found! Please type valid letters.");
                }
            }
        })
    });

    var up_file_name = null;

    function storeFileName(name) {
        up_file_name = name;
    }

    function emptyFileName() {
        up_file_name = null;
    }

    Dropzone.options.dropzone =
        {
            maxFiles: 1,
            maxFilesize: 5,
            renameFile: function (file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".png",
            addRemoveLinks: true,
            timeout: 5000,
            
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
            success: function (file, response) {
                // console.log(response.success);
                if (response.success) {
                    storeFileName(response.data);
                    console.log(up_file_name);
                }
            },
            error: function (file, response) {
                return false;
            },
            init: function () {
                this.on("error", function (file, message) {
                    alert(message);
                    this.removeFile(file);
                });
            }
        };

    function hideProgressBar() {
        document.getElementById("myProgress").style.display = "none";
    }

    var i = 0;

    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    function showProgressBar(title, up_file_name) {
        document.getElementById("myProgress").style.display = "block";
        if (i == 0) {
            i = 1;
            var elem = document.getElementById("myBar");
            var width = 1;
            var id = setInterval(frame, 10);

            function frame() {
                if (width >= 100) {
                    clearInterval(id);
                    i = 0;
                    $.ajax({
                        type: "POST",
                        url: "/upload-data",
                        data: {title: title, file: up_file_name},
                        success: function (data) {
                            hideProgressBar();
                            $.ajax({
                                type: "GET",
                                url: "/ajax-images",
                                success: function (result) {
                                    $('#images-data').html(result);
                                    animateImageTitle();
                                },
                                error: function (error) {
                                    $.jGrowl("Something went wrong!", {theme: 'error', life: 5000});
                                }
                            });
                            emptyFileName();
                            // console.log(up_file_name);
                            Dropzone.forElement('#dropzone').removeAllFiles(true);
                            $('#title').val('');
                            // console.log(data);
                            $.jGrowl("Uploaded successfully!", {theme: 'success', life: 5000});
                        },
                        error: function (error) {
                            $.jGrowl("Something went wrong!", {theme: 'error', life: 5000});
                        }
                    });
                } else {
                    width++;
                    elem.style.width = width + "%";
                }
            }
        }
    }

    $('#upload').on('click', function () {
        var title = $('#title').val();
        if (title.length > 0 && up_file_name != null) {
            showProgressBar(title, up_file_name);
        } else {
            if (title.length === 0 && up_file_name == null) {
                alert("Please choose at least one image with title.");
            } else if (title.length === 0) {
                alert("Image title field can't be empty!");
            } else {
                alert("Please choose at least one image.");
            }
        }
    })

    function animateImageTitle() {
        $('.img-title').each(function () {
            var contentHeight = this.scrollHeight;
            var contentWidth = this.scrollWidth;
            var $this = $(this);
            var visibleHeight = $this.height();
            var visibleWidth = $this.width();

            if (visibleHeight < contentHeight
                || visibleWidth < contentWidth) {
                // console.log('YES');
                $(this)
                    .bind('finished', function () {
                        //Change text to something else after first loop finishes
                        $(this).marquee('destroy');
                        $(this).marquee({
                            duration: 7000,
                            gap: 50,
                            delayBeforeStart: 0,
                            direction: 'left',
                            duplicated: true
                        });
                    })
                    .marquee({
                        duration: 7000,
                        gap: 50,
                        delayBeforeStart: 1000,
                        direction: 'right',
                        duplicated: true
                    });
            }
        })
    }
</script>

</body>
</html>
<?php /**PATH C:\Users\ASUS\Desktop\doorsoft_job_assignment\resources\views/images/image-list.blade.php ENDPATH**/ ?>