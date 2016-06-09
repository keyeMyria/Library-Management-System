<?php


use app\assets\IndexGlobalAsset;
use app\assets\LayerGlobalAsset;
use app\assets\DropDownGlobalAsset;
use app\assets\BookSreachAsset;

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

use yii\helpers\Html;
use yii\helpers\Url;


IndexGlobalAsset::register( $this );
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

<!-- 使用Bootstrap的栅格系统 -->
<div class='container'>
    <div class='row'>

        <!-- 大屏适配 -->
        <div class='col-lg-12 visible-lg-block'>

			<div class='lg-all all'>
				<div class="bread-nav">

					<span>读者管理</span> >
					<span>读者搜索</span>
				
				</div>


				<!-- 左上方搜索框层  -->

				<div class="input-box">
					<?= Html::beginForm('', 'get') ?> 
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
							<th class="text-center">姓名</td>
							<th class="text-center">编号</td>
							<th class="text-center">编辑</td>
							<th class="text-center">删除</td>
							<th class="text-center">查看更多</td>
						</tr>
					</thead>
					<tbody>
						<?php
					if( isset( $models) ){
						foreach( $models as $key => $value ){ ?>
							<tr>
								<td> <?php echo $models[$key]['readerName'];    ?> </td>
								<td> <?php echo $models[$key]['readerNumber'];    ?> </td>
								<td><a id='del-book-btn' href="<?= Url::to(['reader-sreach/edit', 'id' => $models[$key]['PK_readerID'] ]) ?>">编辑</a></td>
								<td><a id='del-book-btn' href="<?= Url::to(['reader-sreach/del', 'id' => $models[$key]['PK_readerID'] ]) ?>">删除</a></td>
								<td><a id='del-book-btn' href="<?= Url::to(['reader-sreach/view-more', 'id' => $models[$key]['PK_readerID'] ]) ?>">查看更多</a></td>
							</tr>
						<?php	}
							}
						?>

					</tbody>

				</table>

				<?php 
					if( isset( $pages))
					echo LinkPager::widget([
						'pagination' => $pages,
					]);
				?>

			</div>

        </div>
 
        <!--中屏适配 -->
        <div class='col-md-12 visible-md-block'>
 
			<div class='md-all all'>
				<div class="bread-nav">

					<span>读者管理</span> >
					<span>读者搜索</span>
				
				</div>


				<!-- 左上方搜索框层  -->

				<div class="input-box">
					<?= Html::beginForm('', 'get') ?> 
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
							<th class="text-center">姓名</td>
							<th class="text-center">编号</td>
							<th class="text-center">编辑</td>
							<th class="text-center">删除</td>
							<th class="text-center">查看更多</td>
						</tr>
					</thead>
					<tbody>
						<?php
					if( isset( $models) ){
						foreach( $models as $key => $value ){ ?>
							<tr>
								<td> <?php echo $models[$key]['readerName'];    ?> </td>
								<td> <?php echo $models[$key]['readerNumber'];    ?> </td>
								<td><a id='del-book-btn' href="<?= Url::to(['reader-sreach/edit', 'id' => $models[$key]['PK_readerID'] ]) ?>">编辑</a></td>
								<td><a id='del-book-btn' href="<?= Url::to(['reader-sreach/del', 'id' => $models[$key]['PK_readerID'] ]) ?>">删除</a></td>
								<td><a id='del-book-btn' href="<?= Url::to(['reader-sreach/view-more', 'id' => $models[$key]['PK_readerID'] ]) ?>">查看更多</a></td>
							</tr>
						<?php	}
							}
						?>

					</tbody>

				</table>

				<?php 
					if( isset( $pages))
					echo LinkPager::widget([
						'pagination' => $pages,
					]);
				?>

			</div>

        </div>
    </div> <!-- class = row end -->
</div> <!-- class = container end -->









<script>

	window.onload = function()
	{
		dropDown();
		recordSreachType();      //  -> js/bookSreach/dropDownSreachType.js
		selectOptionBySession(); //  -> js/bookSreach/dropDownSreachType.js
		recordSreachTypeByClickSreachBtn(); //  -> js/bookSreach/dropDownSreachType.js
		changePageVal();
		paginationMarginTop();

		tip();
	}

	// 为触发下拉框
	function dropDown()
	{
		$(document).ready(function(){
			$('.basic-usage-demo').fancySelect();	
		});
	}


	// 读者搜索时 分页的栏的 margin-top
     function paginationMarginTop()
     {
	     $('.pagination').css('bottom', '-1%');
     }

 

</script>









