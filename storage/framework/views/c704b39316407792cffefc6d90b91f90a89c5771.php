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
<?php /**PATH F:\Laravel\doorsoft_job_assignment\resources\views/images/ajax-image-list.blade.php ENDPATH**/ ?>