<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/27
 * Time: 22:35
 */

namespace app\common\model;


use think\Model;

class News extends Base
{
    /**
     * 通过参数获取数据库数据
     * @param array $condition
     * @param int $from
     * @param int $size
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getNewsByCondition($condition = [], $from = 0, $size = 10){
        if(!isset($condition['status'])){
            $condition['status'] = [
                'neq', config('code.status_delete')
            ];
        }

        $order = [
            'id' => 'desc'
        ];

        $result = $this -> where($condition)
            -> limit($from, $size)
            -> order($order)
            -> select();

        return $result;
    }

    /**
     * 获取条件下新闻的总数
     * @param array $condition
     * @return int|string
     */
    public function getNewsCountByCondition($condition = []){
        if(!isset($condition['status'])){
            $condition['status'] = [
                'neq', config('code.status_delete')
            ];
        }
        return $this -> where($condition)
            -> count();
    }

    /**
     *
     * 获取头部推荐
     * @param int $num
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getIndexHeadNormalNews($num = 4){
        $data = [
          'status' => 1,
          'is_head_figure' => 1
        ];

        $order = [
            'id' => 'desc'
        ];

        return $this -> where($data)
            -> field($this -> getListField())
            -> order($order)
            -> limit($num)
            -> select();
    }

    /**
     * 获取首页数据
     * @param int $num
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getPositionNormalNews($num = 20){
        $data = [
            'status' => 1,
            'is_position' => 1
        ];

        $order = [
            'id' => 'desc'
        ];

        return $this -> where($data)
            -> field($this -> getListField())
            -> order($order)
            -> limit($num)
            -> select();
    }

    /**
     * 获取排行榜推荐新闻数据
     * @param int $num
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getRankNormalNews($num = 5){
        $data = [
            'status' => 1
        ];

        $order = [
            'read_count' => 'desc'
        ];

        return $this -> where($data)
            -> field($this -> getListField())
            -> order($order)
            -> limit($num)
            -> select();
    }

    /**
     * 返回的字段集合
     * @return array
     */
    private function getListField(){
        return [
            'id',
            'catid',
            'image',
            'title',
            'read_count'
        ];
    }
}