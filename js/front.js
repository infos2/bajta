//------------------------------------------------------------------------------------ globals
var h=$("body").css("height").replace(/[^-\d\.]/g, '');
var x=1;
$("#header") >$("#header ul li").click(function(e) {
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
function initialize() {
	var myLatlng = new google.maps.LatLng(44.8607040,13.83287860);
	var mapOptions = {
	  zoom: 12,
	  center: myLatlng,
	  panControl: false,
	  zoomControl: true,
	  mapTypeControl: false,
	  scaleControl: false,
	  streetViewControl: false,
	  overviewMapControl: false,
	  mapTypeId: google.maps.MapTypeId.ROADMAP,
	}
	var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

	var marker = new google.maps.Marker({
	    position: myLatlng,
	    title:"Bajta d.o.o.!"
	});

	// To add the marker to the map, call setMap();
	marker.setMap(map);			
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
	initialize();
	if($(window).width()<603 && !$("#menu-icon").is('*')){
		createMenuIcon();
	}
});
