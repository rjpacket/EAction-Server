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
 * 退出登录
 * Class Index
 * @package app\api\controller\v1
 */
class Logout extends AuthBase
{
    /**
     * 设置短信验证码
     */
    public function save()
    {
        if (!request()->isPost()) {
            return fail('请求方式必须是post', [], 403);
        }

        if(empty($this -> user)){
            return fail('您还未登录', [], 403);
        }

        $data = [
            'time_out' => 0
        ];

        try {
            $id = model('User')->save($data, ['id' => $this->user->id]);
            if($id){
                return success('退出登录成功', []);
            }else{
                return fail('退出登录失败', [], 403);
            }
        }catch (\Exception $e){
            return fail('服务器异常', [], 403);
        }
    }
}