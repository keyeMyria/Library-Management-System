<?php

/*
 * 此 BookBorrow 模型关联 lib_borrow 数据表
 * 只负责为 BookBorrowController 提供数据处理
 */

namespace app\models;

use yii\base\Model;

use yii\db\ActiveRecord;
use yii\db\Query;

use app\models\Reader;
use app\models\ReaderType;

class BookBorrow extends ActiveRecord 
{



	public static function tableName()
	{
		return 'lib_borrow';	
	}



	/*
	 * 通过 ISBN 查询出, 一组可用于 图书借阅 页面的 展示
	 * @param $connect resource  数据库连接的资源句柄
	 * @param $ISBN number 用户提交的 ISBN
	 * @return array / bool(false) 返回一组数据 或 false
	 */
	public function queryBookInfoByISBN( $connect, $ISBN )
	{


		# 明天要做的事，使用 query 查询出的数据才能做分页
		




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




	/*
	 * 计算出 图书什么时候借出 和 什么时候该还
	 * @param $borrowCycle 借阅时间周期，代表借阅时间的长度( 如果是2, 代表两个月之后你就该还书了)
	 * @return $array      $array['beginTimestamp'] , $array['endTimestamp'];
	 */
	public function borrowTimestamp( $borrowCycle )
	{
		
		// 键名代表月份，键值代表 每个月份的秒数
		$perMonthTimestamp[1]  = 2678400;
		$perMonthTimestamp[2]  = 2419200;
		$perMonthTimestamp[3]  = 2678400;
		$perMonthTimestamp[4]  = 2592000;
		$perMonthTimestamp[5]  = 2678400;
		$perMonthTimestamp[6]  = 2592000;
		$perMonthTimestamp[7]  = 2678400;
		$perMonthTimestamp[8]  = 2678400;
		$perMonthTimestamp[9]  = 2592000;
		$perMonthTimestamp[10] = 2678400;
		$perMonthTimestamp[11] = 2592000;
		$perMonthTimestamp[12] = 2678400;

		// 为了在 这种年末借的书能正确的回到 1 月
		$perMonthTimestamp[13]  = 2678400;
		$perMonthTimestamp[14]  = 2419200;
		$perMonthTimestamp[15]  = 2678400;
		$perMonthTimestamp[16]  = 2592000;
		$perMonthTimestamp[17]  = 2678400;
		$perMonthTimestamp[18]  = 2592000;
		$perMonthTimestamp[19]  = 2678400;
		$perMonthTimestamp[20]  = 2678400;
		$perMonthTimestamp[21]  = 2592000;
		$perMonthTimestamp[22] = 2678400;
		$perMonthTimestamp[23] = 2592000;
		$perMonthTimestamp[24] = 2678400;

		$month   = date('n', time() );
		$endTime = time();

		for( $i=1; $i <= $borrowCycle; $i++ ){
				
			// 每次循环都把对应月份的秒数取出，然后叠加进 $endTime;
			$endTime = $endTime + $perMonthTimestamp[ $month + $i ]; 
		}

		$data['beginTime'] = time();	
		$data['endTime']   = $endTime;

		return $data;
	}




	/**
	 * 根据 $readerID 查询此读者可借的书籍数量 
	 * @param resource $connect 数据库资源
	 * @param int $readerID 读者ID
	 * @return int 可借阅的图书数量
	 */
	public function getAllowBorrowNumber( $connect , $readerID )
	{
        $sql = "SELECT `readerTypeBorrowNumber` 
				FROM lib_reader JOIN lib_readerType 
				ON FK_readerTypeID = PK_readerTypeID 
				WHERE PK_readerID = $readerID";
        $allowBorrowNumber =  $connect -> createCommand( $sql ) -> queryOne();
        $allowBorrowNumber = $allowBorrowNumber['readerTypeBorrowNumber'];
	
		return $allowBorrowNumber;
	}



}



