<?php
namespace Admin\Model;

use Think\Exception;
use Think\Model;

class AuthModel extends Model
{

    protected $tableName = 'rule';
    protected $tablePrefix = 'auth_';


    /**
     * 得到所有的权限规则
     * @return array
     */
    public function getAllAuth()
    {
        $allRule = M('auth_rule')->where('level != 0')->select();
        $result = $this->getCleanUp($allRule);
        return $result;
    }



    /**
     * 得到整理后的数组
     * @param $allRules
     * @return array
     */
    public function getCleanUp($allRules)
    {
        $arr = array();
        foreach ($allRules as $controller){
            if ($controller['level'] == 1){
                $arr[] = $controller;
                $temp = array();
                $sort = array();
                foreach ($allRules as $action){
                    if ($action['parent_id'] == $controller['id']){
                        $temp[] = $action;
                        $sort[] = $action['sort'];
                    }
                }
                array_multisort($temp,$sort,'SORT_DESC');
                $arr = array_merge($arr,$temp);
            }
        }
        $level = array(1=>'控制器',2=>'方法');
        $show = array('否','是');
        foreach ($arr as $k=>$row){
            $arr[$k]['explain'] = $level[$row['level']];
            $arr[$k]['show'] = $show[$row['show_status']];
        }
        return $arr;
    }


    /**
     * 保存于更新方法
     * @param $table
     * @param $data
     * @return array
     */
    public static function commonUpdate($table,$data)
    {
        try{
            if ($data['id']){
                $result = M($table)->data($data)->save();
            }else{
                $result = M($table)->data($data)->add();
            }
        }catch (Exception $exception){
            $result = array('exception'=>$exception->getMessage(),'status'=>0);
        }
        return array('exception'=>'','status'=>$result);
    }

    
    /**
     * 得到权限组展示数据
     * @return array
     */
    public function getAuthGroup()
    {
        $allRules = M('auth_rule')->where('level != 0')->select();
        $controller = array();
        foreach ($allRules as $allRule){
            if ($allRule['level'] == 1){
                $controller[] = $allRule;
            }
        }
        foreach ($allRules as $allRule){
            if ($allRule['level'] == 1)
                continue;
            foreach ($controller as $k=>$item){
                if ($allRule['parent_id'] == $item['id']){
                    $controller[$k]['children'][] = $allRule;
                    break;
                }
            }
        }
        return $controller;
    }

    /**
     * @return bool|mixed
     */
    public function saveAuthGroup()
    {
        $db = M('auth_group');

        $data['rules'] = join(',',$_POST['auth_node']);
        $data['status'] = $_POST['status'];
        $data['title'] = $_POST['title'];

        $id = I("post.id","");
        if($id){
            $data['id'] = $id;
            $result = $db->data($data)->save();
        }else{
            $result = $db->data($data)->add();
        }
        return $result;
    }

    /**
     * 得到用户权限
     * @param $values
     * @return mixed
     */
    public function getUserAuth($values)
    {

        $groups = M('auth_group_access')->where("uid={$values['id']}")->select();
        $str = array();
        foreach ($groups as $group){
            $str[] = $group['group_id'];
        }
        $auth = M('auth_group')->where("id in (".join(',',$str).")")->select();
        $ruleID = array();
        foreach ($auth as $row){
            $ruleID[] = $row['rules'];
        }
        $ruleArr = explode(',',join(',',$ruleID));
        $ruleArr = array_unique($ruleArr);
        $result = M('auth_rule')->where("id in (".join(',',$ruleArr).")")->select();
        return $result;
    }



}