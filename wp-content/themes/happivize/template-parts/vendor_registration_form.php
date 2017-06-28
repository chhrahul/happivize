<?php
/**
 * Template Name: Vendor Registration Form

 * @since Twenty Twelve 1.0
 */


 get_header();



    $current_user = wp_get_current_user();
    if ( 0 == $current_user->ID ) {
    }
    else{


        /* If profile was saved, update profile. */
    if ( isset($_POST['submit'] ) ) {
        global $reg_errors;
        $reg_errors = new WP_Error;      

        /* Update user password. */
        if ( !empty($_POST['password'] ) && !empty( $_POST['password2'] ) ) {
            if ( $_POST['password'] == $_POST['password2'] ){                
                $password = esc_attr( $_POST['password'] );
                wp_set_password( $password, $current_user->ID);              
                $sessions = WP_Session_Tokens::get_instance($current_user->ID);
            
                $sessions->destroy_all();
                header('Location: '.site_url().'/vendor-login/');
            }
            else{
                $reg_errors->add( 'passowrd_error', 'Password Does Not Match' );           
            }
        }

       /*  if ( !empty( $_POST['email'] ) ){
            if (!is_email(esc_attr( $_POST['email'] ))){
                $reg_errors->add( 'email_invalid', 'The Email address isn’t correct' );          
            }
            elseif(email_exists(esc_attr( $_POST['email'] )) ){
                $reg_errors->add( 'email_invalid', 'The Email address already exists' );
            }
            else{ 
                update_user_meta( $current_user->ID, 'user_email', esc_attr( $_POST['email'] ) );
            }
        }*/

        /* Update user information. */
        if ( !empty( $_POST['fname'] ) ){       
            update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['fname'] ) );
        }
        if ( !empty( $_POST['lname'] ) ){       
            update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['lname'] ) );   
        }
        if ( !empty( $_POST['company'] ) ){
            update_user_meta( $current_user->ID, 'vndor_company', esc_attr( $_POST['company'] ) );
        }
        if ( !empty( $_POST['adressOne'] ) ){
            update_user_meta( $current_user->ID, 'vndor_adressOne', esc_attr( $_POST['adressOne'] ) );
        }
        if ( !empty( $_POST['addressTwo'] ) ){
            update_user_meta( $current_user->ID, 'vndor_addressTwo', esc_attr( $_POST['addressTwo'] ) );
        }
        if ( !empty( $_POST['city'] ) ){
            update_user_meta( $current_user->ID, 'vndor_city', esc_attr( $_POST['city'] ) );
        }
        if ( !empty( $_POST['state'] ) ){
            update_user_meta( $current_user->ID, 'vndor_state', esc_attr( $_POST['state'] ) );
        }
        if ( !empty( $_POST['country'] ) ){
            update_user_meta( $current_user->ID, 'vndor_country', esc_attr( $_POST['country'] ) );
        }
        if ( !empty( $_POST['postalCode'] ) ){
            update_user_meta( $current_user->ID, 'vndor_postalCode', esc_attr( $_POST['postalCode'] ) );
        }
        if ( !empty( $_POST['phone'] ) ){
            update_user_meta( $current_user->ID, 'vndor_phone', esc_attr( $_POST['phone'] ) ); }        

      
        if ( is_wp_error( $reg_errors ) ) {
     
            foreach ( $reg_errors->get_error_messages() as $error ) {
             
                echo '<div style="color:red;">';
                echo '<strong>ERROR</strong>:';
                echo $error . '<br/>';
                echo '</div>';
                 
            }
         
        }
    }


    echo '
    <style>
    div {
        margin-bottom:2px;
         margin-top: 9px;
    }
     
    input{
        margin-bottom:4px;
    }
    .affiliates-registration {
        margin: 0 auto 5%;
        width: 50%;
    }
    .affiliates-registration input[type="text"], .affiliates-registration input[type="password"], .affiliates-registration textarea {
        background-image: url("../images/not-required.png");
        background-position: right center;
        background-repeat: no-repeat;
        border: 1px solid #aaaaaa;
        display: block;
        padding: 10px;
        width: 100%;
    }
    .affiliates-registration .required {
        background-image: url("https://dev.happivize.com/wp-content/plugins/affiliates-enterprise/images/required.png") !important;
        background-position: right center;
        background-repeat: no-repeat;
        border: 1px solid #aaaaaa;
        padding: 10px;
    }
    </style>
    ';
 
    ?>
    <div id="affiliates-registration" class="affiliates-registration">
    <form action="<?php the_permalink(); ?>" method="post" id="vendor_registration">
    <div>
    <label for="firstname">First Name</label>
    <input required id="firstname" class="required" type="text" name="fname" value="<?php echo the_author_meta( 'first_name', $current_user->ID ) ?>">
    </div>
     
    <div>
    <label for="lname">Last Name</label>
    <input required id="lname" class="required" type="text" name="lname" value="<?php echo the_author_meta( 'last_name', $current_user->ID ) ?>">
    </div>

    <div>
    <label for="email">Email</label>
    <input disabled="disabled" id="email" required class="required"  type="text" name="email" value="<?php echo the_author_meta( 'user_email', $current_user->ID ) ?>">
    <p id="eamil_error"></p>
    </div>

    <div>
    <label for="company">Company</label>
    <input type="text" name="company" value="<?php echo the_author_meta( 'vndor_company', $current_user->ID ) ?>">
    </div>

    <div>
    <label for="adressOne">Address 1</label>
    <input id="adressOne" required class="required" type="text" name="adressOne" value="<?php echo the_author_meta( 'vndor_adressOne', $current_user->ID ) ?>">
    </div>

    <div>
    <label for="addressTwo">Address 2</label>
    <input type="text" name="addressTwo" value="<?php echo the_author_meta( 'vndor_addressTwo', $current_user->ID ) ?>">
    </div>   

    <div>
    <label for="city ">City</label>
    <input id="city" required class="required" type="text" name="city" value="<?php echo the_author_meta( 'vndor_city', $current_user->ID ) ?>">
    </div>

    <div>
    <label for="state">State</label>
    <input id="state" required class="required" type="text" name="state" value="<?php echo the_author_meta( 'vndor_state', $current_user->ID ) ?>">
    </div>

    <div>
    <label for="postalCode">Postal Code</label>
    <input id="postalCode" required class="required" type="text" name="postalCode" value="<?php echo the_author_meta( 'vndor_postalCode', $current_user->ID ) ?>">
    </div>

    <div>
    <label for="country">Country</label>
    <input id="country" required class="required" type="text" name="country" value="<?php echo the_author_meta( 'vndor_country', $current_user->ID ) ?>">
    </div>

    <div>
    <label for="phone">Phone</label>
    <input id="phone" required class="required" type="text" onkeypress="return isNumber(event)" name="phone" value="<?php echo the_author_meta( 'vndor_phone', $current_user->ID ) ?>">
    <p id="numbervalues"></p>
    </div>

    <div>
    <label for="paypalemail">Paypal Email</label>
    <input id="paypalemail" required class="required" type="text" name="paypalemail" value="<?php echo the_author_meta( 'vndor_paypalemail', $current_user->ID ) ?>">
    <p id="paypalemail_error"></p>
    </div>

    <div>
    <label for="username" id="Username">Username</label>
    <input disabled="disabled" id="username"  type="text" name="username" value="<?php echo the_author_meta( 'user_login', $current_user->ID ) ?>">
    </div>
     
    <div>
    <label for="password">Password</label>
    <input id="password1" type="password" name="password">
    </div>

    <div>
    <label for="password2">Repeat Password</label>
    <input id="password2"  type="password" name="password2">
    <p id="pass_error"></p>
    </div> 
     
   
    <input id="update_field" type="submit" name="submit" value="Save"/>
    </form>
    </div>

<?php

}

?>

<?php get_footer(); ?>


<script type="text/javascript">
    jQuery("document").ready(function(){
        jQuery("#email").focusout(function() {
            emailaddress = jQuery("#email").val();             
            if(emailaddress == ""){
               jQuery("#email").css({'border':'1px solid #ff0000','box-shadow':'0 0 2px 1px #ff0000'});
            }   
            else{
               var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if( !emailReg.test( emailaddress ) ) {
                    jQuery("#eamil_error").html(""); 
                    jQuery("#eamil_error").html("Email is not valid");   
                }
                else{
                    jQuery("#eamil_error").html("");     
                    jQuery("#email").css({'border':'1px solid #aaaaaa','box-shadow':'0 0 2px 1px #fff'}); 
                } 
            }      
            
           
        });

         jQuery("#paypalemail").focusout(function() {
            emailaddress = jQuery("#paypalemail").val();    
            if(emailaddress == ""){
               jQuery("#email").css({'border':'1px solid #ff0000','box-shadow':'0 0 2px 1px #ff0000'});
            } 
            else{
                  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if( !emailReg.test( emailaddress ) ) {
                    jQuery("#paypalemail_error").html(""); 
                    jQuery("#paypalemail_error").html("Email is not valid");               
                }
                else{
                    jQuery("#paypalemail_error").html("");  
                    jQuery("#email").css({'border':'1px solid #aaaaaa','box-shadow':'0 0 2px 1px #fff'});    
                }  
            }      
          
           
        });

        jQuery("#password2").focusout(function() {
            password1 = jQuery("#password1").val();
            password2 = jQuery("#password2").val();    
            if(password1 != password2){
                jQuery("#password2").css({'border':'1px solid #ff0000','box-shadow':'0 0 2px 1px #ff0000'});
                jQuery("#pass_error").html(""); 
                jQuery("#pass_error").html("Passowrd doesn't match");  
            } 
            else
            {   
                jQuery("#pass_error").html("");  
                jQuery("#password2").css({'border':'1px solid #aaaaaa','box-shadow':'0 0 2px 1px #fff'});
            }             
          
           
        });

        jQuery("#firstname, #lname, #city, #state, #postalCode, #country, #phone, #adressOne").focusout(function() {
            checkval = jQuery(this).val();
            hasSpace = /\s/g.test(jQuery(this).val());
            if(checkval == "" || (jQuery.trim( checkval )).length == 0){
               jQuery(this).css({'border':'1px solid #ff0000','box-shadow':'0 0 2px 1px #ff0000'});
            } 
            else{
              jQuery(this).css({'border':'1px solid #aaaaaa','box-shadow':'0 0 2px 1px #fff'});  
            }
 
        });

       

    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            jQuery("#numbervalues").html(""); 
            jQuery("#numbervalues").html("Enter Numbers");
            return false;

        }
        jQuery("#numbervalues").html(""); 
        return true;
    }
</script>