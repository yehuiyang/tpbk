<?php

namespace app\adlog\controller;
use think\Controller;
use think\Request;

class Index extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        
        $countlog = db()->name('Blog')->count();
        $countcomment = db()->name('comment')->count();
        $mysql_version = db()->query('select VERSION() AS mysql_version')->toarray()[0]['mysql_version'];
        $serverinfo = substr($_SERVER['SERVER_SOFTWARE'],0,21).' php/'.PHP_VERSION;
        $gd_version = gd_info()['GD Version'];
        $filesize = ini_get('upload_max_filesize');
        $this->assign('prefix',config('database.prefix'));
        $this->assign('countlog',$countlog);
        $this->assign('countcomment',$countcomment);
        $this->assign('php_version',PHP_VERSION);
        $this->assign('mysql_version',$mysql_version);
        $this->assign('serverinfo',$serverinfo);
        $this->assign('gd_version',$gd_version);
        $this->assign('filesize',$filesize);
        return $this->fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
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
        //
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
