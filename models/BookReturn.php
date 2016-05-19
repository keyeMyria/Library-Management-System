<?php

/**
 * 此 BookReturn 模型 不关联任何数据表
 * 只负责为 BookReturnController 提供数据处理
 */

namespace app\models;

use yii\base\Model;
use app\models\Reader;


class  BookReturn extends Model
{

	/*
	 * 接收 $readerNumber ，放进 reader 数据表中查找。
	 * @param string 存放读者编号
	 * @return array 返回读者信息
	 *
	 */
	public function getReaderInfo( $readerNumber )
	{
		$readerData = Reader::find() -> where( ['readerNumber' => $readerNumber ] ) -> one();		
		return $readerData;
	}







}




?>
