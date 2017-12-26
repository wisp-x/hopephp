<?php

// +----------------------------------------------------------------------
// | HiPHP
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://www.wispx.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: WispX <wisp-x@qq.com>
// +----------------------------------------------------------------------

namespace app\controller;

use app\model\Article;

class Index
{
    public function index()
    {
        $article = Article::find(1);
        dump($article->title);
    }
}