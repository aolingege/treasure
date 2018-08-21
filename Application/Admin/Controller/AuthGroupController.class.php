<?php
namespace Admin\Controller;


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





}