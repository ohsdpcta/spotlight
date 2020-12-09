<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Mail\Markdown;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

class HogeController extends Controller
{
    public function index()
    {
        $text = <<< EOM
    # 見出し h1
    ## 見出し h2
    ### 見出し h3
    #### 見出し h4
    ##### 見出し h5
    ###### 見出し h6
    **太字**
    - リスト
    - リスト
        - リスト
    - [ ] チェックボックス
    - [x] チェックボックス
    - [ ]

    | Left align       |       Right align |    Center align    |
    |:-----------------|------------------:|:------------------:|
    | This             |              This |        This        |
    | column           |            column |       column       |
    | will             |              will |        will        |
    | be               |                be |         be         |
    | left             |             right |       center       |
    | aligned          |           aligned |      aligned       |
    EOM;



        // 変換
        dd(Markdown::parse($text));
    }
}
