<?php

use yii\helpers\Url;

?>

<frameset rows="40,100%" border="0" > 

	<!-- 
		这里的 <frame> 的 src 属性为什么引用的是路由 frameset/top , 
		这是因为被嵌入的页面要经过 asset::register（）资源包的渲染,
		如果直接调用 src="top.php" 的话，页面是不能加载 js css的	
	-->
	<frame src="<?= Url::to(['frameset/top']) ?>">

	<frameset cols="220,83%" >
	<frame src="<?= Url::to(['frameset/left']) ?>" scrolling="no"> 


		<frame src="<?= Url::to(['index/index']) ?>" name="right" >
	</frameset>

</frameset>

