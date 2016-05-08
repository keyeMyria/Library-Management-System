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
	
	/*
	 * 图书搜索功能 的总模块， 负责 根据 sreachType 去决定使用哪个方法去处理 sreachText
	 */
	public function bookSreach( $post )
	{
		$db = Yii::$app->db;
		$sreachType = $post['sreachType'];
		$sreachText = $post['sreach'];

		if( empty($sreachText) ){
			return 'empty';	
		}

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
				return $this -> sreachBookshelf( $sreachText );
				break;
				
		}	

	
	}


	/**
	 * 搜索 书名、作者名、ISBN 时共用的公共方法，因为他们都在同一个数据表内，方便嘛。
	 */ 
	public function sreachBookInfoPublic( $sreachType, $sreachText )
	{
		$db = Yii::$app->db;
		$bookInfoTableName = BookInfo::tableName(); 

		$sql = "SELECT `PK_bookInfoID`, `bookInfoBookISBN`, `bookInfoBookName`, `bookInfoBookAuthor`  FROM $bookInfoTableName  WHERE $sreachType LIKE  '%$sreachText%'";
		$result = $db -> createCommand( $sql ) -> queryAll();
		
		return $result;
	}


	/**
	 * 搜索 出版社 方法
	 */
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
	

	

	/**
	 * 搜索 书架 的方法
	 */
	public function sreachBookshelf( $sreachText )
	{
	
		$db = Yii::$app->db;
		$bookshelfTableName        = Bookshelf::tableName();
		$bookInfoTableName         = BookInfo::tableName(); 
		$bookRelationshipTableName = BookInfo::bookRelationshipTableName();
		
		$sql = "SELECT `FK_bookInfoID` FROM $bookshelfTableName AS b JOIN $bookRelationshipTableName  AS r   ON b.PK_bookshelfID = r.FK_bookshelfID WHERE b.bookshelfName = '$sreachText'";

		$bookInfoID  = $db -> createCommand( $sql ) -> queryAll();

		foreach( $bookInfoID as $key => $value)
		{
			$id = $bookInfoID[$key]['FK_bookInfoID'];
			$bookInfoSql = "SELECT * FROM $bookInfoTableName WHERE PK_bookInfoID = $id";	
			$bookInfoResult[] = $db -> createCommand( $bookInfoSql ) -> queryAll();
		}


		foreach( $bookInfoResult as $key => $value )
		{
			$result[] = $bookInfoResult[$key][0];	
		}

		return $result;
	
	}


}
