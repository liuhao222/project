<?php

namespace app\common\model;

use think\Model;

class Type extends Model
{
	//数据表
    protected $table='data_type';
    //主键
    protected $pk='id';


    //$this正在遍历的数据
    public function getTypenameAttr(){
    	$n = substr_count($this->path,',')-1;
    	$space = str_repeat('&nbsp;',$n*8);
    	$name = $space.$this['name'];
    	return $name;
    }
}
