<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/27
 * Time: 22:33
 */

namespace app\api\controller\v1;


use app\api\controller\Common;
use app\common\lib\exception\ApiException;
use app\common\lib\SmsUtils;

/**
 * 获取验证码
 * Class Index
 * @package app\api\controller\v1
 */
class GetCode extends Common
{
    /**
     * 设置短信验证码
     */
    public function save(){
        if(!request() -> isPost()){
            return fail('请求方式必须是post', [], 403);
        }

        //校验数据
        $validate = validate('Identify');
        if(!$validate -> check(input('post.'))){
            return fail('手机号格式不正确', [], 403);
        }

        $id = input('post.phone');
        if(SmsUtils::sendSms($id)){
            return success('验证码发送成功', []);
        }else{
            return fail('验证码发送失败', [], 403);
        }
    }
}