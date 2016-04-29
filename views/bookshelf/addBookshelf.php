<?php


use yii\widgets\ActiveForm;
use app\assets\BookshelfAsset;
use yii\Helpers\Html;

BookshelfAsset::register( $this );

?>


<div class="all">
	<div class="bread-nav">
        <span>参数设置</span>  >
        <span>书架设置</span>  >
		<span>添加书架</span>	
    </div>

	
	<div class="input-box">
		<?php $form = ActiveForm::begin();  ?> 
			<?= $form->field( $model, 'bookshelfName') ->textinput(['placeholder' => '请输入书架名称']) -> label( false ) ?>
			<?= Html::submitButton('添加', ['class' => 'btn btn-primary'])	?>		
		<?php ActiveForm::end()  ?>
	</div>


</div>
