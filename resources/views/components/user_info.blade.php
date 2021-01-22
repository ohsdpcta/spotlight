<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js" type="text/javascript"></script>

<style>
    .myModal_popUp,
        input[name="myModal_switch"],
        #myModal_open + label ~ label {
            display: none;
        }
        #myModal_open + label,
        #myModal_close-button + label {
            cursor: pointer;
    }

    .myModal_popUp {
        animation: fadeIn 1s ease 0s 1 normal;
        -webkit-animation: fadeIn 1s ease 0s 1 normal;
    }
    #myModal_open:checked ~ #myModal_close-button + label{
        animation: fadeIn 2s ease 0s 1 normal;
        -webkit-animation: fadeIn 2s ease 0s 1 normal;
    }
    @keyframes fadeIn {
        0% {opacity: 0;}
        100% {opacity: 1;}
    }
    @-webkit-keyframes fadeIn {
        0% {opacity: 0;}
        100% {opacity: 1;}
    }

    #myModal_open:checked + label ~ .myModal_popUp {
        background: #fff;
        display: block;
        width: 90%;
        height: 80%;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        -webkit-transform: translate(-50%,-50%);
        -ms-transform: translate(-50%,-50%);
        z-index: 998;
    }

    #myModal_open:checked + label ~ .myModal_popUp > .myModal_popUp-content {
        width: calc(100% - 40px);
        height: calc(100% - 20px - 44px );
        padding: 10px 20px;
        overflow-y: auto;
        -webkit-overflow-scrolling:touch;
    }

    #myModal_open:checked + label + #myModal_close-overlay + label {
        background: rgba(0, 0, 0, 0.70);
        display: block;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        overflow: hidden;
        white-space: nowrap;
        text-indent: 100%;
        z-index: 997;
    }

    #myModal_open:checked ~ #myModal_close-button + label {
        display: block;
        background: #fff;
        text-align: center;
        font-size: 25px;
        line-height: 44px;
        width: 90%;
        height: 44px;
        position: fixed;
        bottom: 10%;
        left: 5%;
        z-index: 999;
    }
    #myModal_open:checked ~ #myModal_close-button + label::before {
        content: '×';
    }
    #myModal_open:checked ~ #myModal_close-button + label::after {
        content: 'CLOSE';
        margin-left: 5px;
        font-size: 80%;
    }

    @media (min-width: 768px) {
    #myModal_open:checked + label ~ .myModal_popUp {
        width: 600px;
        height: 500px;
        border-radius:15px;
    }
    #myModal_open:checked + label ~ .myModal_popUp > .myModal_popUp-content {
        height: calc(100% - 20px);
    }
    #myModal_open:checked ~ #myModal_close-button + label {
        width: 44px;
        height: 44px;
        left: 50%;
        top: 57%;
        margin-left: 240px;
        margin-top: -285px;
        overflow: hidden;
    }
    #myModal_open:checked ~ #myModal_close-button + label::after {
        display: none;
    }
    .guide {
        transition: all 0.5s linear 0s;
        border-radius: 50%;
        cursor: pointer;
    }
    .guide:hover {
        transform: rotateY(180deg);
    }
}
</style>

<section class="myModal">
    <input id="myModal_open" type="radio" name="myModal_switch" />
    <label for="myModal_open">
        <div class="fas fa-info-circle guide" style="color:#6bb6e9"></div>
    </label>
    <input id="myModal_close-overlay" type="radio" name="myModal_switch" />
    <label for="myModal_close-overlay">オーバーレイで閉じる</label>
    <input id="myModal_close-button" type="radio" name="myModal_switch" />
    <label for="myModal_close-button"></label>
    <div class="myModal_popUp">
        <div class="myModal_popUp-content col-10 offset-1">
            <h3 class="pt-3">パフォーマーとスポッター</h3>
            <hr>
            <h6 class="pb-3">パフォーマーかスポッターを選ぶことで、<br>
            それぞれ異なる機能を持つことができます。</h6>
            <p>パフォーマー...<br>
                自分の活動をより広く知ってもらうためのロール<br>
                パフォーマーの検索にあなたのユーザーネームが表示されるようになります。<br>
                ロケーションを登録している場合、あなたの登録した活動場所が他ユーザーのロケーションに表示されます。
            </p>
            <p>スポッター...<br>
                活動せず、他パフォーマーの応援をしたい人へのロール<br>
                パフォーマーの検索に自分のユーザーネームが表示されず、<br>ロケーションを登録することができません。
            </p>
        </div>
    </div>
</section>