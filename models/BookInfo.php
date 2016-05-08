<?php

namespace app\models;

use yii\db\ActiveRecord;


class BookInfo extends ActiveRecord
{

	public static function bookRelationshipTableName()
	{
		return 'lib_bookRelationship';
	}

	public static function tableName()
	{
		return 'lib_bookInfo';	
	}

}
