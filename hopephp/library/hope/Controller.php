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

use traits\Jump;

class Controller
{
    use Jump;

    /**
     * 视图类实例
     * @var null
     */
    protected $view = null;

    /**
     * 构造函数
     * Controller constructor.
     */
    public function __construct()
    {
        if(is_null($this->view)) {
            $this->view = View::instance();
        }
        return $this->view;
    }

    /**
     * 渲染视图
     * @param null $template
     * @throws \Exception
     */
    protected function fetch($template = null)
    {
        return $this->view->fetch($template);
    }

    /**
     * 模板赋值
     * @param $var
     * @param null $value
     */
    protected function assign($var, $value = null)
    {
        return $this->view->assign($var, $value);
    }
}