<?php
namespace Admin\Controller;

use Admin\Model\AdminModel;
use Admin\Model\AuthModel;
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
     * @return bool|string
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
        $account['last_login'] = date('Y-m-d H:i:s');
        $adminTable->where(array('user_name'=>$account['user_name'],'password'=>$account['password']))
            ->data($account)->save();
        session('admin',$account);
        return true;
    }


    /**
     * 重置密码
     */
    public function resetPsw()
    {
        $values = session('admin');
        $adminModel = new AdminModel();
        $result = $adminModel->where("id={$values['id']}")
            ->data(array('password'=>md5('123456')))->save();
        $values['password'] = md5('123456');
        session('admin',$values);
        if ($result){
            $this->ajaxReturn(array('status'=>1,'msg'=>'重置成功'));
        }else{
            $this->ajaxReturn(array('status'=>0,'msg'=>'重置失败'));
        }
    }


    /**
     * 查看权限
     */
    public function viewPermissions()
    {
        $values = session('admin');
        $authModel = new AuthModel();
        if ($values['id'] == 1){
            //超级管理员
            $result = $authModel->getAllAuth();
        }else{
            $result = $authModel->getUserAuth($values);
            $result = $authModel->getCleanUp($result);

        }
        $this->assign('info',$result);
        $this->display();
    }


    /**
     * 退出登录
     */
    public function loginOut()
    {
        session('admin',null);
        $this->redirect('login/login');
    }



}