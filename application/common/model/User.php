<?php

namespace app\common\model;

use think\Model;

class User extends Model
{
    //数据表明
    protected $table = 'data_user';

    //主键
    protected $pk = 'uid';

    //将加密的密码放入这里
    public function setPwdAttr($v){     //setPwdAttr修改器    set+Name(字段名)+Attr
    		// dump($v);     //$v   密码
    		return md5($v);
	}

}
