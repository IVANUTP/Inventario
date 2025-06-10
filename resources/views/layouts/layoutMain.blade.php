<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Título por Defecto')</title>
     @vite('resources/css/app.css')
</head>

<body>
    <div class="flex-1 ml-64 p-8">
        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
