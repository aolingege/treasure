<?php
namespace Admin\Model;

use Think\Model;


class LoginLogModel extends Model
{

    /**
     * 密码错误
     * @param $account
     * @return mixed
     */
    public function passwordError($account)
    {
        $log['user_name'] = $account;
        $log['status'] = 2;
        $log['last_login'] = date('Y-m-d H:i:s');
        return self::data($log)->add();
    }

    /**
     * 正常登陆日志
     * Normal landing
     * @param $account
     * @return mixed
     */
    public function normalLanding($account)
    {
        $log['user_name'] = $account;
        $log['status'] = 1;
        $log['last_login'] = date('Y-m-d H:i:s');
        return self::data($log)->add();
    }


    /**
     * 验证码错误
     * Verification Code
     * @param $account
     * @return mixed
     */
    public function verificationError($account)
    {
        $log['user_name'] = $account;
        $log['status'] = 3;
        $log['last_login'] = date('Y-m-d H:i:s');
        return self::data($log)->add();
    }

    /**
     * 其他错误
     */
    public function otherError()
    {
        $log['status'] = 4;
        $log['last_login'] = date('Y-m-d H:i:s');
        return self::data($log)->add();
    }

    /**
     * 通用错误记录
     * General error
     * @param string $account
     * @param $type
     * @return bool|mixed
     */
    public function generalError($account = '',$type)
    {
        if (!intval($type) || $type < 1 || $type > 4 )
            return false;
        $log['status'] = $type;
        $log['last_login'] = date('Y-m-d H:i:s');
        if ($account != '')
            $log['user_name'] = $account;
        return self::data($log)->add();
    }


}