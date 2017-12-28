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

class View
{
    /**
     * View instance 对象实例
     * @var
     */
    protected static $instance;

    /**
     * 模板配置
     * @var
     */
    protected $config;

    /**
     * 模板变量
     * @var
     */
    protected $data;

    /**
     * 作定界符
     * @var string
     */
    protected $begin    = '{';

    /**
     * 右定界符
     * @var string
     */
    protected $end      = '}';

    /**
     * 初始化
     * @param array $options 参数
     * @return \hope\View
     */
    public static function instance($options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($options);
        }
        return self::$instance;
    }

    /**
     * 模板引擎初始化
     * View constructor.
     */
    public function __construct()
    {
        $this->config   = Config::get('template');
        $this->begin    = preg_quote($this->config['tpl_begin'], '/');
        $this->end      = preg_quote($this->config['tpl_end'], '/');
    }

    /**
     * 模板字符串替换
     * @param $content
     * @return null|string|string[]
     */
    public function replace($content)
    {
        $pattern = array(
            '/' . $this->begin . '\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)' . $this->end . '/i'
        );

        $replace = array(
            '<?php echo $this->data[\'${1}\']; ?>'
        );

        return preg_replace($pattern, $replace, $content);
    }

    /**
     * 编译模板文件
     * @param $name 编译后的文件名
     * @param $file 文件内容
     * @throws \Exception
     */
    public function compiler($name, $file)
    {
        if (!file_exists($name) || filemtime($file) > filemtime($name)) {
            $content = $this->replace(file_get_contents($file));
            $content = "<?php defined('HOPE') or die('Forbidden access'); ?>\r\n" . $content;
            if (false === file_put_contents($name, $content)) {
                throw new \Exception("写入缓存失败：{$name}");
            }
        }
    }

    /**
     * 解析模板
     * @param string $template
     * @throws \Exception
     */
    public function fetch($template)
    {

        // 拼装模板地址
        $file = "{$this->config['view_path']}{$template}.{$this->config['view_suffix']}";

        if (!file_exists($file)) {
            throw new \Exception("模板文件不存在：{$file}");
        }

        $name = TEMP_PATH . md5($file) . EXT;

        $this->compiler($name, $file);

        include $name;
    }

    /**
     * 模板变量赋值
     * @param $var
     * @param null $value
     */
    public function assign($var, $value = null)
    {
        if (is_array($var) && count($var) > 0) {
            foreach ($var as $k => $v) {
                $this->data[$k] = $v;
            }
        } elseif ($var) {
            $this->data[$var] = $value;
        }
    }

    /**
     * 模板变量赋值
     * @param string    $name  变量名
     * @param mixed     $value 变量值
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * 取得模板显示变量的值
     * @param string $name 模板变量
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * 检测模板变量是否设置
     * @param string $name 模板变量名
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
}