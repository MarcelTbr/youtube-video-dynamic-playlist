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
<nav class="navbar navbar-expand-lg navbar-light bg-primary">
<!--    class="navbar-brand"-->

<!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
<!--        <span class="navbar-toggler-icon"></span>-->
<!--    </button>-->

<!--    <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
<!--        <ul class="navbar-nav mr-auto" id="collapse-navbar">-->
<!--            <li class="nav-item active">-->
        <div id="collapse-navbar">
            <a  class="navbar-brand"href="<?php echo base_url(); ?>/home">PlayU</a>
                <a class="nav-link active" href="<?php echo base_url(); ?>/home">Home <span class="sr-only">(current)</span></a>
<!--            </li>-->
<!--            <li class="nav-item">-->
                <a class="nav-link" href="<?php echo base_url(); ?>/users/register">Signup</a>
<!--            </li>-->
<!--            <li class="nav-item">-->
                <a class="nav-link disabled" href="#">App</a>
        </div>
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
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

</body>
</html>