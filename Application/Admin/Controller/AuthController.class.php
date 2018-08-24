<?php
namespace Admin\Controller;

use Admin\Model\AuthModel as authModel;

class AuthController extends BaseController {

    /**
     * 节点列表
     */
    public function index()
    {
        //权限模型类
        $authModel = new authModel();
        $res = $authModel->getAllAuth();
        $this->assign('info',$res);
        $this->display();
    }


    /**
     * 更新节点列表
     * @param string $id
     */
    public function updateNode($id='')
    {
        if (IS_POST){
            $data = $_POST;
            if ($data['level'] == 1){
                $data['parent_id'] = $data['nav'];
            }else{
                $data['parent_id'] = $data['controller'];
            }
            unset($data['nav']);
            unset($data['controller']);
            //filters
            $result = authModel::commonUpdate('auth_rule',$data);
            if ($result['status']){
                $this->success('更新节点成功',U('index'),1);
            }else{
                $this->success('更新节点失败');
            }
            exit();
        }
        parent::updateCommon($this,'auth_rule',$id);
        //parent node
        $parents = M('auth_rule')->where("level=0 or level=1")->select();
        $controller = array();
        $nav = array();
        foreach ($parents as $parent){
            if ($parent['level'] == 0){
                $nav[] = $parent;
            }else{
                $controller[] = $parent;
            }
        }
        $this->assign('parentNav',$nav);
        $this->assign('parentController',$controller);
        $this->display();
    }



}