<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 12-7-12
 * Time: 上午11:18
 * To change this template use File | Settings | File Templates.
 */
class QllifeUtils
{
    public static function  DF_SimpleTitle($str){
         return mb_substr($str,0,20,"UTF-8");
    }
}
