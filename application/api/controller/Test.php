<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/25
 * Time: 0:41
 */

namespace app\api\controller;

use app\common\lib\IAuth;
use app\common\lib\SmsUtils;

class Test extends Common
{
    public function index(){
        return [
            'ererer',
            'ewrwerwer'
        ];
    }

    public function save(){
//        $data['a'];
        echo IAuth::setAppLoginToken(13552280894);exit;
        return input('post.');
    }

    /**
     *
     */
    public function sendSms(){
        SmsUtils::sendSms('17611248922');
    }
}