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

/**
 * 获取排行榜数据
 * Class Index
 * @package app\api\controller\v1
 */
class Rank extends Common
{
    /**
     * 1.获取数据库
     * 2.优化
     */
    public function index(){
        try {
            $ranks = model('News')->getRankNormalNews();
            $ranks = $this -> getDealNews($ranks);
        }catch (\Exception $e){
            throw new ApiException('error', 404);
        }
        return success('ok', $ranks);
    }
}