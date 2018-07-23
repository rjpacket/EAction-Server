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
use app\common\lib\IAuth;
use think\Exception;

/**
 * 获取用户信息
 * Class Index
 * @package app\api\controller\v1
 */
class User extends AuthBase

{
    /**
     * 获取用户信息
     * 用户的信息需要过滤，不能全部展示给用户
     */
    public function read(){
        $result = [
            'id' => $this -> user['id'],
            'username' => $this -> user['username'],
            'phone' => $this -> user['phone'],
            'image' => $this -> user['image'],
            'sex' => $this -> user['sex'],
            'signature' => $this -> user['signature'],
            'update_time' => $this -> user['update_time'],
            'status' => $this -> user['status'],
        ];

        return success('ok', $result);
    }

    /**
     * 修改用户数据
     */
    public function save(){
        $postData = input('param.');
        //validate 校验

        if(!empty($postData['image'])){
            $data['image'] = $postData['image'];
        }
        if(!empty($postData['username'])){
            $data['username'] = $postData['username'];
        }
        if(!empty($postData['sex'])){
            $data['sex'] = $postData['sex'];
        }
        if(!empty($postData['signature'])){
            $data['signature'] = $postData['signature'];
        }
        if(!empty($postData['password'])){
            $data['password'] = IAuth::setPassword($postData['password']);
        }

        if(empty($data)){
            return fail('没有数据', []);
        }

        try {
            $id = model('User')->save($data, ['id' => $this->user['id']]);
            if($id){
                return success('修改成功', []);
            }else{
                return fail('修改失败', []);
            }
        }catch (\Exception $e){
            return fail('修改失败', []);
        }
    }
}