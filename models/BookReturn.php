<?php

/**
 * 此 BookReturn 模型 不关联任何数据表
 * 只负责为 BookReturnController 提供数据处理
 */

namespace app\models;

use yii\base\Model;
use yii\db\Query;

use app\models\Reader;
use app\models\ReaderType;


class  BookReturn extends Model
{

	/*
	 * 接收 $readerNumber ，放进 reader 数据表中查找。
	 * @param resource $connect  数据库连接
	 * @param string  $readerNumber 存放读者编号
	 * @return array 返回读者信息
	 */
	public function getReaderInfo(  $connect, $readerNumber )
	{
		$readerTableName     = Reader::tableName();	
		$readerTypeTableName = ReaderType::tableName();

		$sql = "SELECT `PK_readerID`, `readerName`, `readerNumber`, 
					   `readerCertificate`, `readerCertificateNumber`, `readerTypeName`,
					   `readerTypeBorrowNumber` 
				FROM $readerTableName JOIN $readerTypeTableName 
				ON FK_readerTypeID = PK_readerTypeID 
				WHERE readerNumber = $readerNumber";
		$query = $connect -> createCommand( $sql ) -> queryOne();
		
		return $query;
	}




	/*
	 * 根据读者 ID, 查询出他借了什么书
	 * 
	 * @param resource $connect 数据库连接
	 * @param string  $readerID 存放读者编号
	 * @return array 返回读者信息
	 */
	public function getBorrowInfo( $connect, $readerID )
	{
		$borrowTableName    = BookBorrow::tableName();
		$bookInfoTableName  = BookInfo::tableName();
		$bookRelsTableName  = BookRelationship::tableName();
		$bookshelfTableName = Bookshelf::tableName();

		$query = new Query;
		$query  -> select('bw.PK_borrowID, bi.bookInfoBookName, bf.bookshelfName, bw.borrowBeginTimestamp, bw.borrowReturnTimestamp, bw.borrowIsReturn ')
				-> from( $borrowTableName . ' AS bw')	
				-> where(['FK_readerID' => $readerID ])
				-> join('INNER JOIN', $bookInfoTableName . ' AS bi', 'bw.FK_bookInfoID = bi.PK_bookInfoID' )
				-> join('INNER JOIN', $bookRelsTableName . ' AS brp', 'bw.FK_bookInfoID = brp.FK_bookInfoID' )
				-> join('INNER JOIN', $bookshelfTableName . ' AS bf', 'brp.FK_bookshelfID = bf.PK_bookshelfID' );

		return $query;
	}


}




?>
