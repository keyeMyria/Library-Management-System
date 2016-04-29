<?php

use app\assets\BookshelfAsset;
use yii\widgets\ActiveForm;
use yii\Helpers\Html;
use yii\widgets\LinkPager;

BookshelfAsset::register( $this );

?>


<div class="all">
	<div class="bread-nav">
		<span>参数设置</span>  >
		<span>书架设置</span>
	</div>


	<div class="input-box">
		<?php $form = ActiveForm::begin();  ?> 
			<?= $form->field( $model, 'bookshelfName') ->textinput(['placeholder' => '请输入书架名称']) -> label( false ) ?>
			<?= Html::submitButton('新增', ['class' => 'btn btn-primary add-bookshelf-btn'])	?>		
		<?php ActiveForm::end()  ?>
	</div>

	<div>
		

	</div>


	<div class="table-box">
		<table class="table table-hover table-bordered text-center">
			<thead>
				<tr class="active">
					<td><b>书架名称</b></td>
					<td><b>编辑</b></td>
					<td><b>删除</b></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $data as $key => $value ) {  ?>
					<tr>
					<td><?php echo $data[ $key ]['bookshelfName']; ?></td>
						<td><a>编辑</a></td>
						<td><a>删除</a></td>
					</tr>
				<?php } ?>

			</tbody>
		</table>
	</div>
	
	<div class="pages-box">	
		<?php
			echo LinkPager::widget([
					'pagination' => $pages,
				]);

		?>
	</div>



</div>
