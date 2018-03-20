<article class="col col-sm-9" id="mainContent">
    <div class="">        
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: #999">Account</li>
            <li class="breadcrumb-item active">Hospitals</li>
            <li class="right back"  style="width: 65px;"><a href="<?php echo base_url(); ?>"><i class="fa fa-angle-left" style="position: relative; top: -2px;"></i> Back </a></li>
        </ol>
    </div>
    <div>
        <h2>Hospitals</h2>
    </div>
    <hr/>
    <div>
        <!-- <form class="Search card">  
            <input type="text" class="Search-box" name="Search-box" id="Search-box" placeholder="Search Users">
            <span class="Search-close valign-wrapper">
                <i class="fa fa-times" style="font-size: 20px; color: #6e6e6e;"></i>
            </span>
        </form> -->
        <div class='table-responsive' style="margin-top: 20px;">
            <table class='table table-bordered table-striped'>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Hospital Name</th>
                        <th>Area</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Doctor(s)</th>
                        <th class='hidden-print'>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Gyanpushp Research Center for Chest Disease</td>
                        <td>Dhar Kothi, Indore</td>
                        <td>07312711271</td>
                        <td>contact@gyanpushp.com</td>
                        <td>1</td>
                        <td class="hidden-print">
                            <a href="<?php echo base_url();?>account/hospitals/1" title="View User">
                                <i class="fa fa-external-link"></i> view
                            </a>                            
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Refine Skin Clinic</td>
                        <td>South Tokuganj, Indore</td>
                        <td>9425059808</td>
                        <td>contact@refineskin.io</td>
                        <td>1</td>
                        <td class="hidden-print">
                            <a href="<?php echo base_url();?>account/hospitals/2" title="View User">
                                <i class="fa fa-external-link"></i> view
                            </a>                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div style="margin-top: 20px; float: right;">
        <a href="http://localhost/clinic_records/account/signup" class="btn btn-default hidden-print valign-wrapper" style="padding: 5px 10px; height: 32px;"><b><i class="fa fa-plus"></i> Add User</b></a>
    </div>
</article>