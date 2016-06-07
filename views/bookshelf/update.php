<?php

use app\assets\IndexGlobalAsset;
use app\assets\ParamSetGlobalAsset;

use yii\widgets\ActiveForm;
use yii\helpers\Html;

IndexGlobalAsset::register( $this );
ParamSetGlobalAsset::register( $this );

?>


<!-- 用于标记本页面是 update 页面，在css中 可以 .update .all{ .. } 而不会影响
     其他页面的 .index 
-->
<div class='update'>

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
				<?= Html::submitButton('修改', ['class' => 'btn btn-primary update-btn'])	?>		
			<?php ActiveForm::end()  ?>
		</div>

	</div>

</div>
