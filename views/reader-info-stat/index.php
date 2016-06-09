<?php


use app\assets\IndexGlobalAsset;
use app\assets\UpdateGlobalAsset;
use app\assets\BookInfoStatAsset;

use yii\helpers\Html;


IndexGlobalAsset::register( $this );
UpdateGlobalAsset::register( $this );
// 共用
BookInfoStatAsset::register( $this );

?>






<!-- 使用Bootstrap的栅格系统 -->
<div class='container'>
    <div class='row'>

        <!-- 大屏适配 -->
        <div class='col-lg-12 visible-lg-block'>                                                       

			<div class="lg-all all">
				<div class="bread-nav">
					<span>读者管理</span> >
					<span>读者信息统计</span>
				</div>

				<?= Html::hiddenInput('jsonData', $json , [ 'class' => 'jsonData' ] ) ?>	
				


				<div class='help-block'></div>
				<div id="container_lg" class='main-chart' style="min-width: 310px; height: 100%; max-width: 78%; margin: 0 0 0 240px; "></div>	



			</div>
                
        </div>      
                    
        <!--中屏适配 -->
        <div class='col-md-12 visible-md-block'>
                
			<div class="md-all all">
				<div class="bread-nav">
					<span>读者管理</span> >
					<span>读者信息统计</span>
				</div>

				<?= Html::hiddenInput('jsonData', $json , [ 'class' => 'jsonData' ] ) ?>	
				


				<div class='help-block'></div>
				<div id="container_md" class='main-chart' style="min-width: 310px; height: 520px; max-width: 700px; margin: 0 0 0 220px; "></div>	


			</div>

                
        </div>  
    </div> <!-- class = row end -->
</div> <!-- class = container end -->









<script>
window.onload = function(){
	str  = $('.jsonData').val();
	json = eval("("+ str +")");
	pie( json );	
	changePieBackground();
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
					text: '读者职业分布'
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
					name: '占比',
					data: []
				}]
		};

		//console.log( options.series[0] );
		for ( var i=0; i<json.length; i++ ){
			options.series[0].data[i] = [ json[i].readerTypeName , json[i].percent ];		
		}
		


		if( $(document).width() > 1500 ){
			
			container = '#container_lg';	
		} else {
			container = '#container_md';	
		}



		// Build the chart
		$( container ).highcharts( options );
	});

}


function changePieBackground()
{
	$('.highcharts-background').attr('fill', '#FFFFF0');
}


</script>
