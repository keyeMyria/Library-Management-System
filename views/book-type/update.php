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
		<span>图书类型管理</span> >
		<span>编辑图书类型</span> 
	</div>

	<div class="input-box" style="position:absolute;top:25%;left:40%;">
		<?php $form = ActiveForm::begin();  ?> 
			<?= $form->field( $model, 'bookTypeName') ->textinput(['value' => $data->bookTypeName ]) -> label( false ) ?>
			<?= Html::hiddenInput('id', $data->PK_bookTypeID) ?>
			<?= Html::submitButton('修改', ['class' => 'btn btn-primary add-btn'])	?>		
		<?php ActiveForm::end()  ?>
	</div>

</div>


