<?php

use app\assets\ParamSetGlobalAsset;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

ParamSetGlobalAsset::register( $this );

?>

<div class="all">

	<button class="btn btn-primary update-goback-btn" onclick='history.go(-1);'>返回</button>


	<div class="bread-nav">
		<span>参数设置</span> >
		<span>书架管理</span> >
		<span>编辑书架</span> 
	</div>

	<div class="input-box" style="position:absolute;top:25%;left:40%;">
		<?php $form = ActiveForm::begin();  ?> 
			<?= $form->field( $model, 'bookshelfName') ->textinput(['value' => $data->bookshelfName ]) -> label( false ) ?>
			<?= Html::hiddenInput('id', $data->PK_bookshelfID) ?>
			<?= Html::submitButton('修改', ['class' => 'btn btn-primary add-bookshelf-btn'])	?>		
		<?php ActiveForm::end()  ?>
	</div>

</div>


