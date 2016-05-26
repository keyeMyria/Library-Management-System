<?php

/**
 * 此 BorrowQuery 模型不关联数据表
 * 为 BorrowQueryController 提供数据处理
 */


namespace app\models;


use yii\base\Model;
use yii\db\Query;


use app\models\BookBorrow;
use app\models\BookInfo;
use app\models\Bookshelf;
use app\models\Reader;
use app\models\BookRelationship;





class BorrowQuery extends Model
{


	

	/**
	 * 借阅查询
	 * @param array $get 存放着用户提交的查询数据
	 */
	public function borrowQuery( $connect,  $get )
	{
		$dayTimestamp = $get['sreachText'] * 86400;

		$nowTimestamp = time();
		$endTimestamp = $nowTimestamp - $dayTimestamp;
		

		if( $get['condition'] == 'notReturn' ){
			$borrowIsReturn = 0;	
		} elseif( $get['condition'] == 'returned' ){
			$borrowIsReturn = 1;	
		}



		$query = new Query;

		/*
		 * 书名 书架 读者名
		 */

		$query  -> select('PK_borrowID, readerName, bookInfoBookName, borrowBeginTimestamp, borrowReturnTimestamp, bookshelfName, borrowIsReturn')
			-> from( BookBorrow::tableName() . ' AS bw' )
			-> join('INNER JOIN', BookInfo::tableName() . ' AS bi' , 'bi.PK_bookInfoID = bw.FK_bookInfoID')
			-> join('INNER JOIN', BookRelationship::tableName() . ' AS brp' , 'brp.FK_bookInfoID = bw.FK_bookInfoID')
			-> join('INNER JOIN', Bookshelf::tableName() . ' AS bs', 'bs.PK_bookshelfID = brp.FK_bookshelfID')
			-> join('INNER JOIN', Reader::tableName() . ' AS rd', 'rd.PK_readerID = bw.FK_readerID')
			-> where([ 'and', [ 'borrowIsReturn' => $borrowIsReturn] ,   ['between', 'borrowBeginTimestamp', $endTimestamp, $nowTimestamp] ])
			-> orderBy('borrowBeginTimestamp DESC');

		return $query;
	}

}
