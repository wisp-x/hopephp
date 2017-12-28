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

class Session
{
    /**
     * 是否初始化
     * @var null
     */
    protected static $init = null;

    /**
     * 初始化Session
     */
    public static function init()
    {
        if(is_null(self::$init)) {
            if(session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            self::$init = true;
        }
    }

    public static function set()
    {
    }

    public static function get()
    {
    }

    public static function has()
    {
    }

    public static function pull()
    {
    }

    public static function flash()
    {
    }

    public static function flush()
    {
    }

    public static function delete()
    {
    }

    public static function clear()
    {
    }

    /**
     * 启动session
     * @return void
     */
    public static function start()
    {
        session_start();
        self::$init = true;
    }

    /**
     * 销毁session
     * @return void
     */
    public static function destroy()
    {
        if (!empty($_SESSION)) {
            $_SESSION = [];
        }
        session_unset();
        session_destroy();
        self::$init = null;
    }

    /**
     * 暂停session
     * @return void
     */
    public static function pause()
    {
        // 暂停session
        session_write_close();
        self::$init = false;
    }
}