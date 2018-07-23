<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/26
 * Time: 0:39
 */

namespace app\common\lib\exception;


use think\Exception;
use Throwable;

class ApiException extends Exception
{
    public $message = '';
    public $httpCode = '';
    public $code = '';

    public function __construct($message = "", $httpCode = 200, $code = 0)
    {
        $this->message = $message;
        $this->httpCode = $httpCode;
        $this->code = $code;
    }
}