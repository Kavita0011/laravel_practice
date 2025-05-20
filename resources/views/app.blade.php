<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>React App</title>

    @viteReactRefresh
    @vite(['resources/js/app1.jsx'])
</head>
<body>
    <div id="app"></div>
</body>
</html>
