<html>

    @include('layouts.main.head')

    <header></header>

    <body class="d-flex flex-column h-100">
        @include('layouts.main.nav')

        @include('layouts.main.flash')

        @include('layouts.main.sidebar')

        @yield('user')

        @include('layouts.main.footer')
    </body>
</html>
