<?php

use app\assets\IndexFrameLeftAsset;

IndexFrameLeftAsset::register( $this );

?>

        <!--            
                SIDEBAR
                         --> 
        <div id="sidebar">
            <ul>
                <li>
                    <a href="index.html">
                        <img src="images/index/left/home.png" alt="" />
                       主页 
                    </a>
                </li>

                <li class="current"><a href="#"><img src="images/index/left/settings.png" alt="" /> 参数设置</a>
                    <ul>
						 <li><a href="www.baidu.com">书架管理</a></li>
						 <li><a href="">读者类型管理</a></li>
						 <li><a href="">出版社管理</a></li>
						 <li><a href="">图书类型管理</a></li>
					</ul>
                </li>

                <li><a href="#"><img src="images/index/left/books.png" alt="" /> 图书档案</a>
                    <ul>
                        <li><a href="#">图书添加</a></li>
                        <li><a href="#">图书搜索</a></li>
                        <li><a href="#">图书信息统计</a></li>
                    </ul>
                </li>

                <li><a href="#"><img src="images/index/left/users.png" alt="" /> 读者管理</a>
                    <ul>
                        <li><a href="#">添加读者</a></li>
                        <li><a href="#">读者列表</a></li>
                        <li><a href="#">读者信息统计</a></li>
                    </ul>
                </li>

                <li class="nosubmenu"><a href="#"><img src="images/index/left/list.png" alt="" /> 图书借还</a></li>
                <li class="nosubmenu"><a href="#"><img src="images/index/left/search.png" alt="" /> 图书借阅查询</a></li>
            </ul>


        </div>
                
                
    </body>
</html>
