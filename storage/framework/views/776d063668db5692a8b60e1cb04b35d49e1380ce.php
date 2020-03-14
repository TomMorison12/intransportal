<?php $__empty_1 = true; $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="card">
        <div class="card-header">
            <div class="level">
                <div class="flex">
                    <h3>
                        <a href="<?php echo e($thread->path()); ?>">
                            <?php if(auth()->check() && $thread->hasUpdatesFor(auth()->user())): ?>
                                <strong>
                                    <?php echo e($thread->title); ?>

                                </strong>
                            <?php else: ?>
                                <?php echo e($thread->title); ?>

                            <?php endif; ?>
                        </a></h3>

                    <h4>Posted by: <a href="<?php echo e(route('profile', $thread->creator)); ?>"><?php echo e($thread->creator->name); ?></a></h4>
                </div>
                <strong><a href="<?php echo e($thread->path()); ?>"><?php echo e($thread->replies_count); ?> <?php echo e(str_plural('reply', $thread->replies_count)); ?></a></strong>
            </div>
        </div>
        <div class="card-body">
            <div class="body"><?php echo e($thread->body); ?></div>

        </div>
        <div class="card-footer">
            <?php echo e($thread->views()->count()); ?> views
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p>There are no relevant results at this time</p>

<?php endif; ?>
<?php /**PATH /home/vagrant/Code/intransportal/resources/views/threads/_list.blade.php ENDPATH**/ ?>