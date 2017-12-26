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

// [ 异常处理类 ]

namespace hope;

use hope\exception\ErrorException;

class Error
{
    /**
     * 注册异常处理
     */
    public static function register()
    {
        error_reporting(E_ALL);
        set_error_handler([__CLASS__, 'error']);
        set_exception_handler([__CLASS__, 'exception']);
        register_shutdown_function([__CLASS__, 'shutdown']);
    }

    /**
     * 错误处理
     * @param  integer $errno      错误编号
     * @param  integer $errstr     详细错误信息
     * @param  string  $errfile    出错的文件
     * @param  integer $errline    出错行号
     * @param  array   $errcontext 出错上下文
     * @throws ErrorException
     */
    public static function error($errno, $errstr, $errfile = '', $errline = 0, $errcontext = [])
    {
        $exception = new ErrorException($errno, $errstr, $errfile, $errline, $errcontext);

        // 符合异常处理的则将错误信息托管至 lib\exception\ErrorException
        if (error_reporting() & $errno) {
            throw $exception;
        }
        //trigger_error('error!', E_USER_NOTICE);
    }

    /**
     * 异常中止处理
     * @return void
     */
    public static function shutdown()
    {
        // 将错误信息托管至 lib\ErrorException
        if (!is_null($error = error_get_last()) && self::isFatal($error['type'])) {
            self::exception(new ErrorException(
                $error['type'], $error['message'], $error['file'], $error['line']
            ));
        }

        // TODO 写入日志
    }

    /**
     * 确定错误类型是否致命
     * @param  int $type 错误类型
     * @return bool
     */
    protected static function isFatal($type)
    {
        return in_array($type, [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE]);
    }

    /**
     * 异常处理
     * @param $e
     */
    public static function exception($e)
    {
        // TODO 将错误数据渲染到视图
        echo '<pre>';
        exit(var_dump($e));
    }
}