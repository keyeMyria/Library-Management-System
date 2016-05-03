<?php

namespace app\models;

use yii\db\ActiveRecord;


class Bookshelf extends ActiveRecord
{


	public static function tableName()
	{
		return 'lib_bookshelf';
			
	}

	public function rules()
	{
		return [
			['bookshelfName', 'required', 'message' => '必填'],
			['bookshelfName', 'string', 'length' => [1,16], 'tooLong' => '不得超过16位字符'],		
			['bookshelfName', 'trim'],
		];	
	}

}
