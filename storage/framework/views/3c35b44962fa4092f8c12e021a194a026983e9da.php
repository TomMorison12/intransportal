<?php $__env->startSection('content'); ?>
        <div class="row">

    <div class="col-md-8 offset-4">


            <subcategory country="<?php echo e($country); ?>" cid="<?php echo e($cid); ?>"></subcategory>


    </div>

        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/intransportal/resources/views/categories/list.blade.php ENDPATH**/ ?>