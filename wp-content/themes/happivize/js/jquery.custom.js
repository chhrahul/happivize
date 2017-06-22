
jQuery(document).ready(function( $ ) {

  	$(".add_subscription_scheme").click(function(){
  		
  		setTimeout(function(){ 
  			
  			//$(".subscription_schemes #_subscription_price_discount").css('border','1px solid red');
  			$('.subscription_schemes #_subscription_price_discount').focusout(function() {
		        var get_val = $(this).val();		       
		        if(!(get_val == "")){
		        	$('html,body').animate({
			        	scrollTop: $("#wpt_woo_private_session_sub").offset().top - $("#wpadminbar").height()},
			      	'slow');
		        }		        
		    });

  		}, 2500);
  	});
	
});
