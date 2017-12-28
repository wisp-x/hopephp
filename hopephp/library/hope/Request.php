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

class Request
{
    /**
     * instance对象实例
     * @var
     */
    protected static $instance;

    protected $server;

    protected $method;

    /**
     * 初始化
     * @access public
     * @param array $options 参数
     * @return \hope\Request
     */
    public static function instance($options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($options);
        }
        return self::$instance;
    }

    /**
     * 初始化Request
     * Request constructor.
     */
    public function __construct()
    {
        if(!$this->server) $this->server = $_SERVER;
        if(!$this->method) {
            $this->method = isset($_SERVER['REQUEST_METHOD']) && strtoupper($_SERVER['REQUEST_METHOD']);
        }
    }

    /**
     * 获取客户端IP地址
     * @param integer   $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @param boolean   $adv 是否进行高级模式获取（有可能被伪装）
     * @return mixed
     */
    public function ip($type = 0, $adv = true)
    {
        $type      = $type ? 1 : 0;
        static $ip = null;
        if (null !== $ip) {
            return $ip[$type];
        }
        if ($adv) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos = array_search('unknown', $arr);
                if (false !== $pos) {
                    unset($arr[$pos]);
                }
                $ip = trim(current($arr));
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u", ip2long($ip));
        $ip   = $long ? [$ip, $long] : ['0.0.0.0', 0];
        return $ip[$type];
    }

    /**
     * 检测是否使用手机访问
     * @access public
     * @return bool
     */
    public function isMobile()
    {
        if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
            return true;
        } elseif (isset($_SERVER['HTTP_ACCEPT']) && strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML")) {
            return true;
        } elseif (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
            return true;
        } elseif (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 是否命令行模式
     * @return bool
     */
    public function isCli()
    {
        return PHP_SAPI == 'cli';
    }

    /**
     * 是否Cgi
     * @return bool
     */
    public function isCgi()
    {
        return strpos(PHP_SAPI, 'cgi') === 0;
    }

    /**
     * 是否Ajax请求
     * @return bool
     */
    public function isAjax()
    {
        return isset($this->server['HTTP_X_REQUESTED_WITH']) && strtoupper($this->server['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST';
    }

    /**
     * 是否Post请求
     * @return bool
     */
    public function isPost()
    {
        return $this->method == 'POST';
    }

    /**
     * 是否Get请求
     * @return bool
     */
    public function isGet()
    {
        return $this->method == 'GET';
    }

    /**
     * 是否为Delete请求
     * @return bool
     */
    public function isDelete()
    {
        return $this->method == 'DELETE';
    }

    /**
     * 是否为Put请求
     * @return bool
     */
    public function isPut()
    {
        return $this->method == 'PUT';
    }

    /**
     * 是否Head请求
     * @return bool
     */
    public function isHead()
    {
        return $this->method == 'HEAD';
    }

    /**
     * 是否Patch请求
     * @return bool
     */
    public function isPatch()
    {
        return $this->method == 'PATCH';
    }

    /**
     * 是Options请求
     * @return bool
     */
    public function isOptions()
    {
        return $this->method == 'OPTIONS';
    }

    /**
     * 是否Ssl
     * @return bool
     */
    public function isSsl() {
        if (isset($this->server['HTTPS']) && ('1' == $this->server['HTTPS'] || 'on' == strtolower($this->server['HTTPS']))) {
            return true;
        } elseif (isset($this->server['SERVER_PORT']) && ('443' == $this->server['SERVER_PORT'] )) {
            return true;
        }
        return false;
    }

    /**
     * 获取当前域名
     * @return string
     */
    public function domain()
    {
        return ($this->isSsl() ? 'https://' : 'http://') . (isset($this->server['SERVER_NAME']) ? $this->server['SERVER_NAME'] : $this->server['SERVER_HOST']);
    }

    /**
     * 获取当前请求的时间
     * @param bool $float 是否使用浮点类型
     * @return integer|float
     */
    public function time($float = false)
    {
        return $float ? $this->server['REQUEST_TIME_FLOAT'] : $this->server['REQUEST_TIME'];
    }
}