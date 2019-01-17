<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Type;
use app\tools\Cattree;
class TypeController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $data = Type::select();
        $c = new Cattree($data);
        $data = $c->getTree();
         // dump($data);
        return view('type/index',['data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create($id='')
    {
        echo $id;
        dump($id);
        $data = Type::select();   //获取数据
        // dump($data);
        $c = new Cattree($data);
        $data = $c->getTree();    //获取分类树
       // dump($data);
       return view('type/create',['data'=>$data,'id'=>$id]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {

        // dump($request->post());
        $data = $request->post();
        try {
            Type::create($data,true);
        } catch (\Exception $e) {
            return $this->error('添加失败！');
        }
            return $this->success('添加成功！','/admin/type_index');
        
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
        $data = Type::find($id);
        return view('type/edit',['data'=>$data]);
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
        $data = $request->post();
        try {
             Type::update($data,['id'=>$id]);   //修改数据到数据库
        } catch (\Exception $e) {
            return $this->error('修改分类名失败');
        }
            return $this->success('修改分类名成功');
       
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //查询有没有子分类
        $res = Type::where(['pid'=>$id])->find();
        if($id == $res['pid']){
            return $this->error('改分类下有子分类，不能删除');
        }

        $data = Type::destroy($id);
        if($data){
            return $this->success('删除成功','/admin/type_index');
        }
            return $this->error('删除失败','/admin/type_index');
        
    }
}
