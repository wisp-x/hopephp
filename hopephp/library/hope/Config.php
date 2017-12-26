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

// [ 配置操作类 ]

namespace hope;

class Config
{
    public static function get()
    {

    }

    /**
     * 加载配置文件
     * @param $file
     * @return mixed
     */
    public static function load($file)
    {
        $file = str_replace('\\', '/', $file);
        if(is_file($file)) {
            return require $file;
        }
    }
}