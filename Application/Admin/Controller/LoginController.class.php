<?php
namespace Admin\Controller;

use Admin\Model\AdminModel;
use Admin\Model\LoginLogModel;

class LoginController extends BaseController {


    /**
     * 登录方法
     */
    public function login()
    {
        if ($this->checkLogin())
            $this->redirect('/index/index');
        if (IS_POST){
            //Verification result
            $verifiResult = $this->checkUser();
            if ($verifiResult === true)
                $this->redirect('/index/index');
            else{
                //返回提示信息
                $this->assign('message',$verifiResult);
            }
        }
        $this->display();
    }

    /**
     * 生成一个验证码
     */
    public function code()
    {
        $Verify = new \Think\Verify(C('CODESET'));
        $Verify->entry();
    }


    /**
     * 验证验证码信息
     * @param $code
     * @param string $id
     * @return bool
     */
    public function checkVerify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }


    /**
     * 验证用户信息
     */
    public function checkUser()
    {
        $logModel = new LoginLogModel();
        $code = I('post.code');
        $verifiResult = $this->checkVerify($code);
        if (!$verifiResult){
            $logModel->generalError(I('post.account'),3);
            return '验证码填写错误！';
        }
        $adminTable = new AdminModel();
        $adminTable->user_name = I('post.account','');
        $account = $adminTable->find();
        if ($account){
            if ($account['password']  != md5(I('post.password',''))){
                $logModel->generalError($adminTable->user_name,2);
                return '账号与密码信息不匹配！';
            }
        }else{
            $logModel->generalError($adminTable->user_name,4);
            return '没有此账号信息！';
        }
        $logModel->generalError($adminTable->user_name,1);
        session('admin',$account);
        return true;
    }



}