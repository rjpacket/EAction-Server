<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/26
 * Time: 1:04
 */

namespace app\api\controller;


use app\common\lib\Aes;
use app\common\lib\exception\ApiException;
use app\common\lib\IAuth;
use app\common\lib\Time;
use think\Cache;
use think\Controller;

/**
 * 公共的控制器
 * Class Common
 * @package app\api\controller
 */
class Common extends Controller
{
    public $headers = '';

    /**
     * 初始化的方法
     */
    public function _initialize(){
//        echo time();exit;
        $this -> checkRequestAuth();
//        $this -> testAes();
    }

    public function testAes(){
        // id=1&ms=45&username=rjp
        // VKKNSFdgm4uLZ9FHNpfMwgG6iX4CxJ1IS6JbjQQgbYc=
//        $str = "VKKNSFdgm4uLZ9FHNpfMwgG6iX4CxJ1IS6JbjQQgbYc=";
//        echo Aes::decrypt($str); exit;

        $data = [
            'device_id' => '123',
            'version' => 1,
            'time_stamp' => Time::get13TimeStamp()
        ];
        echo IAuth::setSign($data);exit;

//        $str = '0g73iWYIfvahot2p4t6Iw0KHCoU3gp4zLoWaqU8pMRE=';
//        echo Aes::decrypt($str);exit;
    }

    /**
     * 检查每次app的请求是否合法
     * @throws ApiException
     */
    public function checkRequestAuth(){
        //首先需要获取headers里面的信息
        $headers = request() -> header();
//        halt($headers);

        //验签 sign 加密需要客户端做，服务端解密

        //基础参数校验
//        if(empty($headers['sign'])){
//            throw new ApiException('缺少参数sign', 400);
//        }
        if(empty($headers['version'])){
            throw new ApiException('缺少参数version', 400);
        }

        if(!in_array($headers['app_type'], config('app.apptypes'))){
            throw new ApiException('缺少参数appType', 400);
        }

        if(empty($headers['version_code'])){
            throw new ApiException('缺少参数version_code', 400);
        }

        if(empty($headers['device_id'])){
            throw new ApiException('缺少参数device_id', 400);
        }

        if(empty($headers['model'])){
            throw new ApiException('缺少参数model', 400);
        }

        if(empty($headers['imei'])){
            throw new ApiException('缺少参数imei', 400);
        }

        if(empty($headers['application_id'])){
            throw new ApiException('缺少参数application_id', 400);
        }

        if(empty($headers['mac_address'])){
            throw new ApiException('缺少参数mac_address', 400);
        }

        if(empty($headers['channel'])){
            throw new ApiException('缺少参数channel', 400);
        }

        if(empty($headers['brand'])){
            throw new ApiException('缺少参数brand', 400);
        }

        if(empty($headers['osversion'])){
            throw new ApiException('缺少参数osversion', 400);
        }

        //需要sign  暂时不加sign判断
//        if(!IAuth::checkSignPass($headers)){
//            throw new ApiException('参数sign不合法', 400);
//        }

        //请求过的sign保存，唯一性检查
//        Cache::set($headers['sign'], 1, config('app.app_sign_cache_time'));

        //保存header头的数据，子类可以直接使用
        $this -> headers = $headers;
    }

    public $page = 1;
    public $size = 10;
    public $from = 0;

    /**
     * 计算分页
     * @param array $data
     */
    public function getPageAndSize($data = []){
        $this -> page = !empty($data['page']) ? $data['page'] : 1;
        $this -> size = !empty($data['size']) ? $data['size'] : 10;
        $this -> from = ($this -> page - 1) * $this -> size;
    }

    /**
     * 将栏目ID转成栏目name
     * @param array $news
     * @return array
     */
    public function getDealNews($news = []){
        if(empty($news)){
            return [];
        }

        $cats = config('cat.lists');

        foreach ($news as $key => $new){
            $news[$key]['catname'] = $cats[$new['catid']] ? $cats[$new['catid']] : '-';
        }
        return $news;
    }
}
















