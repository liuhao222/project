<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\User;

class ZhuceController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('zhuce/index');
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

        $data=$request->post();
        dump($data);
            if(empty($data['uname'])){
                 return $this->error('用户名不能为空');
               }

             $att="/^[0-9a-zA-Z_][0-9a-zA-Z_]{5,11}$/";
             //调用正则匹配函数
             //验证用户名是否符合规则
            // if(!preg_match_all($att,$data['uname'],$res))
            // {
             
            //    return $this->error('注册失败，请输入6-12位的数字，字母或下划线的用户名','/home/zhuce_index');
                
            //  }

             //密码是否一致
            if($data['pwd'] != $data['repwd']){
            return $this->error('两次输入的密码不一致，请重新输入');
           }
            //密码是否为空
            if(empty($data['pwd'])){
             return $this->error('密码不能为空');
           }


            //验证密码是否符合规则
            if(!preg_match_all($att,$data['pwd'],$res))
            {
             
               return $this->error('注册失败，请输入6-12位的数字，字母或下划线的密码','/home/zhuce_index');
              
             }



             $preg_phone='/^1([38]\d|5[0-35-9]|7[3678])\d{8}$/';
             //验证手机号码是否符合规则
            if(!preg_match_all($preg_phone,$data['phone'],$res))
            {
             
               return $this->error('注册失败，请输入正确的手机号码','/home/zhuce_index');
                
             }

            //邮箱是否为空
           if(empty($data['email'])){
             return $this->error('邮箱不能为空');
           }

            //使用 FILTER_VALIDATE_EMAIL 过滤器验证邮箱
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                return $this->error('请检查您的邮箱是否正确');
            } 
           

     
    
             try {
               User::create($data,true);   //插入数据库，true  过滤字段
           } catch (\Exception $e) { //  \表示根目录下的
               return $this->error('添加失败！','/home/zhuce_index');
           }
                return $this->success('添加成功！','/home/index'); 

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
