<?php

namespace app\adlog\controller;

use think\Controller;
use think\Request;

class Blog extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = model($this->controller)->select()->toarray();
        foreach ($data as $k => $v) {
            if ($v['type']=='blog') {
               if ($v['sortid']==-1) {
                    $data[$k]['sortname'] = '未分类';
                }else{
                    $data[$k]['sortname'] = model('sort')->where('sid',$v['sortid'])->value('sortname');
                }
            }else{
                unset($data[$k]);
            }
            

        }
        
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
        $tags = db()->name('tag')->select()->toarray();
        $sorts = db()->name('sort')->select()->toarray();
        $this->assign('tags',$tags);
        $this->assign('sorts',$sorts);
        $this->assign('time',$_SERVER['REQUEST_TIME']);
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
        $tags = tagNameToId($data['tags']);
        $data['tags'] = trim('',$tags);
        $data['hide'] = isset($data['hide'])&&!empty($data['hide'])?$data['hide']:'n';
        $data['date'] = strtotime($data['date']);
        unset($data['as_logid']);
        unset($data['token']);
        $result = model($this->controller)->save($data);
        $blogid = model($this->controller)->where('title',$data['title'])->value('gid');
        addBlogIdToTag($blogid,$tags);
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
        print_r($id);exit();
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
