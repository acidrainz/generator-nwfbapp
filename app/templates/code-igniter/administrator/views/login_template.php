<!DOCTYPE html>
<html>
<head>

    <title>Login </title>
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
    <!--[if lt IE 9]><script src="<?=base_url()?>js/admin/html5.js"></script><![endif]-->

    <!-- css -->

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>fonts/admin/fonts.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>fonts/admin/font-awesome.min.css" />
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="<?=base_url()?>fonts/admin/font-awesome-ie7.min.css" /><![endif]-->
    <link href="<?=base_url()?>css/admin/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?=base_url()?>css/admin/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>css/admin/mystyle.css" />
</head>

<body>

<!-- content -->
<section class="container-fluid">
    <div class="login-content">
        <div class="page-header">
            <h1>Login</h1>
        </div>

        <?php if(!empty($error_msg)) { echo '<div class="alert alert-error">'.$error_msg.'</div>'; } ?>

        <form class="form-vertical" method="post">
            <div class="control-group">
                <label class="control-label" for="username">Username</label>
                <div class="controls">
                    <div class="row-fluid">
                        <input type="text" class="span12" id="username" name="username" autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                    <div class="row-fluid">
                        <input type="password" class="span12" id="password" name="password">
                    </div>
                </div>
            </div>

            <div class="control-group">
                <div class="controls">
                    <button name="submit" value="login" class="btn btn-inverse">Login</button>
                </div>
            </div>

        </form>
    </div>
</section>

<!-- /content -->



<!-- Javascript

================================================== -->

<!-- Placed at the end of the document so the pages load faster -->
<script src="<?=base_url()?>plugins/jquery-ui/js/jquery-1.9.0.js"></script>
<script src="<?=base_url()?>js/admin/bootstrap.min.js"></script>
<script src="<?=base_url()?>js/admin/custom.js"></script>
</body>

</html>