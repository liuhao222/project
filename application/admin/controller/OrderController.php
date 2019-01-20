<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Order;

class OrderController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
       $data = Order::select();
       //dump($data);
       return view('order/index',['data'=>$data]);

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

          //用户启用
    public function start($id)
    {   
        try {
           $data =  Order::update(['status'=>'1','uid'=>$id]); //将用户状态改为1达到启用
        //dump($data);
        die();
        } catch (\Exception $e) {
            return $this->error('发货失败');
        }
            return $this->success('发货成功','/admin/order_index');
        
    }

      //用户禁用
    public function stop($id)
    {
     
        try {
            Order::update(['status'=>'2','uid'=>$id]); //将用户状态改为1达到启用
        } catch (\Exception $e) {
            return $this->error('调整待发货失败');
        }
             return $this->success('调整待发货成功','/admin/order_index');
        
    }
      
}
