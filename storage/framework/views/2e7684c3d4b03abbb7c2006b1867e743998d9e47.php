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
    <style>
        .level {display: flex; align-items: center; }
        .level-item { margin-right: 1em; }
        .flex {flex: 1;}
        [v-cloak] {display: none;}
        .ml-a {margin-left: auto}
        .mr-a {margin-right: auto}
    </style>
    <?php echo $__env->yieldContent('head'); ?>
</head>
<body>
    <div id="app">
        <?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
            <flash message="<?php echo e(session('flash')); ?>"></flash>
        </main>
        <?php echo $__env->yieldContent('modal'); ?>

    </div>

    <script
        src="http://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
<?php /**PATH /home/vagrant/Code/intransportal/resources/views/layouts/app.blade.php ENDPATH**/ ?>