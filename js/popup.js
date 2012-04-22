/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function is_email(email){
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(filter.test(email)){
        return true;
    }
    else{
        return false;
    }
}

function is_name(name){
    if(name.length > 2){
        return true;
    }
    else{
        return false;
    }
}

function is_phone(phone){
     if(phone.length >= 10){
        return true;
    }
    else{
        return false;
    }
}

jQuery(document).ready(function($) {
	$('.popup-login').bind('click', function(){
		$('.login_message').hide();
		$('.registration-message').hide();
		
		 var this_obj = this;
			var id = '#popup-content';

			//Get the screen height and width
			var blanketHeight = $(document).height();
			var blanketWidth = $(window).width();

			//Set heigth and width to blanket to fill up the whole screen
			$('#blanket').css({'width':blanketWidth,'height':blanketHeight});

			//transition effect        
			$('#blanket').fadeIn(1000);    
			$('#blanket').fadeTo("slow",0.8);    

			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();

			//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);

			//transition effect
			$(id).show(1000);
			return false;
	})
          

    //if close button is clicked
    $('.close').click(function (e) {
        //Cancel the link behavior
       
                $('#blanket').fadeOut();
                $('.window').slideUp();           
		return false;
    });        
	
	// now if someone tries to login
	
	$('.sitemodal-login-submit').bind('click', function(){
		
		var redirect = window.location.href;	
		var fid = '#sitemodal-login-submit-form';
		var action = $(fid).attr('action');
		var username = $("input[type=text][name=log]").val();
		var password = $("input[type=password][name=pwd]").val();
				
		//login ajax
		
		$.ajax({
			url: action,
			data: 'log=' + username + '&pwd=' + password + '&testcookie=1',
			type: 'POST',
			cache: false,
			success: function (resp) {
				var error = $('#login_error', resp).html();
				if(error){
					$('.login_message').html($('#login_error', resp).html());
					$('.login_message').attr('id', 'login_error');
					$('.login_message').show();
				}
				else{
					window.location.href = redirect;
				}
			},
		});
		return false;
	});
	
	//handling the registration form
	$('.button-register').bind('click', function(){
		
		
		var form_data = $('#registration-form-popup').serialize();
				
		$.ajax({
			async: true,
			type:'post',			
			dataType:"html",
			url:PopUp.ajaxurl,
			cache:false,
			timeout:10000,
			data : {
				'action' : 'popup_user_registration',
				'form_data' : form_data,
			},
			
			success:function(resp){				
				$('.registration-message').html($(resp).html());
				$('.registration-message').show();
				return false;
			},
			error: function(jqXHR, textStatus, errorThrown){
				jQuery('#footer').html(textStatus);
				alert(textStatus);
				return false;
			}
		});
		
		return false;
	})
	
  
});

