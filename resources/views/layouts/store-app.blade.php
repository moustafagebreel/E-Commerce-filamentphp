<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apex E-Commerce Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen flex flex-col">

    @include('layouts.navbar')

    <main class="flex-1">
        {{ $slot }}
    </main>

    @include('layouts.footer')

    @livewire('toast-notification')

    @livewireScripts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>
