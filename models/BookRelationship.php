<?php

namespace app\models;

use yii\db\ActiveRecord;


class BookRelationship extends ActiveRecord
{

	public static function tableName()
	{
		return 'lib_bookRelationship';	
	}


}
