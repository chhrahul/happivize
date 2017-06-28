<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *

 * @package WordPress

 * @subpackage Twenty_Sixteen

 * @since Twenty Sixteen 1.0

 */
$useragent=$_SERVER['HTTP_USER_AGENT'];

/* Mobile Content Redirection */
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))

{ ?>
<script>

$(document).ready(function()
{
  if($("body").hasClass("home")){
    var offset = 55;
  }
  else{
    var offset = 5;
  }
  var addclass = $("body #wraper section .container").addClass("ScrollTothis");
      if(addclass){
        $("html, body").animate({ 
          scrollTop: $(".ScrollTothis").offset().top + offset
      }, 3000);
      }
});

</script>

 <?php
}
/* End of Mobile Content Redirection */

?>
 <footer class="original_footer">

	<div class="footer_top">

		<div class="container">


			<div class="row clearfix">

				<div class="col-sm-4">

					<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer1') ) : else : ?>

					<?php endif; 

					?>

				</div>

				<div class="col-sm-4">

					<div class="links_main">

					<h4 class="footer_title">Quick links</h4>

					<?php $args = array('menu' => 'primary' , 'menu_class'  => 'quick_links clearfix', 'container' =>'' );wp_nav_menu($args); ?>

					</div>

				</div>

				<div class="col-sm-4">

					<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('footer2') ) : else : ?>

					<?php endif; ?>

				</div>

		   </div>

		</div>

	</div>

	<div class="footer_bottom">

		<div class="copyright_txt">© 2016 happivize. All rights reserved.</div>

	</div>

</footer>

<footer class="new_footer">
  <div class="container">
        <div class="row clearfix">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-5">
            <p class="copyright_text">©2016–2017 Happivize. All rights reserved.</p>
            </div> 
            <div class="col-sm-5">
                <nav class="footer-navigation">
                    <ul id="nav-footer" class="inline-nav">
                        <li id="menu-item-416" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-416"><a href="<?php echo site_url().'/terms-and-conditions/' ?>">Terms &amp; Conditions</a></li>
                        <li id="menu-item-417" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-417"><a href="<?php echo site_url().'/privacy-policy/' ?>">Privacy Policy</a></li>
                        <li id="menu-item-418" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-418"><a href="<?php echo site_url().'/refund-policy/' ?>">Refund</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-sm-1">
            </div>
        </div>
    </div>
</footer>

      
	<div id="popup_container" class="modal-box-login" style="display: none">
	 <a class="js-modal-close1 close">×</a>
	  <header>    
	    <h3><?php echo "Cool, looks like you already have an account with us. Login in below and we'll fill in the details we have."; ?></h3>    
	  </header>
	  <div class="modal-body" style=" height:300px; overflow-x: hidden; overflow-y: hidden;">
	  <?php $id = 66; 
	    $post = get_post($id); 
	    $content1 = apply_filters('the_content', $post->post_content); ?>
	    <p><?php echo $content1; ?></p>
	  </div>
	  <!--footer> <a class="btn btn-small js-modal-close1" style="background-color: grey !important; color:#fff;">Close</a> </footer-->
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 

<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>	  

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.js"></script>


<?php wp_footer(); ?>


<script type="text/javascript">

$("document").ready(function(){
  if($("body").hasClass("single-product")){   
    if($(".abouts_tab_tab").length > 0){      
      speaker_bionametext = $(".speakers_biotext .speaker_bionametext").val();
      test_abotlnth = $(".Speakers_bio").length;
      if($(".Speakers_bio .speakers_biotext").length > 0){
        if(speaker_bionametext){
          $(".abouts_tab_tab a").text("About "+ speaker_bionametext);
        }         
      }
      else{
        $("li.abouts_tab_tab").css("display",'none');
      }
          
    }
    if($(".testimonials_tab_tab").length > 0){      
      testi_lngth = $(".testimonials_wrap").find('.testimonials_set').length;
      if(testi_lngth <1){
        $("li.testimonials_tab_tab").css("display",'none');
      }
    }
    
    if($(".contributions-container .commentlist li.review").length > 0){
      $(".testsss").unbind().each(function(){
        getvall = $(this).parent().parent().parent().siblings(".children").length;
        //alert(getvall);
        if(getvall >= 1){
          checkchildren = $(this).parent().parent().parent().siblings(".children").find("li.contribution_comment").length;
          $(this).html("");
          if(checkchildren == 1){
              $(this).html(""+checkchildren+" Comment")
          }
          else{
              $(this).html(""+checkchildren+" Comments")
          }          
          //alert(checkchildren);
        }
      });
    } 

  }
   
});


jQuery( document ).ready(function( $ ) {
  // Code that uses jQuery's $ can follow here.
   if($("body").hasClass("post-type-archive")){
      productss = jQuery('.woof_shortcode_output ul.products .product').length;
      //alert(lastval);
      if(productss){
        //alert("Yes");      
         var maxHeight = -1;
         productss = jQuery('.woof_shortcode_output ul.products .product').css("height","auto");
         productss = jQuery('.woof_shortcode_output ul.products .product .starwrappernew').css("position","relative");
         productss = jQuery('.woof_shortcode_output ul.products .product .button ').css("position","relative");
         productss = jQuery('.woof_shortcode_output ul.products .product .price ').css("position","relative");
          productss = jQuery('.woof_shortcode_output ul.products .product .price ').css("min-height","0px");

          $('.woof_shortcode_output ul.products .product').each(function() {
             maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
           });

          $('.woof_shortcode_output ul.products .product').each(function() {
          	 $.noConflict();
            $(this).height(maxHeight);
            productss = jQuery('.woof_shortcode_output ul.products .product .starwrappernew').css("position","absolute");
            productss = jQuery('.woof_shortcode_output ul.products .product .button ').css("position","absolute");
            productss = jQuery('.woof_shortcode_output ul.products .product .price ').css("position","absolute");
            productss = jQuery('.woof_shortcode_output ul.products .product .price ').css("min-height","56px");

          });
      } 
    }
});


$("#relpro").contents().appendTo('#pro_relpr'); 

$(".wc-product-reviews-pro-profile").contents().appendTo('#tearev');


  	jQuery("#menu-item-921 a").on("click", function(e){

        e.preventDefault();    

        window.open("https://localhost/happivize/my-ledger/", "_blank", "location=1,status=1,scrollbars=1,top=20,left=300,width=750,height=630");

  	});

   jQuery(document).ready(function(){

		var onloadoption = $("#posts_urlss option:first").val();

		var onloadvalueinput = $("#generated_url").val(onloadoption);

		jQuery( ".logpop" ).click(function() {

		jQuery("#mylogin").show();


		$( '<a class="forgot-password-lnk" href="https://happivize.com/forgot-password/">Lost your password?</a>' ).insertAfter( ".SUBSCRIBE .login-password" );

		});

		jQuery( ".close" ).click(function() {

			$( ".forgot-password-lnk" ).remove();

		});

		if($( "#login_form_main" ).hasClass( "login_mainform" )){

			$( '<a class="forgot-password-lnk" href="https://happivize.com/forgot-password/">Lost your password?</a>' ).insertAfter( ".login_mainform .login-remember" );

		}


    });


	function geturlvalue(){  


	  var option = $("#posts_urlss option:selected").val();

	  var valueinput = $("#generated_url").val(option);

	}

	$('iframe').load( function(){

 		$('iframe').contents().find('div#wpadminbar').hide();

	}); 

</script>



<?php if(is_page('724')){ ?>
  <script type="text/javascript">
      $("document").ready(function(){
        if($("#passw1").length > 0){          
         $("#passw1").attr("placeholder", "New Password");
        }
      }); 
  </script>
<?php } ?>




<?php
  global $post;
  $meta_post_tmpz = get_post_meta( $post->ID, 'Product-template' );
  $meta_post_tmpz_vl = $meta_post_tmpz[0];
  if(($meta_post_tmpz_vl == "Template2") || ($meta_post_tmpz_vl == "Template1")){
  ?>
      	<script type="text/javascript">
				$("document").ready(function(){
					  $(".specialoffer_description_tab").css("display","none");
				});
		</script>
  <?php
  }
?> 


<?php if(is_page('971') || is_page('1078') ){ ?>

	<script type="text/javascript">

		jQuery(document).ready(function() {

			jQuery("#datepicker").datepicker({

				showOn: "button",

				buttonImage: "https://happivize.com/wp-content/uploads/2017/01/calendaronly.gif",

				buttonImageOnly: true,

				dateFormat: 'dd-mm-yy'

			});


			jQuery("#datefield_until").datepicker({ 

				showOn: "button",

				buttonImage: "https://happivize.com/wp-content/uploads/2017/01/calendaronly.gif",

				buttonImageOnly: true,

				dateFormat: 'dd-mm-yy' 

			});

			jQuery("#datepicker2").datepicker({

				showOn: "button",

				buttonImage: "https://happivize.com/wp-content/uploads/2017/01/calendaronly.gif",

				buttonImageOnly: true,

				dateFormat: 'dd-mm-yy'

			});


			jQuery("#datefield_until2").datepicker({ 

				showOn: "button",

				buttonImage: "https://happivize.com/wp-content/uploads/2017/01/calendaronly.gif",

				buttonImageOnly: true,

				dateFormat: 'dd-mm-yy' 
			});

		});

	</script>

<?php } ?>



<?php 
/* Subscription price Radio buttons */
 global $product;
  $prdcttid = $product->id;
  if($prdcttid){
     $_product = wc_get_product($prdcttid);     
     $regular_price = $_product->get_regular_price();
     $sale_price = $_product->get_sale_price();
    
    if($sale_price){
        ?>
        <script type="text/javascript">
          $(document).ready(function(){
           $( ".subscription-option label" ).first().html('<input type="radio" name="convert_to_sub_<?php echo get_the_ID();?>" data-custom_data="[]" value="0" checked="checked" ><span class="price subscription-price"><del><span class="amount"><?php echo "$".$regular_price."";  ?></span></del><ins><span class="amount"><?php echo " $".$sale_price."";  ?></span></ins></span>');
         });
        </script>
        <?php 
    }
    else{ ?>
    <script type="text/javascript">
          $(document).ready(function(){
        $( ".subscription-option label" ).first().html('<input type="radio" name="convert_to_sub_<?php echo get_the_ID();?>" data-custom_data="[]" value="0" checked="checked" ><span class="price subscription-price"><?php echo "$".$regular_price.".00";  ?></span>');
      });
      </script>
    <?php
    }
  }
/* End of Subscription price Radio buttons */

?>




<script type="text/javascript">

$(document).ready(function(){


  var size_li = $(".testimonial_group").length;
    x=3;    
    if(size_li <= x){
      $('#loadmore').hide();
    }
    $('.testimonial_group:lt('+x+')').show();

    $('#loadmore').click(function () {
     	$('#loadmore').hide();
        x= (x+3 <= size_li) ? x+3: size_li;
        $('.testimonial_group:lt('+x+')').show(1000);
        if(size_li <= x){
        
    	}
    });


	$( ".offer-description_tab a" ).html('Description');

	$('#assoc_pro').change(function() {

		window.location = $(this).val();

	});
 
 	var ur = '<?php echo $_REQUEST["option"];?>';
    var t = 0;
	$('input:radio').each(function() {
		t++;
	 
	  
		if(t == ur)
		{
		    $(this).attr("checked", "checked"); 
		}
	  
	});



    $("#rew").click(function(){

        $(".form-review").show(1000);

         $("#question_form_wrapper").hide(1000);

        $( "#review_rating_field label" ).trigger( "click" );

          $("#review_form_wrapper").css("border-top", "1px solid #e3e3e3");

          $('#review_rating_field > label').text('Score :');

    });


     $("#askq").click(function(){

        $("#question_form_wrapper").show(1000);

        $(".form-review").hide(1000);

          $("#review_form_wrapper").css("border-top", "1px solid #e3e3e3");

    });


    var self = $("#reviews");

    if (self.find('.product-rating').length) {

        $("#review_rating_field").hide();

       // alert('this');

    }
    else {

       $("#review_rating_field").hide();   

    $('<div class="nre"><button type="button" id="nrew" class="btn btn-default"><i class="fa fa-edit"> &nbsp;</i>write a review</button><button id="naskq" type="button" class="btn btn-default"><i class="fa fa-comments">&nbsp;</i>ask a question</button></div>').insertBefore(".contribution-type-selector");

    }

});


$(document).on('click', '#nrew', function(){ 

       $(".form-review").show(1000);

         $("#question_form_wrapper").hide(1000);

        $( "#review_rating_field label" ).trigger( "click" );

        $("#review_form_wrapper").css("border-top", "1px solid #e3e3e3");

});


$(document).on('click', '#naskq', function(){ 

        $("#question_form_wrapper").show(1000);

        $(".form-review").hide(1000);

          $("#review_form_wrapper").css("border-top", "1px solid #e3e3e3");

});




$(document).on('click', '#bilchk', function(){ 

	$("#order_review").hide(1000);

	$(".scannerdata").hide(1000);

	$(".checkbox-custom").show(1000);

	$(".woocommerce-billing-fields").show(1000);

	$(".woocommerce-error").hide(1000);

	$('#ki').show();


});



$(document).on('click', '#pin', function(){ 

	$("#order_review").hide(1000);

	$(".scannerdata").hide(1000);

	$(".checkbox-custom").show(1000);

	$(".woocommerce-billing-fields").show(1000);

	$("#billing_postcode_field #billing_postcode").css('border','1px solid red');

	$(".woocommerce-error").hide(1000);

	$('#ki').show();


});



  $(document).on('click', '#ki', function(){ 


		$('#rod').hide();


         var fn = $("#billing_first_name").val();

         var ln = $("#billing_last_name").val();

         var cm = $("#billing_company").val();

         var em = $("#billing_email").val();

         var ph = $("#billing_phone").val();

         var cnt = $("#select2-chosen-1").text();  

         var ad = $("#billing_address_1").val();

         var ad1 = $("#billing_address_2").val();  

         var ct = $("#billing_city").val();

         //var st = $("#select2-chosen-259").text();        

         var st = $('#s2id_billing_state').find('.select2-choice').text();

           //alert(st);
           var substfdfdring = 'State *';
           // if(st == 'State *')

           if(st == '')
           {
              st = $('#billing_state').val();

           }
           

         var pt = $("#billing_postcode").val();



         var ckha = $("#chkboxvalreq").is(':checked');

	  if($('.scannerdata').css('display') == 'none')
	  {
	     if(((cnt == 'United States (US)') || (cnt == 'Canada') || (cnt == 'Australia')) && (st.indexOf(substfdfdring) !== -1)){
	       $(".scannerdata").css("display", "none !important");
	     }
	     else{
	       $(".scannerdata").toggle();
	     }

	  }

    if(ckha==false)
    {
      alert('Please accept the terms and conditions');


        $("#chkboxvalreq").css("border", "1px solid red");

     return;

    }

  if((fn.length < 1 || ln.length < 1 || em.length < 1  || ph.length < 1 || cnt.length < 1 || ad.length < 1 ||  ct.length < 1 || pt.length < 1) || (((cnt == 'United States (US)') || (cnt == 'Canada') || (cnt == 'Australia')) && (st.indexOf(substfdfdring) !== -1)) ){

       if(((cnt == 'United States (US)') || (cnt == 'Canada') || (cnt == 'Australia')) && (st.indexOf(substfdfdring) !== -1)){
          alert("State is a required field");
          $("#s2id_billing_state .select2-choice").css('border','1px solid red');
          $(".scannerdata").css("display", "none !important");
       }
       else{
        $("#s2id_billing_state .select2-choice").css('display','none');
        $("#s2id_billing_state .select2-choice").html("");
          $(".scannerdata").css("display", "block !important");
       }

        

          if(em.length < 1){

             $("#billing_email").css("border", "1px solid red"); 


          }else if(em.length > 1){

        $("#billing_first_name").css("border", "none !important");

            //  $(".checkout.woocommerce-checkout #billing_email").css("border", "1px solid red");

          }

          if(ln.length < 1){

             $("#billing_last_name").css("border", "1px solid red");

          }
          else{

              $("#billing_last_name").css("border", "none !important");

          }

          if(em.length < 1){

          $("#billing_email").css("border", "1px solid red");

          }

          else{

              $("#billing_email").css("border", "0px solid green !important");

          }

          if(ph.length < 1){

             $("#billing_phone").css("border", "1px solid red");

          }

          else{

              $("#billing_phone").css("border", "none !important");

          }

          if(fn.length < 1){

             $("#billing_first_name").css("border", "1px solid red");

          }

          else{

              $("#billing_first_name").css("border", "none !important");

          }

          if(ad.length < 1){

             $("#billing_address_1").css("border", "1px solid red");

          }

          else{

            $("#billing_address_1").css("border", "none");

          }


         if(ct.length < 1){

             $("#billing_city").css("border", "1px solid red");
          }
          else{

              $("#billing_city").css("border", "none");

          }

          if(pt.length < 1){

             $("#billing_postcode").css("border", "1px solid red");

          }else{

              $("#billing_postcode").css("border", "none");

          }

          if(pt.length < 1){

             $("#billing_postcode").css("border", "1px solid red");

          }else{

              $("#billing_postcode").css("border", "none");

          }

         }else{

        jQuery(".scannerdata").html('<h3>Billing Details</h3><span id="bilchk" ><button type="button" style="padding: 6px 12px!important;" id="nrew" class="btn btn-default"><i class="fa fa-edit"> &nbsp;</i>Billing Address</button></span><p>'+fn+' '+ln+'</p><p>'+cm+'</p><p>'+em+'</p><p>'+ph+'</p><p>'+cnt+'</p><p>'+ad+'</p><p>'+ad1+'</p><p>'+ct+'</p><p>'+st+'</p><p>'+pt+'</p>');



         $(".woocommerce-billing-fields").hide("slow");

         $("#order_review").show("slow");

         $("#ki").hide("slow"); 

         $('.form-row terms').css("display", "none");

         $('.checkbox-custom').hide();

         

           	jQuery(".main-list1").show();

	        if(((cnt == 'United States (US)') || (cnt == 'Canada') || (cnt == 'Australia')) && (st.indexOf(substfdfdring) !== -1)){          
	        	$(".scannerdata").css("display", "none !important");
	        }
	        else{
	            $(".scannerdata").css("display", "block !important");
	        }

          //$(".scannerdata").css("display", "block !important");

          }
    }); 


</script> 



<?php $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  ?>

<?php if(is_page('6')) { 
    $loginerror2 =  $_REQUEST['loginerror'];

    $coponcode = $_REQUEST['remove_coupon'];
    if($loginerror2)
    {
      if (!(is_user_logged_in()) ) {
        ?>
          <script type="text/javascript">
            $('body').css('overflow-x','hidden');
            $('.modal-box-login').show();            
            if($(".wppb-error").length > 0) {                           
               
            }
            var valemail = $("#email_popval").val();
            $("#user_login").val(valemail);
            $(".js-modal-close1").click(function(){
                 // hide Modal
                 $('.modal-box-login').hide();
            });
        </script>
        <?php
      }
    }

    if($coponcode){ ?>
         <script type="text/javascript">
          $(".woocommerce-error").hide();
          $('<div class="woocommerce-message">Coupon has been removed.</div>').prependTo( ".checkout.woocommerce-checkout" );
          $(".woocommerce-error").show(100);
        </script>
    <?php
    }   

  ?> 
    

  <script type="text/javascript">   


  <?php if(! is_user_logged_in()) { ?>

    jQuery("#billing_email").blur(function() {

      var fdata = jQuery('#billing_email').val();

        jQuery.ajax({     
          type: "POST",

          dataType: "html",

          url: "https://happivize.com/mail_chk.php",

          data: {'daaa': fdata} ,              

          success: function(response) {

              var data = $.parseJSON(response);

              if(data.res == "yes"){

                $('#rod').remove();                    

                jQuery('<div id="rod"><p id="merr">An account is already registered with your email address.<a id="popup_logincheckout" href="javascript:void(0)"> Please login.</a><input type="hidden" id="email_popval" value="'+data.mail+'"></input></p></div>').insertBefore(".woocommerce");                  

             
                if($("#rod").length > 0) {                           
                    $('html,body').animate({
                        scrollTop: $("#rod").offset().top},
                    'normal');
                }

                $('.modal-box-login').show();
                var valemail = $("#email_popval").val();
                $("#user_login").val(valemail);

                if($(".wppb-error").length > 0) {                           
                 $(this).hide();
                }

              $( ".forgot-password-lnk" ).remove();

              $( '<a class="forgot-password-lnk" href="https://happivize.com/forgot-password/">Lost your password?</a>' ).insertAfter( ".login_mainform .login-remember" );


              $("#popup_logincheckout").click(function(){
                $('.modal-box-login').show();
                var valemail = $("#email_popval").val();
                $("#user_login").val(valemail);

                if($(".wppb-error").length > 0) {                           
                 $(this).hide();
                }

                $( ".forgot-password-lnk" ).remove();

                $( '<a class="forgot-password-lnk" href="https://happivize.com/forgot-password/">Lost your password?</a>' ).insertAfter( ".login_mainform .login-remember" );
              });

              $(".js-modal-close1").click(function(){
              // hide Modal
                $('.modal-box-login').hide();
              });



            }
            else
            {
               jQuery('#rod').hide(); 
            }

          }

       });

    });

  <?php } ?>


   $(document).ready(function(){ 

    $('#createaccount').prop('checked', true);


    $('p.form-row.form-row-wide.create-account').css("display","none");


    $( "<a href='https://happivize.com/'><img style='margin-bottom:5%;' src='https://happivize.com/wp-content/themes/happivize/images/happivize-logo.png'></a><p style='margin-left:0%; margin-bottom:5%;'> <a style ='color:#000;' href='https://happivize.com/cart'>Cart </a> > <span style='color:#4d4d4d;'> Customer information </span> ><span style='color:grey;'> Payment method </span> </p>" ).insertBefore( ".woocommerce-billing-fields" );


    $( "<h3>Customer information</h3>" ).insertBefore( "#billing_email_field" );


    $( "<p id='bllog'>Already have an account ? <a target='_blank' href='https://happivize.com/login/?a_redirect_to=https://happivize.com/checkout/'>Log in</a></p>" ).insertAfter( "#billing_email_field" );

    $( "<h3 id='bda'>Billing Details</h3>" ).insertBefore( "#billing_first_name_field" );


    $(".clear").remove().prev("#billing_phone_field");

  });

  </script>  

  <?php if ( is_user_logged_in() ) { ?>

      <style type="text/css">

        #bllog{display: none !important; }

        #billing_email,#billing_phone{margin-bottom: 5%;}

      </style>

  <?php } ?>



    <style type="text/css">

    #merr {padding: 1em 2em 1em 3.5em !important;

    margin: 0 0 2em !important;

    position: relative;

    background-color: #f7f6f7;

    color: #515151;

    border-top: 3px solid #b81c23;

    list-style: none !important;

    width: auto;

    word-wrap: break-word;}



    #merr:before {

        content: "\e016";

        color: #b81c23;

        /* content: "\e028"; */

        display: inline-block;

        position: absolute;

        left: 1.5em;

        top: 1em;

        font-family: WooCommerce;

    }

    input::-webkit-input-placeholder {

        font-size: 12px !important;

        color:#a1a1a3 !important;


       }


   .woocommerce-billing-fields{margin-bottom: 5%;}

    .woocommerce form .form-row{margin-bottom: 0 !important;} 

    .woocommerce form .form-row-first, .woocommerce form .form-row-last, .woocommerce-page form .form-row-first, .woocommerce-page form .form-row-last{margin:0 !important;}

    .main-list{display: block !important;}

    .wc_payment_method.payment_method_paypal label > img, .about_paypal{display: none;}

     #order_review{display: none;}


    .container{width: 1070px !important;}

    #ki{display: block;}  

    .woocommerce .col2-set .col-1, .woocommerce-page .col2-set .col-1{width: 53% !important;}

    .woocommerce .col2-set .col-2, .woocommerce-page .col2-set .col-2{width: 37% !important;}

    /*#bd{display: block !important;} */


    .cart-subtotal td, td.product-total, .order-total td, .tax-rate td, .cart-discount td {

        text-align: right !important;

    }
    .cart-discount td {
        border-top: 1px solid rgba(0, 0, 0, .1) !important;
    }

       .order-total span.amount{font-size: 22px; margin-left: 5px;}


    .woocommerce-info:first-child {

      display: none;

    }

    .entry-header h1{

      display: none;

    }

    #billiadd2 > h3 {

      text-align: center;


    }

    div#customer_details {

        margin-top: 3%;

    }

    div#billiadd2 {

        height: 500px;

        background: whitesmoke;

        margin-top: 4%;

    }

      .onsale1 {

      background-color: #E0EDFA !important;

      border-radius: 50%;

      font-size: 10px;

      left: 59px;

      padding: 2px;

      position: absolute;

      top: 1px;

    }

    .cart_item > td {

      position: relative;

    }

    #billiadd2 > h3 {

     padding-bottom: 59px !important;

    }

    .main-list .menuslist li {

     padding: 7px 97px 6px 8px !important;

    }

    table {

      background-color: whitesmoke;
      margin: 0 auto;

      padding-bottom: 20px;
      padding-left: 9px;
      width: 90% !important;
    }

    .main-list .menuslist .border-row {

      width: 99.6% !important;

    }

    .cart_item td img {

      width: 66px !important;

    }

    p {

     margin: 0 -8px;

    }


    .cart_item > td {

      width: 4%;

    }

    .main_header, footer{display: none;}


     .modal-box-login {
        position: fixed;
        z-index: 1000;
        width: 49%;
        top: 20%;
        left: 26%;
        /* margin-left: 15% !important; */
        background: white;
        border-bottom: 1px solid #aaa;
        border-radius: 4px;
        box-shadow: 0 3px 0px 10000px rgba(80, 80, 80, 0.5);
        border: 1px solid rgba(0, 0, 0, 0.1);
        background-clip: padding-box;
        padding: 5px 15px;
    }
    .modal-box-login h3 {
        line-height: 31px;
        margin-top: 3%;
        font-family: "Trebuchet MS", Helvetica, sans-serif !important;
        font-size: 28px !important;
        line-height: 30px !important;
        font-weight: 700 !important;
        color: #FA6B25 !important;
        display: block !important;
        text-align: center !important;
        box-sizing: border-box !important;
        -moz-box-sizing: border-box !important;
        cursor: pointer !important;
        margin-bottom: 0px;
    }
    .modal-box-login div#login_form_main {
        width: 47%;
        margin: 0 auto;
    }
    #loginform p.login-password {
        margin-bottom: 0px;
        padding-bottom: 0px;
    }
    #loginform p.login-remember {
        display: none;
    }
    .modal-box-login .js-modal-close1 {
        position: relative;
        top: -15px;
        color: #fff !important;
        opacity: 1;
        right: -23px;
        background: #000;
        border: 2px solid #fff;
        border-radius: 50%;
        width: 27px;
        text-align: center;
        line-height: -1;
        padding: 0px 1px;
        height: 27px;
    }


    </style>

<?php 
  
} 
  else{

  ?>

  <style type="text/css">


  #billiadd2{

    display: none !important;


   }


   #account_password_field{display: block; }

   .create-account > p {


      display: none;

    }


    #billiadd {

        width: 100% !important;

    }

  </style>

<?php } ?>




<?php if(is_page('5')) { ?>


  <style type="text/css">


    input.button {   background-color: #a2a2a2 !important; }

    .main-list{display: block !important;}

    input::-webkit-input-placeholder {

      font-size: 16px;
      line-height: 3;

    }

    #menu-cart_menu li a{border-right:none !important;}

  </style>

<?php } ?>



<?php if(is_page('2412') ) { ?>



  <style type="text/css">

    .page-template-speaker-page-recorded .join_sec{ display: none !important; }

    .main_header, .footer_top, .footer_bottom{ display: block; !important; }

    #logo_header_content {

         display: none; 

        text-align: center;

    }

    .page-template-speaker-page-recorded .it-box:before{

        padding-top:0 !important;

    }

  </style>

  <?php 
  
  }

  elseif(is_page('2478')){

    ?>

    <style type="text/css">

     .page-template-speaker-page-recorded .join_sec{ display: none !important; }

      .main_header, .footer_top, .footer_bottom{ display: block; !important; }

      #logo_header_content {

           display: none; 

          text-align: center;

      }

      /*footer{border:none;}*/

      .it-box:before{

        padding-top:0 !important;

      }



    </style>

    <?php

  }

  else{

  ?>

  <style type="text/css">

    .main_header{

        display: block;

    }

    #logo_header_content{

        display: none;

        text-align: center;

            overflow: hidden;

    }

    .page-id-6  #logo_header_content{

        display: none;

    }

    .error404 header.main_header {

        display: none;

    }

    .error404 #logo_header_content {

        display: block;

        text-align: center;

    }

  </style>


  <?php
  } 


  if(is_page('7')){ ?>

     <style type="text/css">
       .woocommerce form .form-row label{
        display: block !important;
     }
     </style>
    <?php 
  }

  if($_REQUEST['a_redirect_to']=="https://happivize.com/checkout/" || $_REQUEST['a_redirect_to']=="https://happivize.com/checkout")
  {
    if ( is_user_logged_in() ) {
      header('Location: https://happivize.com/checkout/');
    }
  }

  ?>


  <!-- begin olark code -->
    <script type="text/javascript" async>
    ;(function(o,l,a,r,k,y){if(o.olark)return;
    r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0];
    y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r);
    y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)};
    y.extend=function(i,j){y("extend",i,j)};
    y.identify=function(i){y("identify",k.i=i)};
    y.configure=function(i,j){y("configure",i,j);k.c[i]=j};
    k=y._={s:[],t:[+new Date],c:{},l:a};
    })(window,document,"static.olark.com/jsclient/loader.js");
    /* Add configuration calls bellow this comment */
    olark.identify('5407-639-10-6225');
    </script>
  <!-- end olark code -->
</body>


</html>

<style type="text/css">
  .cart_item .product-quantity {
       float: none; 
       padding: 0px 15px !important; 
      width: 50px;
  }
  .woof_shortcode_output ul.products .product h3 {
      padding: 0 4px !important;
  }
  .moonray-form-p2c11452f204  .moonray-form{
    width: 100%;
  }
  .moonray-form-p2c11452f204 .moonray-form-element-wrapper {   
      padding-bottom: 2px !important;
  }
  .moonray-form .moonray-form-input-type-image .moonray-form-input {
         margin-top: 0px;
  }
  div#mr-field-element-496556276222 p {
      margin-bottom: 0px;
  }
  .moonray-form .moonray-form-input {
      border: 0px !important;
      background: #fff0c3 !important;
      border-radius: 0px !important;
      margin-top: 10px;
      padding: 15px 10px !important;
      font-weight: 600 !important;
      font-family: inherit !important;
  }
  .moonray-form .moonray-form-input:focus {
      background-color: #fdfaef !important;
      outline: none !important;
  }
  footer.original_footer{

      display: block;

  }

  footer.new_footer {

      display: none;

  }

  .home footer.original_footer {

      display: none;

  }

  .home footer.new_footer {

      display: block;

  }

  /*.home footer {

      background-color: #f7f7f7;

      border-top: 3px solid #ff3366;

      clear: both;

  }*/

  .page-template-speaker-page-recorded .join_sec, .page-template-home2 .join_sec{ display: none !important; }

  .woocommerce-checkout footer.original_footer, .woocommerce-checkout footer.new_footer,.woocommerce-checkout .main_header{

  display: none;

  }

  .page-id-3472 header.main_header {

      display: none;

  }
  .page-id-3472 #logo_header_content {

      display: block !important;

  }

  .load_div_more {

      width: 15%;

      text-align: center;

      margin: 0 auto;

      overflow: hidden;

  }

  .page-template-speaker-page-recorded .it-box:before{



        padding-top:0 !important;



        }

  .load_div_more #loadmore {

      font-size: 19px;

      color: #fff;

      padding: 8px 30px!important;

      background-color: #f36;

      border-radius: 22px;

      cursor: pointer;

      font-weight: 60;

  }

  .page-id-3472 footer .container {

      padding-right: 15px;

      padding-left: 15px;

      margin-right: auto;

      margin-left: auto;

      width: 1170px;

      float: none;

      font-family: lato;

  }

  .page-id-3472 header .container {

      padding-right: 15px;

      padding-left: 15px;

      margin-right: auto;

      margin-left: auto;

      width: 1170px;

      float: none;

      font-family: lato;

  }

  .page-id-3472 .header_top ul {

      margin: 5px 0px 0;

  }

  .page-id-3472 .header_top ul li, .page-id-3472 .header_bottom ul li{

      margin-bottom: 0px;

  }
    
  /* Filters */
  .hfeed .woof_sid_auto_shortcode{
      background: #fff !important;
      border: 0px solid !important;    
  }
  .hfeed .woof_sid_auto_shortcode .woof_list_checkbox .woof_checkbox_term {
      display: none;
  }
  .hfeed .woof_sid_auto_shortcode .woof_list_radio .woof_radio_term {
      display: none;
  }
  .hfeed .woof_sid_auto_shortcode ul.woof_list.woof_list_radio,.hfeed .woof_sid_auto_shortcode ul.woof_list.woof_list_checkbox {
      padding-left: 15px;
  }
  .woof_sid_auto_shortcode .woof_container_radio .woof_block_html_items, .woof_sid_auto_shortcode .woof_container_checkbox .woof_block_html_items, .woof_sid_auto_shortcode .woof_container_label .woof_block_html_items {
      min-height: auto;
  }

  .woof_block_html_items.woof_price_filter_txt_container p {
      margin: 0px;
      padding: 0.25rem 0 0.30rem !important;
  }
  .woof_block_html_items.woof_price_filter_txt_container p a, .woof_by_rating_dropdown .refinementLink{
      color: #0a4988;
  }
  .woof_block_html_items.woof_price_filter_txt_container p a:hover ,.woof_by_rating_dropdown .refinementLink:hover{
      color: #FF3366;
  }
  .woof_container .woof_container_inner h4 a.woof_front_toggle {
      margin-top: -3px;
  }
  .hfeed .woof_sid_auto_shortcode ul.woof_list.woof_list_radio, .hfeed .woof_sid_auto_shortcode ul.woof_list.woof_list_checkbox{
      padding-left: 0px !important;
  }
  .hfeed .woof  .woof_container_inner .woof_block_html_items{
        padding: 0px;
  }
  .hfeed .woof.woof_sid_auto_shortcode .woof_container {
      margin: 3% 0px 4%;
  }
  .hfeed .woof_sid_auto_shortcode .woof_author_search_container .woof_container_inner, .hfeed .woof_sid_auto_shortcode .woof_by_rating_container .woof_container_inner{
      padding-top: 0px;
  }
  ul.woof_by_rating_dropdown.woof_select{
    padding-left: 0px !important;
  }

  .woof_list li label:hover {
      color: #FF3366;
  }
  .woof_list li label {
      color: #0a4988;
      font-size: 1.08em;
      margin: 0px !important;
      padding: 0% 0% !important;
      font-weight: 400;
      text-transform: capitalize;
  }
  .woof_list li label span {
      color: #999999;
      font-size: 11px;
  }
  .hfeed .woof_list li {
      margin: 0 0px 0 0px !important;
      padding: 0.25rem 0 0.30rem !important;
  }
  .woof_container .woof_container_inner h4 {
      padding: 0px;
      text-align: left;
      background: #fff;
      text-transform: uppercase;
      font-weight: bold;
      color: #575657;
      font-size: 17px !important;
  }
  .woof_sid_auto_shortcode .woof_container_radio .woof_block_html_items, .woof_sid_auto_shortcode .woof_container_checkbox .woof_block_html_items, .woof_sid_auto_shortcode .woof_container_label .woof_block_html_items {
      min-height: auto;
  }
  .woof_block_html_items.woof_price_filter_txt_container p {
      margin: 0px;
      padding: 0.25rem 0 0.30rem !important;
  }
  .woof_block_html_items.woof_price_filter_txt_container p a, .woof_by_rating_dropdown .refinementLink{
      color: #0a4988;
  }
  .woof_block_html_items.woof_price_filter_txt_container p a:hover ,.woof_by_rating_dropdown .refinementLink:hover{
      color: #FF3366;
  }
  .woof_container .woof_container_inner h4 a.woof_front_toggle {
      margin-top: -3px;
  }
  .hfeed .woof_sid_auto_shortcode ul.woof_list.woof_list_radio, .hfeed .woof_sid_auto_shortcode ul.woof_list.woof_list_checkbox{
      padding-left: 0px !important;
  }
  .hfeed .woof  .woof_container_inner .woof_block_html_items{
        padding: 0px;
  }
  .hfeed .woof.woof_sid_auto_shortcode .woof_container {
      margin: 3% 0px 4%;
  }
  .hfeed .woof_sid_auto_shortcode .woof_author_search_container .woof_container_inner, .hfeed .woof_sid_auto_shortcode .woof_by_rating_container .woof_container_inner{
      padding-top: 0px;
  }
  ul.woof_by_rating_dropdown.woof_select{
    padding-left: 0px !important;
  }

  /* btn colors*/
  .hfeed  a.button.product_type_simple.ajax_add_to_cart.add_to_cart_button  {
      background-color: #ff3366;
  }
  .hfeed  a.button.product_type_simple.ajax_add_to_cart.product_type_subscription {
      background-color: #ff3366;
  } 
  .hfeed  a.button.product_type_simple.ajax_add_to_cart {
      background-color: #D3D3D3;;
  }
  .email_us#email_tphEd a {
      font-size: 15px;
  }
  .email_us#email_tphEd label {
      font-size: 15px;
  }
  /* Price text */
  .hfeed .starwrappernew {   
      bottom: 17%;
  }
  .post-type-archive-product ul.products li.type-product.sale .price del {
      float: left;
      text-align: right;
      width: 50%;
  }
  .post-type-archive-product ul.products li.type-product.sale .price ins {
      float: left;
      text-align: left;
      padding-left: 4%;
  }
  .group-blog .description_set,.group-blog .description_custom {
      margin-bottom: 3%;
  }
  .group-blog form.cart .price {
      margin-bottom: 2%;
  }
  .hfeed.post-type-archive-product .woocommerce ul.products li.product.sale small {
      margin-left: -26px;
  }
  .shop_table_responsive.cart ul.wcsatt-options.overrides_exist {
    margin: 0 0 0;
      padding-left:0px;
  }
  .shop_table_responsive.cart .product-price .amount
  {
      padding-left:16px;
  }

  .shop_table_responsive.cart li .amount
  {
      padding-left:0px !important;
  }

  @media only screen and (max-width: 480px) and (min-width: 320px){
    .summary.temp .group_table tr td.price {
        text-align: left !important;
    }
    .group_table tr .label a {
        width: 150px !important;
    }
  }

  @media only screen and (min-width: 420px) and (max-width: 780px) and (orientation: landscape){
    .single-product.woocommerce div.product .woocommerce-product-rating {
        margin-bottom: 1.618em;
        width: 100%;
        padding-top: 0px;
        float: left !important;
    }
  }

  @media only screen and (min-width: 320px) and (max-width: 780px) and (orientation: landscape){
      .add_cart_purchasebtn #subcontent_listen p {
          text-align: center;
          font-weight: bold;
      }
      .add_cart_purchasebtn #subcontent_listen .wcsatt-options-product {
          text-align: center;
          padding: 0;
      }
      .summary .price.subscription-price {
           float: none; 
         
      }
      .listen_mainfirst .description_custom .bullets_set {
          width: 100%;
      }
      .listen_mainfirst .description_custom .bullets_set .bullet_img {
          width: 15%;
      }
      .listen_mainfirst .description_custom .bullets_set .content_bullets {
          width: 80%;
          text-align: left;
      }
      .single-product .contributions-container .contribution-actions {
          
          margin-left: 0% !important; 
     }

  }

  @media only screen and (max-width: 370px) and (min-width: 320px){
     /* 26-5 */
      #tab-listen_tab .listen_mainfirst {
           padding-left: 0px; 
           padding-right: 0px; 
      }
      .listen_mainfirst .description_custom .bullets_set {
          width: 100%;
      }
      .listen_mainfirst .description_custom .bullets_set .bullet_img {
          width: 15%;
      }
      .listen_mainfirst .description_custom .bullets_set .content_bullets {
          width: 80%;
          text-align: left;
      }
     .single-product.woocommerce #reviews .form-contribution #review_rating_field label {
          text-align: left;
      }
      .add_cart_purchasebtn #subcontent_listen p{
        text-align: center;
        font-weight: bold;
      }
      .add_cart_purchasebtn #subcontent_listen .wcsatt-options-product{
        text-align: center;
        padding: 0;
      }

  }

  @media only screen and (max-width: 480px) and (min-width: 371px){
     /* 26-5 */
      #tab-listen_tab .listen_mainfirst {
           padding-left: 0px; 
           padding-right: 0px; 
      }
      .listen_mainfirst .description_custom .bullets_set {
          width: 100%;
      }
      .listen_mainfirst .description_custom .bullets_set .bullet_img {
          width: 15%;
      }
      .listen_mainfirst .description_custom .bullets_set .content_bullets {
          width: 80%;
          text-align: left;
      }
     .single-product.woocommerce #reviews .form-contribution #review_rating_field label {
          text-align: left;
      }
      .add_cart_purchasebtn #subcontent_listen p{
        text-align: center;
        font-weight: bold;
      }
      .add_cart_purchasebtn #subcontent_listen .wcsatt-options-product{
        text-align: center;
        padding: 0;
      }
  }

  @media only screen and (min-width: 768px) and (max-width: 1024px){

       /* 26-5 */
      #tab-listen_tab .listen_mainfirst {
           padding-left: 0px; 
           padding-right: 0px; 
      }
      .listen_mainfirst .description_custom .bullets_set {
          width: 100%;
      }
      .listen_mainfirst .description_custom .bullets_set .bullet_img {
          width: 15%;
      }
      .listen_mainfirst .description_custom .bullets_set .content_bullets {
          width: 80%;
          text-align: left;
      }
      .single-product.woocommerce #reviews .form-contribution #review_rating_field label {
            text-align: left;
        }

  }
</style>
