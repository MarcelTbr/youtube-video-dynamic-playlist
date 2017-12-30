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

<h2><?php
    echo "This is the home view"; ?></h2>
