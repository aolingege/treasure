<?php
namespace Admin\Controller;


use Admin\Model\AuthModel;

class NodeController extends BaseController {

    /**
     * 导航列表
     */
    public function navList()
    {
        $navNodes = M('auth_rule')->where("level=0")->select();
        $show = array('不显示','显示');
        foreach ($navNodes as $k=>$navNode){
            $navNodes[$k]['show'] = $show[$navNode['show_status']];
        }
        $this->assign('info',$navNodes);
        $this->display();
    }


    /**
     * 添加导航
     * @param string $id
     */
    public function navAdd($id='')
    {
        if (IS_POST){
            $data = $_POST;
            $data['level'] = 0;
            $data['parent_id'] = 0;
            $result = AuthModel::commonUpdate('auth_rule',$data);
            if ($result['status']){
                $this->success('更新成功',U('navList'),1);
            }else{
                $this->success('更新失败');
            }
            exit();
        }
        $this->updateCommon($this,'auth_rule',$id);
        $this->display();
    }

}