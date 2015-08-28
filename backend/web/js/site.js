jQuery(function($) {
	//左侧主菜单控制
	$('.sidebar .treeview-menu li.treeview').each(function(i){
		if($(this).hasClass('active'))
			$(this).parent().parent().addClass('active');
    });
	
	
	
	
});