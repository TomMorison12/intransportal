<?php $__env->startComponent('profiles.activities.activity'); ?>
    <?php $__env->slot('heading'); ?>

        <?php echo e($profileUser->name); ?> published <a href="<?php echo e($activity->subject); ?>"><?php echo e($activity->subject->title); ?></a>

    <?php $__env->endSlot(); ?>
    <?php $__env->slot('body'); ?>
    <?php echo e($activity->subject->body); ?>

    <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<?php /**PATH /home/vagrant/Code/intransportal/resources/views/profiles/activities/created_thread.blade.php ENDPATH**/ ?>