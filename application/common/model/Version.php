<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/27
 * Time: 22:35
 */

namespace app\common\model;


use think\Model;

class Version extends Base
{
    /**
     * 获取最后一条更新数据
     * @param string $appType
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getLastNormalVersionByAppType($appType = ''){
        $data = [
            'status' => 1,
            'app_type' => $appType
        ];

        $order = [
            'id' => 'desc'
        ];

        return $this -> where($data)
            -> order($order)
            -> limit(1)
            -> find();
    }
}