/*
 * 此方法用于 图书搜索页面 的 搜索结果中的 “编辑” 按钮进去 编辑页面后  三个 下拉框的默认选择。
 * 分别是 “图书类型” “书架” “出版社”
 */




function selectOption( name )
{

	nameVal = $('.' + name).find('select').attr('value');
	nameElm = $('.' + name);	
	nameElm.find('li').each(function(){
	
		if ( $(this).attr('data-raw-value') == nameVal) {
			text = $(this).text();	
			
			// 显示层 select 改变值
			trigger = nameElm.find('div[class=trigger]');
			trigger.text( text );
		}	
	});

	nameElm.find('option').each(function(){
		
		if ( $(this).val() == nameVal ){
			// 实际的 <option> 也要改变
			$(this).attr('selected', 'selected');			
		}
	});
	
}
