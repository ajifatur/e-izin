<!DOCTYPE html>
<html lang="en">
    <head>
        @include('template/_head')
        @yield('css')
        <title>@yield('title') | {{ setting('name') }}</title>
    </head>
    <body class="app sidebar-mini">
        @include('template/_header')
        @include('template/_sidebar')
        @yield('content')
        @include('template/_js')
        @yield('js')
    </body>
</html>