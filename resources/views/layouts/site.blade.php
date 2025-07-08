<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'My Laravel Site')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('components.site_header')

    <main>
        @yield('content')
    </main>

    @include('components.site_footer')
</body>
</html>
