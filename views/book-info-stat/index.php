<?php

use app\assets\BookInfoStatAsset;

use yii\helpers\Html;


BookInfoStatAsset::register( $this );

?>
<div class="all">
	<div class="bread-nav">
		<span>图书档案</span>
		<span>图书信息统计</span>
	</div>
	<?= Html::hiddenInput('jsonData', $data , [ 'class' => 'jsonData' ] ) ?>	


	<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto;"></div>	


</div>

<script>
window.onload = function(){
	str  = $('.jsonData').val();
	json = eval("("+ str +")");
	charts( json );
}

function charts( data ){

	options = {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Browser market shares at a specific website, 2014'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: []
        }]
    }


	// 将php传过来的 json 数据，循环放进 options 对象的 data 里
	for( var i=0; i < data.length; i++ ){
		options.series[0].data[i] = [ data[i].name , data[i].count ];	
	}


	$(function () {
		// 传入上面定义的对象数据 options
		$('#container').highcharts( options	);
	});



}


</script>
