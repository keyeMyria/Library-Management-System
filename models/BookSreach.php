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
				return $this -> sreachPublisher( $sreachText );	
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


		$sql = "SELECT `PK_bookInfoID`, `bookInfoBookISBN`, `bookInfoBookName`, `bookInfoBookAuthor`  FROM $bookInfoTableName  WHERE $sreachType LIKE  '%$sreachText%'";
		$result = $db -> createCommand( $sql ) -> queryAll();
		
		return $result;
		
	}


	public function sreachPublisher( $sreachText )
	{
		$db = Yii::$app->db;
		$publisherTableName        = Publisher::tableName();
		$bookInfoTableName         = BookInfo::tableName(); 
		$bookRelationshipTableName = BookInfo::bookRelationshipTableName();
		
		// 下面sql语句是 利用 publisher 表查询出的 id , 再去 join  bookRelationship表。
		$sql = "SELECT `FK_bookInfoID` FROM $publisherTableName AS p JOIN $bookRelationshipTableName  AS r   ON p.PK_publisherID = r.FK_publisherID WHERE p.publisherName = '$sreachText'";

		// 执行 sql 语句后, 查询到是该 $sreachText 出版社的图书的 ID, 
		$bookInfoID  = $db -> createCommand( $sql ) -> queryAll();


		// 有了图书ID 后就好办了, 直接查询后得到结果放入 $bookInfoResult 数组中。
		foreach( $bookInfoID as $key => $value)
		{
			$id = $bookInfoID[$key]['FK_bookInfoID'];
			$bookInfoSql = "SELECT * FROM $bookInfoTableName WHERE PK_bookInfoID = $id";	
			$bookInfoResult[] = $db -> createCommand( $bookInfoSql ) -> queryAll();
		}

		// 由于上面 $bookInfoResult[] 数组插入时多了一层(没办法), 这个数组结构变成了 $arr[0][0][val];
		// 但是，在 view 的输出的格式是要通用的 $arr[0][val];  所以就有了下面的代码, 把数组的结构去掉一层.

		foreach( $bookInfoResult as $key => $value )
		{
			$result[] = $bookInfoResult[$key][0];	
		}

		return $result;
	}
	

}
