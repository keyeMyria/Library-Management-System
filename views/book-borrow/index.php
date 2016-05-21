<?php

use app\assets\ParamSetGlobalAsset;
use app\assets\LayerGlobalAsset;
use app\assets\BookBorrowAsset;


use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

ParamSetGlobalAsset::register( $this );
LayerGlobalAsset::register( $this );
BookBorrowAsset::register( $this );


/** -------------------------------------------------------
 * 判断是否出现 " 操作成功 " 的 tip 层
 * @var $session['isShowTip'] boolean  为 true 则出现 tip 层，false反之
 */
if ( $session['isShowTip'] ){
    echo " <script>function tip(){ layer.msg('{$session['tipContent']}', { icon: {$session['tipLevel']},  offset:'100px'}) }  </script>";
    $session['isShowTip'] = false;
}



?>


<div class='all'>

	<div class='bread-nav'>
		<span>图书归还</span>	
	</div>
	

	<a href='<?= Url::to(['book-return/index']) ?>' class='btn btn-primary goback-btn' > 返回 </a>		


	<div class='input-box' >
	<?php $form = ActiveForm::begin(['method' => 'get']) ?>
		<?= $form -> field( $bookInfoModel, 'bookInfoBookISBN')->textinput(['placeholder' => '输入图书ISBN', 'class' => 'sreachInput']) -> label( false ) ?>
		<?= Html::submitButton('查询', ['class' => 'btn btn-primary sreach-btn']) ?>
	<?php ActiveForm::end() ?>
			
	</div>
	

	<!--

		1. 输入ISBN查询出具体的书
		2. ISBN栏给上 class='isbn'
		3. 用 js ， 当点击 “查询” 按钮后，去获取 class='isbn' 的 text,
				如果有，就存放到 “确认借阅” 上方的隐藏域中，
				如果没有，那就不用管。
	 --> 

	<table class='table table-hover table-book-info '>

			<tbody>
		<?php if( isset( $bookInfoData ) ){  ?>

				<tr>
				<td>ISBN:  &nbsp;<span class='isbn' book-info-id='<?php echo $bookInfoData['PK_bookInfoID']; ?>'> <?php echo $bookInfoData['bookInfoBookISBN'];  ?>  </span></td>
					<td>书名: <span>  《  <?php echo $bookInfoData['bookInfoBookName'];  ?>  》  </span></td>
				</tr>
				<tr>
				<td>作者: &nbsp;<span>    <?php echo $bookInfoData['bookInfoBookAuthor'];  ?></span></td>
					<td>类型:  &nbsp;<span> <?php echo $bookInfoData['bookTypeName'];  ?> </span></td>
				</tr>
				<tr>
					<td>出版社:  <span>  <?php echo $bookInfoData['publisherName'];  ?>  </span></td>
					<td>书架:  &nbsp;<span> <?php echo $bookInfoData['bookshelfName'];  ?> </span></td>
				</tr>
				<tr>
					<td>定价:  &nbsp;<span>  ￥<?php echo $bookInfoData['bookInfoBookPrice'];  ?> </span></td>
					<td>页码:  &nbsp;<span>  <?php echo $bookInfoData['bookInfoBookPage'];  ?></span></td>
				</tr> 


		<?php   } else {  ?>
			
				<tr>
				<td>ISBN:  &nbsp;<span>  </span></td>
					<td>书名: <span>   </span></td>
				</tr>
				<tr>
				<td>作者: &nbsp;<span> </span></td>
					<td>类型:  &nbsp;<span> </span></td>
				</tr>
				<tr>
					<td>出版社:  <span>    </span></td>
					<td>书架:  &nbsp;<span>  </span></td>
				</tr>
				<tr>
					<td>定价:  &nbsp;<span>   </span></td>
					<td>页码:  &nbsp;<span>  </span></td>
				</tr> 

		<?php  }  ?>

			</tbody>
	</table>

	<?= Html::beginForm( Url::to(['book-borrow/index']), 'post'  ) ?>	
		<?= Html::hiddenInput( 'bookInfoID', null , ['id' => 'bookInfoID'] ); ?>
		<?= Html::submitButton('确认借阅', ['class' => 'btn btn-primary confirm-borrow-btn', 'disabled' => 'true']) ?>
	<?= Html::endForm() ?>
	
</div>


<script>

window.onload = function()
{
	setBookInfoID();
	tip();
}

// 当按照 ISBN 查询出图书信息，然后把 图书ID, 放入 “确认借阅” 的隐藏域中
function setBookInfoID(){

		bookInfoID = $('.isbn').attr('book-info-id');
		$('#bookInfoID').val( bookInfoID );

		if ( !isNaN( bookInfoID )  ){
			// 不是　NaN, 说明有 ISBN ，把按钮 禁用的属性去掉
			$('.confirm-borrow-btn').removeAttr('disabled');	
		}
}





</script>

