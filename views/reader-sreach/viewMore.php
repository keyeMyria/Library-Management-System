<?php

use app\assets\IndexGlobalAsset;
use app\assets\UpdateGlobalAsset;
use app\assets\BookSreachAsset;


IndexGlobalAsset::register( $this );
UpdateGlobalAsset::register( $this );
BookSreachAsset::register( $this );

?>


<div class='update'>
	<div class="all">
		<div class="bread-nav">
			<span>读者管理</span>  >
			<span>读者搜索</span>  >
			<span>查看更多</span>
		</div>
		
		<button type="button" class="btn btn-primary view-more-goback-btn" onclick='history.go(-1);'> 返回 </button>


		<table class='table table-bordered view-more-table text-center'>
			<tbody>
				<tr>
					<td> 姓名 </td>
					<td> <?php echo $data['readerName'];  ?> </td>
				</tr>
				<tr>
					<td> 编号 </td>
					<td> <?php echo $data['readerNumber'];  ?> </td>
				</tr>
				<tr>
					<td> 出生年月 </td>
					<td> <?php echo $data['readerBirthday'];  ?> </td>
				</tr>
				<tr>
					<td> 证件类型 </td>
					<td> <?php echo $data['readerCertificate'];  ?> </td>
				</tr>
				<tr>
					<td> 证件号码 </td>
					<td> <?php echo $data['readerCertificateNumber'];  ?> </td>
				</tr>
				<tr>
					<td> 手机 </td>
					<td> <?php echo $data['readerPhone'];  ?> </td>
				</tr>
				<tr>
					<td> Email </td>
					<td> <?php echo $data['readerEmail'];  ?> </td>
				</tr>
				<tr>
					<td> 注册时间 </td>
					<td> <?php echo $data['readerCreateDate'];  ?> </td>
				</tr>
			</tbody>	

		</table>


	</div>

</div>

