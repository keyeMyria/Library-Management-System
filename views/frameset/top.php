<?php

use app\assets\FramesetTopAsset;
use yii\helpers\Url;


FramesetTopAsset::register( $this );
?>
        <!--              
                HEAD
                        --> 
        <div id="head">
            <div class="left">
				<a href="#" class="button profile">
					<img src="../images/frameset/top/huser.png" alt="" />
				</a>
                Hi, 
				<a href="#">   <?php echo $model->managerUsername; ?>   </a>
                |
				<a href="<?= Url::toRoute(['index/logout'])  ?>"> 登出　</a>


            </div>
        </div>
