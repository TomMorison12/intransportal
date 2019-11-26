<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'InTransPortal')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <style type="text/css">
        .navbar-nav li:hover > ul.dropdown-menu {
            display: block;
        }
        .dropdown-submenu {
            position:relative;
        }
        .dropdown-submenu>.dropdown-menu {
            top: 0;
            left: 100%;
            margin-top:-6px;
        }

        /* rotate caret on hover */
        .dropdown-menu > li > a:hover:after {
            text-decoration: underline;
            transform: rotate(-90deg);
        }

        body { padding-bottom: 100px; }
        .level {display: flex; align-items: center; }
        .flex {flex: 1;}
    </style>
</head>
<body>
<?php if(Session::has('success')): ?>
    <div class="alert alert-success">
        <?php echo e(Session::get('success')); ?>

    </div>
<?php endif; ?>

<?php if(Session::has('fail')): ?>
    <div class="alert alert-danger">
        <?php echo e(Session::get('fail')); ?>

    </div>
<?php endif; ?>
    <div id="app">
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


                    <ul class="nav navbar-nav">
                        <li class="dropdown"><a href="#" tabindex="-1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Forum</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu"><a href="#" tabindex="-2" aria-haspopup="true">Browse</a>

                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo e(url('forum/threads')); ?>">All threads</a></li>
                                <?php if(auth()->check()): ?>
                                <li><a href="<?php echo e(url('/forum/threads?by='. Auth::user()->name)); ?>">My threads</a></li>
                                    <?php endif; ?>
                                    <li><a href="<?php echo e(url('forum/threads?popular=1')); ?>">Popular threads</a></li>
                                </ul>


                        <li class="dropdown-submenu">
                            <a href="#" tabindex="-2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Channels</a>
                                 <ul class="dropdown-menu">
                                <?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(url('/forum/threads/'.$channel->slug)); ?>"><?php echo e($channel->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        </li>
                        <?php if(auth()->check()): ?>
                        <li class="list-group-item"><a href="<?php echo e(url('forum/threads/create')); ?>">Create Thread</a></li>
                        <?php endif; ?>
                        </ul>


                        <li><a href="#">Wiki</a></li>
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
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
        </nav>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
</body>
</html>
<?php /**PATH /home/vagrant/Code/intransportal/resources/views/layouts/app.blade.php ENDPATH**/ ?>