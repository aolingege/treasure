<?php
namespace Admin\Controller;


use Admin\Model\AuthModel;

class AuthGroupController extends BaseController {

    /**
     * 权限组列表
     */
    public function index()
    {
        //auth_group
        $group = M('auth_group')->select();

        $status = array('禁用','正常');

        foreach ($group as $k=>$row){
            $group[$k]['status_cn'] = $status[$row['status']];
        }

        $this->assign('info',$group);
        $this->display();
    }

    /**
     * 更新权限组
     * @param string $id
     */
    public function update($id = '')
    {
        $authModel = new AuthModel();
        if (IS_POST){
            $result = $authModel->saveAuthGroup();
            if ($result){
                $this->success('更新成功',U('index'),1);
            }else{
                $this->success('更新失败');
            }
            exit();
        }
        $this->updateCommon($this,'auth_group',$id);
        $allAuth = $authModel->getAuthGroup();
        $this->assign('authNode',$allAuth);
        $this->display();
    }





}