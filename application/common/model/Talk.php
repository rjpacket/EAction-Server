<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/27
 * Time: 22:35
 */

namespace app\common\model;


use think\Model;

class Talk extends Base
{
    /**
     * 获取社交的条数
     * @param array $condition
     * @return int|string
     */
    public function getTalksCountByCondition($condition = []){
        if(!isset($condition['status'])){
            $condition['status'] = [
                'neq', config('code.status_delete')
            ];
        }
        return $this -> where($condition)
            -> count();
    }

    public function getTalksByCondition($condition = [], $from = 0, $size = 10){
        $order = [
            'id' => 'desc'
        ];

        $result = $this -> where($condition)
            -> limit($from, $size)
            -> order($order)
            -> select();

        return $result;
    }
}