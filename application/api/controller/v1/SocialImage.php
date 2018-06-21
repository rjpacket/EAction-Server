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
use app\common\lib\Upload;
use Qiniu\Auth;
use think\Request;

require EXTEND_PATH.'php-sdk-7.2.6/autoload.php';

/**
 * 社区发布图片的接口
 * Class Index
 * @package app\api\controller\v1
 */
class SocialImage extends AuthBase
{
    public function uploadImageType(){
        $config = config('qiniu');
        //构建鉴权对象
        $auth = new Auth($config['ak'], $config['sk']);
        //生成token
        $token = $auth -> uploadToken($config['bucket']);

        $data = [
          'type' => config('app.upload_type'),
          'token' => $token,
          'image_base_url' => $config['image_base_url']
        ];
        return success('获取上传token成功', $data);
    }

    /**
     * 上传图片到本地服务器
     */
    public function localUploadImage(){
        $key = Upload::image();
        //把图片上传到指定文件夹
        if($key){
            $result = [
                'image_url' => config('qiniu.image_base_url').$key
            ];
            return success("上传图片成功", $result);
        }else{
            return fail("上传图片成功", [], 403);
        }
    }

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