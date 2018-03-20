<article class="col col-sm-9" id="mainContent">

    <div class="">        
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url() .'users';?>">Users</a></li>
            <li class="breadcrumb-item"><a href="<?php echo base_url() .'users/1';?>">User Details</a></li>
            <li class="breadcrumb-item active">Report</li>
            <li class="right back"  style="width: 65px;"><a href="<?php echo base_url(); ?>users/1"><i class="fa fa-angle-left" style="position: relative; top: -2px;"></i> Back </a></li>
        </ol>        
    </div>
    <div>
        <h2>Report: ID-001</h2>
    </div>
    <hr/>
    <div>       
        <div style="margin-top: 20px;">
            <h4>19 JAN, 2018</h4>            
            <h3>Visited Pulmonologist</h3>
            <h4>Hospital: <b>Gyanpushp Research Center for Chest And Allergy Diseases</b></h4>
            <h4>Doctor: <img src="<?php echo base_url();?>assets/uploads/drsb.jpg" height="50" width="50" class="img-thumbnail img-circle"> <b>Salil Bhargava</b></h4>
            <hr/>
        </div>
        <div style="margin-top: 20px;">
            <h3>Vital Sign</h3>
            <div class="card clearfix center" style="padding: 10px 20px;">
                <div class="col s3" style="padding: 5px 0px;">
                    <p>TEMP (°F)</p>
                    <b style="font-size: 18px;">97</b>
                </div>
                <div class="col s3" style="padding: 5px 0px;">
                    <p>PULSE (bpm)</p>                    
                    <b>79</b>                    
                </div>
                <div class="col s3" style="padding: 5px 0px;">
                    <p>RR (breaths/min)</p>                    
                    <b style="font-size: 18px;">18</b>                    
                </div>
                <div class="col s3" style="padding: 5px 0px;">
                    <p>WEIGHT (kg)</p>
                    <b style="font-size: 18px;">82.00</b>
                </div>
            </div>
        </div>
        <div style="margin-top: 20px;">
            <h3>Prescription</h3>
            <div class="card clearfix" style="padding: 10px 20px;">
                <div style="padding: 5px 0px;">
                    <b>1. Tablet Azithral (Azithromycin) 250mg</b>
                    <p>Morning: 1</p>
                    <p>Morning: 1</p>
                    <p>Note: For 5 days, After Food</p>
                </div>
                <div style="padding: 5px 0px;">
                    <b>2. Tablet Laveta (Levocetrizine) 5mg</b>                
                    <p>Evening: 1</p>
                    <p>Note: For 7 days, After Food</p>
                </div>
                <div style="padding: 5px 0px;">
                    <b>3. Syrup Alex (Sf) 100MI 10mg</b>
                    <p>Morning: 1</p>
                    <p>Afternoon: 1</p>
                    <p>Evening: 1</p>
                    <p>Note: For 5 days</p>
                </div>
                <div style="padding: 5px 0px;">
                    <b>4. Tablet Maxamine Forte 45mg</b>
                    <p>Evening: 1</p>                
                    <p>Note: For 15 days, After Food</p>
                </div>
                <div style="padding: 5px 0px;">
                    <b>5. Tablet Celin (Vit C) 500mg</b>
                    <p>Afternoon: 1</p>                
                    <p>Note: For 15 days, After Food</p>
                </div>                
            </div>            
        </div>        

        <div style="margin-top: 20px;">
            <h3>More Reports</h3>

            <div class="card clearfix" style="padding: 10px 20px;">                
                <div class="col s4" style="padding: 5px;">
                    <b>1. X Ray</b><br>
                    <a href="<?php echo base_url();?>assets/uploads/x-ray.jpg" target="_blank">
                        <img class="img-responsive" src="<?php echo base_url();?>assets/uploads/x-ray.jpg">
                    </a>
                </div>                
            </div>            
        </div>
    </div>    
</article>