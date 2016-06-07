<?php


/**
 * 本模型不关联任何数据表。
 * 本模型负责处理与 IndexController 的功能
 */

namespace app\models;

use yii\base\Model;

use app\models\BookBorrow;
use app\models\BookInfo;
use app\models\Reader;




class Index extends Model
{


	/** 
	 * 查询热门借阅书籍。
	 *
	 */
	public function hotBook( $connect, $getNumber )
	{
		$borrowTableName   = BookBorrow::tableName();
		$bookInfoTableName = BookInfo::tableName();

		$sql = "SELECT count( FK_bookInfoID )  AS count , FK_bookInfoID, bookInfoBookName  
				FROM $borrowTableName JOIN $bookInfoTableName 
				ON FK_bookInfoID = PK_bookInfoID 
				GROUP BY FK_bookInfoID 
				ORDER BY count DESC, PK_borrowID DESC 
				LIMIT 0, $getNumber";
		$data =  $connect -> createCommand( $sql ) -> queryAll();
		return $data;
	}


	public function hotReader( $connect, $getNumber )
	{
		$borrowTableName   = BookBorrow::tableName();
		$readerTableName   = Reader::tableName();

		$sql = "SELECT count( FK_readerID )  AS count , FK_readerID, readerName  
				FROM $borrowTableName JOIN $readerTableName
				ON FK_readerID = PK_readerID 
				GROUP BY FK_readerID 
				ORDER BY count DESC, FK_readerID DESC 
				LIMIT 0, $getNumber";
		$data =  $connect -> createCommand( $sql ) -> queryAll();
		return $data;
	}

}

