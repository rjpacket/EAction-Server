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
 * 首页
 * Class Index
 * @package app\api\controller\v1
 */
class News extends Common
{
    public function index(){
        //校验 validate
        $data = input('get.');
        $this -> getPageAndSize($data);

        $whereData['status'] = config('code.status_normal');
        if(!empty($data['catid'])) {
            $whereData['catid'] = input('get.catid', 0, 'intval');
        }

        //模糊查询
        if(!empty($data['title'])){
            $whereData['title'] = ['like', '%'.$data['title'].'%'];
        }

        $count = model('News') -> getNewsCountByCondition($whereData);

        $news = model('News') -> getNewsByCondition($whereData, $this -> from, $this -> size);

        $result = [
            'total' => $count,
            'page_num' => ceil($count / $this -> size),
            'list' => $news
        ];

        return success('ok', $result);
    }

    /**
     * 获取详情接口
     */
    public function read(){

        //1.html 加载
        //2.接口
        $id = input('param.id', 0, 'intval');
        if(empty($id)){
            throw new ApiException('id is request', 404);
        }

        $news = model('News') -> get($id);
        if(empty($news) || $news -> status != config('code.status_normal')){
            throw new ApiException('news is not exists', 404);
        }

        //阅读数自增
        try {
            model('News')->where(['id' => $id])->setInc('read_count');
        }catch (\Exception $e){
            throw new ApiException('set inc fail', 404);
        }

        //转化catid位catname
        $cats = config('cat.lists');
        $news -> catname = $cats[$news -> catid];

        return success('ok', $news);
    }
}