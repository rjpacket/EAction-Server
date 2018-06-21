<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/6/13
 * Time: 23:58
 */

namespace app\common\lib;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use think\Request;

//require EXTEND_PATH.'php-sdk-7.2.6/autoload.php';

class Upload
{
    /**
     * 图片上传接口
     * @return null|string
     * @throws \Exception
     */
    public static function image(){
        //拿到的文件
        $file = $_FILES['file']['tmp_name'];

        /*$ext = explode('.', $_FILES['file']['name']);
        $ext = $ext[1];*/

        $pathinfo = pathinfo($_FILES['file']['name']);
        $ext = $pathinfo['extension'];

        if(empty($file)){
            exception('您提交的图片不合法', 404);
        }

        $config = config('qiniu');

        //构建鉴权对象
        $auth = new Auth($config['ak'], $config['sk']);
        //生成token
        $token = $auth -> uploadToken($config['bucket']);
        //上传七牛的文件名
        $key = date('Y').'/'.date('m').'/'.substr(md5($file), 0, 5).date('YmdHis').rand(1000, 9999).'.'.$ext;

        //初始化一个uploadManager
        $manager = new UploadManager();
        list($ret, $err) = $manager -> putFile($token, $key, $file);
        if($err != null){
            return null;
        }else{
            return $key;
        }
    }
}