<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/26
 * Time: 0:32
 */

namespace app\common\lib\exception;


use Exception;
use think\exception\Handle;

/**
 * config.php下面配置这个路径处理通用错误
 * Class ApiHandleException
 * @package app\common\lib\exception
 */
class ApiHandleException extends Handle
{
    //状态码
    public $httpCode = 500;

    public function render(Exception $e)
    {
        //如果是开发模式，提示debug信息
        if(config('app_debug') == true){
            return parent::render($e);
        }
        if ($e instanceof ApiException) {
            $this->httpCode = $e->httpCode;
        }
        return show(0, $e->getMessage(), [], $this->httpCode);
    }
}