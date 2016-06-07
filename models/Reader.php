<?php


/**
 * Reader 模型关联 lib_reader 数据表
 * 为 ReaderAddController 提供数据服务
 */

namespace app\models;

use yii\db\ActiveRecord;


class Reader extends ActiveRecord
{


	public static function tableName()
	{
		return 'lib_reader';
	}


	public function rules()
	{
		return [ 
			[
				[
					'readerNumber',
					'readerName',
					'readerBirthday',
					'readerCertificateNumber',
					'readerPhone',
					'readerEmail',
				]
				, 'required' , 'message' => '必填',
			],
			['readerNumber', 'match', 'pattern' => '/^[0-9]{9}$/', 'message' => '请输入 9 位字符的读者编号' ],
			['readerName', 'string', 'length' => [1,100], 'tooLong' => '读者名称超过 100 位字符'],
			['readerPhone', 'match', 'pattern' => '/^[0-9]{11}$/', 'message' => '请输入 11 位的手机号码' ],
			['readerEmail', 'email', 'message' => '请输入正确的邮箱格式'],
		];	
	}

}
