<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Forum threads</div>

                    <div class="card-body">
                        <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article>
                                <div class="level">
                                    <h3 class="flex"><a href="<?php echo e($thread->path()); ?>"><?php echo e($thread->title); ?></a></h3>
                                    <strong><a href="<?php echo e($thread->path()); ?>"><?php echo e($thread->replies_count); ?> <?php echo e(str_plural('reply', $thread->replies_count)); ?></a></strong>
                                </div>

                                <div class="body"><?php echo e($thread->body); ?></div>
                            </article>
                            <hr />

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/intransportal/resources/views/threads/index.blade.php ENDPATH**/ ?>