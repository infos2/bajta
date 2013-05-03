//------------------------------------------------------------------------------------ globals
var h=$("body").css("height").replace(/[^-\d\.]/g, '');
var x=1;
$("#header") >$(" ul li").click(function(e) {
	x=$(this).index() + 1;
	$('body').animate({
	 scrollTop: $("#page"+x).offset().top,
	 complete:menuToggle()
	 }, 800);
 });
 $(window).resize(function() {
	 if($(window).width()<603 && !$("#menu-icon").is('*') ){
		 createMenuIcon();
	 }else if($("#menu-icon").is('*') && $(window).width()>602){
		var vmenu=document.getElementById('menu-icon');
		document.getElementById('header').removeChild(vmenu);
		$("#header ul").css('overflow','visible');
	 }
	 n=$("body").css("height").replace(/[^-\d\.]/g, '');
	 if(n!=h && $(window).width()>602){
		$('body').animate({scrollTop: $("#page"+x).offset().top	}, 0);
		 h=n;
	 }
});
//------------------------------------------------------------------------------------ Helper functions
function createMenuIcon(){
	$("#header ul").css('overflow','hidden');
	vmenu=document.createElement('div');
	vmenu.id='menu-icon';
	vmenu.onclick=function(){menuToggle();}
	$("#header").append(vmenu);
	return vmenu;
}
function menuToggle(){
	if(!$("#menu-icon").is('*') || $(window).width()>602) return;
	if($("#header ul").css('overflow')=='hidden')$("#header ul").css('overflow','visible');
	else $("#header ul").css('overflow','hidden');
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
	if($(window).width()<603 && !$("#menu-icon").is('*')){
		createMenuIcon();
	}
});
