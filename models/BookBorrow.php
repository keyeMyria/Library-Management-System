<?php

/*
 * 此 BookBorrow 模型不关联任何数据表
 * 只负责为 BookBorrowController 提供数据处理
 */

namespace app\models;

use yii\base\Model;


class BookBorrow extends Model
{



	/*
	 * 通过 ISBN 查询出, 一组可用于 图书借阅 页面的 展示
	 * @param $connect resource  数据库连接的资源句柄
	 * @param $ISBN number 用户提交的 ISBN
	 * @return array / bool(false) 返回一组数据 或 false
	 */
	public function queryBookInfoByISBN( $connect, $ISBN )
	{
		$sql = "SELECT `PK_bookInfoID`,       `bookInfoBookName`,
                              `bookInfoBookISBN` ,  `bookInfoBookAuthor` , 
                              `bookInfoBookPrice` , `bookInfoBookPage` ,
                              `bookTypeName`,       `bookshelfName`,
                              `publisherName`,       COUNT( distinct bookInfoBookISBN ) AS count
                          FROM lib_bookInfo
                              JOIN lib_bookRelationship 
                              JOIN lib_bookType 
                              JOIN lib_bookshelf 
                              JOIN lib_publisher 
                          ON FK_bookInfoID = PK_bookInfoID 
                              AND FK_bookTypeID = PK_bookTypeID 
                              AND FK_bookshelfID = PK_bookshelfID 
                              AND FK_publisherID = PK_publisherID  
                          WHERE bookInfoBookISBN = $ISBN 
                          GROUP BY bookInfoBookISBN";
        $bookInfoData = $connect -> createCommand( $sql ) -> queryOne();	

		return $bookInfoData;
	}


}



