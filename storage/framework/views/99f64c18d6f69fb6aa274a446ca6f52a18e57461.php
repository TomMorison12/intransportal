<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            <?php echo e(config('app.name', 'InTransPortal')); ?>

        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php echo e(__('Toggle navigation')); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->


            <ul class="nav navbar-nav flex">
                <li class="dropdown"><a href="#" tabindex="-1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                        aria-expanded="false">Forum</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu"><a href="#" tabindex="-2" aria-haspopup="true">Browse</a>

                            <ul class="dropdown-menu">
                                <li><a href="<?php echo e(page_url('forum', 'threads')); ?>">All threads</a></li>
                                <?php if(auth()->check()): ?>
                                    <li><a href="<?php echo e(page_url('forum', 'threads?by='. Auth::user()->name)); ?>">My threads</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo e(page_url('forum','threads?popular=1')); ?>">Popular threads</a></li>
                                <li><a href="<?php echo e(page_url('forum', 'threads?unanswered=1')); ?>">Unanswered threads</a></li>
                            </ul>


                        <li class="dropdown-submenu">
                            <a href="#" tabindex="-2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Channels</a>
                            <ul class="dropdown-menu">
                                <?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(page_url('forum','/threads/'.$channel->slug)); ?>"><?php echo e($channel->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        </li>
                        <?php if(auth()->check()): ?>
                            <li class="list-group-item"><a href="<?php echo e(page_url('forum','threads/create')); ?>">Create Thread</a></li>
                        <?php endif; ?>
                    </ul>


                <li class="dropdown flex"><a href="#" tabindex="-1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                          aria-expanded="false">Wiki</a>
                    <ul class="dropdown-menu">
                    
                        <li class="list-group-item"><a href="<?php echo e(route('wiki.index')); ?>">Main page</a></li>
                    </ul>

               </li>

         </ul>

        </div>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <?php if(auth()->guard()->guest()): ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                </li>
                <?php if(Route::has('register')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                    </li>
                <?php endif; ?>
            <?php else: ?>
                <user-notifications></user-notifications>
                <li class="nav-item dropdown">

                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                    </a>




                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>


                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>

                        <a class="dropdown-item" href="<?php echo e(route('profile', Auth::user())); ?>">My Profile</a>



                    </div>
                </li>

            <?php endif; ?>
        </ul>
    </div>
</nav>
<?php /**PATH /home/vagrant/Code/intransportal/resources/views/layouts/nav.blade.php ENDPATH**/ ?>