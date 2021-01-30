<html>

    @include('main.head')

    <header></header>

    <body>
        <div id="app">
            @include('main.nav')

            @include('main.flash')

            @include('main.sidebar')

            @yield('user')

            @include('main.footer')
        </div>
    </body>
</html>
