<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
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

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-lg-3 center" id="login-col">

            <?php $this->load->view('users/login_view'); ?>

        </div>
        <div class="col-sm-9 col-lg-9 center">


            <?php $this->load->view($main); ?>

        </div>
    </div>


</div>

</body>
</html>