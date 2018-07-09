<?php
namespace Admin\Model;

use Think\Model;


class AdminModel extends Model
{
    /**
     * 初始化root
     * @param string $password
     * @return mixed
     */
    public function initAdmin($password = 'admin.com')
    {
        //删除管理员账号
        self::where("id=1")->delete();
        $admin['id'] = 1;
        $admin['user_name'] = 'admin';
        $admin['password'] = md5($password);
        $admin['create_time'] = date('Y-m-d H:i:s');
        return self::data($admin)->add();
    }

}