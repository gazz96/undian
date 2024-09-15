

<?php $__env->startSection('content'); ?>

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">PARTISIPAN</h1>
                <div>
                    
                    <a href="<?php echo e(url('participants/form?drawing_id=' . $_GET['drawing_id'] ?? '')); ?>" class="btn btn-primary rounded-pill">TAMBAH</a>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>UNDIAN</th>
                        <th>NIPP</th>
                        <th>NAMA</th>
                        <th>SUBAREA</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($participant->drawing->name ?? ''); ?></td>
                        <td><?php echo e($participant->nipp); ?></td>
                        <td><?php echo e($participant->name); ?></td>
                        <td><?php echo e($participant->subarea); ?></td>
                        <td>
                            <a href="<?php echo e(url('participants/form/' . $participant->id)); ?>">Edit</a> | 
                            <a href="<?php echo e(url('participants/delete/' . $participant->id)); ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
        </div>
    </div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bags1423/public_html/eden/views/participant/index.blade.php ENDPATH**/ ?>