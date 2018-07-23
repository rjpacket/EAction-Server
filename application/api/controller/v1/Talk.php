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
use think\Log;

/**
 * 社交页面
 * Class Index
 * @package app\api\controller\v1
 */
class Talk extends AuthBase
{
    public function index()
    {
        //校验 validate
        $data = input('get.');
        $this->getPageAndSize($data);

        $whereData = [];

        $count = model('Talk')->getTalksCountByCondition($whereData);

        $talks = model('Talk')->getTalksByCondition($whereData, $this->from, $this->size);

        if ($talks) {
            foreach ($talks as $talk) {
                $userIds[] = $talk['user_id'];
            }
            $userIds = array_unique($userIds);

            $users = model('User')->getUsersUserId($userIds);
            if (empty($users)) {
                $usersMap = [];
            } else {
                foreach ($users as $user) {
                    $usersMap[$user->id] = $user;
                }
            }

            $resultData = [];
            foreach ($talks as $talk) {
                $sendImages = model('TalkImage') -> getSendImagesByTalkId($talk -> id);

                $resultData[] = [
                    'id' => $talk->id,
                    'user_id' => $talk->user_id,
                    'content' => $talk->content,
                    'username' => !empty($usersMap[$talk->user_id]) ? $usersMap[$talk->user_id]->username : '',
                    'create_time' => $talk->create_time,
                    'image' => !empty($usersMap[$talk->user_id]) ? $usersMap[$talk->user_id]->image : '',
                    'send_images' => $sendImages
                ];
            }

            $result = [
                'total' => $count,
                'page_num' => ceil($count / $this->size),
                'list' => $resultData
            ];

            return success('获取动态成功', $resultData);
        }else{
            return fail('获取动态失败', [], 403);
        }
    }

    /**
     * 社区动态发布接口
     */
    public
    function sendTalk()
    {
        $param = input('post.');
        if (empty($param['content'])) {
            return fail('内容不能为空', [], 403);
        }

        if ($param['imageUrls']) {
            if (empty($param['imageUrls'])) {
                return fail('图片不能为空', [], 403);
            }
        }

        $data = [
            'user_id' => $this->user['id'],
            'content' => $param['content'],
            'status' => 1
        ];

        $id = model('Talk')->add($data);

        try {
            if ($param['imageUrls']) {
                $imgUrls = explode(',', $param['imageUrls']);
                foreach ($imgUrls as $imgUrl) {
                    $imageData = [
                        'talk_id' => $id,
                        'image_url' => $imgUrl
                    ];
                    model('TalkImage')->insert($imageData);
                }
            }
        } catch (\Exception $e) {

        }

        if ($id) {
            return success('发布动态成功', []);
        } else {
            return fail('发布动态失败', [], 403);
        }
    }
}