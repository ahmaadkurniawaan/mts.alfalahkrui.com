<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title ?? config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        {!! $page->styles !!}
    </style>
</head>

<body>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="min-h-screen">
            {!! $page->html !!}
        </div>
    </div>
</body>

</html>
