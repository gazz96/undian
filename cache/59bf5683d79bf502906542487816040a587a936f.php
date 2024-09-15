

<?php $__env->startSection('content'); ?>

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">FORM UNDIAN</h1>
            </div>
        </div>

        <div class="col-md-4">


            <form action="<?php echo e(url("drawings")); ?>" method="POST">
                
                <input type="hidden" name="truth_action" value="<?php echo e($drawing->id ? 'update' : 'create'); ?>">
                <input type="hidden" name="id" value="<?php echo e($drawing->id); ?>">

                <div class="mb-3">
                    <label for="">NAMA</label>
                    <input name="name" type="text" class="form-control" value="<?php echo e(old('name', $drawing->name)); ?>">
                    <?php if($error = error('name')): ?>
                    <div class="d-block invalid-feedback"><?php echo e($error); ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="">DURASI (DETIK)</label>
                    <input name="duration" type="text" class="form-control" value="<?php echo e(old('duration', $drawing->duration)); ?>">
                    <?php if($error = error('duration')): ?>
                    <div class="d-block invalid-feedback"><?php echo e($error); ?></div>
                    <?php endif; ?>
                </div>

            
                

                <button class="btn btn-primary">SIMPAN</button>

            </form>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\undian\views/drawing/form.blade.php ENDPATH**/ ?>