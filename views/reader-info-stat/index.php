<?php

use app\assets\BookInfoStatAsset;

use yii\helpers\Html;


// 共用
BookInfoStatAsset::register( $this );

?>
<div class="all">
	<div class="bread-nav">
		<span>读者管理</span> >
		<span>读者信息统计</span>
	</div>

	<?= Html::hiddenInput('jsonData', $json , [ 'class' => 'jsonData' ] ) ?>	
	


	<div class='help-block'></div>
	<div id="container" class='main-chart' style="min-width: 310px; height: 520px; max-width: 700px; margin: 0 0 0 180px; "></div>	


</div>

<script>
window.onload = function(){
	str  = $('.jsonData').val();
	json = eval("("+ str +")");
	pie( json );	
	//charts( json );
}




function pie( json ){

	$(function () {

		// Radialize the colors
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
			return {
				radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
				stops: [
					[0, color],
					[1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
				]
			};
		});


		var options = {
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
							},
							connectorColor: 'silver'
						}
					}
				},
				series: [{
					type: 'pie',
					name: 'Browser share',
					data: [
						['Firefox',   45.0],
						['IE',       26.8],
						{
							name: 'Chrome',
							y: 12.8,
							sliced: true,
							selected: true
						},
						['Safari',    8.5],
						['Opera',     6.2],
						['Others',   0.7]
					]
				}]
		};

		//console.log( options.series[0] );
		for ( var i=0; i<json.length; i++ ){
			options.series[0].data[i] = [ json[i].readerTypeName, json[i].percent ];		
		}
		

		// Build the chart
		$('#container').highcharts( options );
	});

}

















function changePieBackground()
{

	$('.highcharts-background').attr('fill', '#FFFFF0');

}


</script>
