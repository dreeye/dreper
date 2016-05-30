<?php

namespace Dreeye\Helper;

class Validate_helper {


    // 验证手机号
    public function isMobile($str)  
    { 
       $str = preg_replace(array('/\+86/', '/-/', '/ /'), array('', '', ''), $str);
       if (preg_match('/^\d{11}$/', $str) == 1) 
       {
            return $str;       
       }
        return FALSE;
    }

    /**
     * Alpha
     * 如果表单元素值包含除字母以外的其他字符，返回 FALSE
     *
     * @param   string
     * @return  bool
     */
    public function isAlpha($str)
    {
        return ctype_alpha($str);
    }
    /**
     * Alpha-numeric
     * 如果表单元素值包含除字母和数字以外的其他字符，返回 FALSE
     *
     * @param   string
     * @return  bool
     */
    public function isAlphaNumeric($str)
    {
        return ctype_alnum((string) $str);
    }

    /**
     * Alpha-numeric w/ spaces
     * 如果表单元素值包含除字母、数字和空格以外的其他字符，返回 FALSE 应该在 trim 之后使用，避免首尾的空格
     *
     * @param   string
     * @return  bool
     */
    public function isAlphaNumericSpaces($str)
    {
        return (bool) preg_match('/^[A-Z0-9 ]+$/i', $str);
    }

    /**
     * Alpha-numeric with underscores and dashes
     * 如果表单元素值包含除字母/数字/下划线/破折号以外的其他字符，返回 FALSE
     * @param   string
     * @return  bool
     */
    public function isAlphaDash($str)
    {
        return (bool) preg_match('/^[a-z0-9_-]+$/i', $str);
    }

    /**
     * Valid Email
     *
     * @param   string
     * @return  bool
     */
    public function isEmail($str)
    {
        if (function_exists('idn_to_ascii') && $atpos = strpos($str, '@'))
        {
            $str = substr($str, 0, ++$atpos).idn_to_ascii(substr($str, $atpos));
        }
        return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);
    }

    
    /**
     * Minimum Length
     *
     * @param   string
     * @param   string
     * @param   string
     * @return  bool
     */
    public function compareLength($str, $val, $compare='min')
    {
        if ( ! is_numeric($val))
        {
            return FALSE;
        }

        if ($compare == 'min')
        {
            return (mb_strlen($str) <= $val);
        }
        else
        {
            return (mb_strlen($str) >= $val);
        }
    }

    
    /**
     * Integer
     *
     * @param   string
     * @return  bool
     */
    public function isInteger($str)
    {
        return (bool) preg_match('/^[\-+]?[0-9]+$/', $str);
    }

    /**
     * Numeric
     *
     * @param   string
     * @return  bool
     */
    public function isNumeric($str)
    {
        return (bool) preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $str);
    }

   /**
     * 验证日期格式
     * @param string
     * @return bool
     *
     */
    public function isDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    } 

}
