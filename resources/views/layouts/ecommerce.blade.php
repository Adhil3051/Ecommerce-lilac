<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Ecommerce')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('layouts.partials.header-script')
</head>

<body>
  {{-- @auth --}}
  @include('layouts.ecom-partials.header')
    
  {{-- @endauth --}}
    
    <div class="container-fluid py-4">
      

        <main class="flex-grow-1">
          
              @yield('content')
         
        </main>
     
    </div>
    @include('layouts.partials.footer-script')

</body>
</html>
