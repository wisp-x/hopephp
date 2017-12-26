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

namespace hope;

class App
{
    /**
     * 执行应用，返回全局配置
     * @return array
     */
    public static function run()
    {
        $config = self::init();

        // 设置系统时区
        date_default_timezone_set($config['default_timezone']);

        // 初始化路由
        Route::init();

        return $config;
    }

    /**
     * 初始化应用
     * @param string $module
     * @return array
     */
    public static function init($module = '')
    {
        // 定位模块目录
        $module = $module ? $module . DS : '';

        // 加载第三方拓展包
        require_once VENDOR_PATH . 'autoload' . EXT;

        // 加载助手函数
        include HOPE_PATH . 'helper' . EXT;

        // 读取配置
        $files = File::getFolder(CONF_PATH)['file'];
        foreach ($files as $item => $file) {
            if(is_file(CONF_PATH . $file)) {
                $conf = Config::load(CONF_PATH . $file);
                if($item === 0) {
                    $config = $conf;
                } else {
                    $config[basename($file, EXT)] = $conf;
                }
            }
        }

        $path = APP_PATH . $module;

        // 加载公共文件
        if (is_file($path . 'common' . EXT)) {
            require $path . 'common' . EXT;
        }

        return $config;
    }
}