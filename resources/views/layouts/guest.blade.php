<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title ?? config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    @stack('styles')
</head>

<body>
    {{ $slot }}
    @livewireScripts
    @stack('scripts')
</body>

</html>
