<article class="col col-sm-9" id="mainContent">
    <div class="">        
        <ol class="breadcrumb">
            <li class="breadcrumb-item" style="color: #000;font-weight: 500;">Users</li>
            <li class="right back"  style="width: 65px;"><a href="<?php echo base_url(); ?>"><i class="fa fa-angle-left" style="position: relative; top: -2px;"></i> Back </a></li>
        </ol>
    </div>
    <div>
        <h2>Users</h2>
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
            <h3>Total Users: <b>150</b></h3>
            <table class='table table-bordered table-striped'>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>AADHAR ID</th>
                        <th>BHAMASHAH ID</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="1" title="Seeta Ram">
                        <td>Seeta Ram</td>
                        <td>780623649996</td>
                        <td>1428-WKMY-25373</td>
                        <td>Female</td>
                        <td class="hidden-print">
                            <a href="<?php echo base_url();?>users/1" title="View User">
                                <i class="fa fa-external-link"></i> view
                            </a>
                        </td>
                    </tr>
                    <tr id="2" title="Neelam Ram">
                        <td>Neelam Ram</td>
                        <td></td>
                        <td>1428-WKMY-25373</td>
                        <td>Female</td>
                        <td class="hidden-print">
                            <a href="<?php echo base_url();?>users/1" title="View User">
                                <i class="fa fa-external-link"></i> view
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <div style="margin-top: 20px; float: right;">
        <a href="http://localhost/clinic_records/account/signup" class="btn btn-default hidden-print valign-wrapper" style="padding: 5px 10px; height: 32px;"><b><i class="fa fa-plus"></i> Add User</b></a>
    </div> -->
</article>