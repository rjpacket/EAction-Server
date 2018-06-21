<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/26
 * Time: 1:12
 */

//配置文件
return [
    'password_pre_halt' => 'eaction_rjp@09.22',
    'aeskey' => 'rjp0922renjinpeng19920922', //aes密钥
    'apptypes' => [
        'ios',
        'android',
        'web'
    ],
    'app_sign_time' => 0, //sign失效时间
    'app_sign_cache_time' => 0, //sign缓存时间
    'login_time_out_day' => 7, //登录token失效时间 7天
    'upload_type' => 'qiniu', // 上传图片的类型，目前支持qiniu和local两种
];