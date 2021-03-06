<?php


namespace app\admin\controller;


use think\Controller;
use think\Request;
use app\common\model\User;
use think\captcha\Captcha;


class LoginController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('default/index');
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
     * 退出登录
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function logout()
    {
        session('loginAdmin',false);
        return $this->error('正在退出中....','/admin/login');
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
    /**
     * 显示登录显示页
     */
     public function login()
    {
        return view('login/index');
    }
    /**
     * 显示登录执行页
     */
     public function do_login(Request $req)
    {
        $data = $req->post();
        // //dump($data);
        $code = $data['code'];
        $captcha = new Captcha();
        if(!$captcha->check($code))
        {
            return $this->error('验证码不正确','/admin/login');
        }
        $uname = $data['uname'];
        $pwd = $req->post('pwd',null,'md5');
        // $data['pwd'] = md5($data['pwd']);
        $res = User::where('uname','=',$uname)->where('pwd','=',$pwd)->find();
        if(empty($res)){
            return $this->error('密码错误','/admin/login');
        }
            //保存一个数据用来验证用户是否登录
            session('loginAdmin',true);
            //保存(session)登录用户信息
            session('users',$res);
            return $this->success('登录成功','/admin/index');
    }
    /**
     * 显示验证码
     */
    public function code()
    {
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
}
