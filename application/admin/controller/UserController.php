<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\User;
class UserController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // $search = $_GET['uname'];
        // echo $search;
        $search = [];
        if(!empty($_GET['uname'])){
            $search[]=['uname','like',"%{$_GET['uname']}%"];
        }

        if(!empty($_GET['status'])){
            $search[]=['status','=',"{$_GET['status']}"];
        }
        $data = User::where($search)->paginate(3)->appends($_GET);
        // dump($data);

       return view('user/index',['data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('user/create');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        // dump($request->post());   //打印获取数据
       $data = $request->post();   //获取数据添加的数据
       if($data['pwd'] != $data['repwd']){
        return $this->error('两次输入的密码不一致，请重新输入');
       }

        if(empty($data['pwd'])){
         return $this->error('密码不能为空');
       }
     



       try {
           User::create($data,true);   //插入数据库，true  过滤字段
       } catch (\Exception $e) { //  \表示根目录下的
           return $this->error('注册失败！','/admin/user_create');
       }
            return $this->success('注册成功！','/admin/user_index');       
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
       
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        // var_dump($data);
        return view('user/edit',['data'=>$data]);
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
        // dump($request->post());
        $data = $request->post();   //获取数据添加的数据
        try {
             User::update($data,['uid'=>$id]);   //修改数据到数据库
        } catch (\Exception $e) {
            return $this->error('修改失败！','/admin/user_index');
        }
            return $this->success('修改成功！','/admin/user_index');
    }

    //修改密码页面
    public function updatepwd($id)
    {
        $data = User::find($id);
        // var_dump($data);

        // var_dump($data);
        return view('user/updatepwd',['data'=>$data]);
    }

    //执行修改密码
     public function reupdatepwd(Request $request, $id)
    {
        $data = User::find($id);
        // var_dump($data);
        // dump($request->post());
        
        $res = $request->post();   //获取数据添加的数据
        // var_dump($res);
      
        if(empty($res['pwd']) || empty($res['repwd'])){
            return $this->error('新密码不能为空哦！');
        }elseif(empty($res['ypwd'])){
            return $this->error('原密码不能为空哦！！！');
        }elseif($res['pwd'] != ($res['repwd'])){
            return $this->error('两次密码不一致哦！！');
        }elseif(md5($res['ypwd']) != $data['pwd']){
            return $this->error('原密码不正确');
        }else{
             User::update($res,['uid'=>$id]);
            return $this->success('密码修改成功!!!','/admin/user_index');
        }
               
    }

      //用户启用
    public function start($id)
    {   
        try {
            User::update(['zt'=>'1','uid'=>$id]); //将用户状态改为1达到启用
        } catch (Exception $e) {
            return $this->error('启用失败！！！');
        }
            return redirect('/admin/user_index');
        
    }

      //用户禁用
    public function stop($id)
    {
     
        try {
            User::update(['zt'=>'2','uid'=>$id]); //将用户状态改为1达到启用
        } catch (Exception $e) {
            return $this->error('禁用失败！！！');
        }
            return redirect('/admin/user_index');
    }
      
    

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
      $data = User::destroy($id);
      if($data){
            return $this->success('删除成功！','/admin/user_index');
       }
            return $this->error('删除失败');
    }

     /**
     * 检测用户名是否存在
     */
    public function search_uname(){
       $name = $_GET['uname'];
       $data = User::where('uname','=',$name)->find();
       if(empty($data)){
            return json_encode(['status'=>400]);
       }
       return json_encode(['status'=>200]);
    }
}
