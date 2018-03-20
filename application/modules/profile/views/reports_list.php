<article class="col col-sm-9" id="mainContent">

    <div class="">        
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url();?>profile">Profile</a></li>
            <li class="active breadcrumb-item">Seema Reports</li> 
            <li class="right back"  style="width: 65px;"><a href="<?php echo base_url();?>profile"><i class="fa fa-angle-left" style="position: relative; top: -2px;"></i> Back </a></li>
        </ol>
    </div>
    <div>
        <h2>Report</h2>
    </div>
    <hr/>
    <div>       
        <div class='table-responsive' style="margin-top: 20px;">
            <table class='table table-bordered table-striped'>
                 <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Note</th>
                        <th>Hospital</th>
                        <th>Doctor Name</th>
                        <th>Date of Visit</th>
                        <th>Records</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>                       
                        <td>1</td>
                        <td>Visited Pulmonologist</td>
                        <td>Gyanpushp Research Center for Chest Disease</td>
                        <td>Dr. Salil Bhargava</td>
                        <td>19/01/2018</td>
                        <td>1 Prescription, 1 Vital Sign, 1 Clinical Note</td>
                        <td class="hidden-print">
                            <span style="cursor: pointer; font-size: 15px; color: #2c2b7b; font-weight: 600;"><a href="<?php echo base_url();?>profile/1/detail"><i class="fa fa-arrow-circle-down"></i> Get</a></span>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Visited Dermatologist</td>
                        <td>Refine Skin Clinic</td>
                        <td>Dr. Rahul Nagar</td>
                        <td>28/02/2018</td>
                        <td>1 Prescription, 0 Vital Sign, 1 Clinical Note</td>
                        <td class="hidden-print">
                            <span style="cursor: pointer; font-size: 15px; color: #2c2b7b; font-weight: 600;"><a href="<?php echo base_url();?>profile/1/detail"><i class="fa fa-arrow-circle-down"></i> Get</a></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="reports_view">
            
        </div>
    </div>    
</article>