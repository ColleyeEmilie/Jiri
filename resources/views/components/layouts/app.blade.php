<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../../../css/app.css" rel="stylesheet" />
        <title>{{ $title ?? 'Page Title' }}</title>
        <style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
        </style>
    </head>
    <body>
    @include('layouts.navigation')
    {{ $slot }}
    </body>
</html>
