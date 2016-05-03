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
		<span>读者类型管理</span> >
		<span>编辑读者类型</span> 
	</div>

	<div class="input-box reader-type-update-input-box" style="position:absolute;top:25%;left:40%;">
		<?php $form = ActiveForm::begin();  ?> 
			<?= $form->field( $model, 'readerTypeName') ->textinput(['value' => $data->readerTypeName, 'class'=> 'form-control reader-type-update-name reader-type-name' ]) -> label( false ) ?>
			<?= $form->field( $model, 'readerTypeBorrowNumber') ->textinput(['value' => $data->readerTypeBorrowNumber, 'class'=>'form-control reader-type-update-borrow-number borrow-number' ]) -> label( false ) ?>
			<?= Html::hiddenInput('id', $data->PK_readerTypeID) ?>
			<?= Html::submitButton('修改', ['class' => 'btn btn-primary add-btn'])	?>		
		<?php ActiveForm::end()  ?>
	</div>

</div>


