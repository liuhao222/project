<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use app\common\model\Userinfo;
use app\common\model\Config;
use app\common\model\Friendlink;
class UserinfoController extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $dd = Config::select();
        $f = Friendlink::select();
         //判断用户是否登录
        if(empty(session('loginUser'))){
             return $this->error('请先登录','/home/login_index');
        }

        $s =  session('users');
        //// dump($s);
        
      //按照用户id查询用户中心信息
        $res = Userinfo::where('uid','=',session('users.uid'))->select();
        // echo count($res); die;
        //// dump($res);
        //dump((bool)$res);
        if(count($res)){
            return view('userinfo/index',['res'=>$res,'s'=>$s,'dd'=>$dd,'f'=>$f]);
        }
        // dump($s);
        return view('userinfo/index1',['s'=>$s,'dd'=>$dd,'f'=>$f]);
       // dump($s);
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
        $data=$request->post();
       // dump($data);
        $file = $request->file('pic');
       // dump($file);
        $info = $file->move('userpic');
        $filePath = $info->getSaveName();
        // echo $filePath.'----------';
        // $data['pic'] = $filePath;

        //缩放图片
        $image = \think\Image::open('userpic/'.$filePath); //photo下的路径的图片
        $newName = str_replace('\\','/sm_',$filePath);//弄一个新文件名，不和原图片重名
        // echo $newName;die;
        //将图片裁剪为300x300并保存为crop.png
        $image->thumb(150, 150)->save('userpic/'.$newName);
        $data['pic'] = $newName;
       // dump($data);
        // die();
       try {
           Userinfo::create($data,true);   //插入数据库，true  过滤字段
       } catch (\Exception $e) { //  \表示根目录下的
           return $this->error('添加信息失败','/home/index');
       }
            return $this->success('添加信息成功！','/home/userinfo_index');   
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
        $dd = Config::select();
         $data=$request->post();
       // dump($data);
        $file = $request->file('pic');
       // dump($file);
        $info = $file->move('userpic');
        $filePath = $info->getSaveName();
        // echo $filePath.'----------';
        // $data['pic'] = $filePath;

        //缩放图片
        $image = \think\Image::open('userpic/'.$filePath); //photo下的路径的图片
        $newName = str_replace('\\','/sm_',$filePath);//弄一个新文件名，不和原图片重名
        // echo $newName;die;
        //将图片裁剪为300x300并保存为crop.png
        $image->thumb(150, 150)->save('userpic/'.$newName);
        $data['pic'] = $newName;
       // dump($data);
        // die();
        try {
             Userinfo::update($data,['uid'=>$id]);   //修改数据到数据库
        } catch (\Exception $e) {
            return $this->error('修改失败！','/home/userinfo_index');
        }
            return $this->success('修改成功！','/home/userinfo_index');
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
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function address()
    {
        $dd = Config::select();
        return view('userinfo/address',['dd'=>$dd]);
    }
}
