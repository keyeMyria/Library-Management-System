<?php


/**
 * bookType 模型关联 lib_bookType 数据表
 * 
 * 为 bookType 提供数据服务
 */

namespace app\models;

use yii\db\ActiveRecord;


class bookType extends ActiveRecord
{


	public static function tableName()
	{
		return 'lib_bookType';
	}


	public function rules()
	{
		return [
			['bookTypeName', 'required', 'message' => '必填'],
			['bookTypeName', 'string', 'length' => [1,16], 'tooLong' => '不得超过16位字符'],		
			['bookTypeName', 'trim'],
		];	
	}

}
