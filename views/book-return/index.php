<?php

use app\assets\ParamSetGlobalAsset;
use app\assets\LayerGlobalAsset;
use app\assets\BookReturnAsset;


use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;


ParamSetGlobalAsset::register( $this );
LayerGlobalAsset::register( $this );
BookReturnAsset::register( $this );


/** -------------------------------------------------------
 * 判断是否出现 " 操作成功 " 的 tip 层
 * @var $session['isShowTip'] boolean  为 true 则出现 tip 层，false反之
 */
if ( $session['isShowTip'] ){
    echo " <script>function tip(){ layer.msg('{$session['tipContent']}', { icon: 1, offset:'100px'}) }  </script>";
    $session['isShowTip'] = false;
}


?>


<div class='all'>

	<div class='bread-nav'>
		<span>图书归还</span>	
	</div>
	
	<div class='top-btn-bar'>
		<a href='<?= Url::to(['book-return/borrow']) ?>' class='btn btn-primary add-borrow-btn'> 借阅图书 </a>		
		<a href='<?= Url::to(['book-return/logout']) ?>' class='btn btn-primary switch-reader-btn' > 切换读者 </a>		

	</div>

	<div class='reader-data-box'>

		<ul class='one'>
			<li>姓名: <span><?php echo $readerData['readerName'];   ?></span></li>
			<li>读者类型:  <span><?php echo $readerData['readerTypeName'];  ?></span></li>
		</ul>

		<ul class='two'>
			<li>证件类型: <span><?php echo $readerData['readerCertificate'];   ?></span></li>
			<li>证件号码:  <span><?php echo $readerData['readerCertificateNumber'];   ?></span></li>
		</ul>

		<ul class='three'>
			<li>可借 <span><?php echo $readerData['readerTypeBorrowNumber'];  ?></span> 本 </li>
			<li>已借 <span><?php echo $borrowedCount;  ?></span> 本 </li>
		</ul>

	</div>

	<div class='reader-borrow-box'>
		<table class='table table-bordered text-center'>
			<thead>
				<tr>
					<th class='text-center'>图书名称</th>
					<th class='text-center'>书架</th>
					<th class='text-center'>借阅时间</th>
					<th class='text-center'>应还时间</th>
					<th class='text-center'>状态</th>
					<th class='text-center'>续借</th>
					<th class='text-center'>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $models as $key => $value ){  ?> 
					<tr>
					<td>《<?php echo $models[ $key ]['bookInfoBookName'];  ?>》</td>
					<td><?php echo $models[ $key ]['bookshelfName'];  ?></td>
					<td><?php echo date( 'Y-m-d' , $models[ $key ]['borrowBeginTimestamp'] )   ?></td>
					<td><?php echo date( 'Y-m-d' , $models[ $key ]['borrowReturnTimestamp'] )   ?></td>
					<td><b><?php echo $models[ $key ]['borrowIsReturn'] ? '已归还' : '未归还'; ?></b></td>
					<td><a href='<?= Url::to(['book-return/renew', 'PK_borrowID' => $models[ $key ]['PK_borrowID']])    ?>' >续借 </a> </td>
					<td><a href='<?= Url::to(['book-return/return', 'PK_borrowID' => $models[ $key ]['PK_borrowID']])    ?>' > 归还 </a> </td>
					</tr>
				<?php }   ?>
			</tbody>

		</table>

	
	</div>


<?php

echo LinkPager::widget([
	'pagination' => $pages,
]);


?>


	
</div>


<script>
	window.onload = function()
	{
		tip();
	}	

</script>

