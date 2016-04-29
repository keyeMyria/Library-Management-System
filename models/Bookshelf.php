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
			['bookshelfName', 'required'],
			['bookshelfName', 'string', 'length' => [1,16]],		
			['bookshelfName', 'trim'],
		];	
	}

}
