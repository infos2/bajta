//------------------------------------------------------------------------------------ globals
var h=$("body").css("height").replace(/[^-\d\.]/g, '');
var x=1;
$("#header") >$(" ul li").click(function(e) {
	x=$(this).index() + 1;
	$('body').animate({
	 scrollTop: $("#page"+x).offset().top
	 }, 800);
 });
 $(window).resize(function() {
	 if($(window).width()<599){
		 $("#header").append('<div id="menu-icon"></div>');
	 }else{
		$("#header").remove('#menu-icon');
	 }
	 n=$("body").css("height").replace(/[^-\d\.]/g, '');
	 if(n!=h){
		$('body').animate({scrollTop: $("#page"+x).offset().top	}, 0);
		 h=n;
	 }
});
//------------------------------------------------------------------------------------ Helper functions
$('#menu-icon').click(function(e){
	alert(1);
});

//------------------------------------------------------------------------------------ Database

//------------------------------------------------------------------------------------ Bindings

//------------------------------------------------------------------------------------ Starters
function bindingsInit(){
	return true;
}


//------------------------------------------------------------------------------------ document ready
$(document).ready(function(){
	bindingsInit();
});
