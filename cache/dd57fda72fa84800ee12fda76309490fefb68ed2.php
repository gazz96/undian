

<?php $__env->startSection('content'); ?>

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">FORM USERS</h1>
            </div>
        </div>

        <div class="col-md-4">


            <form action="<?php echo e(url("users")); ?>" method="POST">
                
                <input type="hidden" name="truth_action" value="<?php echo e($user->id ? 'update' : 'create'); ?>">
                <input type="hidden" name="id" value="<?php echo e($user->id); ?>">

                <div class="mb-3">
                    <label for="">NAMA LENGKAP</label>
                    <input name="name" type="text" class="form-control" value="<?php echo e(old('name', $user->name)); ?>">
                    <?php if($error = error('name')): ?>
                    <div class="d-block invalid-feedback"><?php echo e($error); ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="">USERNAME</label>
                    <input name="username" type="text" class="form-control" value="<?php echo e(old('username', $user->username)); ?>">
                    <?php if($error = error('username')): ?>
                    <div class="d-block invalid-feedback"><?php echo e($error); ?></div>
                    <?php endif; ?>
                </div>

                
                <div class="mb-3">
                    <label for="">PASSWORD</label>
                    <input name="password" type="password" class="form-control">
                    <?php if($error = error('password')): ?>
                    <div class="d-block invalid-feedback"><?php echo e($error); ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="">STATUS</label>
                    <select name="status" id="i-status" class="form-control">
                        <?php $__currentLoopData = ['ON', 'OFF']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status); ?>" <?php echo e(($status == old('status', $user->status)) ? 'selected' : ''); ?>><?php echo e($status); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if($error = error('status')): ?>
                    <div class="d-block invalid-feedback"><?php echo e($error); ?></div>
                    <?php endif; ?>
                </div>

                <button class="btn btn-primary">SIMPAN</button>

            </form>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\undian\views/user/form.blade.php ENDPATH**/ ?>