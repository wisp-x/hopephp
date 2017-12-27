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

namespace hope;

use think\Db;

class Model extends \think\Model
{
    /**
     * 初始化Think ORM
     * Model constructor.
     */
    public function __construct()
    {
        Db::setConfig(require APP_PATH . 'database' . EXT);

        parent::__construct();
    }
}