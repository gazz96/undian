

<?php $__env->startSection('content'); ?>

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">FORM PARTISIPAN</h1>
            </div>
        </div>

        <div class="col-md-4">


            <form action="<?php echo e(url("participants")); ?>" method="POST">
                
                <input type="hidden" name="truth_action" value="<?php echo e($participant->id ? 'update' : 'create'); ?>">
                <input type="hidden" name="id" value="<?php echo e($participant->id); ?>">
                
                <div class="mb-3">
                    <label for="">UNDIAN</label>
                    <select name="drawing_id" id="i-drawing_id" class="form-control">
                        <option value="">PILIH UNDIAN</option>
                        <?php $__currentLoopData = $drawings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drawing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($drawing->id); ?>" <?php echo e(($drawing->id == old('drawing_id', $_GET['drawing_id'] ?? $participant->drawing_id)) ? 'selected' : ''); ?>><?php echo e($drawing->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($error = error('drawing_id')): ?>
                    <div class="d-block invalid-feedback"><?php echo e($error); ?></div>
                    <?php endif; ?>
                </div> 

                <div class="mb-3">
                    <label for="">NIPP</label>
                    <input name="nipp" type="text" class="form-control" value="<?php echo e(old('nipp', $participant->nipp)); ?>">
                    <?php if($error = error('nipp')): ?>
                    <div class="d-block invalid-feedback"><?php echo e($error); ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="">NAMA</label>
                    <input name="name" type="text" class="form-control" value="<?php echo e(old('name', $participant->name)); ?>">
                    <?php if($error = error('name')): ?>
                    <div class="d-block invalid-feedback"><?php echo e($error); ?></div>
                    <?php endif; ?>
                </div>

                
                <div class="mb-3">
                    <label for="">SUBAREA</label>
                    <input name="subarea" type="text" class="form-control" value="<?php echo e(old('subarea', $participant->subarea)); ?>">
                    <?php if($error = error('subarea')): ?>
                    <div class="d-block invalid-feedback"><?php echo e($error); ?></div>
                    <?php endif; ?>
                </div>

            
                
                <a href="<?php echo e(url('/participants?drawing_id=' . ($_GET['drawing_id'] ?? ''))); ?>" class="btn btn-light">KEMBALI</a>
                <button class="btn btn-primary">SIMPAN</button>

            </form>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\undian\views/participant/form.blade.php ENDPATH**/ ?>