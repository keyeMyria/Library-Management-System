<?php

use app\assets\IndexGlobalAsset;
use app\assets\UpdateGlobalAsset;
use app\assets\BookInfoStatAsset;

use yii\helpers\Html;

UpdateGlobalAsset::register( $this );
IndexGlobalAsset::register( $this );
BookInfoStatAsset::register( $this );


?>



<!-- 使用Bootstrap的栅格系统 -->
<div class='container'>
    <div class='row'>

        <!-- 大屏适配 -->
        <div class='col-lg-12 visible-lg-block'>                                                       

			<div class="lg-all all">
				<div class="bread-nav">
					<span>图书档案</span> >
					<span>图书信息统计</span>
				</div>

				<?= Html::hiddenInput('jsonData', $data , [ 'class' => 'jsonData' ] ) ?>	

				<div class='help-block'></div>
				<div id="container_lg" class='main-chart' style="min-width: 310px; height: 98%; max-width: 90%; margin: 0px 250px 0px 280px; "></div>	

			</div>

        </div>

        <!--中屏适配 -->
        <div class='col-md-12 visible-md-block'>

			<div class="md-all all">
				<div class="bread-nav">
					<span>图书档案</span> >
					<span>图书信息统计</span>
				</div>

				<?= Html::hiddenInput('jsonData', $data , [ 'class' => 'jsonData' ] ) ?>	

				<div class='help-block'></div>
				<div id="container_md" class='main-chart' style="min-width: 310px; height: 570px; max-width: 700px; margin: 0px 0px 0px 180px; "></div>	

			</div>

        </div>
    </div> <!-- class = row end -->
</div> <!-- class = container end -->




<script>
window.onload = function(){

	

	str  = $('.jsonData').val();
	json = eval("("+ str +")");
	pie();
	changePieBackground();	
	//charts( json );
}


function pie(){

$(function () {

    var colors = Highcharts.getOptions().colors,
        categories = ['MSIE', 'Firefox', 'Chrome', 'Safari', 'Opera'];

	var data = [{}],
        browserData = [],
        versionsData = [],
        i,
        j,
        dataLen = data.length,
        drillDataLen,
        brightness;





    // Build the data arrays
    for (i = 0; i < json.length; i += 1) {

        browserData.push({
            name: json[i].bookshelfName,
            y: json[i].bookshelfPercent,
            color: colors[i]
        });


        drillDataLen = json[i].subClass.length; 

        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            versionsData.push({
                name: json[i].subClass[j].bookTypeName,
                y: json[i].subClass[j].percent,
                color: Highcharts.Color(browserData[i].color).brighten(brightness).get()
            });
        }
    }



	if( $(document).width() > 1500 ){

		// 大屏
		container = '#container_lg';			
		size = '70%';

	} else {

		// 小屏	
		container = '#container_md';			
		size = '90%';

	}

	


    // Create the chart
    $(container).highcharts({
        chart: {
            type: 'pie'
        },
		className: 'main-chart',

        title: {
            text: '各书架分类与其子分类在图书馆书籍总数中的占比'
        },
        yAxis: {
            title: {
                text: 'Total percent market share'
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '47%']
            }
        },
        tooltip: {
            valueSuffix: '%'
        },
        series: [{
            name: '占比',
            data: browserData,
            size: size,
            dataLabels: {
                formatter: function () {
                    return this.y > 5 ? this.point.name : null;
                },
                color: 'white',
                distance: -110
            }
        }, {
            name: '子分类占比',
            data: versionsData,
            size: '90%',
            innerSize: '70%',
            dataLabels: {
                formatter: function () {
                    // display only if larger than 1
                    return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + '%'  : null;
                }
            }
        }]
    });
});

}   // function pie()



function changePieBackground()
{
	$('.highcharts-background').attr('fill', '#FFFFF0');
}


</script>
