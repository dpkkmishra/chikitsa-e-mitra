<!DOCTYPE html>
<html>

<head>
    <title>Chikitsha Mitra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?php echo base_url();?>assets/css/materialize.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/advertiser/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href='<?php echo base_url();?>assets/css/ui/jquery-ui.min.css' media="screen" / rel="stylesheet">
    <link href='<?php echo base_url();?>assets/css/print.css' media="print" rel="stylesheet" />

    <link href='<?php echo base_url();?>assets/css/style.css' rel="stylesheet" />

    <style>
        legend { color: rgba(10, 120, 180, 50); }        
        #sidebar { margin-bottom: 10px; }        
        .glyphicon { margin-right: 5px; }        
        .panel-body { padding: 0px; }        
        .panel-body table tr td { padding-left: 15px }        
        .panel-body .table { margin-bottom: 0px; }        
        .modal-lg { width: 85%; }        
        .form-group { margin-bottom: 0px; }        
        .form-group .form-control { margin-bottom: 10px; }        
        .table { margin-bottom: 3px; }        
        .pagination { margin: 1px 0px; }
    </style>

    <script src="<?php echo base_url();?>assets/js/jquery-2.1.0.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script>    
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src='<?php echo base_url();?>assets/js/html5shiv.js'></script>
      <script src='<?php echo base_url();?>assets/js/respond.min.js'></script>
    <![endif]-->
</head>

<body>
    <div class="container">
        <div class="navbar-fixed">
            <nav style="color: #000; background: #f5f5f5; width: 80%; margin-top: -25px;">
                <div class="nav-wrapper">
                    <a href="<?php echo base_url(); ?>" class="brand-logo"><b>Chikitsa Mitra - Admin</b></a>
                    <ul class="right hide-on-med-and-down valign-wrapper">                    
                        <li><a href="badges.html"><i class="fa fa-lock"></i> Logout</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="content">
            <section class="row">
                <aside class="col col-sm-3">
                    <div id='sidebar'>
                        <div id="accordion" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse">
                                            <span class="glyphicon glyphicon-cog"></span> Users 
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse in" id="collapseOne">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <i class="fa fa-list"></i>
                                                        <a href="<?php echo base_url();?>users"> List</a> 
                                                    </td>
                                                </tr>                                                
                                                <!-- <tr>
                                                    <td>                                                        
                                                        <i class="fa fa-plus"></i>
                                                        <a href="<?php echo base_url();?>users/register"> Register</a> 
                                                    </td>
                                                </tr> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#collapseAdmin" data-parent="#accordion" data-toggle="collapse">
                                            <span class="glyphicon glyphicon-folder-close"></span> Accounts
                                        </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseAdmin">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <i class="fa fa-building"></i>
                                                        <a href="<?php echo base_url();?>account/hospitals"> Hospitals</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <i class="fa fa-user-md"></i>
                                                        <a href="<?php echo base_url();?>account/doctors"> Doctors</a>
                                                    </td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>                                                        
                                                        <i class="fa fa-flask"></i>
                                                        <a href="<?php echo base_url();?>account/pathology"> Pathology</a>
                                                    </td>
                                                </tr> -->
                                                <tr>
                                                    <td>                                                        
                                                        <i class="fa fa-plus-square"></i>                       
                                                        <a href="<?php echo base_url();?>account/register"> Register Account</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>