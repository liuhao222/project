<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\User;
use app\common\model\Goods;
use app\common\model\Car;
use app\common\model\Config;
use app\common\model\Friendlink;

use think\Session;
use  \think\Db;
class CarController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        //判断用户是否登录
        if(empty(session('loginUser'))){
             return $this->error('请先登录','/home/login_index');
        }
        $dd = Config::select();
        $f = Friendlink::select();
        $data['uid'] = session('users.uid');
        //查询商品表
        $res = Goods::select();
        //按照用户id查询购物车信息
        $res = Car::where('uid','=',session('users.uid'))->select();
        //统计当前用户的购物车数量
        $b = count($res);
        //dump($b);
        //dump($res);

         return view('car/index',['data'=>$data,'res'=>$res,'b'=>$b,'dd'=>$dd,'f'=>$f]);


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
    public function save(Request $request,$id)
    {
        $dd = Config::select();
        $data = $request->post();
        //dump($data);
        // die();
       if(empty(session('loginUser'))){
            return $this->error('登陆后才能添加哦！','/home/login_index');
        }
            //获取传入的参数
             $data = $request->post();
             //dump($data);
             //将传入的参数存进购物车
            try {
           Car::create($data,true);   //插入数据库，true  过滤字段
       } catch (\Exception $e) { //  \表示根目录下的
           return $this->error('添加购物车失败','/home/index');
       }
            return $this->success('添加购物车成功','/home/car_index/{$data->uid}');
        return view('car/index');
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
        $dd = Config::select();
         $data = Car::destroy($id);
      if($data){
            return $this->success('删除成功！','/home/car_index');
       }
            return $this->error('删除失败','/home/car_index');
    }
}
