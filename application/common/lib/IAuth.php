<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/26
 * Time: 1:25
 */

namespace app\common\lib;


use think\Cache;

class IAuth
{
    /**
     * 密码进行加密
     * @param $password
     * @return string
     */
    public static function setPassword($password){
        return md5($password.config('app.password_pre_halt'));
    }

    /**
     * 生成每次请求的sign
     * @param array $data
     * @return string
     */
    public static function setSign($data = []){
        // 按字段排序
        ksort($data);
        // 拼接
        $string = http_build_query($data);
        // 加密
        $string = Aes::encrypt($string);
        return $string;
    }

    /**
     * 检验sign是否合法
     * @param $data
     * @return bool
     */
    public static function checkSignPass($data){
        $str = Aes::decrypt($data['sign']);
        if(empty($str)){
            return false;
        }
        parse_str($str, $arr);
//        halt($arr);
        if(!is_array($arr) || empty($arr['device_id']) || $arr['device_id'] != $data['device_id']){
            return false;
        }

        if(!config('app_debug')) {
            if (time() - ceil($arr['time_stamp'] / 1000) > config('app.app_sign_time')) {
                return false;
            }

            //唯一性判断
            if (Cache::get($data['sign'])) {
                return false;
            }
        }

        return true;
    }

    /**
     * 生成app login token(40位)
     * @return string
     */
    public static function setAppLoginToken($phone = ''){
        $str = md5(uniqid(md5(microtime(true)), true));
        $str = sha1($str.$phone);
        return $str;
    }
}