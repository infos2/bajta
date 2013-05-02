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
	 if($(window).width()<599 && !$("#menu-icon").is('*') ){
		 createMenuIcon()
	 }else if($("#menu-icon").is('*') && $(window).width()>599){
		var vmenu=document.getElementById('menu-icon');
		document.getElementById('header').removeChild(vmenu);
	 }
	 n=$("body").css("height").replace(/[^-\d\.]/g, '');
	 if(n!=h && $(window).width()>599){
		$('body').animate({scrollTop: $("#page"+x).offset().top	}, 0);
		 h=n;
	 }
});
//------------------------------------------------------------------------------------ Helper functions
function createMenuIcon(){
	vmenu=document.createElement('div');
	vmenu.id='menu-icon';
	vmenu.onclick=function(){alert(1)}
	$("#header").append(vmenu);
	return vmenu;
}

//------------------------------------------------------------------------------------ Database

//------------------------------------------------------------------------------------ Bindings

//------------------------------------------------------------------------------------ Starters
function bindingsInit(){
	return true;
}


//------------------------------------------------------------------------------------ document ready
$(document).ready(function(){
	bindingsInit();
	if($(window).width()<599 && !$("#menu-icon").is('*')){
		createMenuIcon();
	}
});
