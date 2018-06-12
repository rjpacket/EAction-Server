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
 * 登录
 * Class Index
 * @package app\api\controller\v1
 */
class Login extends Common
{
    /**
     * 设置短信验证码
     */
    public function save()
    {
        if (!request()->isPost()) {
            return fail('请求方式必须是post', [], 403);
        }

        $param = input('param.');
        if (empty($param['phone'])) {
            return fail('手机号码不合法', [], 403);
        }
        if ($param['code'] && empty($param['code'])) {
            return fail('验证码不合法', [], 403);
        }
        if ($param['password'] && empty($param['password'])) {
            return fail('密码不能为空', [], 403);
        }


        //可以选择validate验证
        if($param['code']) {
            $code = SmsUtils::checkSmsCache($param['phone']);
            if ($code != $param['code']) {
                return fail('验证码已失效', [], 403);
            }
        }

        //第一次登录 注册
        $token = IAuth::setAppLoginToken($param['phone']);
        $data = [
            'token' => $token,
            'time_out' => strtotime('+' . config('app.login_time_out_day') . ' days'),
        ];

        $user = User::get(['phone' => $param['phone']]);
        if($user && $user -> status == 1){
            //存在这个用户
            if($param['password']){
                if(IAuth::setPassword($param['password']) != $user -> password){
                    return fail('密码不正确', [], 403);
                }
            }
            //更新数据库
            $id = model('User') -> save($data, ['phone' => $param['phone']]);
        }else {
            //新增用户
            if($param['code']) {
                $data['username'] = 'eaction' . $param['phone'];
                $data['status'] = 1;
                $data['phone'] = $param['phone'];

                $id = model('User')->add($data);
            }else{
                return fail('用户不存在', [], 403);
            }
        }

        if ($id) {
            $result = [
                'token' => Aes::encrypt($token . '||' . $id),
            ];
            return success('登录成功', $result);
        }else{
            return fail('登录失败', [], 403);
        }
    }
}