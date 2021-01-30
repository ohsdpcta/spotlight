// サイドバー
$(function() {
    $('.btn_menu').click(function() { $('nav.sidebar').toggleClass('open'); });
    $('.btn_menu').click(function() { $('button.btn_menu').toggleClass('open'); });

    $(document).click(function(e) {
        // クリックした場所がmenu-wrapper(領域内とみなす範囲)に無ければmenuを消す
        if (!$.contains($('div.side-content')[0], e.target)) {
            if ($('nav.sidebar').hasClass('open')) {
                $('nav.sidebar').removeClass('open');
            }
            if ($('button.btn_menu').hasClass('open')) {
                $('button.btn_menu').removeClass('open');
            }
        }
    });
});

const listener = {
    methods:{
        listen :function(target, eventType, callback) {
            if (!this._eventRemovers){
                this._eventRemovers = [];
            }
            target.addEventListener(eventType, callback);
            this._eventRemovers.push( {
                remove :function() {
                    target.removeEventListener(eventType, callback)
                }
            })
        }
    },
    destroyed:function(){
        if (this._eventRemovers){
            this._eventRemovers.forEach(function(eventRemover){
                eventRemover.remove();
            });
        }
    }
}

Vue.component('dropdown-menu', {
    mixins:[listener],
    template: '#dropdown-template',
    created:function(){
        this.listen(window, 'click', function(e){
            if (!this.$el.contains(e.target)){
                this.$emit('close');
            }
        }.bind(this));
    }
});
