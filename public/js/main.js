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