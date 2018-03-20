
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>    
    <meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes">
    <title>Login</title>
    <link rel='stylesheet prefetch' href='<?php echo base_url(); ?>assets/login/css/bootstrap.min.css'>
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/css/style.css"> 
    <script src='https://www.google.com/recaptcha/api.js'></script>
     <style>
        #mainLoader {
            animation: loader 5s linear infinite;
            position: absolute;
            top: 40%;
            left: 0px;
            margin: auto;
            width: 100%;
            right: 0px;
            text-align: center;
        }
    
        @keyframes mainLoader {
            0% { left: -100px; }
            100% { left: 110%; }
        }
    
        #box {
            width: 50px;
            height: 50px;
            background: #d76ac6;
            animation: animate .5s linear infinite;
            margin: auto;
            border-radius: 3px;
        }
    
        @keyframes animate {
            17% { border-bottom-right-radius: 3px; }
            25% { transform: translateY(9px) rotate(22.5deg); }
            50% { transform: translateY(18px) scale(1, .9) rotate(45deg); border-bottom-right-radius: 40px; }
            75% { transform: translateY(9px) rotate(67.5deg); }
            100% { transform: translateY(0) rotate(90deg); }
        }
    
        #shadow {
            width: 50px;
            height: 5px;
            background: #d76ac6;
            opacity: 0.1;
            position: relative;
            top: 70px;
            margin: auto;
            border-radius: 50%;
            animation: shadow .5s linear infinite;
        }
    
        #welcomeback {
            font-family: 'Roboto', sans-serif;
            color: #d76ac6;
            top: 40px;
            position: relative;
            font-size: 22px;
        }
    
        @keyframes shadow {
            50% { transform: scale(1.2, 1); }
        }
    </style>
</head>
<body>    
     <div id="successful_login" class="fix-middle">
        <div id="mainLoader">
            <div id="shadow"></div>
            <div id="box"></div>
            <h3 id="welcomeback">
                <b>Logging. Please Wait!</b>
            </h3>
        </div>
    </div>

    <!-- <div class="brand center dialog dialog-effect-in">
        <img src="<?php echo base_url(); ?>assets/login/images/logo.png" alt="logo" height="100">        
    </div> -->

    <div class="col col-lg-4">
        <div style="position: absolute; margin: auto; right: 0; top: 50px; text-align: center;">
            
            <img src="<?php echo base_url(); ?>assets/images/cm-profile.jpg" alt="logo" >
            <!-- <img src="<?php echo base_url(); ?>assets/images/helathcare-rajasthan.jpg" alt="logo" > -->
        </div>
        
    </div>
    <div id="root" class="col col-lg-8" style="margin-top: 50px;">
        <h1 id="loginHeader" class="loginHeader center dialog dialog-effect-in">Chikitsha e-Mitra </h1>        
        <div id="dialog" class="dialog dialog-effect-in">
            <div class="dialog-content">
                <form id="dialog_form" class="dialog-form" action method="POST" novalidate="novalidate">
                    <div class="dialog-front">
                        <fieldset>
                            <p class="center"><em class="is_error"></em></p>
                            <div class="form-group clearfix">
                                <label for="bhamashah_id" class="control-label">Bhamashah Family ID</label>
                                <div class="col-sm-12">
                                    <input type="text" id="bhamashah_id" class="form-control" name="bhamashah_id" placeholder="Enter Family ID number" autofocus required autocomplete="off" />
                                </div>
                            </div>

                            <!-- <p style="text-align: center;color: #fff; font-weight: 800">OR</p>

                            <div class="form-group clearfix">
                                <label for="aadhar_id" class="control-label">Aadhar Id</label>
                                <div class="col-sm-12">                                    
                                    <input type="text" id="aadhar_id" class="form-control" name="aadhar_id" placeholder="Enter Aadhar Id" autofocus required autocomplete="off" />
                                </div>
                            </div> -->
                            <div class="form-group clearfix">
                                <label for="mobile_number" class="control-label"> Registered Mobile</label>
                                <div class="col-sm-12">
                                    <input type="text" id="mobile_number" class="form-control" placeholder="Enter your 10 digit registered mobile number" name="mobile_number" autocomplete="off" required/>
                                </div>
                            </div>
                            <!-- <div class="form-group clearfix recaptcha" style="text-align: center;">
                                <div class="g-recaptcha" style="display: inline-block;" data-sitekey="6Lemg0UUAAAAAIh4_UggBQw1eKVmAcimolcxKJhP"></div>
                            </div> -->                            
                        </fieldset>                    
                    </div>
                    
                    <div class="form-group clearfix recaptcha" style="text-align: center;">
                        <div class="g-recaptcha" style="display: inline-block;" data-sitekey="6Lemg0UUAAAAAIh4_UggBQw1eKVmAcimolcxKJhP"></div>
                    </div>
                    <div class="clearfix">
                        <input type="button" class="btn btn-default btn-block btn-lg" id="btnSubmit" value="Continue">
                    </div>
                </form>                
            </div>
        </div>
        <div class="center dialog dialog-effect-in">
            <!-- <a id="resetPassword" class="resetPassword" href="#"><span>Can't log in?</span></a> -->
        </div>
        <footer class="dialog dialog-effect-in">
            <div class="center">
                <ul class="fine-print">
                    <li><a href="<?php echo base_url();?>privacy" target="_blank"><span>Privacy policy</span></a></li>
                    <li><a href="<?php echo base_url();?>end-user-agreement" target="_blank"><span>Terms of use</span></a></li>
                </ul>
            </div>
        </footer>        
    </div>
    <div id="registration_successful" class="text-center col col-lg-8 registration_successful" style="display: none; margin-top: 50px; margin-left: 260px;">
        <h1 id="loginHeader" class="loginHeader center dialog dialog-effect-in">Chikitsha e-Mitra </h1>
        <!-- <h3>Hello, <b id="registered_name"></b></h3> -->
        <h4  style="color: #000; margin-top: 20px;">Validate OTP (One Time Passcode)</h4>
        <hr/>
        <div style="text-align: left;">
            <p>A One Time Passcode has been sent to <b id="registered_mobile"></b>.</p>
            <p style="text-align: justify;">Please enter the OTP below to verify.</p>
        </div>
        
        <input type="text" id="register_otp" class="form-control" placeholder="Enter OTP" name="register_otp" onkeypress="resetOTPMessage()" />
        <div id="invalid_otp" class="text-right has-error" style="display: none;"><em class="is_error" id="invalid_otp_message"><i class="fas fa-exclamation-triangle"></i> Invalid OTP!</em></div>
        <button id="validate_otp" class="btn btn-default btn-block pull-left" onclick="validateOTP()">Validate OTP</button>


        <!-- <a id="resend_otp" class="pull-right">Resend OTP</a> -->
        <!-- <a style="color: #000" class="pull-right">Go back</a> -->
    </div>    
    
    <script src='<?php echo base_url(); ?>assets/login/js/jquery-3.2.1.min.js'></script>    
    <script src='<?php echo base_url(); ?>assets/login/js/jquery.validate.min.js'></script>    
    <script type="text/javascript">
        var BASE_URL = "<?php echo base_url(); ?>";
    </script>
    
    <script src="<?php echo base_url(); ?>assets/login/js/script.js"></script>
</body>
</html>