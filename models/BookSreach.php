<?php

/**
 * BookSreach 模型不关联任何表
 * 负责 BookSreachController 的数据处理
 * 主要任务是负责 接受 BookSreachController 传过来的 用户提交数据 $get ，对此进行处理
 */

namespace app\models;

use yii\base\Model;
use yii\db\Query;
use yii\data\SqlDataProvider;
use Yii;



class BookSreach extends Model
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
		 'bookName'  => '按书名',
         'bookISBN'  => '按ISBN',
         'publisher' => '按出版社',
         'author'    => '按作者',
         'bookshelf' => '按书架',
	];

	


	/*
	 * 图书搜索功能 的总模块， 负责 根据 sreachType 去决定使用哪个方法去处理 sreachText
	 */
	public function bookSreach( $get )
	{
		$sreachType = $get['sreachType'];
		$sreachText = $get['sreachText'];

		$this -> sreachType = $sreachType;	

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
				$sreachType = 'publisherName';
				return $this -> sreachPublisherOrBookshelf( $sreachType ,$sreachText );	
				break;

			case 'author':
				$sreachType = 'bookInfoBookAuthor';
				return $this -> sreachBookInfoPublic( $sreachType, $sreachText );	
				break;

			case 'bookshelf':
				$sreachType = 'bookshelfName';
				return $this -> sreachPublisherOrBookshelf( $sreachType, $sreachText );
				break;
		}	

	
	}


	/**
	 * 搜索 书名、作者名、ISBN 时共用的公共方法，因为他们都在同一个数据表内，方便嘛。
	 */ 
	public function sreachBookInfoPublic( $sreachType, $sreachText )
	{
		$beginTime = microtime( true );

		$query = new Query;
		$query -> from( BookInfo::tableName() )
			   -> where(['like', $sreachType, $sreachText]);

		$endTime   = microtime( true );

		$this -> sreachResultCount = $query->count();
		$this -> sreachResultTime  = $this -> calcQuerySpendTime( $beginTime, $endTime );
		$this -> sreachResultText  = $sreachText;

		return $query;
	}


	/**
	 * 搜索 出版社 或 书架 方法( 根据传入的 $sreachType 参数 决定 )
	 */
	public function sreachPublisherOrBookshelf( $sreachType, $sreachText )
	{
		$bookInfoTableName         = BookInfo::tableName(); 
		$bookRelationshipTableName = BookInfo::bookRelationshipTableName();

		if( $sreachType == 'publisherName' ){
			  	
			$tableName  = Publisher::tableName();		
			$PK_tableID = 'PK_publisherID';	
			$FK_tableID = 'FK_publisherID';
		}
 
		if( $sreachType == 'bookshelfName' ){

			$tableName  = Bookshelf::tableName();		
			$PK_tableID = 'PK_bookshelfID';	
			$FK_tableID = 'FK_bookshelfID';	
		}


		$beginTime = microtime( true );

		$query = new Query;
		$query -> select('b.FK_bookInfoID, a.PK_bookInfoID, a.bookInfoBookName, a.bookInfoBookISBN, a.bookInfoBookAuthor')
			   -> from( $tableName . ' AS p' )
			   -> where([ $sreachType => $sreachText ])
			   -> join('INNER JOIN',  $bookRelationshipTableName.' AS b', 'b.'. $FK_tableID .' = p.' . $PK_tableID)
			   -> join('INNER JOIN'	, $bookInfoTableName . ' AS a' , 'b.FK_bookInfoID = a.PK_bookInfoID');

		$endTime = microtime( true );

		$this -> sreachResultCount = $query -> count();
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
		$sreachResultInfo['sreachType']        = $this -> sreachTypeArr[ $this->sreachType ];

		return $sreachResultInfo;
	}






}
