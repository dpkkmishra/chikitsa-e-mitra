<article class="col s9" id="mainContent">
    <form action="http://localhost/clinic_records/account/signup" method="post" accept-charset="utf-8" id="signupForm" role="form">
        <div style="display:none">
            <input type="hidden" name="csrf_test_name" value="e13649c53b09ae519d6da2546ea5ce28" />
        </div>
        <fieldset>
            <legend>Account Registration:</legend>
            <div>
                <div class="form-group">
                    <div class="col m6">
                        <select class="browser-default">
                            <option value="" selected>Choose your option</option>
                            <option value="hospital">Hospital</option>
                            <option value="doctor">Doctor</option>
                            <option value="pathology">Pathology</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col m6">
                        <input type="text" name='first_name' id="first_name" value="" class='form-control' placeholder='First Name' title='First Name' required autofocus />
                    </div>
                    <div class="col m6">
                        <input type="text" name='last_name' id='last_name' value="" class='form-control' placeholder='Last Name' title='Last Name' />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col m6">
                        <input type="text" name='fname' id='fname' value="" class='form-control' placeholder='Father Name' title='Father Name' />
                    </div>
                    <div class="col m6">
                        <div>
                            <input name="gender" type="radio" id="male_gender" title='Male'/>
                            <label for="male_gender">Male</label>
                        
                            <input name="gender" type="radio" id="female_gender" title='Female'/>
                            <label for="female_gender">Female</label>
                        </div>                        
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col m6">
                        <input type="text" name='username' id='username' value="" class='form-control' placeholder='User Name' title='User Name' required />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col m6">
                        <input type="date" name='birth_date' id='birth_date' value="" class='form-control' placeholder='Birth Date' title='Birth Date' />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col m6">
                        <input type='password' name='password' id='password' class='form-control' placeholder='Password' title='Password' required/>
                    </div>
                    <div class="col m6">
                        <input type='password' name='password_conf' id='password_conf' class='form-control' placeholder='Confirm Password' title='Confirm Password' required />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col m6">
                        <input type='email' name='email' id='email' value="" class='form-control' placeholder='Email' title='Email' required />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col m6">
                        <input type='text' name='phone' id='phone' value="" class='form-control' placeholder='Phone' title='Phone' required/>
                    </div>
                </div>                

                <div class="form-group">
                    <div class="col m6">
                        <input type="text" name='social_id' id='registration_id' value="" class='form-control' placeholder='Registration Id' title='Registration Id' required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col m12">
                        <input type="text" name='address' id='address' value="" class='form-control' placeholder='Address' title='Address' />                    
                    </div>
                </div>
                
            </div>
        </fieldset>
        
        <div class="form-group">
            <div class="col m2">
                <input type="submit" name='submit' id='submit' value='Register' class="form-control btn btn-info" />
            </div>
            <div class="col m2"><a href="<?php echo base_url();?>account/hospitals" class="form-control btn btn-info">Cancel</a></div>
        </div>

    </form>        
</article>