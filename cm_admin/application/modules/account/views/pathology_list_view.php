<article class="col col-sm-9" id="mainContent">
    <legend>Users</legend>
    <div>
        <form class="Search card">  
            <input type="text" class="Search-box" name="Search-box" id="Search-box" placeholder="Search Users">
            <span class="Search-close valign-wrapper">
                <i class="fa fa-times" style="font-size: 20px; color: #6e6e6e;"></i>
            </span>
        </form>
        <div class='table-responsive' style="margin-top: 20px;">
            <table class='table table-bordered table-striped'>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Position</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th class='hidden-print'></th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="1" title="Deepak Mishra">
                        <td>dpkkmishra</td>
                        <td>Deepak Mishra</td>
                        <td>Ramsushil</td>
                        <td>admin</td>
                        <td>dpkkmishra@outlook.com</td>
                        <td>9009781991</td>
                        <td class="hidden-print">
                            <a href="<?php echo base_url();?>users/1" title="View User">
                                <i class="fa fa-external-link"></i> view
                            </a>                            
                        </td>
                    </tr>
                    <tr id="2" title="Deepak Mishra">
                        <td>deepakMishra</td>
                        <td>Deepak Mishra</td>
                        <td>Ramsushil Mishra</td>
                        <td>doctor</td>
                        <td>deepak@brahma.io</td>
                        <td>9009781991</td>
                        <td class="hidden-print">
                            <a href="<?php echo base_url();?>users/2" title="View User">
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