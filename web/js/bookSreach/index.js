/*
 * 为了每次点击 “搜索” 按钮之后，显示的搜索结果的页数都是默认在第一页。
 * 在点击了“搜索” 按钮后，将表单隐藏域中的page 的值改为1，再让 php 提交.
 *
 */
function changePageVal()
{
	$('.sreach-btn').click(function(){
		$('input[name=page]').attr('value', 1);	
	})
}
