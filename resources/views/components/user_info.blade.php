<style>
    .{{ $modal_name }}_popUp,
        input[name="{{ $modal_name }}_switch"],
        #{{ $modal_name }}_open + label ~ label {
            display: none;
        }
        #{{ $modal_name }}_open + label,
        #{{ $modal_name }}_close-button + label {
            cursor: pointer;
    }

    .{{ $modal_name }}_popUp {
        animation: fadeIn 1s ease 0s 1 normal;
        -webkit-animation: fadeIn 1s ease 0s 1 normal;
    }
    #{{ $modal_name }}_open:checked ~ #{{ $modal_name }}_close-button + label{
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

    #{{ $modal_name }}_open:checked + label ~ .{{ $modal_name }}_popUp {
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

    #{{ $modal_name }}_open:checked + label ~ .{{ $modal_name }}_popUp > .{{ $modal_name }}_popUp-content {
        width: calc(100% - 40px);
        height: calc(100% - 20px - 44px );
        padding: 10px 20px;
        overflow-y: auto;
        -webkit-overflow-scrolling:touch;
    }

    #{{ $modal_name }}_open:checked + label + #{{ $modal_name }}_close-overlay + label {
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

    #{{ $modal_name }}_open:checked ~ #{{ $modal_name }}_close-button + label {
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
    #{{ $modal_name }}_open:checked ~ #{{ $modal_name }}_close-button + label::before {
        content: '×';
    }
    #{{ $modal_name }}_open:checked ~ #{{ $modal_name }}_close-button + label::after {
        content: 'CLOSE';
        margin-left: 5px;
        font-size: 80%;
    }

    @media (min-width: 768px) {
    #{{ $modal_name }}_open:checked + label ~ .{{ $modal_name }}_popUp {
        width: 600px;
        height: 500px;
        border-radius:15px;
    }
    #{{ $modal_name }}_open:checked + label ~ .{{ $modal_name }}_popUp > .{{ $modal_name }}_popUp-content {
        height: calc(100% - 20px);
    }
    #{{ $modal_name }}_open:checked ~ #{{ $modal_name }}_close-button + label {
        width: 44px;
        height: 44px;
        left: 50%;
        top: 57%;
        margin-left: 240px;
        margin-top: -285px;
        overflow: hidden;
    }
    #{{ $modal_name }}_open:checked ~ #{{ $modal_name }}_close-button + label::after {
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

<section class="{{ $modal_name }}">
    <input id="{{ $modal_name }}_open" type="radio" name="{{ $modal_name }}_switch" />
    <label for="{{ $modal_name }}_open">
        <div class="fas fa-info-circle guide" style="color:#6bb6e9"></div>
    </label>
    <input id="{{ $modal_name }}_close-overlay" type="radio" name="{{ $modal_name }}_switch" />
    <label for="{{ $modal_name }}_close-overlay">オーバーレイで閉じる</label>
    <input id="{{ $modal_name }}_close-button" type="radio" name="{{ $modal_name }}_switch" />
    <label for="{{ $modal_name }}_close-button"></label>
    <div class="{{ $modal_name }}_popUp">
        <div class="{{ $modal_name }}_popUp-content col-10 offset-1">
            {!! $user_modal_content !!}
        </div>
    </div>
</section>
