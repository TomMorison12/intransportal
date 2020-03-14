<?php $__env->startSection('content'); ?>
    <thread-view :initial-replies-count="<?php echo e($thread->replies_count); ?>" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="level">
                            <span class="flex"><a href="<?php echo e(page_url(null, 'profiles/'.$thread->creator->name)); ?>"><?php echo e($thread->creator->name); ?></a> posted <?php echo e($thread->title); ?></span>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $thread)): ?>
                            <form action="<?php echo e($thread->path()); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            <button type="submit" class="btn btn-link">Delete</button>
                        </form>
                        <?php endif; ?>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php echo nl2br(e($thread->body)); ?>

                    </div>
                </div>
                <replies @added="repliesCount++" @remove="repliesCount--"></replies>









            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        This thread was published <?php echo e($thread->created_at->diffForHumans()); ?> by <a href="#"><?php echo e($thread->creator->name); ?></a> and currently has <span v-text="repliesCount"></span> <?php echo e(str_plural('reply', $thread->replies_count)); ?>

                        <p>
                        <subscribe-button :active="<?php echo e(json_encode($thread->isSubscribedTo)); ?>"></subscribe-button>
                        </p>
                    </div>
                </div>
            </div>
        </div>



    </div>
    </thread-view>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/intransportal/resources/views/threads/show.blade.php ENDPATH**/ ?>