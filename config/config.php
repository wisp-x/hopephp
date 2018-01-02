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

// [ 应用配置 ]

return [
    // +----------------------------------------------------------------------
    // | 应用设置
    // +----------------------------------------------------------------------

    // 调试模式
    'app_debug'              => true,

    // 默认时区
    'default_timezone'       => 'PRC',

    // 错误显示信息,非调试模式有效
    'error_message'          => '404 Not Found，页面被外星人抓走啦~',

    // +----------------------------------------------------------------------
    // | 模板设置
    // +----------------------------------------------------------------------
    'template'               => [
        // 模板文件目录，默认view
        'view_path'    => 'view',
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 模板后缀
        'view_suffix'  => 'html',
    ],

    // +----------------------------------------------------------------------
    // | 日志设置
    // +----------------------------------------------------------------------

    'log'                    => [
        // 日志保存目录
        'path'  => '',
    ],

    // +----------------------------------------------------------------------
    // | Cookie设置
    // +----------------------------------------------------------------------

    'cookie'                 => [
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
    ],
];