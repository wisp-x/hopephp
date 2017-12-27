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

namespace app\controller;

use app\model\Article;
use hope\Config;

class Index
{
    public function index()
    {

        /*$article = Article::get(1);
        dump($article);*/

        //throw new \Exception('自定义异常');

        exit(dump(Config::get('post.666')));

    }
}