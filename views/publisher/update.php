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
		<span>出版社管理</span> >
		<span>编辑出版社</span> 
	</div>

	<div class="input-box" style="position:absolute;top:25%;left:40%;">
		<?php $form = ActiveForm::begin();  ?> 
			<?= $form->field( $model, 'publisherName') ->textinput(['value' => $data->publisherName ]) -> label( false ) ?>
			<?= Html::hiddenInput('id', $data->PK_publisherID) ?>
			<?= Html::submitButton('修改', ['class' => 'btn btn-primary add-btn'])	?>		
		<?php ActiveForm::end()  ?>
	</div>

</div>


