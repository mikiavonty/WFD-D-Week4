<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
  </head>
  <body>
    <div class="w-lg mx-auto py-10">
        {{-- <h1 class="text-3xl font-bold underline">
            Hello world!
        </h1> --}}
        @yield('content')
    </div>    
    @vite('resources/js/app.js')
  </body>
</html>