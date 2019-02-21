<?php

// 02_const.php
// 常量: 本质就是起别名

// 用途1: 给一个比较长的, 记不住的量 起别名
define('PI', 3.141592653);

// 用途2: 作为方法的参数的值. 有的函数的值 只有几种固定的可填项
// define('PATHINFO_BASENAME', 0);
// pathinfo(__FILE__, PATHINFO_BASENAME)

//类中 也可以声明常量
class Demo
{
    //常量的声明格式
    const PI = 3.141592653;

    const SEX_NV     = 0;
    const SEX_NAN    = 1;
    const SEX_BAO_MI = 2;

    //类内: self::sex(self::SEX_NV);
    //类外: Demo::sex(Demo::SEX_BAO_MI)
    public static function sex($type)
    {
        $arr = ['女', '男', '保密'];
        return $arr[$type];

        return ['女', '男', '保密'][$type];
    }

    public function desc()
    {
        //类内
        echo self::PI; //永远调用当前的,忽略重写
        echo '<br>';
        echo static::PI; //优先调用子类重写的
    }
}

//类外:
echo Demo::PI, '<hr>';

$obj = new Demo;
$obj->desc();

echo '<br>';
echo Demo::sex(Demo::SEX_BAO_MI);
