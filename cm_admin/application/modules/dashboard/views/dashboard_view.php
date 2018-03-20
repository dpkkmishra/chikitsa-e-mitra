<article class="col s9" id="mainContent">
    <div id="cPanel" class="">
        <a href="<?php echo base_url();?>users" class="btn btn-primary btn-lg" role="button">
            <i class="fa fa-users" style="font-size: 20px;"></i> <br/>Users
        </a>

        
        <a href="<?php echo base_url();?>account/hospitals" class="btn btn-warning btn-lg" role="button" title="List of All Drugs">
            <i class="fa fa-building" style="font-size: 20px;"></i> <br/>Hospitals
        </a>        
        
        <a href="<?php echo base_url();?>account/doctors" class="btn btn-danger btn-lg" role="button" title="List of All Tests">
            <i class="fa fa-user-md" style="font-size: 20px;"></i> <br/>Doctors
        </a>

        <a href="<?php echo base_url();?>account/register" class="btn btn-info btn-lg" role="button" title="Register New Xray to Database">
            <i class="fa fa-plus-square" style="font-size: 20px;"></i> <br/>Add Account            
        </a>

        <style>
            #cPanel a {
                width: 190px;
                height: 80px;
                margin: 0px 4px 10px 4px;
                border-radius: 0px;
                font-size: medium;
                padding: 15px;
            }
        </style>
    </div>
</article>
            