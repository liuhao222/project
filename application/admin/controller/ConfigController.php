<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\model\Config;

class ConfigController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
         $data = Config::select();
         dump($data);
        return view('config/index',['data'=>$data]);

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
      
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
         $data = Config::find($id);
        // var_dump($data);
        return view('config/edit',['data'=>$data]);
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
        $file = $request->file('logo');
        $info = $file->move('images');
        $filePath = $info->getSaveName();
        // echo $filePath.'----------';
        // $data['pic'] = $filePath;

        //缩放图片
        $image = \think\Image::open('images/'.$filePath); //photo下的路径的图片
        $newName = str_replace('\\','/sm_',$filePath);//弄一个新文件名，不和原图片重名
        // echo $newName;die;
        //将图片裁剪为300x300并保存为crop.png
        $image->thumb(150, 150)->save('images/'.$newName);
        $data['logo'] = $newName;
         try {
             Config::update($data,['id'=>$id]);   //修改数据到数据库
        } catch (\Exception $e) {
            return $this->error('修改失败！','/admin/config_index');
        }
            return $this->success('修改成功！','/admin/config_index');
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

    //网站配置启用
    public function start($id)
    {   
        try {
            Config::update(['status'=>'1','id'=>$id]); //将用户状态改为1达到启用
        } catch (Exception $e) {
            return $this->error('启用失败！！！');
        }
            return redirect('/admin/config_index');
        
    }

      //用户禁用
    public function stop($id)
    {
     
        try {
            Config::update(['status'=>'2','id'=>$id]); //将用户状态改为1达到启用
        } catch (Exception $e) {
            return $this->error('禁用失败！！！');
        }
            return redirect('/admin/config_index');
    }
}
