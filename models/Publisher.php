<?php


/**
 * Publisher 模型关联 lib_publisher 数据表
 * 为 PublisherController 提供数据服务
 */

namespace app\models;

use yii\db\ActiveRecord;


class Publisher extends ActiveRecord
{


	public static function tableName()
	{
		return 'lib_publisher';
	}


	public function rules()
	{
		return [
			['publisherName', 'required', 'message' => '必填'],
			['publisherName', 'string', 'length' => [1,16], 'tooLong' => '不得超过16位字符'],		
			['publisherName', 'trim'],
		];	
	}

}
