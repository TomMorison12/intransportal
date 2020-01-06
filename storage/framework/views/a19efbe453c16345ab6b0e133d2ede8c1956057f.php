<reply :attributes="<?php echo e($reply); ?>" inline-template v-cloak>
<div id="reply-<?php echo e($reply->id); ?>" class="card mt-2">

    <div class="card-header">
        <div class="level">
            <h5 class="flex">
        <a href="<?php echo e(url('profiles/'. $reply->owner->name)); ?>"><?php echo e($reply->owner->name); ?></a> said <?php echo e($reply->created_at->diffForHumans()); ?>

            </h5>
<?php if(auth()->check()): ?>

<div>
  <?php if(Auth::check()): ?>
    <favorite :reply="<?php echo e($reply); ?>"></favorite>
    <?php endif; ?>
</div>
<?php endif; ?>
</div>
</div>

<div class="card-body">
    <div v-if="editing">
       <div class="form-group">
           <textarea class="form-control" v-model="body"></textarea>
           <button class="btn btn-sm btn-primary" @click="update">Update</button>
           <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
       </div>
    </div>
    <div v-else v-text="body">

    </div>
</div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $reply)): ?>
    <div class="panel-footer level">
        <button class="btn btn-sm" style="margin-right: 1em" @click="editing = true">Edit</button>
        <button class="btn btn-danger btn-sm" style="margin-right: 1em" @click="destroy">Delete</button>

    </div>
        <?php endif; ?>

</div>
</reply>
<?php /**PATH /home/vagrant/Code/intransportal/resources/views/threads/reply.blade.php ENDPATH**/ ?>