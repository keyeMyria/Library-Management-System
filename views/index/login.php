<?php

use yii\widgets\ActiveForm;
use app\assets\LoginAsset;
use yii\helpers\Html;

LoginAsset::register( $this );

?>
<div class="login" >
<?php $form = ActiveForm::begin() ?>

	<?= $form -> field( $model, 'managerUsername')-> textinput(['placeholder' => '用户名']) -> label( false ) ?>
	<?= $form -> field( $model, 'managerPassword')-> passwordInput(['placeholder' => '密码']) -> label( false ) ?>
	<?= Html::submitButton('登陆', ['class' => 'btn btn-primary btn-block btn-large']) ?>

<?php ActiveForm::end(); ?>
</div>

</body>
</html>
