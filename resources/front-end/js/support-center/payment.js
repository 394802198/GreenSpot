(function($){

	var plan_price;
	var hardware_name = 'MX-30';
	var hardware_amount = 1;
	var hardware_price = 199.00;
	var shipping_cost = 10;
	
	if(plan_type=='premium') {
		plan_price = Number(299.00);
	} else if(plan_type=='basic') {
		plan_price = Number(0);
	}
	
	function orderTotal(){
		var total = plan_price + (hardware_amount*hardware_price) + shipping_cost;
		$('span[data-name="total_cost_span"]').text(Number(total).toFixed(2));
	}
	
	/**
	 * BEGIN Hardware Area
	 */
	$('select[data-name="hardware_name_selector"]').change(function(){
		hardware_name = $(this).val();
		hardware_price = Number($(this).find('option:selected').attr('data-price'));
		
		$('span[data-name="hardware_name_show"]').text(hardware_name);
		$('span[data-name="hardware_price_show"]').text(hardware_price.toFixed(2));
		orderTotal();
	});
	
	$('input[data-name="hardware_amount"]').blur(function(){
		if($(this).val() < 1 || !$.isNumeric($(this).val())){
			$(this).val(1);
			hardware_amount = 1;
		} else {
			hardware_amount = Number($(this).val());
		}
		$('span[data-name="hardware_amount_show"]').text(hardware_amount);
		orderTotal();
	});
	
	$('a[data-name="increase_hardware_amount"]').click(function(){
		var hardware_amount_temp = $('input[data-name="hardware_amount"]').val();
		hardware_amount_temp = Number(hardware_amount_temp)+1;
		$('input[data-name="hardware_amount"]').val(hardware_amount_temp);
		hardware_amount = hardware_amount_temp;
		$('span[data-name="hardware_amount_show"]').text(hardware_amount);
		orderTotal();
	});
	
	$('a[data-name="decrease_hardware_amount"]').click(function(){
		var hardware_amount_temp = $('input[data-name="hardware_amount"]').val();
		if(hardware_amount_temp > 1){
			hardware_amount_temp = Number(hardware_amount_temp)-1;
			$('input[data-name="hardware_amount"]').val(hardware_amount_temp);
			hardware_amount = hardware_amount_temp;
		}
		$('span[data-name="hardware_amount_show"]').text(hardware_amount);
		orderTotal();
	});
	/**
	 * END Hardware Area
	 */
	
	/**
	 * BEGIN Plan Type Area
	 */
	$('select[data-name="plan_type_selector"]').change(function(){
		if($(this).val()=='premium'){
			$('input[data-name="pay_yearly"]').val('Pay Yearly $299');
			$('div[data-name="premium_plan_detail_div"]').show('swing');
			$('div[data-name="basic_plan_detail_div"]').hide('swing');
//			$('div[data-name="premium_plan_detail_div"]').css('display','');
//			$('div[data-name="basic_plan_detail_div"]').css('display','none');
			plan_type = 'premium';
			plan_price = Number(299);
		} else {
			$('input[data-name="pay_yearly"]').val('Pay Yearly $0');
			$('div[data-name="basic_plan_detail_div"]').show('swing');
			$('div[data-name="premium_plan_detail_div"]').hide('swing');
			plan_type = 'basic';
			plan_price = Number(0);
		}
		orderTotal();
	});
	/**
	 * END Plan Type Area
	 */
	
	/**
	 * BEGIN Customer Detail Area
	 */
	$('select[data-name="business_type_selector"]').change(function(){
		if($(this).val()=='other'){
			$('div[data-name="business_type_div"]').show('swing');
		} else {
			$('div[data-name="business_type_div"]').hide('swing');
		}
	});
	/**
	 * END Customer Detail Area
	 */

	/**
	 * BEGIN Shipping Address Area
	 */
	$('input[name="shipping_address_radio"]').change(function(){
		if($(this).val()=='different'){
			$('div[data-name="different_shipping_address_div"]').show('swing');
		} else {
			$('div[data-name="different_shipping_address_div"]').hide('swing');
		}
	});
	/**
	 * END Shipping Address Area
	 */
	
	$('a[data-name="buy_now"]').click(function(){
		var data = {
			'plan_type':plan_type,
			'plan_price':plan_price,
			'hardware_name':hardware_name,
			'hardware_amount':hardware_amount,
			'hardware_price':hardware_price,
		};
		console.log(data);
	});
	
})(jQuery);