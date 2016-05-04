<?php


/**
 * BookAdd 模型关联 lib_bookInfo 数据表
 * 为 BookAddController 提供数据服务
 */

namespace app\models;

use yii\db\ActiveRecord;


class BookAdd extends ActiveRecord
{


	public static function tableName()
	{
		return 'lib_bookInfo';
	}


	public function rules()
	{
		return [
			[
				[
					'bookInfoBookName',		
					'bookInfoBookISBN',		
					'bookInfoBookAuthor',		
					'bookInfoBookTranslator',		
					'bookInfoBookPrice',		
					'bookInfoBookPage', 		
				],
			   	'required', 'message' => '必填' 
			],
		];	
	}

}
