<?php

use app\assets\ParamSetGlobalAsset;
use app\assets\LayerGlobalAsset;

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

use yii\Helpers\Url;
use yii\Helpers\Html;

ParamSetGlobalAsset::register( $this );
LayerGlobalAsset::register( $this );


/** -------------------------------------------------------
 * 判断是否出现 " 操作成功 " 的 tip 层
 * @var $session['isShowTip'] boolean  为 true 则出现 tip 层，false反之
 */
#if ( $session['isShowTip'] ){
#	echo " <script> window.onload = function(){ layer.msg('操作成功', { icon: 1, offset:'100px'}) } </script>";
#	$session['isShowTip'] = false;
#}

?>


<div class="all">
	<div class="bread-nav">
		<span>参数设置</span>  >
		<span>读者类型管理</span>
	</div>


<?php
/**----------------------------------------------------
 * 书架添加 
 */
?>
	<div class="input-box reader-type-input-box" >
		<?php $form = ActiveForm::begin();  ?> 
			<?= $form->field( $model, 'readerTypeName') ->textinput(['placeholder' => '读者类型名称', 'class' => 'form-control reader-type-name']) -> label( false ) ?>
			<?= $form->field( $model, 'readerTypeBorrowNumber') ->textinput(['placeholder' => '可借数量', 'class' => 'borrow-number form-control']) -> label( false ) ?>

			<?= Html::submitButton('新增', ['class' => 'btn btn-primary add-btn'])	?>		
		<?php ActiveForm::end()  ?>
	</div>

	<div>
		

	</div>


<?php
/** -----------------------------------------------------
 * 书架列表
 */
?>
	<div class="table-box">
		<table class="table table-hover table-bordered text-center">
			<thead>
				<tr class="active"o>
					<td><b>读者类型名称</b></td>
					<td><b>可借图书数量</b></td>
					<td><b>编辑</b></td>
					<td><b>删除</b></td>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
	
<?php
/** ------------------------------------------------------------
 * 页码
 */
?>
	<div class="pages-box">	
		<?php
			#echo LinkPager::widget([
			#		'pagination' => $pages,
			#	]);

		?>
	</div>



</div>
