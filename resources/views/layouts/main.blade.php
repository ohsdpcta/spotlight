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

    <script>
        const flashmsg = new Vue({
            el: '#flash-message',
            data: {
                flash_show: false,
            },
            created: function() {
                setTimeout(() => {
                    this.flash_show = !this.flash_show;
                }, 100);
                setTimeout(() => {
                    this.flash_show = !this.flash_show;
                }, 3000);
            }
        });
    </script>

</html>
