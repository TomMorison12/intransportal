<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
    <div class="page-header">
        <h1><?php echo e($profileUser->name); ?>

        <small>since <?php echo e($profileUser->created_at->diffForHumans()); ?></small>
        </h1>
        <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <h3 class="page-header"><?php echo e($date); ?></h3>
            <?php $__currentLoopData = $activity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(view()->exists('profiles.activities.'.$record->type)): ?>
            <?php echo $__env->make('profiles.activities.'.$record->type, ['activity'  => $record], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>There is no activity for this user yet</p>
        <?php endif; ?>


    </div>
        </div>
    </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/intransportal/resources/views/profiles/show.blade.php ENDPATH**/ ?>