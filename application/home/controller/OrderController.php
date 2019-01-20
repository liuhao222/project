<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Order;
use app\common\model\Config;
use app\common\model\Friendlink;
class OrderController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
          if(empty(session('loginUser'))){
             return $this->error('请先登录','/home/login_index');
        }
       $dd = Config::select();
       $f = Friendlink::select();
        $data = Order::where('uid','=',session('users.uid'))->select();
       // dump($data);

        return view('order/index',['data'=>$data,'dd'=>$dd,'f'=>$f]);
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
        $dd = Config::select();
         $data = $request->post();

       // dump($data);
        // die();
        try {
           Order::create($data,true);   //插入数据库，true  过滤字段
       } catch (\Exception $e) { //  \表示根目录下的
           return $this->error('下单失败','/home/car_index');
       }
            return $this->success('下单成功','/home/order_index');
       
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
