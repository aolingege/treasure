<?php
namespace Admin\Controller;

use Admin\Model\IndexModel;

class IndexController extends BaseController {




    /**
     * 首页信息
     */
    public function index()
    {
        $indexModel = new IndexModel();
        $loginInfo = $indexModel->getLogin();
        $this->assign('login',json_encode($loginInfo));
        $this->assign('log',$loginInfo);
        $this->display();
    }

    /**
     * 关于
     */
    public function about()
    {
        $this->display();
    }

}