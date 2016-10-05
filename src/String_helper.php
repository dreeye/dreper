<?php

namespace Dreeye\Helper;

class String_helper {


    /**
     * Create a Random String
     *
     * Useful for generating passwords or hashes.
     *
     * @param   string  type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
     * @param   int number of characters
     * @return  string
     *
     * alpha: 只含有大小写字母的字符串
     * alnum: 含有大小写字母以及数字的字符串
     * basic: 根据 mt_rand() 函数生成的一个随机数字
     * numeric: 数字字符串
     * nozero: 数字字符串（不含零）
     * md5: 根据 md5() 生成的一个加密的随机数字（长度固定为 32）
     * sha1: 根据 sha1() 生成的一个加密的随机数字（长度固定为 40）
     */
    public static function randomString($type = 'alnum', $len = 8)
    {
        switch ($type)
        {
            case 'basic':
                return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
                switch ($type)
                {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'sha1':
                return sha1(uniqid(mt_rand(), TRUE));
        }
    }

   /** 
    * 兼容key没有双引括起来的JSON字符串解析
    * @param String $str JSON字符串
    * @param boolean $mod true:Array,false:Object
    * @return Array/Object
    */
    public static function ext_json_decode($str, $mode=FALSE)
    {
      if (preg_match('/\w:/', $str)) {
         $str = preg_replace('/(\w+):/is', '"$1":', $str);
      }
      return json_decode($str, $mode);
    }

}
