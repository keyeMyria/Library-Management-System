<?php

use app\assets\IndexGlobalAsset;
use app\assets\UpdateGlobalAsset;
use app\assets\LayerGlobalAsset;
use app\assets\BorrowQueryAsset;
use app\assets\DropDownGlobalAsset;

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

use yii\helpers\Url;
use yii\helpers\Html;

IndexGlobalAsset::register( $this );
UpdateGlobalAsset::register( $this );
LayerGlobalAsset::register( $this );
BorrowQueryAsset::register( $this );
DropDownGlobalAsset::register( $this );


/** -------------------------------------------------------
 * 判断是否出现 " 操作成功 " 的 tip 层
 * @var $session['isShowTip'] boolean  为 true 则出现 tip 层，false反之
 */
if ( $session['isShowTip'] ){

	echo " <script>function tip(){ layer.msg('{$session['tipContent']}', { icon: 1, offset:'100px'}) }  </script>";
	$session['isShowTip'] = false;
}

?>







<!-- 使用Bootstrap的栅格系统 -->                                                                         
<div class='container'>
    <div class='row'>

        <!-- 大屏适配 -->
        <div class='col-lg-12 visible-lg-block'>
        
			<div class="lg-all all">
				<div class="bread-nav">
					<span>图书借阅查询</span>
				</div>

				<?= Html::beginForm( Url::to(['borrow-query/index']), 'get') ?>

				<div class='input-box'>
					<div class='radio-box'>
						<?= Html::radioList('condition', 'notReturn' , ['notReturn' => '只查看未归还', 'returned' => '只查看已归还'])  ?>	
					</div>
					<div class='sreach-box'>
						<span>查找最近</span>
						<?= Html::input('sreachText', 'sreachText'   , null, ['class' => 'sreachInput'] )  ?>
						<span>天被借出的书</span>
						<?= Html::submitButton('查询' ,  ['class' => 'btn btn-primary'] )  ?>
					</div>
				</div>

				<?= Html::endForm() ?>


				<table class='table table-bordered table-result text-center'>
					<thead class='text-center'>
						<tr>
							<th class='text-center'>读者</th>	
							<th class='text-center'>书名</th>	
							<th class='text-center'>借出时间</th>	
							<th class='text-center'>应还时间</th>	
							<th class='text-center'>书架</th>	
							<th class='text-center'>状态</th>	
						</tr>
					</thead>
					<tbody>
					<?php if( isset( $pages_large )){	
							foreach( $models_large as $key => $value ){  ?>
							<tr>
								<td class='text-center'><?php echo $models_large[ $key ]['readerName'];  ?></td>
								<td title='<?php echo isset($models_large[ $key ]['viewBookName']) ? $models_large[ $key ]['bookInfoBookName'] : ''; ?>'>《<?php echo isset($models_large[ $key ]['viewBookName']) ? $models_large[$key ]['viewBookName'] : $models_large[ $key ]['bookInfoBookName'] ;  ?>》</td>
								<td><?php echo date('Y-m-d', $models_large[ $key ]['borrowBeginTimestamp']);  ?></td>
								<td><?php echo date('Y-m-d', $models_large[ $key ]['borrowReturnTimestamp']);  ?></td>
								<td><?php echo $models_large[ $key ]['bookshelfName'];  ?></td>
								<td><?php echo $models_large[ $key ]['borrowIsReturn'] ? '已归还' : '未归还'; ?></td>
							</tr>
					<?php  
							}	   
						} ?>
					</tbody>

				</table>


			<?php
			if( isset( $pages_large ) ){
				echo LinkPager::widget([
						'pagination' => $pages_large,
				]);
			}
			?>



			</div>



        </div>

        <!--中屏适配 -->
        <div class='col-md-12 visible-md-block'>

			<div class="md-all all">
				<div class="bread-nav">
					<span>图书借阅查询</span>
				</div>

				<?= Html::beginForm( Url::to(['borrow-query/index']), 'get') ?>

				<div class='input-box'>
					<div class='radio-box'>
						<?= Html::radioList('condition', 'notReturn' , ['notReturn' => '只查看未归还', 'returned' => '只查看已归还'])  ?>	
					</div>
					<div class='sreach-box'>
						<span>查找最近</span>
						<?= Html::input('sreachText', 'sreachText'   , null, ['class' => 'sreachInput'] )  ?>
						<span>天被借出的书</span>
						<?= Html::submitButton('查询' ,  ['class' => 'btn btn-primary'] )  ?>
					</div>
				</div>

				<?= Html::endForm() ?>


				<table class='table table-bordered table-result text-center'>
					<thead class='text-center'>
						<tr>
							<th class='text-center'>读者</th>	
							<th class='text-center'>书名</th>	
							<th class='text-center'>借出时间</th>	
							<th class='text-center'>应还时间</th>	
							<th class='text-center'>书架</th>	
							<th class='text-center'>状态</th>	
						</tr>
					</thead>
					<tbody>
					<?php if( isset( $pages )){	
							foreach( $models as $key => $value ){  ?>
							<tr>
								<td class='text-center'><?php echo $models[ $key ]['readerName'];  ?></td>
								<td title='<?php echo isset($models[ $key ]['viewBookName']) ? $models[ $key ]['bookInfoBookName'] : ''; ?>'>《<?php echo isset($models[ $key ]['viewBookName']) ? $models[$key ]['viewBookName'] : $models[ $key ]['bookInfoBookName'] ;  ?>》</td>
								<td><?php echo date('Y-m-d', $models[ $key ]['borrowBeginTimestamp']);  ?></td>
								<td><?php echo date('Y-m-d', $models[ $key ]['borrowReturnTimestamp']);  ?></td>
								<td><?php echo $models[ $key ]['bookshelfName'];  ?></td>
								<td><?php echo $models[ $key ]['borrowIsReturn'] ? '已归还' : '未归还'; ?></td>
							</tr>
					<?php  
							}	   
						} ?>
					</tbody>

				</table>


			<?php
			if( isset( $pages) ){
				echo LinkPager::widget([
						'pagination' => $pages,
				]);
			}
			?>



			</div>



        </div>
    </div> <!-- class = row end -->
</div> <!-- class = container end -->
















	<script>
		window.onload = function()
		{
			selectedRadio();
			tip();
		}


		function selectedRadio()
		{
			// 由于在分页跳转后，radio 单选框的值就自动变回默认的选中，那么这里要做的是保持他的选中
			// 时间原因暂无
		}
	</script>



