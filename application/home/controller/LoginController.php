<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\User;
use think\captcha\Captcha;
use app\common\model\Config;
use app\common\model\Friendlink;

class LoginController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $dd = Config::select();
        return view('login/index');
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

        public function do_login(Request $req)
    {
        $dd = Config::select();
        $data = $req->post();
        //// dump($data);
        $code = $data['code'];
        $captcha = new Captcha();
        if(!$captcha->check($code))
        {
            return $this->error('验证码不正确','/home/login_index');
        }
        $uname = $data['uname'];
        $pwd = $req->post('pwd',null,'md5');
        // $data['pwd'] = md5($data['pwd']);
        $res = User::where('uname','=',$uname)->where('pwd','=',$pwd)->find();
        
        if(empty($res)){
            return $this->error('密码错误','/home/login_index');
        }
            //保存一个数据用来验证用户是否登录
            session('loginUser',true);
            //保存(session)登录用户信息
            session('users',$res);
            return $this->success('登录成功','/home/index');
    }

        /* 显示验证码
     */
    public function code()
    {
        $dd = Config::select();
        $config =    [
        // 验证码字体大小
        'fontSize'=>15,    
        // 验证码位数
        'length'=>4,   
        // 关闭验证码杂点
        'useNoise'=>false, 
        //是否画混淆曲线
        'useCurve'=>false,
    ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }
     /**
     * 退出登录
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function logout()
    {
        // $dd = Config::select();
        session('loginUser',null);
        
        return $this->error('正在退出中....','/home/index');
    }


}
