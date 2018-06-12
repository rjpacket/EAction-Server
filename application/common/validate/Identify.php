<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/6/10
 * Time: 12:41
 */

namespace app\common\validate;
use think\Validate;

/**
 * 验证机制
 * Class Identify
 * @package app\common\validate
 */
class Identify extends Validate
{
    protected $rule = [
        'phone' => 'require|number|length:11'
    ];
}