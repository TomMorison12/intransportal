<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php if(isset($page_title)): ?>
    <title><?php echo e(config('app.name', 'InTransPortal').' - '.$page_title); ?></title>
    <?php else: ?>
        <title><?php echo e(config('app.name', 'InTransPortal')); ?></title>
    <?php endif; ?>

    <!-- Scripts -->
    <script>
      window.App = <?php echo json_encode([
        'user' => Auth::user(),
        'signedIn' => Auth::check()
    ]);; ?>

    </script>

<    <script src="<?php echo e(asset('js/app.js')); ?>" defer>
</script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">


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

        body {
            padding-bottom: 100px;
            font-size: 14px !important;
        }
        .level {display: flex; align-items: center; }
        .flex {flex: 1;}
        [v-cloak] {display: none;}
    </style>
</head>
<body>
    <div id="app">
        <?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        <flash message="<?php echo e(session('flash')); ?>"></flash>
    </div>
</body>
</html>
<?php /**PATH /home/vagrant/Code/intransportal/resources/views/layouts/app.blade.php ENDPATH**/ ?>