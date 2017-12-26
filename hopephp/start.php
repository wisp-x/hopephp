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

// [ 框架引导文件 ]

namespace hope;

// 常量配置
defined('HOPE_VERSION') or define('HOPE_VERSION', '1.0');
defined('START_TIME') or define('START_TIME', microtime(true));
defined('START_MEM') or define('START_MEM', memory_get_usage());
defined('EXT') or define('EXT', '.php');
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('THIS_PATH') or define('THIS_PATH', __DIR__ . DS);
defined('HOPE_PATH') or define('HOPE_PATH', ROOT_PATH . 'hopephp' . DS);
defined('APP_PATH') or define('APP_PATH', ROOT_PATH . 'app' . DS);
defined('LIB_PATH') or define('LIB_PATH', HOPE_PATH . 'library' . DS);
defined('VENDOR_PATH') or define('VENDOR_PATH', ROOT_PATH . 'vendor' . DS);
defined('RUNTIME_PATH') or define('RUNTIME_PATH', ROOT_PATH . 'runtime' . DS);
defined('CONF_PATH') or define('CONF_PATH', ROOT_PATH . 'config' . DS);
defined('VENDOR_PATH') or define('VENDOR_PATH', ROOT_PATH . 'vendor' . DS);

// 环境常量
define('IS_CLI', PHP_SAPI == 'cli' ? true : false);
define('IS_WIN', strpos(PHP_OS, 'WIN') !== false);

// 载入Loader类
require LIB_PATH . 'hope/Loader.php';

// 注册自动加载
\hope\Loader::register();

// 注册错误和异常处理类
\hope\Error::register();

// 执行应用
\hope\App::run();