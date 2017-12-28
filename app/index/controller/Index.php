<?php

// +----------------------------------------------------------------------
// | HopePHP
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://www.wispx.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: WispX <i@wispx.cn>
// +----------------------------------------------------------------------

namespace app\index\controller;

use app\index\model\Article;
use hope\Config;
use hope\Controller;
use hope\Request;
use hope\View;

class Index extends Controller
{
    public function index()
    {
        /*$article = Article::get(1);
        dump($article);*/

        //throw new \Exception('自定义异常');

        //exit(dump(\config('?cache')));

        $this->assign('hope', 'HopePHP');
        $this->fetch();

    }
}