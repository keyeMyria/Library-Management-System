<?php 

namespace app\controllers;

use yii\web\Controller;
use Yii;

use app\models\Reader;


class ReaderInfoStatController extends Controller
{


	
	public function actionIndex()
	{

		$connect = Yii::$app->db;

		$readerSql     = 'SELECT COUNT(*) as count, FK_readerTypeID, readerTypeName
							FROM lib_reader JOIN lib_readerType 
							ON FK_readerTypeID = PK_readerTypeID	
							GROUP BY FK_readerTypeID'; 
		
		$readerData    = $connect -> createCommand( $readerSql  ) -> queryAll();
		$readerCount = Reader::find()->count();

		#dump( $readerTypeData ); 
	
		foreach ( $readerData as $key => $value ){
		
			$readerData[ $key ]['percent'] = round( $readerData[ $key ]['count'] / $readerCount * 100  , 2 );	
			unset( $readerData[ $key ]['count'] );
		}

		$json = json_encode( $readerData );

		return $this -> render( 'index' , ['json' => $json]);
	}

















}
