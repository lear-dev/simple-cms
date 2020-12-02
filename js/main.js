$(document).ready(function() {
	$('#nav li').hover(function() {
		$('ul', this).show();
	}, function() {
		$('ul', this).hide();
	});
	$('.subli').hover(function() {
		$(this).parent().siblings(".topa").css({"background-color": "#fff", "border-left": "1px solid #d5dce8", "border-right": "1px solid #d5dce8", "color": "#576482"});
	}, function() {
		$(this).parent().siblings(".topa").removeAttr('style');
	});
});