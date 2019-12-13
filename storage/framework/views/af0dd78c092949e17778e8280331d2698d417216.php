<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
    <div class="page-header">
        <h1><?php echo e($profileUser->name); ?>

        <small>since <?php echo e($profileUser->created_at->diffForHumans()); ?></small>
        </h1></div>

        <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="card">

                <div class="card-header">
                    <div class="level">
                <span class="flex">
                    <a href="#"><?php echo e($thread->creator->name); ?></a> posted <a href="<?php echo e($thread->path()); ?>"><?php echo e($thread->title); ?></a>
                </span>
                        <span><?php echo e($thread->created_at->diffForHumans()); ?></span>

            </div>
                </div>
                <div class="card-body">
                    <?php echo nl2br(e($thread->body)); ?>

                </div>
            </div>


        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php echo e($threads->links()); ?>

    </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/intransportal/resources/views/profiles/show.blade.php ENDPATH**/ ?>