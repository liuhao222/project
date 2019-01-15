<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Goods;
use app\common\model\Type;
use app\tools\Cattree;
class GoodsController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = Goods::select();
       
         dump($data);

        return view('goods/index',['data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
    $data = Type::select();
      $c = new Cattree($data);
      $data = $c->getTree();
      return view('goods/create',['data'=>$data]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->post();
        $file = $request->file('pic');
        $info = $file->move('photo');
        $filePath = $info->getSaveName();
        // echo $filePath.'----------';
        // $data['pic'] = $filePath;

        //缩放图片
        $image = \think\Image::open('photo/'.$filePath); //photo下的路径的图片
        $newName = str_replace('\\','/sm_',$filePath);//弄一个新文件名，不和原图片重名
        // echo $newName;die;
        //将图片裁剪为300x300并保存为crop.png
        $image->thumb(150, 150)->save('photo/'.$newName);
        $data['pic'] = $newName;
        try {
             Goods::create($data,true);
        } catch (\Exception $e) {
            return $this->error('添加商品失败！','/admin/goods_create');
        }
            return $this->success('添加商品成功！','/admin/goods_index');
       
        // dump($data);
        // dump($request->file());

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
        $data = Goods::find($id);
        return view('goods/edit',['data'=>$data]);
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
         $data = $request->post();
        $file = $request->file('pic');
        $info = $file->move('photo');
        $filePath = $info->getSaveName();
        // echo $filePath.'----------';
        // $data['pic'] = $filePath;

        //缩放图片
        $image = \think\Image::open('photo/'.$filePath); //photo下的路径的图片
        $newName = str_replace('\\','/sm_',$filePath);//弄一个新文件名，不和原图片重名
        // echo $newName;die;
        //将图片裁剪为300x300并保存为crop.png
        $image->thumb(150, 150)->save('photo/'.$newName);
        $data['pic'] = $newName;


        
        // $file = $request->file('pic');
        // dump($file);

        // $data = $request->post();
        // dump($data);
        // die();
         try {
             Goods::update($data,['id'=>$id]);   //修改数据到数据库
        } catch (\Exception $e) {
            return $this->error('修改失败！','/admin/goods_index');
        }
            return $this->success('修改成功！','/admin/goods_index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $res = Goods::find($id);
        dump($res);
        $data = Goods::destroy($id,$res['pic']);
        if($data){
            return $this->success('删除成功！','/admin/goods_index');
       }
            return $this->error('删除失败','/admin/goods_index');
    }
}
