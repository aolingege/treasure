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


    /**
     * 得到所有用户信息
     * @return mixed
     */
    public function getAllUser()
    {
        $user = self::join('auth_group_access ON admin.id = auth_group_access.uid','LEFT')
            ->field('admin.id,admin.user_name,admin.last_login,admin.create_time,auth_group_access.group_id')
            ->select();
        $group = M('auth_group')->select();
        $groupIndex = array_column($group,'title','id');
        foreach ($user as $k=>$row){
            $user[$k]['item'] = $groupIndex[$row['group_id']] ?
                $groupIndex[$row['group_id']] : '未分配';
        }
        return $user;
    }

    /**
     * 寻找单一用户
     * @param $id
     * @return mixed
     */
    public function getUser($id)
    {
        $user = self::join('auth_group_access ON admin.id = auth_group_access.uid','LEFT')
            ->field('admin.id,admin.user_name,admin.last_login,admin.create_time,auth_group_access.group_id')
            ->where("admin.id = {$id}")
            ->find();
        return $user;
    }


    /**
     * 保存用户信息
     * @return bool|mixed
     */
    public function saveUser()
    {
        $uid = I('post.id',"");
        if ($uid){
            //编辑
            $dbGroup = M('auth_group_access');
            $group['group_id'] = $_POST['group_id'];
            $group['uid'] = $uid;
            if ($group['group_id'] != 0){
                $dbGroup->where($group)->delete();
                if ($dbGroup->where($group)->find()){
                    $dbGroup->where("uid='{$uid}'")->data($group)->save();
                }else{
                    $dbGroup->data($group)->add();
                }
            }
            if ($_POST['password']){
                $data['password'] = md5($_POST['password']);
            }
            $data['user_name'] = $_POST['user_name'];
            $data['update_time'] = date('Y-m-d H:i:s');
            return self::where("id='{$uid}'")->data($data)->save();
        }else{
            $data['password'] = md5($_POST['password']);
            $data['user_name'] = $_POST['user_name'];
            $data['create_time'] = date('Y-m-d H:i:s');
            self::startTrans();
            $id = self::data($data)->add();
            $group['uid'] = $id;
            $group['group_id'] = $_POST['group_id'];
            if ($group['group_id'] == 0){
                self::commit();
                return true;
            }
            $groupID =  M('auth_group_access')->data($group)->add();
            if ($groupID){
                self::commit();
            }else{
                self::rollback();
            }
            return $groupID;
        }
    }

}