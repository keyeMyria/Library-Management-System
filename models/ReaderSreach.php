<?php

/**
 * ReaderSreach 模型不关联任何表
 * 负责 ReaderSreachController 的数据处理
 * 主要任务是负责 接受 ReaderSreachController 传过来的 用户提交数据 $get ，对此进行处理
 */

namespace app\models;

use yii\base\Model;
use yii\db\Query;
use yii\data\SqlDataProvider;
use yii\helpers\Url;


use Yii;



class ReaderSreach extends Model
{
	# 搜索类型 ( 存放 get() 过来的参数 )
	public $sreachType;

	# 搜索文本 ( 存放 get() 过来的参数 )
	public $sreachText;
	
	# 搜索结果条目数量统计
	public $sreachResultCount;

	# 搜索结果所用耗时
	public $sreachResultTime;

	# 搜索文本 ( 和 上面的 $this->sreachText 是一样的)
	public $sreachResultText;

	# 搜索类型
	public $sreachTypeArr = [
		 'readerName'  => '按姓名',
         'readerNumber'  => '按编号',
	];

	


	/*
	 * 图书搜索功能 的总模块， 负责 根据 sreachType 去决定使用哪个方法去处理 sreachText
	 */
	public function readerSreach( $get )
	{
		$sreachType = $get['sreachType'];
		$sreachText = $get['sreachText'];

		$this -> sreachType = $sreachType;	

		if( empty($sreachText) ){
			return 'empty';	
		}


		switch ( $sreachType )
		{
			case 'readerName':
				// 为了 where 条件, 得匹配字段名
				$sreachType = 'readerName';
				return $this -> sreachReaderPublic( $sreachType, $sreachText );	
				break;

			case 'readerNumber':
				$sreachType = 'readerNumber';
				return $this -> sreachReaderPublic( $sreachType, $sreachText );	
				break;

		}	

	
	}


	/**
	 * 搜索 姓名、编号、 时共用的公共方法，因为他们都在同一个数据表内，方便嘛。
	 */ 
	public function sreachReaderPublic( $sreachType, $sreachText )
	{
		$beginTime = microtime( true );

		$query = new Query;
		$query -> from( Reader::tableName() )
			   -> where(['like', $sreachType, $sreachText]);

		$endTime   = microtime( true );

		$this -> sreachResultCount = $query->count();
		$this -> sreachResultTime  = $this -> calcQuerySpendTime( $beginTime, $endTime );
		$this -> sreachResultText  = $sreachText;

		return $query;
	}


	/**
	 * 计算查询所花费的秒数
	 */
	public function calcQuerySpendTime( $beginTime, $endTime )
	{
		$spend = $endTime - $beginTime;	
		$spendTime = substr( $spend , 0 , 5 );

		return $spendTime;
	}


	/*
	 * 获取搜索结果的信息
	 * 之所以能 $this -> xx 这样就能获取搜索结果的信息，是因为此方法是在 bookSreach 控制器调用了 
	 * 搜索方法后（在搜索方法中把这些 搜索结果信息都放到 类成员属性里. 
	 */
	public function getSreachResultInfo()
	{
		$sreachResultInfo['sreachResultCount'] = $this -> sreachResultCount;	
		$sreachResultInfo['sreachResultTime']  = $this -> sreachResultTime;	
		$sreachResultInfo['sreachResultText']  = $this -> sreachResultText;	
		#$sreachResultInfo['sreachType']        = $this -> sreachTypeArr[ $this->sreachType ];
		$sreachResultInfo['sreachType']        = $this -> sreachTypeArr['readerName'];

		return $sreachResultInfo;
	}



}
