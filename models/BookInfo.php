<?php

namespace app\models;

use yii\db\ActiveRecord;


class BookInfo extends ActiveRecord
{

	public static function bookRelationshipTableName()
	{
		return 'lib_bookRelationship';
	}

	public static function tableName()
	{
		return 'lib_bookInfo';	
	}


	public function rules()
	{
		return [
			['bookInfoBookISBN', 'required', 'message' => '请输入要查询的ISBN号'],
			['bookInfoBookISBN', 'number', 'message' => '请输入数字类型的ISBN号'],	
		];	
	}



	 /*
      * 共用方法。
      * 负责对超长的 图书名称 进行 cut， 好让 view 层输出的更优美.
	  * @param array $data 装着要处理的数组，格式为 $data[0][data]。
      * @param number $viewBookNameLength 指定显示的长度
	  * @return array $data 处理完成后的数据数组 ，其中包含着超长被处理过后的图书名
      */
     public function cutBookName( $data , $viewBookNameLength )
     {
         foreach( $data as $key => $value )
         {
             $bookName =  $data[$key]['bookInfoBookName'] ;
             
			 if ( mb_strlen( $bookName , 'utf8' ) > $viewBookNameLength ){
				 $data[$key]['viewBookName'] = mb_substr( $bookName , 0 , $viewBookNameLength , 'utf8') . "....";
             }
         }

         return $data;
     }






}
