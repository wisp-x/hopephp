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

namespace core;

// 常量配置
define('HI_VERSION', '1.0');
define('START_TIME', microtime(true));
define('START_MEM', memory_get_usage());
define('EXT', '.php');
define('DS', DIRECTORY_SEPARATOR);
define('THIS_PATH', __DIR__ . DS);
defined('CORE_PATH') or define('CORE_PATH', ROOT_PATH . 'core' . DS);
defined('APP_PATH') or define('APP_PATH', ROOT_PATH . 'app' . DS);
defined('LIB_PATH') or define('LIB_PATH', ROOT_PATH . 'library' . DS);
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