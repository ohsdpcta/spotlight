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
        // ドロップダウン
        const app = new Vue({
            el: '#app',
            data: {
                dropdown_show: false,
            }
        });

        // フラッシュメッセージ
        const flashmsg = new Vue({
            el: '#flash-message',
            data: {
                show: false,
            },
            created: function() {
                setTimeout(() => {
                    this.show = !this.show;
                }, 100);
                setTimeout(() => {
                    this.show = !this.show;
                }, 3000);
            }
        });
    </script>

</html>
