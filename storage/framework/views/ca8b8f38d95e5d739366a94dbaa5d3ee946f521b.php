<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="#"><?php echo e($thread->creator->name); ?></a> posted <?php echo e($thread->title); ?></div>

                    <div class="card-body">
                        <?php echo nl2br(e($thread->body)); ?>

                    </div>
                </div>

                <?php $__currentLoopData = $replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('threads.reply', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php echo e($replies->links()); ?>


                <?php if(auth()->check()): ?>

                    <form method="post" action="<?php echo e($thread->path() . '/replies'); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group mt-2">
                            <textarea rows="5" name="body" id="body" class="form-control" placeholder="Have something to say?"></textarea>
                            <button type="submit" name="submit" class="btn btn-primary">Post</button>
                        </div>
                    </form>



                <?php else: ?>
                    <p class="text-center">Please <a href="<?php echo e(route('login')); ?>">login</a> to participate in this discussion</p>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        This thread was published <?php echo e($thread->created_at->diffForHumans()); ?> by <a href="#"><?php echo e($thread->creator->name); ?></a> and currently has <?php echo e($thread->replies_count); ?> <?php echo e(str_plural('reply', $thread->replies_count)); ?>

                    </div>
                </div>
            </div>
        </div>



    </div>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/intransportal/resources/views/threads/show.blade.php ENDPATH**/ ?>