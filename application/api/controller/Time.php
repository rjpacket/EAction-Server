<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/26
 * Time: 13:46
 */

namespace app\api\controller;


use think\Controller;

/**
 * 直接在api中返回服务器时间，不需要这个接口
 * Class Time
 * @package app\api\controller
 */
class Time extends Controller
{
    public function index(){
        return show(1, 'ok', time());
    }
}