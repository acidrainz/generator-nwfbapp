<!DOCTYPE html>
<html>
<head>
    <title>CMS </title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="NuWorks Interactive Labs, Inc." />
    <!-- favicon and touch icons -->
    <link rel="shortcut icon" href="<?=base_url()?>images/admin/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>images/admin/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>images/admin/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>images/admin/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>images/admin/ico/apple-touch-icon-57-precomposed.png">
    <!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>fonts/admin/fonts.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>fonts/admin/font-awesome.min.css" />
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?=base_url()?>fonts/admin/font-awesome-ie7.min.css" /><![endif]-->

	<link rel="stylesheet" media="screen" href="<?=base_url()?>css/admin/bootstrap.css">
    <link rel="stylesheet" href="<?=base_url()?>css/admin/bootstrap-responsive.css">
    <link rel="stylesheet" href="<?=base_url()?>css/admin/mystyle.css" />

    <!-- jquery ui -->
    <link href="<?=base_url()?>plugins/jquery-ui/css/smoothness/jquery-ui-1.10.0.custom.css" rel="stylesheet">
   <script src="bower_components/jquery/jquery.js"></script>
    <script src="<?=base_url()?>plugins/jquery-ui/js/jquery-ui-1.10.0.custom.js"></script>
    <!-- /jquery ui -->

    <script src="<?=base_url()?>js/admin/bootstrap.min.js"></script>
    <script src="<?=base_url()?>js/admin/custom.js"></script>
</head>
    <body>
        <!-- header -->
    <header class="navbar navbar-inverse navbar-fixed-top">

        <div class="navbar-inner">
            <!-- container -->
            <div class="container-fluid">
                <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></spasn>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>


<!-- Be sure to leave the brand out there if you want it shown -->
<a class="brand" href="<?=base_url()?>admin/home">CMS</a>

<!-- Everything you want hidden at 940px or less, place within here -->
<div class="nav-collapse collapse">
    <ul class="nav nav-pills">
        <li  <?=$this->uri->segment(1)=='home' || $this->uri->segment(1)=='' ? 'class="active"' : ''?> ><a href="<?=site_url('home')?>">Dashboard</a></li>
        <li  <?=$this->uri->segment(1)=='registrants'  ? 'class="active"' : ''?> ><a href="<?=site_url('registrants')?>">Registrants</a></li>
        <li  <?=$this->uri->segment(1)=='entries'  ? 'class="active"' : ''?> ><a href="<?=site_url('entries')?>">Entries</a></li>
        <li  <?=$this->uri->segment(1)=='entries'  ? 'class="active"' : ''?> ><a href="<?=site_url('mechanics')?>">Mechanics</a></li>
        <li  <?=$this->uri->segment(1)=='entries'  ? 'class="active"' : ''?> ><a href="<?=site_url('analytics')?>">Analytics</a></li>
        <li  <?=$this->uri->segment(1)=='promoduration'  ? 'class="active"' : ''?> ><a href="<?=site_url('promoduration')?>">Promo Duration</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a tabindex="-1" href="<?=site_url('accounts')?>">CMS User Accounts</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="<?=site_url('myaccount')?>">My Account Settings</a></li>
                <li><a tabindex="-1" href="logout">Logout</a></li>
            </ul>
        </li>
    </ul>
</div>
    </div>
    <!-- /container -->
</div>
</header>

<!-- /header -->

<!-- content -->

<section class="container-fluid">
    <div class="page-header"> <h3><?=$title?><h3> </div>
    <div class="content"><?=$main_content?></div>
</section>

<!-- /content -->

<hr>

<!-- footer -->



<section class="container">

    <p><small>Managed with <a href="http://www.nuworks.ph" target="_blank">NuWorks Interactive Labs, Inc.</a></small></p>

</section>
</body>

</html>
