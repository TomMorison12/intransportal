<div class="card" v-if=editing>
                    <div class="card-header">

                            <input class="form-control" type="text" class="flex" name="title" v-model="form.title" />
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <textarea rows="20" cols="20" class="form-control" v-model="form.body"></textarea>
                         </div>
                    </div>
                    <div class="card-footer">
                    <div class="level">
                        <button class="btn btn-xs level-item" @click="update">Update</button>
                        <button class="btn btn-xs level-item" @click="editing = false">Cancel</button>


                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $thread)): ?>
                            <form action="<?php echo e($thread->path()); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                        </form>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>

<div class="card" v-if=!editing>
                    <div class="card-header">
                        <div class="level flex">
                            <?php if($thread->creator->avatar_path): ?>
                            <img src="<?php echo e(asset('/storage/'.$thread->creator->avatar_path)); ?>" width="25" height="25" class="mr-1" />
                            <?php endif; ?>
                            <span class="flex"><a href="<?php echo e(route('profile', $thread->creator->name)); ?>"><?php echo e($thread->creator->name); ?></a> posted <span v-text="form.title"></span></span>

                        </div>
                    </div>
                    <div class="card-body" v-text="form.body">
                    </div>
                    <div class="card-footer">
                    <div class="level">

                    <button class="btn btn-xs level-item" @click="editing = true" v-show="!editing">Edit</button>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $thread)): ?>
                            <form action="<?php echo e($thread->path()); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('DELETE')); ?>

                            <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                        </form>
                        <?php endif; ?>
                        </div>

                    </div>
                </div>
<?php /**PATH /home/vagrant/Code/intransportal/resources/views/threads/_question.blade.php ENDPATH**/ ?>