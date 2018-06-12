<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/26
 * Time: 13:55
 */

namespace app\api\controller\v1;


use app\api\controller\Common;

class Cat extends Common
{
    public function read(){
        $cats = config('cat.lists');
//        halt($cats);

        $result = [];

        foreach ($cats as $catid => $catname){
            $result[] = [
                'catid' => $catid,
                'catname' => $catname
            ];
        }

        return success("ok", $result);
    }
}