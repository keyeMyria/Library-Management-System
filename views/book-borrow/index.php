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
    echo " <script>function tip(){ layer.msg('{$session['tipContent']}', { icon: {$session['tipLevel']}  , offset:'100px'}) }  </script>";
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
	

	<table class='table table-hover table-book-info '>

			<tbody>
				<tr>
				<td>ISBN:  &nbsp;<span> <?php echo $bookInfoData['bookInfoBookISBN'] ? $bookInfoData['bookInfoBookISBN'] : ' ';  ?>  </span></td>
					<td>书名: <span>  《  <?php echo $bookInfoData['bookInfoBookName'] ? $bookInfoData['bookInfoBookName'] : ' ';  ?>  》  </span></td>
				</tr>
				<tr>
				<td>作者: &nbsp;<span>    <?php echo $bookInfoData['bookInfoBookAuthor'] ? $bookInfoData['bookInfoBookAuthor'] : ' ';  ?></span></td>
					<td>类型:  &nbsp;<span> <?php echo $bookInfoData['bookTypeName'] ? $bookInfoData['bookTypeName'] : ' ';  ?> </span></td>
				</tr>
				<tr>
					<td>出版社:  <span>  <?php echo $bookInfoData['publisherName'] ? $bookInfoData['publisherName'] : ' ';  ?>  </span></td>
					<td>书架:  &nbsp;<span> <?php echo $bookInfoData['bookshelfName'] ? $bookInfoData['bookshelfName'] : ' ';  ?> </span></td>
				</tr>
				<tr>
					<td>定价:  &nbsp;<span>  ￥<?php echo $bookInfoData['bookInfoBookPrice'] ? $bookInfoData['bookInfoBookPrice'] : ' ';  ?> </span></td>
					<td>页码:  &nbsp;<span>  <?php echo $bookInfoData['bookInfoBookPage'] ? $bookInfoData['bookInfoBookPage'] : '未知 ';  ?></span></td>
				</tr> 

			</tbody>


	<table>

	<a href='#' class='btn btn-primary confirm-borrow-btn'> 确认借阅 </a>
	
</div>


<script>

window.onload = function()
{
	tip();
}







</script>

