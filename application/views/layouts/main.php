<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PlayU</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tether.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/tether.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-primary">

    <div id="collapse-navbar">
        <a class="navbar-brand" href="<?php echo base_url(); ?>home"><img id="logo" src="<?php echo base_url(); ?>/assets/img/test_logo_48dp.png">PlayU</a>
        <a class="nav-link active" href="<?php echo base_url(); ?>home">Home <span class="sr-only">(current)</span></a>

        <a class="nav-link" href="<?php echo base_url(); ?>users/register">Signup</a>

        <a class="nav-link" href="<?php echo base_url(); ?>app/playlist">App</a>
    </div>

</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-lg-3 center" id="login-col">

            <?php $this->load->view('users/login_view'); ?>

        </div>
        <div class="col-sm-9 col-lg-9 center" id="main-col">


            <?php $this->load->view($main); ?>

        </div>
    </div>


</div>

<script src="<?php echo base_url(); ?>assets/js/mq-fix.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

</body>
</html>