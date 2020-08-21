<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        @include('layouts.partials.navigation')

        @yield('content')

        @include('layouts.partials.footer')
    </body>
</html>
