<?php


/**
 * BookAdd 模型不关联任何数据表
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
						'bookInfoBookPrice',		
						'bookInfoBookPage', 		
					],
					'required', 'message' => '必填' 
				],
				['bookInfoBookName', 'string', 'length' => [1,150], 'tooLong' => '书名超过 150 个字符，请截取后再试'],
				['bookInfoBookISBN', 'match', 'pattern' => '/^[0-9]{13}$/', 'message' => '请输入 13 位数字的 ISBN 号'],
				['bookInfoBookAuthor', 'string', 'length' => [1,100], 'tooLong' => '作者名超过 100 个字符，请截取后再试'],
				['bookInfoBookPrice', 'double', 'max' => 60000, 'message' => '请以数值表示', ],
				['bookInfoBookPage', 'number', 'max' => 60000, 'message' => '请以数值表示'],

		];	
	}


	/**
	 * 为 BookAddController::actionBookAdd() 提供下拉框的数据
	 */
	public function combineDropDownListData()
	{
	
		// 从各数据表中取出数据, 以数组形式保存
		$bookType  =  BookType::find()-> asArray() ->all();
		$publisher = Publisher::find()-> asArray() ->all();
		$bookshelf = Bookshelf::find()-> asArray() ->all();
	
		$bookTypeData['default']  = '请选择';
		$publisherData['default'] = '请选择';
		$bookshelfData['default'] = '请选择';

		// 把数组抽出来一层，让 id => name, (例如：原本：[0] => [id,name]  处理成 >  [id] => [name] )
		foreach ( $bookType as $key => $value ){
			$bookTypeData[ $bookType[$key]['PK_bookTypeID'] ]    = $bookType[$key]['bookTypeName'];
		}
	
		foreach ( $publisher as $key => $value ){
			$publisherData[ $publisher[$key]['PK_publisherID'] ] = $publisher[$key]['publisherName'];
		}

		foreach ( $bookshelf as $key => $value ){
			$bookshelfData[ $bookshelf[$key]['PK_bookshelfID'] ] = $bookshelf[$key]['bookshelfName'];
		}


		$data[] = $bookTypeData;
		$data[] = $publisherData;
		$data[] = $bookshelfData;
		return   $data;
	}



}
