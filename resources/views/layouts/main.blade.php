<html>

    @include('layouts.main.head')

    <header></header>

    <body>
        <div id="app">
            @include('layouts.main.nav')

            @include('layouts.main.flash')

            @include('layouts.main.sidebar')

            @yield('user')

            @include('layouts.main.footer')
        </div>
    </body>
</html>
