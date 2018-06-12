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
class Home extends Common
{
    public function read()
    {
        $heads = model('News')->getIndexHeadNormalNews();
        $heads = $this->getDealNews($heads);

        $position = model('News')->getPositionNormalNews();
        $position = $this->getDealNews($position);

        $result = [
            'heads' => $heads,
            'positions' => $position
        ];

        return success('ok', $result);
    }

    /**
     * 客户端初始化接口
     */
    public function init()
    {
        //app_type 去 version 表查询最后一条数据
        $version = model('Version')->getLastNormalVersionByAppType($this->headers['app_type']);
        if (empty($version)) {
            throw new ApiException('version is null', 404);
        }
//        halt($this->headers);
        if ($version->version > $this->headers['version']) {
            //0 不更新  1需要更新 2强制更新
            $version->is_update = $version->is_force == 1 ? 2 : 1;
        } else {
            $version->is_update = 0;
        }

        //记录信息
        $actives = [
            'version' => $this->headers['version'],
            'app_type' => $this->headers['app_type'],
            'version_code' => $this->headers['version_code'],
            'device_id' => $this->headers['device_id'],
            'model' => $this->headers['model'],
            'imei' => $this->headers['imei'],
            'application_id' => $this->headers['application_id'],
            'mac_address' => $this->headers['mac_address'],
            'channel' => $this->headers['channel'],
            'brand' => $this->headers['brand'],
            'time_stamp' => $this->headers['time_stamp'],
            'osversion' => $this->headers['osversion']
        ];

        try {
            model('AppActive')->add($actives);
        } catch (\Exception $e) {

        }
        return success('ok', $version);
    }
}