$(document).ready(function(){

	$('#sidemenu-toggle').click(function(){
		$('#sidemenu').toggle();
		$('#content').toggleClass('menupadding');
	});

	checkIfHideSidebar();
	$(window).resize(checkIfHideSidebar);

});

function checkIfHideSidebar(){
	if(window.innerWidth > 1280){
		$('#sidemenu').show();
		$('#content').addClass('menupadding');
	}else{
		$('#sidemenu').hide();
		$('#content').removeClass('menupadding');
	}
}