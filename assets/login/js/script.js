$( document ).ready(function() {
    $( "#dialog_form" ).validate( {
        rules: {
            bhamashah_id: { required: true, minlength: 7 },
            mobile_number: { required: true, minlength: 10 }
        },
        messages: { 
            bhamashah_id: {
                required: "Please provide a Bhamashah ID",
                minlength: "Your Bhamashah ID must be 7 characters long"
            },
            mobile_number: {
                required: "Please provide a registered mobile",
                minlength: "Your password must be 10 digit"
            }            
        },
        errorElement: "em",
        errorPlacement: function ( error, element ) {          
            error.addClass( "help-block" );
            error.insertAfter( element );
        },
        highlight: function ( element, errorClass, validClass ) {
            $( element ).parents( ".col-sm-12" ).addClass( "has-error" ).removeClass( "has-success" );          
        },
        unhighlight: function ( element, errorClass, validClass ) {
          $( element ).parents( ".col-sm-12" ).addClass( "has-success" ).removeClass( "has-error" );          
        }
    });
    /*var dialogBox = $("#dialog");
    var dialog_selected = 'login';
    
    $("#resend_otp").click(function() {
        var mobile = $('#mobile_number').text();        
        
        if(mobile!='') {
            $('#resend_otp').hide();
            setTimeout(function(){ $('#resend_otp').show(); }, 20000);
            $.ajax({
                type: "POST",
                data: {
                    'mobile': mobile,
                },
                url: BASE_URL + "authentication/resend_otp/",
                success: function(data){
                    if(data.status) {
                        console.log('Mail Sent successfully!');
                    }
                }
            });
        }
        
    });*/

    function addFormError(formRow, errorMsg) {
        var errorMSG = '<span class="error-msg">' + errorMsg + '</span>';
        $(formRow).parents('.form-group').addClass('has-error');
        $(formRow).parents('.form-group').append(errorMSG);        
    }    

    $("#btnSubmit").click(function(){
        
        $('#dialog').removeClass('shakeit');
        $('.is_error').html('');
        
        $("#dialog_form").valid();      
        var bhamashah_id = $('#bhamashah_id').val();
        var mobile_number = $('#mobile_number').val();
        var recptcha_response = $('#g-recaptcha-response').val();     
        if(bhamashah_id != '' && mobile_number != ''){
            if(recptcha_response!=''){
                $('#btnSubmit').attr("disabled", true);
                $.ajax({
                    type: "POST",
                    data: {
                        'family_id':bhamashah_id, 
                        'mobile':mobile_number, 
                        'g-recaptcha-response':recptcha_response 
                    },
                    url: BASE_URL + "authentication/login/",
                    success: function(data){
                        $('#btnSubmit').attr("disabled", false);
                        if(data.status) {
                            $('#root').hide();
                            $('#registration_successful').show();
                        } else {
                            grecaptcha.reset();
                            $('#dialog').addClass('shakeit');
                            $("html, body").animate({ scrollTop: 0 }, "fast");
                            $('.is_error').html('<i class="fas fa-exclamation-triangle"></i> ' +data.message);
                        }
                    },
                    error: function(err){
                        grecaptcha.reset();
                        $('#btnSubmit').attr("disabled", false);
                        $('#dialog').addClass('shakeit');
                        $("html, body").animate({ scrollTop: 0 }, "fast");
                        $('.is_error').html('<i class="fas fa-exclamation-triangle"></i> Something went wrong!');
                    }
                });
            } else{
                $('.is_error').text('Invalid Recaptcha!');
            }
        }
	});
});

function validateOTP() {
    var otp = $('#register_otp').val();
    var mobile = $('#mobile_number').val();
    
    if(otp!=''){
        $('#validate_otp').attr("disabled", true);        
        
        $.ajax({
            type: "POST",
            data: {
                'otp': otp,
                'mobile': mobile
            },
            url: BASE_URL + "authentication/validate_otp/",
            success: function(data){
                $('#validate_otp').attr("disabled", false);
                if(data.status) {
                    location.href = BASE_URL;
                } else {
                    $('#invalid_otp').show();                    
                    $('#register_otp').addClass('errorInOTP');
                    $('#invalid_otp_message').html('<i class="fas fa-exclamation-triangle"></i> ' +data.message);
                }
            },
            error: function(err){
                $('#validate_otp').attr("disabled", false);
                $('#dialog').addClass('shakeit');
                $('.is_error').html('<i class="fas fa-exclamation-triangle"></i> Something went wrong!');
            }
        });
    }
}
function resetOTPMessage(){
    $('#invalid_otp').hide();
    $('#invalid_otp_message').html('');
    $('#register_otp').removeClass('errorInOTP');
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}