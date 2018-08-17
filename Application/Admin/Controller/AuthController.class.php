<?php
namespace Admin\Controller;

use Admin\Model\AuthModel as authModel;

class AuthController extends BaseController {

    public function index()
    {
        //权限模型类
        $authModel = new authModel();
        $res = $authModel->getAllAuth();
        $this->assign('info',$res);
        $this->display();
    }

}