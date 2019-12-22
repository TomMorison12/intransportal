<?php $__env->startComponent('profiles.activities.activity'); ?>
    <?php $__env->slot('heading'); ?>

        <?php echo e($profileUser->name); ?> posted a reply to <a href="<?php echo e($activity->subject->thread->path()); ?>"><?php echo e($activity->subject->thread->title); ?></a>

        <?php $__env->endSlot(); ?>
    <?php $__env->slot('body'); ?>

    <?php echo e($activity->subject->body); ?>

    <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>


<?php /**PATH /home/vagrant/Code/intransportal/resources/views/profiles/activities/created_reply.blade.php ENDPATH**/ ?>