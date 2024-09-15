

<?php $__env->startSection('content'); ?>

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">HADIAH</h1>
                <div>
                    <a href="<?php echo e(url('prizes/form?drawing_id=' . $_GET['drawing_id'] ?? '')); ?>" class="btn btn-primary rounded-pil">TAMBAH</a>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>UNDIAN</th>
                        <th>NAMA</th>
                        <th>JABATAN</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $prizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prize): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($prize->drawing->name ?? ''); ?></td>
                        <td><?php echo e($prize->name); ?></td>
                        <td><?php echo e($prize->jabatan); ?></td>
                        <td>
                            <a href="<?php echo e(url('drawings/form/' . $prize->id)); ?>">Edit</a> | 
                            <a href="<?php echo e(url('drawings/delete/' . $prize->id)); ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
        </div>
    </div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\undian\views/prize/index.blade.php ENDPATH**/ ?>