<?php

use app\assets\BookSreachAsset;
use app\assets\IndexGlobalAsset;

BookSreachAsset::register( $this );
IndexGlobalAsset::register( $this );

?>

<div class='container'>
	<div class='row'>

		<!-- 适配大屏 -->
		<div  class='col-lg-12 visible-lg-block'>		

			<div class="lg-all all">

				<div class="bread-nav">
					<span>图书搜索</span>  >
					<span>查看更多</span>
				</div>
				
				<button type="button" class="btn btn-primary view-more-goback-btn" onclick='history.go(-1);'> 返回 </button>


				<table class='table table-bordered view-more-table text-center'>
					<tbody>
						<tr>
							<td> ISBN </td>
							<td> <?php echo $data['bookInfoBookISBN'];  ?> </td>
						</tr>
						<tr>
							<td> 书名 </td>
							<td> <?php echo $data['bookInfoBookName'];  ?> </td>
						</tr>
						<tr>
							<td> 作者 </td>
							<td> <?php echo $data['bookInfoBookAuthor'];  ?> </td>
						</tr>
						<tr>
							<td> 译者 </td>
							<td> <?php echo $data['bookInfoBookTranslator'];  ?> </td>
						</tr>
						<tr>
							<td> 单价 </td>
							<td> <?php echo $data['bookInfoBookPrice'];  ?> </td>
						</tr>
						<tr>
							<td> 页码 </td>
							<td> <?php echo $data['bookInfoBookPage'];  ?> </td>
						</tr>
						<tr>
							<td> 图书类型 </td>
							<td> <?php echo $data['bookTypeName'];  ?> </td>
						</tr>
						<tr>
							<td> 书架 </td>
							<td> <?php echo $data['bookshelfName'];  ?> </td>
						</tr>
						<tr>
							<td> 出版社 </td>
							<td> <?php echo $data['publisherName'];  ?> </td>
						</tr>
						<tr>
							<td> 入库时间 </td>
							<td> <?php echo $data['bookRelationshipStorageTime'];  ?> </td>
						</tr>
						<tr>
							<td> 操作人 </td>
							<td> <?php echo $data['managerUsername'];  ?> </td>
						</tr>
					</tbody>	

				</table>
			</div>

		</div>

		<!-- 适配中屏 -->
		<div  class='col-md-12 visible-md-block'>		

			<div class="md-all all">

				<div class="bread-nav">
					<span>图书搜索</span>  >
					<span>查看更多</span>
				</div>
				
				<button type="button" class="btn btn-primary view-more-goback-btn" onclick='history.go(-1);'> 返回 </button>


				<table class='table table-bordered view-more-table text-center'>
					<tbody>
						<tr>
							<td> ISBN </td>
							<td> <?php echo $data['bookInfoBookISBN'];  ?> </td>
						</tr>
						<tr>
							<td> 书名 </td>
							<td> <?php echo $data['bookInfoBookName'];  ?> </td>
						</tr>
						<tr>
							<td> 作者 </td>
							<td> <?php echo $data['bookInfoBookAuthor'];  ?> </td>
						</tr>
						<tr>
							<td> 译者 </td>
							<td> <?php echo $data['bookInfoBookTranslator'];  ?> </td>
						</tr>
						<tr>
							<td> 单价 </td>
							<td> <?php echo $data['bookInfoBookPrice'];  ?> </td>
						</tr>
						<tr>
							<td> 页码 </td>
							<td> <?php echo $data['bookInfoBookPage'];  ?> </td>
						</tr>
						<tr>
							<td> 图书类型 </td>
							<td> <?php echo $data['bookTypeName'];  ?> </td>
						</tr>
						<tr>
							<td> 书架 </td>
							<td> <?php echo $data['bookshelfName'];  ?> </td>
						</tr>
						<tr>
							<td> 出版社 </td>
							<td> <?php echo $data['publisherName'];  ?> </td>
						</tr>
						<tr>
							<td> 入库时间 </td>
							<td> <?php echo $data['bookRelationshipStorageTime'];  ?> </td>
						</tr>
						<tr>
							<td> 操作人 </td>
							<td> <?php echo $data['managerUsername'];  ?> </td>
						</tr>
					</tbody>	

				</table>
			</div>

		</div>

	</div>
</div>
