<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title') - Admin Panel</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  @include('components.admin_header')

  <main>
    @yield('content')
  </main>

  @include('components.admin_footer')
</body>
</html>
