<html>

    @include('main.head')

    <header></header>

    <body>
        <div id="app">
            {{-- navbar --}}
            @include('main.nav')

            @include('main.flash')

            {{ session()->flash('flash_message', 'グッズの登録が完了しました') }}
            @include('main.sidebar')

            @yield('user')

            @include('main.footer')
        </div>
    </body>

    <script>
        // ドロップダウン
        const dropdown = new Vue({
            el: '#dropdown-container',
            data: {
                dropdown_show: false,
            },
            created:function(){
                this.listen(window, 'click', function(e){
                    if (!this.$el.contains(e.target)){
                        this.$emit('close');
                    }
                }.bind(this));
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
