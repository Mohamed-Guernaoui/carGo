<!-- resources/views/components/layouts/guest.blade.php -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>
<div> <!-- Single root element wrapper -->
    <body class="font-sans antialiased bg-gray-50">

        <main class="min-h-screen">
            {{ $slot }}
        </main>

        <!-- Footer -->
        @livewireScripts
    </body>
</div>
