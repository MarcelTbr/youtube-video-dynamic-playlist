<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Play_U</title>
</head>
<body>
<p class="alert-success">
    <?php if($this->session->flashdata('login_success') == TRUE): ?>

        <?php echo $this->session->flashdata('login_success'); ?>

    <?php endif ?>

</p>
<p class="alert-danger">
    <?php if($this->session->flashdata('login_failed') == TRUE): ?>

        <?php echo $this->session->flashdata('login_failed'); ?>

    <?php endif ?>

</p>
	<h2>Welcome to <b>Play_U</b></h2>
</body>
</html>
