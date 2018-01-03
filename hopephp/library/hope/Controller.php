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

// [ 控制器基类 ]

namespace hope;

use think\Template;
use traits\Jump;

class Controller
{
    use Jump;

    /**
     * 视图类实例
     * @var null
     */
    public $view = null;

    /**
     * 构造函数
     * Controller constructor.
     */
    public function __construct()
    {
        if(is_null($this->view)) {
            $this->view = new Template(Config::get('template'));
        }
        return $this->view;
    }

    /**
     * 渲染模板文件
     * @param null $template
     * @param array $vars
     * @param array $config
     * @throws \Exception
     */
    public function fetch($template = null, $vars = [], $config = [])
    {
        $backtrace = debug_backtrace();
        array_shift($backtrace);

        // 该数组依次对应：app、模块名、控制器名、方法名
        $array = explode('\\', str_replace('controller', 'view', strtolower($backtrace[0]['class'])));

        $file = ROOT_PATH;

        $config = Config::get('template');
        if (is_null($template)) {
            foreach ($array as $value) {
                $file .= $value . DS;
            }
            $file .= strtolower($backtrace[0]['function'] . '.' . $config['view_suffix']);
        } else {
            $file = APP_PATH . "{$array[1]}/{$config['view_path']}/{$template}.{$config['view_suffix']}";
        }

        if (!file_exists($file)) {
            throw new \Exception("模板文件不存在：{$file}");
        }

        $this->view->fetch($file, $vars = [], $config = []);
    }

    /**
     * 渲染模板内容
     * @param string $content 模板内容
     * @param array $vars 模板变量
     * @param array $config 模板参数
     * @return void
     */
    public function display($content, $vars = [], $config = [])
    {
        $this->view->display($content, $vars = [], $config = []);
    }
}