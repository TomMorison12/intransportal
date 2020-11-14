<?php $__env->startSection('content'); ?>
<div class="container">

    <div class="col-md-6 offset-3">

        <subcategory country="<?php echo e($country); ?>" cid="<?php echo e($cid); ?>" slug="<?php echo e($slug); ?>"></subcategory>
    </div>

</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <modal name="<?php echo e($city->name.'-modal'); ?>">
                    <h3>Upload a photo</h3>

        </modal>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/intransportal/resources/views/categories/list.blade.php ENDPATH**/ ?>