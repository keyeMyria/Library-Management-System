<?php

use app\assets\FramesetTopAsset;


FramesetTopAsset::register( $this );
?>
        <!--              
                HEAD
                        --> 
        <div id="head">
            <div class="left">
                <a href="#" class="button profile"><img src="images/frameset/top/huser.png" alt="" /></a>
                Hi, 
				<a href="#">   <?php echo $model->managerUsername; ?>   </a>
                |
                <a href="index.php?r=index/logout"> 登出　</a>
            </div>
        </div>
