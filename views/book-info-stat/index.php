<?php

use app\assets\BookInfoStatAsset;

use yii\helpers\Html;


BookInfoStatAsset::register( $this );

?>
<div class="all">
	<div class="bread-nav">
		<span>图书档案</span> >
		<span>图书信息统计</span>
	</div>

	<?= Html::hiddenInput('jsonData', $data , [ 'class' => 'jsonData' ] ) ?>	



	


	<div class='help-block'></div>
	<div id="container" class='main-chart' style="min-width: 310px; height: 580px; max-width: 700px; margin: 0 0 0 180px; "></div>	


</div>

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

    // Create the chart
    $('#container').highcharts({
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
            size: '90%',
            dataLabels: {
                formatter: function () {
                    return this.y > 5 ? this.point.name : null;
                },
                color: 'white',
                distance: -110
            }
        }, {
            name: 'Versions',
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
