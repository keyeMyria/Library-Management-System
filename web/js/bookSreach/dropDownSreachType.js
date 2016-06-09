/*
 * dropDownSreachType.js 文件功能是
 *	在用户用了图书搜索功能后，页面先是会把匹配到 关键字的数据进行输出，
 *	此时，坐上方的 “搜索类型下拉框” 和 “搜索框” 依旧要保持用户搜索时的样子，不能恢复默认。
 *
 *	举个例子：用户选择了 “按书架” 搜索类型去搜索 “小说区” 然后点击了搜索按钮，之后
 *				页面显示出了数据，页面上方的 “搜索类型下拉框” 要自动选择 “按书架” 还有
 *				“ 搜索框” 也要自动填上用户之前输入的 “小说区”
 */


/*
 * 在 “ 搜索类型下拉框 ” 选定了搜索类型后，将此类型的文本（例如：按书架），放入到 
 * javascript 的 session 中，以便查询出数据后的页面刷新后 “ 搜索类型下拉框 ” 还能自动选择
 * 搜索类型。
 */
function recordSreachType()
{
	screenWidth = $(document).width();

	if( screenWidth > 1500 ){

		options = $('.lg-all .options li');
		//sessionStorage.sreachType = null; // 默认
		options.click(function(){
			sessionStorage.sreachType = $(this).text();	
		}); 
	} else {

		options = $('.md-all .options li');
		//sessionStorage.sreachType = null; // 默认
		options.click(function(){
			sessionStorage.sreachType = $(this).text();	
		}); 
		
	}

}


/**
 * 在点击 图书搜索 页面的搜索按钮时，把当时 " 搜索类型下拉框 " 的值放入 session
 */
function recordSreachTypeByClickSreachBtn()
{
	
	screenWidth = $(document).width();

	if( screenWidth > 1500 ){

		options   = $('.lg-all .options li');
		sreachBtn = $('.lg-all .sreach-btn');	

		sreachBtn.click(function(){
			options.each(function(){
				if ( $(this).attr('class') == 'selected' ){
					sessionStorage.sreachType = $(this).text();	
				}
			});
		});

	} else {
	
		options   = $('.md-all .options li');
		sreachBtn = $('.md-all .sreach-btn');	

		sreachBtn.click(function(){
			options.each(function(){
				if ( $(this).attr('class') == 'selected' ){
					sessionStorage.sreachType = $(this).text();	
				}
			});
		});
	}

}

/*
 * 根据 session 中的 sreachType 在 " 搜索类型下拉框 " 中选择相应的类型。
 * 因为我引用了一个外部的下拉框样式, 因此选中的时候有两层, 一层是真实的 <select><option>, 
 * 而另外一层则是使用 <ul><li> 和 jQuery 所模拟出来的下拉框样式
 * 因此，在下面的程序中选择下拉框样式，一要给真实层加上 class='select' (为了提交时能匹配搜索
 * 类型) , 二要给 <ul> 中相应的 <li> 模拟层加上 class='selected' ( 为了页面上能显示出来我们
 * 选中了哪个)
 */
function selectOptionBySession()
{

	var sreachType = sessionStorage.sreachType;

	// 模拟层的 options
	options = $('.options li');
	options.each(function(){
		
		var optionText = $(this).text();	
		if( sreachType == optionText ){
			
			$(this).addClass('selected');
			$('.trigger').text( sreachType );
			$('.trigger').addClass('selected');
		}
	
	});


	// 真实层的 optionList
	optionList = $('.basic-usage-demo option');	
	optionList.each(function(){
		
		var optionText =$(this).text();
		if( sreachType == optionText ){
			
			$(this).attr('selected', 'selected');
		}
	});

}






