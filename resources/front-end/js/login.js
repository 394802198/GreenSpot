(function($){
	
	$('#forgot_password_link').click(function(){
		$('.containers').transition({ x: '-100%' },600,'ease');
	});
	
	$('#back_to_login_link').click(function(){
		$('.containers').transition({ x: '0%' },600,'ease');
	});
	
})(jQuery);