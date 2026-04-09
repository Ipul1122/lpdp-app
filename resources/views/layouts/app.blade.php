<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LPDP App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-800">

    @include('layouts.sidebar')

    @include('layouts.navbar')

    <main class="ml-20 p-8 min-h-[calc(100vh-5rem)]">
        @yield('content')
    </main>

</body>
</html>