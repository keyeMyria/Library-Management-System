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


<div class="all" >
<!--
	<div class="upper">
		<div class="top">
			<h2>Git</h2>
			<span>
				公告:丢掉多余的空白符。如果给定这个值，换行字符（回车）会转换为空格，一行中多个空格的序列也会转换为一个空格。
			</span>
		</div>
	</div>

	<div class="lower">
		<div class="left">
		<span>运行系统 :   <?php echo $userAgent['platform'];  ?></span><br/>
		<span>浏览器 :  <?php echo $userAgent['browser']; ?> </span><br/>
		<span>版本 :  <?php echo $userAgent['version']; ?> </span><br/>
		</div>
		<div class="right"></div>
	</div>
-->


	<div class='well text-center h4'>欢迎回来主页</div>



	<!-- 最近热门书籍  -->
	<div class='panel panel-default text-center hot-book-box'>
		<div class='panel-heading'>
			<h3 class='panel-title'> 
				<span> 最近热门书籍 </span>	
			</h3>
		</div>
		<div class='panel-body'>
			<table class='table'>
					<tr>
						<th class='text-center'>图书名称</th>
						<th class='text-center'>借阅次数</th>
			
					</tr>
				<?php foreach( $hotBookData as $key => $value ){ ?>
					<tr>
						<td>《<?php echo $hotBookData[ $key ]['bookInfoBookName']; ?>》</td>
						<td>  <?php echo $hotBookData[ $key ]['count']; ?> </td>
					</tr>
				<?php } ?>
			</table>
		</div>	
	</div>

	
	<!-- 最近活跃读者  -->
	<div class='panel panel-default text-center hot-reader-box'>
		<div class='panel-heading'>
			<h3 class='panel-title'> 
				<span> 最近活跃读者 </span>	
			</h3>
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
