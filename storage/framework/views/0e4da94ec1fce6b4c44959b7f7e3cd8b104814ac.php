<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php $__empty_1 = true; $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card">
                    <div class="card-header">
                    <div class="level">
                    <h3 class="flex"><a href="<?php echo e($thread->path()); ?>"><?php echo e($thread->title); ?></a></h3>
                    <strong><a href="<?php echo e($thread->path()); ?>"><?php echo e($thread->replies_count); ?> <?php echo e(str_plural('reply', $thread->replies_count)); ?></a></strong>
                    </div>
                    </div>
                    <div class="card-body">
                                <div class="body"><?php echo e($thread->body); ?></div>

                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p>There are no relevant results at this time</p>

                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/intransportal/resources/views/threads/index.blade.php ENDPATH**/ ?>