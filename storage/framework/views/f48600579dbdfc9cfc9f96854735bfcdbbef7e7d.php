<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a New Thread</div>
                    <form method="post" action="/forum/threads">

                        <?php echo e(csrf_field()); ?>


                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="channel">Choose a channel:</label>
                                <select class="form-control" name="channel_id" id="channel_id" required>
                                    <option>Choose one:</option>
                                    <?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <option value="<?php echo e($channel->id); ?>" <?php echo e(old('channel_id') == $channel->id ? 'selected' : ''); ?>><?php echo e($channel->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="title">TItle:</label>
                            <input type="text" class="form-control" name="title" value="<?php echo e(old('title')); ?>" required/>
                        </div>
                        </div>

                      <div class="form-group">
                          <label for="body">Body:</labeL>
                          <textarea name="body" class="form-control" id="body" rows="8" required><?php echo e(old('body')); ?></textarea>
                      </div>

                        <input type="submit" name="submit" class="btn btn-primary" value="Post" />
                        <div class="form-hroup">
                            <?php if(count($errors)): ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <ul class="alert alert-danger">
                                    <li><?php echo e($error); ?></li>
                                </ul>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </div>


                    </form>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/Code/intransportal/resources/views/threads/create.blade.php ENDPATH**/ ?>