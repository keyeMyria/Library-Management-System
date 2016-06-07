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
if ( $session['isShowTip'] ){
	echo " <script> window.onload = function(){ layer.msg('{$session['tipContent']}', { icon: 1, offset:'100px'}) } </script>";
	$session['isShowTip'] = false;
}

?>


<div class="all">
	<div class="bread-nav">
		<span>参数设置</span>  >
		<span>出版社管理</span>
	</div>


<?php
/**----------------------------------------------------
 * 出版社添加 
 */
?>
	<div class="input-box">
		<?php $form = ActiveForm::begin();  ?> 
			<?= $form->field( $model, 'publisherName') ->textinput(['placeholder' => '请输入出版社名称']) -> label( false ) ?>
			<?= Html::submitButton('新增', ['class' => 'btn btn-primary add-btn'])	?>		
		<?php ActiveForm::end()  ?>
	</div>

	<div>
		

	</div>


<?php
/** -----------------------------------------------------
 * 出版社列表
 */
?>
	<div class="table-box">
		<table class="table table-hover table-bordered text-center">
			<thead>
				<tr class="active">
					<td><b>出版社名称</b></td>
					<td><b>编辑</b></td>
					<td><b>删除</b></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $data as $key => $value ) {  ?>
					<tr>
					<td><?php echo $data[ $key ]['publisherName']; ?></td>
						<td><a href="<?= Url::toRoute(['publisher/update-publisher', 'id'=>$data[$key]['PK_publisherID'] ])?>" >编辑</a></td>
						<td><a href="<?= Url::toRoute(['publisher/del-publisher', 'id'=>$data[$key]['PK_publisherID'] ])?>">删除</a></td> 
				<?php } ?>

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
			echo LinkPager::widget([
					'pagination' => $pages,
				]);

		?>
	</div>



</div>
