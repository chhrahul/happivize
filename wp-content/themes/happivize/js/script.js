var selectedBox = null;

$(document).ready(function() {
    $(".onecheck").click(function() {
        selectedBox = this.id;

        $(".onecheck").each(function() {
            if ( this.id == selectedBox )
            {
                this.checked = true;
            }
            else
            {
                this.checked = false;
            };        
        });
    });    
});

$(document).ready(function(){

    $('.check_box_right input').click(function(){
       $('.muti_select_row').addClass('orange');
    });
    $('.check_box_left input').click(function(){
       $('.muti_select_row').addClass('white');
    });
     $('.check_box_center input').click(function(){
       $('.muti_select_row').removeClass('white');
    });
    $('.check_box_left input,.check_box_center input').click(function(){
       $('.muti_select_row').removeClass('orange');
    });
     $('#txtStep1').click(function(){
       $('.time_line_lavel').addClass('_W100_');
         $('.progress_bar').html('100%');
    });

   /* function ANS_VAL(){

			

                       var favorite = [];

			$.each($(".search_result_for .tag"), function(){ 

                            var check_val = $(this).children('.tag_txt').text()

				favorite.push(check_val);

			});

                        var search_value = favorite.join(",");

                    $(window).load(function(e){   

                        $('.search_block input[type="text"]').val(search_value)

                    });

	}

        ANS_VAL();*/

    

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

   /* if ($('.muti_select_row input[type="checkbox"]:checked').length > 0)

        {

            $('.time_line_lavel').addClass('_W100_');

            $('.progress_bar').html('100%');

        } */   

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

          /* if ($('.muti_select_row input[type="checkbox"]:checked').length > 0)

            {

                $('.time_line_lavel').addClass('_W100_');

                $('.progress_bar').html('100%');

            }*/

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

	

	$('.last_submit').click(function(e){

			e.preventDefault();

			if ($('.muti_select_row input[type="checkbox"]:checked').length > 0)

			{	

					$('#form_name').submit()

			}

			else{	

				$('.alert_message').show();

			}

	})

	$('.muti_select_row input[type="checkbox"]').click(function(e){

        if ($('.muti_select_row input[type="checkbox"]:checked').length > 0)

        {

			$('.alert_message').hide()

			

		}

	});


    $('.clear').click(function(e){

        $('.tag').remove();

		document.location.reload(true);

    })

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

        responsive_myaccount();

});

$('#user_login').attr('placeholder','Email');
$('#user_pass').attr('placeholder','Password');
$('#username').attr('placeholder','Username');
$('#first_name').attr('placeholder','First Name');
$('#last_name').attr('placeholder','Last Name');
$('#email').attr('placeholder','E-mail');
$('#website').attr('placeholder','Website');
$('#passw1').attr('placeholder','Password');
$('#passw2').attr('placeholder','Repeat Password');

/******************js for carol pages****************/
	/*$tab = 0
	$('.title_for_res').click(function(e) {
        if($tab == 0){
			$(this).children('b').html("&#9650;")
			$('.extra_weight .nav.nav-tabs').slideDown(300);$tab = 1
		}else{
			$(this).children('b').html("&#9660;")
			$('.extra_weight .nav.nav-tabs').slideUp(300);$tab = 0
			}
    });
	
	$(document).on("scroll", onScroll);
    $(window).scroll(function() {
		if ($(window).scrollTop() > $('.carol_speak').offset().top-100) {
			$(".nav-tabs").addClass("fixed");
		} else {
			$(".nav-tabs").removeClass("fixed");
		}
	});
    //smoothscroll
    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
       $(document).off("scroll");
        
        $('a').each(function () {
            $(this).removeClass('active');
        })
        $(this).addClass('active');
     
        var target = this.hash,
        menu = target;
        $target = $(target);
		/* if ($(window).scrollTop() > $('.carol_speak').offset().top-100) {
			$('html, body').stop().animate({'scrollTop': $target.offset().top-$('.feel_safe .nav').outerHeight()+10}, 500, 'swing',function(){window.location.hash = target-50;
				$(document).on("scroll", onScroll);
			});
		}
		else{
			$('html, body').stop().animate({'scrollTop': $target.offset().top-$('.feel_safe .nav').outerHeight()-75}, 500, 'swing',function(){window.location.hash = target-50;
				$(document).on("scroll", onScroll);
			});
			} */
			
	/*	function mob_adj(){
			if (window.innerWidth < 480) {
				if ($(window).scrollTop() > $('.carol_speak').offset().top-100) {
					$('html, body').stop().animate({'scrollTop': $target.offset().top-$('.feel_safe .nav').outerHeight()+10}, 500, 'swing',function(){window.location.hash = target-50;
						$(document).on("scroll", onScroll);
					});
				}
			else{
					$('html, body').stop().animate({'scrollTop': $target.offset().top-$('.feel_safe .nav').outerHeight()-140}, 500, 'swing',function(){window.location.hash = target-50;
						$(document).on("scroll", onScroll);
					});
				}
			}
		}
		
		mob_adj()
		
		$(window).resize(function(e) {
                if ($(window).scrollTop() > $('.carol_speak').offset().top-100) {
				$('html, body').stop().animate({'scrollTop': $target.offset().top-$('.feel_safe .nav').outerHeight()+10}, 500, 'swing',function(){window.location.hash = target-50;
					$(document).on("scroll", onScroll);
				});
			}
			else{
				$('html, body').stop().animate({'scrollTop': $target.offset().top-$('.feel_safe .nav').outerHeight()-75}, 500, 'swing',function(){window.location.hash = target-50;
					$(document).on("scroll", onScroll);
				});
				}
				mob_adj()
            });
    });


function onScroll(event){
    var scrollPos = $(document).scrollTop();
    $('.feel_safe a').each(function () {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
			if (window.innerWidth < 480) {
				var res_act_diff = refElement.position().top-160
			}
			else{
				var res_act_diff = refElement.position().top-80
				}
        if (res_act_diff <= scrollPos && refElement.position().top + refElement.height() > scrollPos+50) {
            $('.feel_safe ul li a').removeClass("active");
            currLink.addClass("active");
        }
    });
	
	
	
}*/
});

