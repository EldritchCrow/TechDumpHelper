$(document).ready(function(){

	$('#sidemenu-toggle').click(function(){
		$('#sidemenu').toggle();
		$('#content').toggleClass('menupadding');
	});

});