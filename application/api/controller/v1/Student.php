<?php
/**
 * Created by PhpStorm.
 * User: small
 * Date: 2018/5/26
 * Time: 13:55
 */

namespace app\api\controller\v1;


use app\api\controller\Common;
use app\common\model\StudentMessage;

class Student extends Common
{
    public function save(){
        $param = input('param.');
        if (empty($param['name'])) {
            return fail('姓名不能为空', [], 200);
        }
        if (empty($param['sex'])) {
            return fail('性别不能为空', [], 200);
        }
        if (empty($param['year'])) {
            return fail('届别不能为空', [], 200);
        }
        if (empty($param['company'])) {
            return fail('工作单位不能为空', [], 200);
        }
        if (empty($param['job'])) {
            return fail('职务不能为空', [], 200);
        }
        if (empty($param['phone'])) {
            return fail('电话不能为空', [], 200);
        }
        if (empty($param['email'])) {
            return fail('邮箱不能为空', [], 200);
        }

        $student = StudentMessage::get(['phone' => $param['phone']]);
        if($student){
            $id = model('StudentMessage') -> save($param, ['phone' => $param['phone']]);
            if($id){
                return success('上传数据成功', []);
            }else{
                return fail('上传数据失败', []);
            }
        }else{
            $id = model('StudentMessage') -> insert($param);
            if($id){
                return success('上传数据成功', []);
            }else{
                return fail('上传数据失败', []);
            }
        }
    }
}