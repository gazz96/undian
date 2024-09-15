

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
                        <th>PARTISIPAN</th>
                        <th width="150">DURASI</th>
                        <th width="250"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $drawings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drawing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($drawing->name); ?></td>
                        <td><?php echo e($drawing->participants()->count() ?? 0); ?> Orang</td>
                        <td><?php echo e($drawing->duration); ?> Detik</td>
                        <td>
                            <a href="<?php echo e(url('drawings/form/' . $drawing->id)); ?>" class="btn rounded-pill border me-2 mb-2">
                                <span class="bi bi-pencil"></span>
                            </a>
                            <a href="<?php echo e(url('drawings/delete/' . $drawing->id)); ?>" class="btn rounded-pill border me-2 mb-2">
                                <span class="bi bi-trash"></span>
                            </a>
                            
                            <a href="<?php echo e(url('participants?drawing_id=' . $drawing->id)); ?>" target="_blank" class="btn rounded-pill border me-2 mb-2">
                                <span class="bi bi-people"></span>
                            </a> 
                            
                            <a href="<?php echo e(url('participants/truncate/' . $drawing->id)); ?>" class="btn rounded-pill border me-2 mb-2" title="TRUNCATE PARTISIPAN">
                                <span class="bi bi-person-slash"></span>
                            </a> 
                            
                            <a href="<?php echo e(url('?drawing_id=' . $drawing->id)); ?>" target="_blank" class="btn rounded-pill border me-2 mb-2">
                                <span class="bi bi-play"></span> 
                            </a>
                            <a href="#modal-partisipan-<?php echo e($drawing->id); ?>" data-bs-toggle="modal" class="btn rounded-pill border me-2 mb-2">
                                <span class="bi bi-file-earmark-excel"></span>
                            </a>
                            
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            
        </div>
    </div>

</div>

<?php $__currentLoopData = $drawings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drawing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<!-- MODAL IMPORT PARTICIPANT <?php echo e($drawing->name); ?> -->
<div class="modal fade" id="modal-partisipan-<?php echo e($drawing->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">IMPORT PARTISIPAN</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo e(url('participants/import/' . $drawing->id)); ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label>FILE</label>
                <input type="file" name="file" class="form-control form-custom-file">
            </div>
            
            <button class="btn btn-primary">IMPORT</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/bags1423/public_html/eden/views/drawing/index.blade.php ENDPATH**/ ?>