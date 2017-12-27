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

// [ 控制器基类 ]

namespace hope;

use traits\Jump;

class Controller
{
    use Jump;

    public function __construct()
    {
    }

    protected function fetch()
    {
    }

    protected function display()
    {
    }

    protected function assign()
    {
    }
}