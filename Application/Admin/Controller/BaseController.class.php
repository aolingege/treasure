<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {

    public $admin = null;        //管理员信息
    protected $enterTime;

    /**
     * 构造函数完成相关检测
     * BaseController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->enterTime = microtime(true);
        //登录检测
        $safeController = C('UNLIMITED_CONTROLLER');
        //如果未登陆跳转到登陆页面
        $this->checkLogin() || in_array(CONTROLLER_NAME, $safeController) || (array_key_exists(CONTROLLER_NAME, $safeController) && in_array(ACTION_NAME, $safeController[CONTROLLER_NAME])) || $this->redirect('Login/login');
        $this->admin = session('admin');
        //个性化设置
        $this->admin['personalSetting'] = session('personalization');
        //权限检查
        $safeAuthModule = C('UNAUTHED_CONTROLLER');
        $auth = new \Think\Auth();
        ($this->admin['id'] == 1) || in_array(CONTROLLER_NAME, $safeAuthModule) || (array_key_exists(CONTROLLER_NAME, $safeAuthModule) && in_array(ACTION_NAME, $safeAuthModule[CONTROLLER_NAME])) || $auth->check(CONTROLLER_NAME . '/' . ACTION_NAME, $this->admin['id']) || (IS_AJAX ? $this->ajaxReturn(array('status' => false, 'info' => '您没有操作权限!')) : $this->error('您没有操作权限！'));
        //如果没有ID并通过了检测给予最高权限
        if (!isset($this->admin['id'])){
            $this->admin['id'] = 1;
        }
        $this->admin['rule'] = $this->_parseAuthRules($auth->getGroups($this->admin['id']));
        $this->assign('admin', $this->admin);
        $this->_getBaseInfo();
    }


    /**
     * 登录检测
     * @return bool
     */
    protected function checkLogin()
    {
        $admin = session('admin');
        return $admin['id'] ? true : false;
    }


    /**
     * 管理员操作日志
     * 日志数据 包含admin_id、add_time、type、log
     * @param array $data
     * 操作成功返回true 否则返回false
     * @return bool
     */
    protected function adminLog(array $data)
    {
        if (empty($data) || empty($data['log'])) {
            return false;
        }

        $admin_log = M('admin_log');

        return $admin_log->add($data) ? true : false;
    }


    /**
     * @brief 读取初始化信息
     */
    private function _getBaseInfo()
    {
        $config = array();
        $config['URL_MODEL'] = C('URL_MODEL');
        $config['CONTROLLER_NAME'] = CONTROLLER_NAME;
        $config['ACTION_NAME'] = ACTION_NAME;
        $config['MODULE_NAME'] = MODULE_NAME;

        //读取系统导航
        //读取能看到的导航条
        $navigation = M('auth_rule')->where('show_status=1')->order('sort DESC,id ASC')->field('id,name,title,parent_id')->select();
        //取权限交集
        $navigation = refactor_array($navigation);
        //如果ID不等于1
        if ($this->admin['id'] != 1) {
            $intersect = array_intersect(array_keys($navigation), $this->admin['rule']);

            foreach ($navigation as $key => $val) {
                if (!in_array($key, $intersect) && $val['parent_id']) {
                    unset($navigation[$key]);
                }
            }
        }
        $config['current'] = $this->getCurrentFn($navigation);
        $config['navigation'] = tree_array($navigation);
        $this->assign('config', $config);
    }


    /**
     * 得到当前的功能集
     */
    protected function getCurrentFn($fns){
        $current = array();
        //Tree function set
        //Linear lookup
        foreach ($fns as $index => $fn){
            //一级控制器
            if ($fn['parent_id'] == 0 && $fn['name'] == CONTROLLER_NAME){
                //Current function
                $current = $fn;
                unset($fns[$index]);
                break;
            }elseif ($fn['parent_id'] == 0){
                unset($fns[$index]);
            }
        }
        //Can't find
        if (empty($current))
            return false;
        //寻找下面的
        $currentH3 = array();
        foreach ($fns as $fn){
            if ($fn['parent_id'] == $current['id']){
                    if (str_replace('Nav','',$fn['name']) == CONTROLLER_NAME)
                        $fn['active'] = 'active';
                    $currentH3[] = $fn;
            }
        }
        //go on
        if (!empty($currentH3)){
            foreach ($currentH3 as $index => $title){
                foreach ($fns as $fn){
                    if ($title['id'] == $fn['parent_id']){
                        if ($fn['name'] != CONTROLLER_NAME.'/'.ACTION_NAME){
                            $tempFns = explode('/',$fn['name']);
                            if (CONTROLLER_NAME != $tempFns[0]){
                                $fn['active'] = 'style="display: none;"';
                            }
                        }
                        $currentH3[$index]['children'][] = $fn;
                    }
                }
            }
        }
        return array('h2'=>$current,'h3'=>$currentH3);
    }


    /**
     * @brief 解析权限规则
     * @param array $rules 权限数组
     * @return array|bool
     */
    private function _parseAuthRules(array $rules)
    {
        if (!$rules) {
            return false;
        }
        $rule = null;
        foreach ($rules as $val) {
            $rule .= join(',', $val);
        }
        return array_unique(explode(',', $rule));
    }


    /**
     * 404错误
     */
    public function _empty(){
        $this->display('public/404');
    }

    /**
     * 通用添加编辑
     * @param $that
     * @param $table
     * @param string $id
     */
    public function updateCommon($that,$table,$id='')
    {
        if ($id){
            $title = '编辑';
            $rule = M($table)->where("id='{$id}'")->find();
            $that->assign('edit',$rule);
        }else{
            $title = '添加';
        }
        $that->assign('title',$title);
    }

}