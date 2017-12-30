
<p class="alert-danger">
    <?php if($this->session->flashdata('signup_failed') == TRUE): ?>

        <?php echo $this->session->flashdata('signup_failed'); ?>

    <?php endif ?>

</p>

<h2>Signup</h2>

<?php $attributes = array('id' => 'signup_form', 'class' => 'form_horizontal'); ?>
<div class="alert-danger">
    <?php if ($this->session->flashdata('su_errors')): ?>

        <?php echo $this->session->flashdata('su_errors'); ?>


    <?php endif; ?>
</div>

<?php echo form_open('users/signup', $attributes); ?>
<!--calls the users controller and its signup method in the action attribute of the form-->
<div class="form-group align-left">

    <?php echo form_label("New Username") . "<br />"; ?>

    <?php $data = array(

        'class' => 'form-control',
        'name' => 'su_username',
        'placeholder' => 'Enter New Username'

    );
    ?>

    <?php echo form_input($data); ?>

</div>
<div class="form-group align-left">

    <?php echo form_label("New Password") . "<br />"; ?>

    <?php $data = array(

        'class' => 'form-control',
        'name' => 'su_password',
        'placeholder' => 'Enter New Password'

    );
    ?>

    <?php echo form_password($data); ?>

</div>

<div class="form-group align-left">

    <?php echo form_label("Confirm New Password") . "<br />"; ?>

    <?php $data = array(

        'class' => 'form-control',
        'name' => 'confirm_su_password',
        'placeholder' => 'Confirm New Password'

    );
    ?>

    <?php echo form_password($data); ?>

</div>

<div class="form-group align-left">

    <?php $data = array(

        'class' => 'btn btn-primary',
        'name' => 'submit',
        'value' => 'Signup'

    );
    ?>

    <?php echo form_submit($data); ?>

</div>

<?php echo form_close(); ?>