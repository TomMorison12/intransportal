<?php $__env->startSection('content'); ?>
    <thread-view :thread="<?php echo e($thread); ?>" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                    <?php echo $__env->make('threads._question', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <replies @added="repliesCount++" @remove="repliesCount--"></replies>









            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        This thread was published <?php echo e($thread->created_at->diffForHumans()); ?> by <a href="#"><?php echo e($thread->creator->name); ?></a> and currently has <span v-text="repliesCount"></span> <?php echo e(str_plural('reply', $thread->replies_count)); ?>

                        <p>
                        <subscribe-button v-if="signedIn" :active="<?php echo e(json_encode($thread->isSubscribedTo)); ?>"></subscribe-button>
                        <button class="btn btn-default" v-if="authorize('isAdmin')" @click="lock" v-text="locked ? 'Unlock' : 'Lock'"></button>
                        </p>
                    </div>
                </div>
            </div>
        </div>



    </div>
    </thread-view>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/intransportal/resources/views/threads/show.blade.php ENDPATH**/ ?>