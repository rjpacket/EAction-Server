<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/27
 * Time: 22:35
 */

namespace app\common\model;


use think\Model;

class TalkImage extends Base
{
    /**
     * 获取发表的图片集
     * @param $userId
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getSendImagesByTalkId($talkId){
        $data = [
            'talk_id' => $talkId
        ];

        $order = [
            'id' => 'desc'
        ];

        return $this -> where($data)
            -> field(['id', 'image_url', 'create_time'])
            -> order($order)
            -> select();
    }
}