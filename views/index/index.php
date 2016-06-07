<?php


use app\assets\IndexAsset;

IndexAsset::register( $this );


if ( $session['isFirstLogin'] ) {
	echo " <script>
			window.onload = function(){	layer.msg('登陆成功', { icon: 1, offset:'100px' } ) }
		</script> ";
}

$session['isFirstLogin'] = false;

?>


<div class='container'>
    <div class='row'>

		<!-- 中屏适配 -->
		<div class='col-md-12 visible-md-block text-center'>
			<div class='md-all all'>
				<!-- 进入管理系统的欢迎语  -->
				<div class='well'><h4>  欢迎进入图书馆管理系统 <h4></div>
				<div class='row'>

					
					<!-- 中屏 最近活跃读者 -->
					<div class='col-md-4 hot-reader-box'>
						<div class='panel panel-info'>
							<div class='panel-heading'>
								<h3 class='panel-title'> 最近活跃读者 </h3>
							</div>	
							<div class='panel-body'>
								<table class='table'>
										<tr>
											<th class='text-center'>读者</th>
											<th class='text-center'>借阅次数</th>
										</tr>
									<?php foreach( $hotReaderData as $key => $value ){ ?>
										<tr>
											<td><?php echo $hotReaderData[ $key ]['readerName']; ?></td>
											<td><?php echo $hotReaderData[ $key ]['count']; ?> </td>
										</tr>
									<?php } ?>
								</table>
							</div>
						</div>
					</div>

					<!-- 中屏 最近热门图书 -->
					<div class='col-md-6 hot-book-box'>
						<div class='panel panel-info'>
							<div class='panel-heading'>
								<h3 class='panel-title'> 最近热门图书 </h3>
							</div>	
							<div class='panel-body'>
								<table class='table'>
									<tr>
										<th class='text-center'>图书名称</th>
										<th class='text-center'>借阅次数</th>
							
									</tr>
								<?php foreach( $hotBookData as $key => $value ){ ?>
									<tr>
										<td title='<?php echo isset($hotBookData[ $key ]['viewBookName']) ? $hotBookData[ $key ]['bookInfoBookName'] : ''; ?>'>《<?php echo isset($hotBookData[ $key ]['viewBookName']) ? $hotBookData[ $key ]['viewBookName'] : $hotBookData[ $key ]['bookInfoBookName'] ;  ?>》</td>
	 
										<td>  <?php echo $hotBookData[ $key ]['count']; ?> </td>
									</tr>
								<?php } ?>
								</table>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>

		<!-- 大屏适配 -->
		<div class='col-lg-12 visible-lg-block text-center'>
			<div class='lg-all all'>
				<div class='well h4'> 欢迎进入图书馆管理系统 </div>
				<div class='row'>

					<!-- 大屏 最近活跃读者 -->
					<div class='col-lg-3 hot-reader-box'>
						<div class='panel panel-info'>
							<div class='panel-heading'>
								<h3 class='panel-title'> 最近活跃读者 </h3>
							</div>	
							<div class='panel-body'>
								<table class='table'>
										<tr>
											<th class='text-center'>读者</th>
											<th class='text-center'>借阅次数</th>
										</tr>
									<?php foreach( $hotReaderData as $key => $value ){ ?>
										<tr>
											<td><?php echo $hotReaderData[ $key ]['readerName']; ?></td>
											<td><?php echo $hotReaderData[ $key ]['count']; ?> </td>
										</tr>
									<?php } ?>
								</table>
							</div>
						</div>
					</div>

					<!-- 大屏 最近热门图书 -->
					<div class='col-lg-6 hot-book-box'>
						<div class='panel panel-info'>
							<div class='panel-heading'>
								<h3 class='panel-title'> 最近热门图书 </h3>
							</div>	
							<div class='panel-body'>
								<table class='table'>
									<tr>
										<th class='text-center'>图书名称</th>
										<th class='text-center'>借阅次数</th>
							
									</tr>
								<?php foreach( $hotBookData as $key => $value ){ ?>
									<tr>
										<td title='<?php echo isset($hotBookData[ $key ]['viewBookName']) ? $hotBookData[ $key ]['bookInfoBookName'] : ''; ?>'>《<?php echo isset($hotBookData[ $key ]['viewBookName']) ? $hotBookData[ $key ]['viewBookName'] : $hotBookData[ $key ]['bookInfoBookName'] ;  ?>》</td>
	 
										<td>  <?php echo $hotBookData[ $key ]['count']; ?> </td>
									</tr>
								<?php } ?>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

    </div>


</div>



