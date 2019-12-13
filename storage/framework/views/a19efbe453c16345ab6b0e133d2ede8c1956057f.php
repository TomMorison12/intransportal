<div class="card mt-2">

    <div class="card-header">
        <div class="level">
            <h5 class="flex">
        <a href="<?php echo e(url('profiles/'. $reply->owner->name)); ?>"><?php echo e($reply->owner->name); ?></a> said <?php echo e($reply->created_at->diffForHumans()); ?>

            </h5>
<?php if(auth()->check()): ?>

<div>
    <form action="/forum/replies/<?php echo e($reply->id); ?>/favorite" method="post">
        <?php echo e(csrf_field()); ?>

        <button type="submit" class="btn btn-default" <?php echo e($reply->isFavorited() ? 'disabled' : ''); ?>>
        <?php echo e($reply->favorites_count); ?> <?php echo e(str_plural('Favorites', $reply->favorites_count)); ?></button>
    </form>
</div>
<?php endif; ?>
</div>
</div>

<div class="card-body">
    <?php echo nl2br(e($reply->body)); ?>


</div>
</div>
<?php /**PATH /home/vagrant/Code/intransportal/resources/views/threads/reply.blade.php ENDPATH**/ ?>