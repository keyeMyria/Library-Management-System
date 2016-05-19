<?php

use app\assets\ParamSetGlobalAsset;
use app\assets\LayerGlobalAsset;
use app\assets\BookReturnAsset;


use yii\widgets\ActiveForm;
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
			<li>姓名: <span>诸葛不亮</span></li>
			<li>读者类型:  <span>学生</span></li>
		</ul>
		<ul class='two'>
			<li>证件类型: <span>身份证</span></li>
			<li>证件号码:  <span>440111199701093017</span></li>
		</ul>
		<ul class='three'>
			<li>可借 <span>10</span> 本 </li>
			<li>已借 <span>6</span> 本 </li>
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
				<tr>
					<td>《时间简史》</td>
					<td>科技区</td>
					<td>2016-02-09</td>
					<td>2016-05-09</td>
					<td>需归还</td>
					<td>续借</td>
					<td>归还</td>
				</tr>
			</tbody>

		</table>

	
	</div>

	
</div>




