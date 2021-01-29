<html>

    @include('main.head')

    <header></header>

    <body>
        <div id="app">
            {{-- navbar --}}
            @include('main.nav')

            @include('main.flash')

            {{ session()->flash('flash_message', 'Test Flash Message.') }}
            @include('main.sidebar')

            @yield('user')

            @include('main.footer')
        </div>
    </body>

    <script>
        const dropdown = new Vue({
            el: '#dropdown-control',
            data: {
                dropdown_show: false,
            }
        });

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
