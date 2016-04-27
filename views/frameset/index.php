<frameset rows="6%,94%" border="0">

	<!-- 
		这里的 <frame> 的 src 属性为什么引用的是路由 frameset/top , 
		这是因为被嵌入的页面要经过 asset::register（）资源包的渲染,
		如果直接调用 src="top.php" 的话，页面是不能加载 js css的	
	-->
	<frame src="index.php?r=frameset/top">

	<frameset cols="18%,82%" >
		<frame src="index.php?r=frameset/left" scrolling="no"> 


		<frame src="index.php?r=index/index" name="right" >
	</frameset>

</frameset>


