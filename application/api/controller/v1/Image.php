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

/**
 * 设置用户头像
 * Class Index
 * @package app\api\controller\v1
 */
class Image extends AuthBase

{
    public function save(){
        $image = input('post.image');
        if(empty($image)){
            return fail('image_url没有传', [], 503);
        }
        $data = [
            'image' => $image
        ];
        $id = model('User') -> save($data, ['id' => $this -> user['id']]);
        if($id){
            return success('更换头像成功', $data);
        }else{
            return fail('更换头像失败', [], 503);
        }
    }
}