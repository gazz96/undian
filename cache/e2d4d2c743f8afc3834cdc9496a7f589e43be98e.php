

<?php $__env->startSection('content'); ?>

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">USERS</h1>
                <div>
                    <a href="<?php echo e(url('users/form')); ?>" class="btn btn-primary rounded-pil">TAMBAH</a>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NAMA</th>
                        <th>USERNAME</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->username); ?></td>
                        <td><?php echo e($user->status); ?></td>
                        <td>
                            <a href="<?php echo e(url('users/form/' . $user->id)); ?>">Edit</a> | 
                            <a href="<?php echo e(url('users/delete/' . $user->id)); ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\undian\views/user/index.blade.php ENDPATH**/ ?>