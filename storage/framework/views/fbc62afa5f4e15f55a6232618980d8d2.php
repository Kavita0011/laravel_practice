<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>React App</title>

    <?php echo app('Illuminate\Foundation\Vite')->reactRefresh(); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/App.jsx']); ?>
</head>
<body>
    <div id="app"></div>
</body>
</html>
<?php /**PATH C:\Users\LENOVO\OneDrive\Desktop\EverGreen Brain\laravel_practice\laravel\resources\views/app.blade.php ENDPATH**/ ?>