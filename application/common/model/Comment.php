<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/27
 * Time: 22:35
 */

namespace app\common\model;


use think\Db;
use think\Model;

class Comment extends Base
{
    /**
     * 获取评论的总数
     * @param array $param
     * @return int|string
     */
    public function getNormalCommentsCountByCondition($param = []){
        $count = Db::table('eaction_comment')
            -> alias(['eaction_comment' => 'a', 'eaction_user' => 'b'])
            -> join('eaction_user', 'a.user_id = b.id AND a.news_id = '.$param['news_id'])
            -> count();
        return $count;
    }

    /**
     * 获取评论列表
     * @param array $param
     * @param int $from
     * @param int $size
     */
    public function getNormalCommentsByCondition($param = [], $from = 0, $size = 10){
        $result = Db::table('eaction_comment')
            -> alias(['eaction_comment' => 'a', 'eaction_user' => 'b'])
            -> join('eaction_user', 'a.user_id = b.id AND a.news_id = '.$param['news_id'])
            -> limit($from, $size)
            -> order(['a.id' => 'desc'])
            -> select();
        return $result;
    }

    public function getCountByCondition($param = []){
        return $this -> where($param)
            -> field('id')
            -> count();
    }

    public function getListsByCondition($param = [], $from = 0, $size = 10){
        return $this -> where($param)
            -> field('*')
            -> limit($from, $size)
            -> order(['id' => 'desc'])
            -> select();
    }
}