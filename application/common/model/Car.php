<?php

namespace app\common\model;

use think\Model;

class Car extends Model
{
    //
    //数据表
    protected $table='data_car';
    //主键
    protected $pk='id';

   //  public function type(){
  	// 	return $this->belongsTo('Goods','shopid','id');//关联Type的类，要用商品表里的type_id关联分类表里的=id  belongsTo('关联模型类名','关联外键','关联主键'）一对多：一个分类对应多个商品

  	// }

}
