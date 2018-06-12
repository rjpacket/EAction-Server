<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/6/7
 * Time: 23:55
 */

namespace app\common\model;


use app\common\lib\exception\ApiException;
use think\Model;

class Base extends Model
{
    protected $autoWriteTimestamp = true;

    public function add($data){
        if(!is_array($data)){
            exception("data must be array");
        }
        $this -> allowField(true) -> save($data);
        return $this -> id;
    }
}