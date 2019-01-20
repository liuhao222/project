<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Friendlink;

class FriendlinkController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = Friendlink::select();
       
         // //dump($data);

        return view('friendlink/index',['data'=>$data]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
         return view('friendlink/create');

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
         // //dump($data);
        $file = $request->file('friendlinkpic');
        // //dump($file);
        $info = $file->move('friendlinkpic');
        $filePath = $info->getSaveName();
        // echo $filePath.'----------';
        // $data['pic'] = $filePath;

        //缩放图片
        $image = \think\Image::open('friendlinkpic/'.$filePath); //friendlinkpic下的路径的图片
        $newName = str_replace('\\','/sm_',$filePath);//弄一个新文件名，不和原图片重名
        // echo $newName;die;
        //将图片裁剪为300x300并保存为crop.png
        $image->thumb(150, 150)->save('friendlinkpic/'.$newName);
        $data['friendlinkpic'] = $newName;
        // //dump($data);
        // die();
        try {
             Friendlink::create($data,true);
        } catch (\Exception $e) {
            return $this->error('添加友情链接失败！','/admin/friendlink_create');
        }
            return $this->success('添加友情链接成功！','/admin/friendlink_index');

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
         $data = Friendlink::find($id);
         // //dump($data);
        return view('friendlink/edit',['data'=>$data]);
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
        $file = $request->file('friendlinkpic');
        $info = $file->move('friendlinkpic');
        $filePath = $info->getSaveName();
        // echo $filePath.'----------';
        // $data['pic'] = $filePath;

        //缩放图片
        $image = \think\Image::open('friendlinkpic/'.$filePath); //photo下的路径的图片
        $newName = str_replace('\\','/sm_',$filePath);//弄一个新文件名，不和原图片重名
        // echo $newName;die;
        //将图片裁剪为300x300并保存为crop.png
        $image->thumb(150, 150)->save('friendlinkpic/'.$newName);
        $data['friendlinkpic'] = $newName;


        
        // $file = $request->file('pic');
        // //dump($file);

        // $data = $request->post();
        // //dump($data);
        // die();
         try {
             Friendlink::update($data,['id'=>$id]);   //修改数据到数据库
        } catch (\Exception $e) {
            return $this->error('修改失败！','/admin/friendlink_index');
        }
            return $this->success('修改成功！','/admin/friendlink_index');
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $res = Friendlink::find($id);
        // //dump($res);
        $data = Friendlink::destroy($id,$res['friendlinkpic']);
        if($data){
            return $this->success('删除成功！','/admin/friendlink_index');
       }
            return $this->error('删除失败','/admin/friendlink_index');
    }
}
