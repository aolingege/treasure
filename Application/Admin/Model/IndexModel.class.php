<?php
namespace Admin\Model;

use Think\Model;


class IndexModel extends Model
{
    protected $tableName = 'log';
    protected $tablePrefix = 'login_';

    /**
     * 得到登录信息
     * @return array
     */
    public function getLogin()
    {
        $todayLogin = M('login_log')->where("last_login >= '".date('Y-m-d 00:00:00').
            "' and last_login <= '".date('Y-m-d 23:59:59')."'")->select();
        //登录总数
        $all = count($todayLogin);
        $error = $normal = $psw = $code = $other = 0;
        foreach ($todayLogin as $row){
            switch ($row['status']){
                case '1':
                    $normal++;
                    break;
                case '2':
                    $psw++;
                    $error++;
                    break;
                case '3':
                    $code++;
                    $error++;
                    break;
                case '4':
                    $other++;
                    $error++;
                    break;
            }
        }
        $login =  array('all'=>$all,
            'normal'=>$normal,'error'=>$error,
            'psw'=>$psw,'code'=>$code,'other'=>$other);
        return $login;
    }

}