<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/27
 * Time: 22:35
 */

namespace app\common\model;


use think\Model;

class User extends Base
{
    public function getUsersUserId($userIds = []){
        $data = [
          'id' => ['in', implode(',', $userIds)],
          'status' => 1
        ];

        $order = [
          'id' => 'desc'
        ];

        return $this -> where($data)
            -> field(['id', 'username', 'image'])
            -> order($order)
            -> select();
    }
}