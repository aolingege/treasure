<?php
namespace Admin\Controller;

use Admin\Model\AdminModel;

class AuthRoleController extends BaseController {

    /**
     * 管理员列表
     */
    public function index()
    {
        $adminModel = new AdminModel();
        $allUser = $adminModel->getAllUser();
        $this->assign('info',$allUser);
        $this->display();
    }

    /**
     * 添加管理员
     * @param string $id
     */
    public function add($id='')
    {
        $adminModel = new AdminModel();
        if (IS_POST){
            $result = $adminModel->saveUser();
            if ($result){
                $this->success('更新成功',U('index'),1);
            }else{
                $this->success('更新失败');
            }
            exit();
        }
        if ($id){
            $title = '编辑';
            $user = $adminModel->getUser($id);
            $this->assign('edit',$user);
        }else{
            $title = '添加';
        }
        $group = M('auth_group')->select();
        $this->assign('group',$group);
        $this->assign('title',$title);
        $this->display();
    }

}