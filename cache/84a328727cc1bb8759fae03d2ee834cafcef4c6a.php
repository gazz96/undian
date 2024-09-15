

<?php $__env->startSection('content'); ?>

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">UNDIAN</h1>
                <div>
                    <a href="<?php echo e(url('drawings/form')); ?>" class="btn btn-primary rounded-pil">TAMBAH</a>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NAMA</th>
                        <th>DURASI</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $drawings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drawing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($drawing->name); ?></td>
                        <td><?php echo e($drawing->duration); ?> Detik</td>
                        <td>
                            <a href="<?php echo e(url('drawings/form/' . $drawing->id)); ?>">Edit</a> | 
                            <a href="<?php echo e(url('drawings/delete/' . $drawing->id)); ?>">Hapus</a> | 
                            <a href="<?php echo e(url('participants?drawing_id=' . $drawing->id)); ?>" target="_blank">Partisipan</a> | 
                            <a href="<?php echo e(url('?drawing_id=' . $drawing->id)); ?>" target="_blank">Mulai</a>
                            
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
        </div>
    </div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\undian\views/drawing/index.blade.php ENDPATH**/ ?>