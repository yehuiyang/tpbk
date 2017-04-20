<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;

class Node extends Common
{

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        $node = model('node')->where('pid','=',0)->select();
        if (!empty($node)) {
            $this->assign('node',$node);
        }
        parent::create();
    }

}
