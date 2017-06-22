$(document).ready(function(){
$m = 0
$('.menu_ico').click(function(e){
     if($m == 0){
	$('.nav.navbar-nav').stop().animate({'left':0},300);$m=1
     }
     else{
        $('.nav.navbar-nav').stop().animate({'left':'-100%'},300);$m=0
     }
})
			//$('#gallery').css({'width':$('#gallery img').width()+30,'height':$('#gallery img').height()+30})

                $(window).resize(function(e){
                	//$('#gallery').css({'width':$('#gallery img').width()+30,'height':$('#gallery img').height()+30})
                })
                 $(window).load(function(e){
                        $('.loader_overlay').hide(500)
                 	//$('#gallery').css({'width':$('#gallery img').width()+30,'height':$('#gallery img').height()+30})
                 })
                var cur = 0,    // Start Slide Index. We'll use ++cur to increment index
						pau = 1000, // Pause Time (ms)
						fad = 500,  // Fade Time (ms)
				    $ga = $('#gallery'),   // Cache Gallery Element
						$sl = $('> div img', $ga), // Cache Slides Elements
						tot = $sl.length,      // We'll use cur%tot to reset to first slide
						itv ;       // Used to clear on mouseenter

				$sl.hide().eq( cur ).show(); // Hide all Slides but desired one

				function stopFn() { clearInterval(itv); }
				function loopFn() { itv = setInterval(fadeFn, pau); }
				function fadeFn() { $sl.fadeOut(fad).eq(++cur%tot).stop().fadeIn(fad); }
				$ga.hover( stopFn, loopFn );

				loopFn(); // Finally, Start
                                
    if ($('.ans_list li input[type="checkbox"]:checked').length > 0)
        {
            $('.time_line_lavel').addClass('_W50_');
            $('.progress_bar').html('50%');
        }       
    if ($('.muti_select_row input[type="checkbox"]:checked').length > 0)
        {
            $('.time_line_lavel').addClass('_W100_');
            $('.progress_bar').html('100%');
        }    
    $('.ans_list li input[type="checkbox"]').click(function(e){
        if ($('.ans_list li input[type="checkbox"]:checked').length > 0)
        {
            $('.alert_message').hide();
            $('.time_line_lavel').addClass('_W50_');
            $('.progress_bar').html('50%');
        }
        else
        {
           $('.time_line_lavel').removeClass('_W50_');
           $('.progress_bar').html('0%');
           if ($('.muti_select_row input[type="checkbox"]:checked').length > 0)
            {
                $('.time_line_lavel').addClass('_W100_');
                $('.progress_bar').html('100%');
            }
        }
    }); 
    $('.muti_select_row input[type="checkbox"]').click(function(e){
        if ($('.muti_select_row input[type="checkbox"]:checked').length > 0)
        {
            $('.time_line_lavel').addClass('_W100_');
            $('.progress_bar').html('100%');
        }
        else
        {
           $('.time_line_lavel').removeClass('_W100_');
           $('.progress_bar').html('0%');
           if ($('.ans_list li input[type="checkbox"]:checked').length > 0)
            {
                $('.time_line_lavel').addClass('_W50_');
                $('.progress_bar').html('50%');
            }
        }
    }); 
    $('.next').click(function(e){
        e.preventDefault();
        if ($('.ans_list li input[type="checkbox"]:checked').length > 0)
        {
            $(this).parent('fieldset').slideUp();
            $('.second_que').slideDown();
        }
        else{
            $('.alert_message').show()
        }
    });
    
	function ANS_VAL(){
			var favorite = [];
			$.each($("form input[name='survey']:checked"), function(){ 
                            var check_val = $(this).val();
				favorite.push(check_val);
			});
                        
                        window.name = favorite.join("</div><div class='tag'>");
                        
                           /* var favourite = $("input[type='checkbox']:checked").map(function(i,chk){            
                                return chk.value;
                            }).get().join("</div><div class='tag'>");
                            $("#values").val(favourite);
                            window.name = $("#values").val(favourite);
                            alert(favourite)*/
	}
	
    $('.last_submit').click(function(e){
		e.preventDefault()
                    ANS_VAL()
	   if($('.muti_select_row input[type="checkbox"],.ans_list li input[type="checkbox"]').val() != ""){
		
	
		window.location=("http://webdemor.info/wp/happivize/search/")
		
		
			}
			
    })
	
    $('.tag .close').click(function(e){
        $(this).parent('.tag').hide();
    })
    $('.clear').click(function(e){
        $('.tag').hide();
    })
                         
function responsive_menu(){
	if(window.innerWidth < 768){
	$('.nav.navbar-nav').insertBefore('header');
	}
	else{
		$('.nav.navbar-nav').insertBefore('.header_btn');
	}
        
}
responsive_menu()

function responsive_myaccount(){
if(window.innerWidth <= 600){
            $('.my_account_menu').insertAfter('.search_sec')
        }
        else{
            $('.my_account_menu').insertBefore('.header_top .row')
        }
}    
        responsive_myaccount();
$(window).resize(function(e){
	responsive_menu();
        responsive_myaccount();
});

});
