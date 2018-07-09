<?php
namespace Admin\Controller;

use Admin\Model\AdminModel;

class LoginController extends BaseController {

    public function login()
    {
        if (IS_POST){
//            Verification result
            $verifiResult = $this->checkUser();
            if ($verifiResult === true)
                $this->redirect(U('Index/index'));
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
        $code = I('post.code');
        $verifiResult = $this->checkVerify($code);
        if (!$verifiResult)
            return '验证码填写错误！';
        $adminTable = new AdminModel();
        $adminTable->user_name = I('post.account','');
        $account = $adminTable->find();
        if ($account){
            if ($account->password  != md5(I('post.password',''))){
                return '账号与密码信息不匹配！';
            }
        }else
            return '没有此账号信息！';
        return true;
    }


}