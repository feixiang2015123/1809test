<?php

class Demo
{
    const PI     = 3.14;
    const MAN    = 0;
    const WOMEN  = 1;
    const UNKOWN = 2;
    public static function sex($type)
    {
        return ['男', '女', '保密'][$type];

    }

}
echo Demo::sex(Demo::MAN);
