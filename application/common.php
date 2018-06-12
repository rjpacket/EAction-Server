<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 通用化的API接口数据输出
 * @param $code
 * @param $msg
 * @param $data
 * @param $httpCode
 * @return \think\response\Json
 */
function show($code, $msg, $data = [], $httpCode = 200)
{
    $result = [
        'code' => $code,
        'msg' => $msg,
        'data' => $data,
        'server_time' => time()
    ];
    return json($result, $httpCode);
}

/**
 * 成功执行回调
 * @param $msg
 * @param array $data
 * @return \think\response\Json
 */
function success($msg, $data = []){
    return show(config('code.api_call_success'), $msg, $data, 200);
}

/**
 * 失败执行回调
 * @param $msg
 * @param array $data
 * @param int $httpCode
 * @return \think\response\Json
 */
function fail($msg, $data = [], $httpCode = 500){
    return show(config('code.api_call_fail'), $msg, $data, $httpCode);
}
