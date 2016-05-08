<?php

/**
 * BookSreach 模型不关联任何表
 * 负责 BookSreachController 的数据处理
 */

namespace app\models;

use yii\base\Model;
use Yii;


class BookSreach extends Model
{
	
	public function bookSreach( $post )
	{
		$db = Yii::$app->db;
		$sreachType = $post['sreachType'];
		$sreachText = $post['sreach'];

		#dump( $post );

		switch ( $sreachType )
		{
			case 'bookName':
				// 为了 where 条件, 得匹配字段名
				$sreachType = 'bookInfoBookName';
				return $this -> sreachBookInfoPublic( $sreachType, $sreachText );	
				break;

			case 'bookISBN':
				$sreachType = 'bookInfoBookISBN';
				return $this -> sreachBookInfoPublic( $sreachType, $sreachText );	
				break;

			case 'publisher':

				break;

			case 'author':
				$sreachType = 'bookInfoBookAuthor';
				return $this -> sreachBookInfoPublic( $sreachType, $sreachText );	

				break;

			case 'bookshelf':

				break;
				
		}	


#		$sql = "SELECT * FROM lib_bookInfo WHERE bookInfoBookName LIKE '%$sreachText%'";
		#$query = $db -> createCommand( $sql ) -> queryAll();


		
	
	}


	public function sreachBookInfoPublic( $sreachType, $sreachText )
	{
		$db = Yii::$app->db;
		$bookInfoTableName = BookInfo::tableName();

		$sql = "SELECT * FROM $bookInfoTableName  WHERE $sreachType LIKE  '%$sreachText%'";
		$result = $db -> createCommand( $sql ) -> queryAll();
		
		return $result;
		
	}


}
