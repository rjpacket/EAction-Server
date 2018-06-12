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
 * 点赞
 * Class Index
 * @package app\api\controller\v1
 */
class Upvote extends AuthBase
{
    public function save(){
        $id = input('post.id', 0, 'intval');
        if(empty($id)){
            return fail('缺少参数id', [], 403);
        }
        $news = model('News') -> get($id);
        if(empty($news) || $news -> status != 1){
            return fail('文章不存在', [], 403);
        }

        $data = [
          'user_id' => $this -> user -> id,
          'news_id' => $id
        ];

        $userNews = model('UserNews') -> get($data);
        if($userNews){
            return fail('已经点赞过了', [], 403);
        }

        try {
            $userNewsId = model('UserNews')->add($data);
            if ($userNewsId) {
                model('News')->where(['id' => $id])->setInc('upvote_count');
                return success('点赞成功', []);
            }else{
                return fail('点赞失败', [], 403);
            }
        }catch (\Exception $e){
            return fail('数据库异常', [], 403);
        }
    }

    public function delete(){
        $id = input('delete.id', 0, 'intval');
        if(empty($id)){
            return fail('缺少参数id', [], 403);
        }
        $news = model('News') -> get($id);
        if(empty($news) || $news -> status != 1){
            return fail('文章不存在', [], 403);
        }

        $data = [
            'user_id' => $this -> user -> id,
            'news_id' => $id
        ];

        $userNews = model('UserNews') -> get($data);
        if($userNews){
            return fail('没有记录', [], 403);
        }

        try{
            $userNewsId = model('UserNews')
                -> where($data)
                -> delete();
            if($userNewsId){
                model('News')->where(['id' => $id])->setDec('upvote_count');
                return success('取消点赞成功', []);
            }else{
                return fail('取消点赞失败', [], 403);
            }
        }catch (\Exception $e){
            return fail('数据库异常', [], 403);
        }
    }

    /**
     * 查看文章是否被点赞
     */
    public function read(){
        $id = input('param.id', 0, 'intval');
        if(empty($id)){
            return fail('缺少参数id', [], 403);
        }

        $data = [
            'user_id' => $this -> user -> id,
            'news_id' => $id
        ];

        try {
            $userNews = model('UserNews')->get($data);
            if ($userNews) {
                return success('ok', ['isUpvote' => 1]);
            } else {
                return success('ok', ['isUpvote' => 0]);
            }
        }catch (\Exception $e){
            return fail('数据库异常', [], 403);
        }
    }
}