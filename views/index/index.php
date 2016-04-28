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

	<div class="upper">
		<div class="top">
			<!-- <h2>欢迎进入Git图书馆管理系统</h2>	-->
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

</div>
