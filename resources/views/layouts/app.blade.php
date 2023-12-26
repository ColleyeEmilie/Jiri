<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jiri') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen flex bg-gray-100">
    <div class="fixed py-16 bg-white">
        @include('layouts.navigation')
    </div>
    <div class="w-full pl-40">
        @if (isset($header))
            <header class="bg-white shadow pl-6">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="pl-6">
            {{ $slot }}
        </main>
    </div>
    <!-- Page Heading -->
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('lists', () => ({
            openStudent: false,
            openJury: false,
            currentJury: [],
            currentStudent: [],
            currentProject: [],

            splitStringProject(project) {
                this.currentProject = project.split(/[,:;]+/);
                return this.currentProject;
            },
            splitStringJury(name) {
                this.currentJury = name.split(/[,:]+/);
                return this.currentJury;
            },
            splitStringStudent(name) {
                this.currentStudent = name.split(/[,:]+/);
                return this.currentStudent;
            },
            noValue() {
                this.currentStudent = [];
                this.currentJury = [];
                this.currentProject = [];
            }
        }))
    })
</script>
</body>
</html>
