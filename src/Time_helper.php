<?php

namespace Dreper;

class Time_helper {

    // 获取当前毫秒值
    public static function getMsecond() 
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }


}
