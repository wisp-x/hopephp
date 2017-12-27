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
    // 系统配置
    protected static $config;

    /**
     * 初始化系统配置
     * @return mixed
     */
    public static function init()
    {
        $files = File::getFolder(CONF_PATH)['file'];
        foreach ($files as $item => $file) {
            if(is_file(CONF_PATH . $file)) {
                $conf = self::load(CONF_PATH . $file);
                if($item === 0) {
                    self::$config = $conf;
                } else {
                    self::$config[basename($file, EXT)] = $conf;
                }
            }
        }
        return self::$config;
    }

    /**
     * 获取配置数据
     * @param string $term
     * @return array
     */
    public static function get($term = '')
    {
        if(!empty($term)) {
            if(strpos($term, '.') !== false) {
                $data = explode('.', $term);
                return self::$config[$data[0]];
            } else {

            }
        }
        // 返回所有配置
        return self::$config;
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