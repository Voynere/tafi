$(document).ready(function(){
	$('.menu-row .mega-menu table td.wide_menu .customScrollbar').mCustomScrollbarDeferred({
		mouseWheel: {
			scrollAmount: 150,
			preventDefault: true
		}
	})
	$("[title='УЗИ']").closest('.dropdown-submenu').removeClass('dropdown-submenu')
	$("[title='УЗИ']").find('i').hide()


})