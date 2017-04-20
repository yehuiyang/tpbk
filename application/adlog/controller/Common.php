<?php
namespace app\adlog\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Db;
class Common extends Controller
{
    public $module;
    public $controller;
    public $action;
    public $pk;
    /**
     * [_initialize description]
     */
    function _initialize()
    {
       // if (!session("uid")) {
       //   return $this->redirect("Login/index"); 
       // } 
       $this->module = Request::instance()->module(); 
       $this->controller = Request::instance()->controller(); 
       $this->action = Request::instance()->action();
       if (empty(Db::query("SHOW TABLES LIKE '".$this->controller."'"))) {
            $this->pk = Db::getTableInfo($this->controller,'pk');
            echo $this->pk;
       }
       
       session('last_url',Request::instance()->url());
    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = model($this->controller)->select();
        $this->assign('data',$data);
        return $this->fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {

        echo $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->post();
        $result = model($this->controller)->save($data);
        if($result){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('新增成功',url('/'.$this->controller.'/create'));
        }else{
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('新增失败',session('last_url'));
        }

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $result = model('node')->where($this->pk,$id)->find();
        $this->assign('node',$result);
        return $this->fetch();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
