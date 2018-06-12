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
 * 评论
 * Class Index
 * @package app\api\controller\v1
 */
class Comment extends AuthBase
{
    public function save(){
        $data = input('post.');

        //news_id content to_user_id parent_id

        $data['user_id'] = $this -> user -> id;
        try{
            $commnetId = model('Comment') -> add($data);
            if($commnetId){
                return success('评论成功', []);
            }else{
                return fail('评论失败', [], 403);
            }
        }catch (\Exception $e){
            return fail('服务器异常', [], 403);
        }
    }

//    /**
//     * 1.0版本
//     * @return \think\response\Json
//     */
//    public function read(){
//        $newsId = input('param.id', 0, 'intval');
//        if(empty($newsId)){
//            return fail('缺少参数newsId', [], 403);
//        }
//
//        $param['news_id'] = $newsId;
//        $count = model('Comment') -> getNormalCommentsCountByCondition($param);
//
//        $this -> getPageAndSize(input('param.'));
//        $comments = model('Comment') -> getNormalCommentsCountByCondition($param, $this -> from, $this -> size);
//
//        if($comments){
//            $result = [
//                'total' => $count,
//                'page_num' => ceil($count / $this -> size),
//                'list' => $comments
//            ];
//            return success('获取评论列表成功', $result);
//        }else{
//            return fail('获取评论列表失败', [], 403);
//        }
//    }

    /**
     * 2.0版本
     * @return \think\response\Json
     */
    public function read(){
        $newsId = input('param.id', 0, 'intval');
        if(empty($newsId)){
            return fail('缺少参数newsId', [], 403);
        }

        $param['news_id'] = $newsId;
        $count = model('Comment') -> getCountByCondition($param);

        $this -> getPageAndSize(input('param.'));
        $comments = model('Comment') -> getListsByCondition($param, $this -> from, $this -> size);

        if($comments){
            foreach ($comments as $comment){
                $userIds[] = $comment['user_id'];
                if($comment['to_user_id']){
                    $userIds[] = $comment['to_user_id'];
                }
            }
            $userIds = array_unique($userIds);

            $users = model('User') -> getUsersUserId($userIds);
            if(empty($users)){
                $usersMap = [];
            }else{
                foreach ($users as $user){
                    $usersMap[$user -> id] = $user;
                }
            }

            $resultData = [];
            foreach ($comments as $comment){
                $resultData[] = [
                    'id' => $comment -> id,
                    'user_id' => $comment -> user_id,
                    'to_user_id' => $comment -> to_user_id,
                    'content' => $comment -> content,
                    'username' => !empty($usersMap[$comment -> user_id])?$usersMap[$comment -> user_id] -> username : '',
                    'tousername' => !empty($usersMap[$comment -> to_user_id])?$usersMap[$comment -> to_user_id] -> username : '',
                    'parent_id' => $comment -> parent_id,
                    'create_time' => $comment -> create_time,
                    'image' => !empty($usersMap[$comment -> user_id])?$usersMap[$comment -> user_id] -> image : ''
                ];
            }
            $result = [
                'total' => $count,
                'page_num' => ceil($count / $this -> size),
                'list' => $resultData
            ];
            return success('获取评论列表成功', $result);
        }else{
            return fail('获取评论列表失败', [], 403);
        }
    }
}