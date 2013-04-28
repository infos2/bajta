/**
 * Javascript - TABS
 */
$(function() {
	$("#tabs").tabs();
});

/**
 * Unloading a page
 */
var edited = 0;

$('input, textarea').bind('paste change input',function(){
	edited = 1;
	console.log('edited!');
})

window.onbeforeunload = function() {
	if(edited==1) return false;
}

