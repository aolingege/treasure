<?php
namespace Admin\Model;

use Think\Model;

class AuthModel extends Model
{

    protected $tableName = 'rule';
    protected $tablePrefix = 'auth_';

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
    
}