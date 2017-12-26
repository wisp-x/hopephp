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

use Illuminate\Database\Capsule\Manager;

class Model extends \Illuminate\Database\Eloquent\Model
{
    /**
     * 初始化Eloquent
     * Model constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $capsule = new Manager();

        $capsule->addConnection(require APP_PATH . 'database' . EXT);

        $capsule->bootEloquent();
        parent::__construct($attributes);
    }
}