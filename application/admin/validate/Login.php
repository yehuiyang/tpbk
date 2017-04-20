<?php
namespace app\admin\validate;
use \think\Validate;
class Login extends Validate {
    protected $rule = [
     'user'=>'require|max:15',
     'pass'=>'require|max:15',    
    ];
     protected $message  =   [
     'user.require' => '账号必须',
     'user.max'     => '账号最多不能超过15个字符',
     'pass.require' => '密码必须',
     'pass.max'     => '密码最多不能超过15个字符',
    ];
}

