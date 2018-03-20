<article class="col col-sm-9" id="mainContent">

    <div>
        <h2>Profile: ID-<?php echo $hof_details->id; ?></h2>
    </div>
    <hr/>
    <div>       
        <div style="margin-top: 20px;">
            <h2><b><?php echo $hof_details->name_eng; ?></b></h2>
            <h4>Family Id: <b><?php echo $hof_details->family_id_no; ?></b></h4>
            <h4>DOB: <b><?php echo $hof_details->DOB; ?></b></h4>
            <!-- <h4>AADHAR ID: <b>780623649996</b></h4> -->
            <h4>BHAMASHAH ID: <b><?php echo $hof_details->bhamashah_id; ?></b></h4>
            <h4>Village: <b>Tonk</b></h4>
            <h4>District: <b>Tonk</b></h4>
            <hr/>
        </div>
        <div style="margin-top: 20px;">
            <h3>Family Members</h3>
            <div class='table-responsive' style="margin-top: 20px;">
                <table class='table table-bordered table-striped centered'>
                     <thead>
                        <tr>                        
                            <th>Name</th>
                            <th>Relation</th>
                            <th>Gender</th>
                            <th>Blood Group</th>
                            <th>Medical Reports</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($family_members as $member) { ?>
                        <tr>
                            <td><?php echo $member->name_eng; ?></td>
                            <td>   
                                <?php if($member->is_hof == 1) { ?>
                                    Head Of Family
                                <?php }?> 
                            </td>
                            <td><?php echo $member->gender;?></td>
                            <td>NA</td>
                            <td class="hidden-print center">
                                <span style="cursor: pointer; font-size: 15px; color: #2c2b7b; font-weight: 600;"><a href="<?php echo base_url(); ?>profile/<?php echo $member->member_id; ?>"><i class="fa fa-arrow-circle-down"></i> Get</a></span>
                            </td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>       
    </div>    
</article>