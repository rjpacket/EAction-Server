<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/27
 * Time: 22:33
 */

namespace app\api\controller\v1;


use app\api\controller\Common;
use app\common\lib\Aes;
use app\common\lib\exception\ApiException;
use app\common\lib\IAuth;
use app\common\lib\SmsUtils;
use app\common\model\User;

/**
 * 需要token的请求 继承的父类
 * 判断access_user_token是否合法
 * Class Index
 * @package app\api\controller\v1
 */
class AuthBase extends Common
{
    /**
     * 存储用户登录信息
     * @var array
     */
    public $user = [];

    /**
     * 初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        if(!$this->isLogin()){
            throw new ApiException('需要登录', 200);
        }
    }

    /**
     * 判断是否登录
     */
    public function isLogin(){
        if(empty($this -> headers['access_user_token'])){
            return false;
        }
        $accessToken = Aes::decrypt($this->headers['access_user_token']);
        if(empty($accessToken)){
            return false;
        }
        if(!preg_match('/||/', $accessToken)){
            return false;
        }
        list($realToken, $id) = explode('||', $accessToken);
        $user = User::get(['id' => $id]);
        if(!$user || $user -> status != 1){
            return false;
        }
        //判断token是否过期
        if(time() > $user -> time_out){
            return false;
        }
        $this -> user = $user;
        return true;
    }
}