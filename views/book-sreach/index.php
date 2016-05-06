<?php


use app\assets\LayerGlobalAsset;
use app\assets\DropDownGlobalAsset;
use app\assets\BookSreachAsset;

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

use yii\helpers\Html;


BookSreachAsset::register( $this );
DropDownGlobalAsset::register( $this );

?>

<div class='all'>
	<div class="bread-nav">

		<span>图书档案</span> >
		<span>图书搜索</span>
	
	</div>

	<div class="input-box">
		<?= Html::beginForm() ?> 
			<?= Html::dropDownList('sreachType', null, $sreachType ,['class' => 'basic-usage-demo']) ?>
			<?= Html::input('text', 'sreach', null,  ['class' => 'form-control form-sreach'] ) ?>
			<?= Html::SubmitButton('搜索', ['class' => 'btn btn-primary sreach-btn']) ?>
		<?= Html::endForm() ?>
	</div>

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
			<tr>
				<td>88787419189</td>
				<td>《时间简史》</td>
				<td>史蒂夫.霍金</td>
				<td>编辑</td>
				<td>删除</td>
				<td>查看更多</td>
			</tr>
			<tr>
				<td>88999989</td>
				<td>《事件连续》</td>
				<td>霍金</td>
				<td>编辑</td>
				<td>删除</td>
				<td>查看更多</td>
			</tr>
			<tr>
				<td>292929999</td>
				<td>《围城》</td>
				<td>史蒂夫</td>
				<td>编辑</td>
				<td>删除</td>
				<td>查看更多</td>
			</tr>

		</tbody>

	</table>

</div>







<script>

	window.onload = function()
	{
		dropDown();
	}

	function dropDown()
	{
		$(document).ready(function(){
			$('.basic-usage-demo').fancySelect();	
		});
	}
 
</script>










