<div class="card mt-2">

    <div class="card-header"><a href="$"><?php echo e($reply->owner->name); ?></a> said <?php echo e($reply->created_at->diffForHumans()); ?></div>


    <div class="card-body">
{<?php echo nl2br(e($reply->body)); ?>}

    </div>
</div>
<?php /**PATH /home/vagrant/Code/intransportal/resources/views/threads/reply.blade.php ENDPATH**/ ?>