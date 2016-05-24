<?php

use app\assets\LayerGlobalAsset;
use app\assets\BookAddAsset;
use app\assets\DropDownGlobalAsset;
use app\assets\BookSreachEditAsset;

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

use yii\helpers\Url;
use yii\helpers\Html;

LayerGlobalAsset::register( $this );
BookAddAsset::register( $this );
DropDownGlobalAsset::register( $this );
BookSreachEditAsset::register( $this );



/** -------------------------------------------------------
 * 判断是否出现 " 操作成功 " 的 tip 层
 * @var $session['isShowTip'] boolean  为 true 则出现 tip 层，false反之
 */
if ( $session['isShowTip'] ){

	echo " <script>function tip(){ layer.msg('{$session['tipContent']}', { icon: 1, offset:'100px'}) }  </script>";
	$session['isShowTip'] = false;
}

?>


<div class="all">
	<div class="bread-nav">
		<span>读者管理</span>  >
		<span>读者搜索</span>  >
		<span>读者管理</span>
	</div>


<?php

/**----------------------------------------------------
 * 图书档案编辑 
 */
?>
	<div class="input-box">
		<?php $form = ActiveForm::begin();  ?> 
			<?= Html::hiddenInput('PK_readerID', $readerData['PK_readerID'] )  ?>
			<?= $form->field( $model, 'readerName') ->textinput(['placeholder' => '读者姓名', 'value' => $readerData['PK_readerID'] ]) -> label( false ) ?>
			<?= $form->field( $model, 'readerName') ->textinput(['placeholder' => '图书名称', 'value' => $readerData['readerName']  ]) -> label( false ) ?>

			
			<?= $form->field( $model, 'readerNumber' ) ->textinput(['placeholder' => '读者编号', 'value' => $readerData['readerNumber'] ]) -> label( false ) ?>
			<?= $form->field( $model, 'readerBirthday' ) ->textinput(['placeholder' => '出生日期', 'value' => $readerData['readerBirthday'] ]) -> label( false ) ?>


			<div id="main" class="readerType">
				<?= Html::dropDownList('readerType', null, $readerTypeData, ['class' => 'basic-usage-demo'  , 'value' => $readerData['FK_readerTypeID'] ]); ?>
			</div>
			<div class="help-block"></div> 


			<?= Html::submitButton('更新', ['class' => 'btn btn-primary book-edit-btn'])	?>		
		<?php ActiveForm::end()  ?>
	</div>


	<script>
		window.onload = function()
		{
			dropDown();

			selectOption('bookType'); // 进入编辑页面，自动选择下拉框 对应的值
			selectOption('bookshelf');
			selectOption('publisher');

			tip();
		}

		function dropDown()
		{
			$(document).ready(function(){
				$('.basic-usage-demo').fancySelect();	
			});
		}

		
	</script>




</div>
