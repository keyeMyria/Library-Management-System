<?php

/**
 * ReaderType 模型类关联 lib_readerType 数据表
 * 对 ReaderTypeController 提供数据服务
 */

namespace app\models;

use yii\db\ActiveRecord;




class ReaderType extends ActiveRecord
{

	public static function tableName()
	{
		return 'lib_readerType';	
	}


	public function rules()
	{
		return [
			[['readerTypeName', 'readerTypeBorrowNumber'], 'required', 'message' => '必填'],
			[
				'readerTypeName',
				'string',
				'length'=>[1,16],
				'max' => 16,
				'tooShort' => '至少一位字符',
				'tooLong' => '至多16位字符' ,
			],
			[
				'readerTypeBorrowNumber',
				'integer',	
				'max' => 60000,
				'tooSmall' => '范围 1~60000',
				'tooBig' => '范围 1~60000',
				'message' => '请输入数字',
			],

		
		];	
	}
}
