<?php


namespace app\admin\validate;


use think\Validate;

class User extends Validate
{
    protected $rule=[
        'username'=>'require|max:25',
        'password'=>'require|min:6'
    ];
    protected $message=[
        'username.require'=>'用户名不能为空',
        'username.max'=>'名称最多不能超过25个字符',
//        'username.unique'=>'用户已存在',
        'password.require'=>'密码不能为空',
        'password.min'=>'密码至少6个字符'
    ];
}