<?php


/**
 * 本模型不关联任何数据表。
 * 本模型负责处理与 IndexController 的功能
 */

namespace app\models;

use yii\base\Model;


class Index extends Model
{


	/** 
	 * 查询热门借阅书籍。
	 *
	 */
	public function hotBook( $connect, $getNumber )
	{
		$sql = "SELECT count( FK_bookInfoID )  AS count , FK_bookInfoID, bookInfoBookName  
				FROM lib_borrow JOIN lib_bookInfo 
				ON FK_bookInfoID = PK_bookInfoID 
				GROUP BY FK_bookInfoID 
				ORDER BY count DESC 
				LIMIT 0, $getNumber";
		$data =  $connect -> createCommand( $sql ) -> queryAll();
		return $data;
	}


	public function hotReader( $connect, $getNumber )
	{
		$sql = "SELECT count( FK_readerID )  AS count , FK_readerID, readerName  
				FROM lib_borrow JOIN lib_reader 
				ON FK_readerID = PK_readerID 
				GROUP BY FK_readerID 
				ORDER BY count DESC 
				LIMIT 0, $getNumber";
		$data =  $connect -> createCommand( $sql ) -> queryAll();
		return $data;
	}

}

