<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

  </head>
   <body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        @yield('content')
        @stack('scripts')
        @livewireScripts
    </body>
</html>