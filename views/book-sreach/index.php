<?php


use app\assets\LayerGlobalAsset;
use app\assets\DropDownGlobalAsset;
use app\assets\BookSreachAsset;

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

use yii\helpers\Html;


DropDownGlobalAsset::register( $this );
BookSreachAsset::register( $this );

/** -------------------------------------------------------
 * 判断是否出现 " 操作成功 " 的 tip 层
 * @var $session['isShowTip'] boolean  为 true 则出现 tip 层，false反之
 */
if ( $session['isShowTip'] ){
	echo " <script> function tip(){ layer.msg('{$session['tipContent']}', { icon: 1, offset:'100px'}) } </script>";
	$session['isShowTip'] = false;
}



?>

<div class='all'>
	<div class="bread-nav">

		<span>图书档案</span> >
		<span>图书搜索</span>
	
	</div>


	<!-- 左上方搜索框层  -->

	<div class="input-box">
		<?= Html::beginForm() ?> 
			<?= Html::dropDownList('sreachType', null, $sreachType ,['class' => 'basic-usage-demo']) ?>
			<?= Html::input('text', 'sreachText',  isset( $sreachText ) ? $sreachText : null  ,  ['class' => 'form-control form-sreach' ] ) ?>
			<?= Html::SubmitButton('搜索', ['class' => 'btn btn-primary sreach-btn']) ?>
		<?= Html::endForm() ?>
	</div>

	
	<!-- 页面右上角文字层  -->
	<?php if( isset( $sreachResult )){ ?>
	<div class="sreach-info">
		<span class="sreach-tip"><?php echo $sreachResultInfo['sreachType'];  ?>
			<span class="sreach-type"> <?php echo $sreachResultInfo['sreachResultText']; ?> </span> 
			进行搜索
		</span>		
		<br/>
		<span class="sreach-result">
			搜索结果
					<span class="sreach-result-number"> <?php echo $sreachResultInfo['sreachResultCount'];  ?> </span>
			条数据, 在 
					<span class="sreach-spend-time"> <?php echo $sreachResultInfo['sreachResultTime'];  ?></span> 秒内完成查询。
		</span>
	</div>
	<?php } ?>


	<!-- 显示查询结果的表格层   -->

	<table class='table table-bordered  table-hover sreach-result-table text-center'>
		<thead >
			<tr>
				<th class="text-center">ISBN</td>
				<th class="text-center">书名</td>
				<th class="text-center">作者</td>
				<th class="text-center">编辑</td>
				<th class="text-center">删除</td>
				<th class="text-center">查看更多</td>
			</tr>
		</thead>
		<tbody>
			<?php
		if( isset( $sreachResult) ){
			foreach( $sreachResult as $key => $value ){ ?>

				<tr>
					<td><?php echo $sreachResult[$key]['bookInfoBookISBN']; ?></td>
					<td><?php echo $sreachResult[$key]['bookInfoBookName']; ?></td>
					<td><?php echo $sreachResult[$key]['bookInfoBookAuthor']; ?></td>
					<td>编辑</td>
					<td>删除</td>
					<td>查看更多</td>
				</tr>
			<?php	}
				}
			?>

		</tbody>

	</table>

</div>




<script>

	window.onload = function()
	{
		dropDown();
		recordSreachType();      //  -> js/bookSreach/dropDownSreachType.js
		selectOptionBySession(); //  -> js/bookSreach/dropDownSreachType.js

	


		tip();
	}

	function dropDown()
	{
		$(document).ready(function(){
			$('.basic-usage-demo').fancySelect();	
		});
	}
 

</script>










