<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Goods;
use app\common\model\Type;
use app\common\model\Config;
use app\common\model\Friendlink;
use app\tools\Cattree;
use  \think\Db;
class HomeController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

            $f = Friendlink::select();
           // dump($f);
            $dd = Config::select();
            //// dump($dd);
            if($dd['0']['status']==1){
                 //查询商品表
             $a = Goods::select();
              //查询分类表
             $data = Type::select();
             $c = new Cattree($data);
             
              
             // $r = Type::where(['pid'=>'id'])->select();
            // // dump($a);
            //// dump($data);
            //// dump($res);
            //// dump($r);
           
            $res = DB::table('data_goods')->alias('a')
            ->join('data_type t','a.type_id=t.id')
            // ->field('a.type_id,i.id')
            ->select();
            //// dump($res);

            return view('home/index',['data'=>$data,'a'=>$a,'res'=>$res,'dd'=>$dd,'f'=>$f]);

        }
            return view('error/index');
       
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
