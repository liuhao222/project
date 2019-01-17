<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Goods;
use app\common\model\Type;
use app\tools\Cattree;
class HomeController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
         $a = Goods::select();
         
         $data = Type::select();

        // $sql=Db::field('data_goods.type_id,data_type.id')//截取表s的name列 和表a的全部
        // ->table(['data_goods','data_type'])
        // ->where('data_goods.type_id=data_type.id')//查询条件语句
        // ->select();
        // dump($sql);
     
    // Db::table('data_goods','data_type')->where('status',1)->select();
        
        
        dump($a);
        dump($data);
        return view('home/index',['data'=>$data,'a'=>$a]);

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
}
