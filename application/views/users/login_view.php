<?php if ($this->session->userdata('logged_in')):?>


<h2>Logout</h2>

    <?php echo form_open('users/logout'); ?>

    <?php if($this->session->userdata('username')): ?>

        <?php echo "<br />You are logged in as <b>" . $this->session->userdata('username') . "</b><br /><br />"; ?>

    <?php endif ; ?>

    <?php
    $data = array(

            'class' => 'btn btn-primary',
            'name' => 'submit',
            'value' => 'Logout'

    );

    echo form_submit($data);


    ?>


    <?php echo form_close(); ?>

<?php else: ?>
    <h2>Login</h2>

    <?php $attributes = array('id' => 'login_form', 'class' => 'form_horizontal'); ?>
    <div class="alert-danger">
        <?php if ($this->session->flashdata('errors')): ?>

            <?php echo $this->session->flashdata('errors'); ?>


        <?php endif; ?>
    </div>

    <?php echo form_open('users/login', $attributes); ?>
    <!--calls the users controller and its login method in the action attribute of the form-->
    <div class="form-group align-left">

        <?php echo form_label("Username") . "<br />"; ?>

        <?php $data = array(

            'class' => 'form-control',
            'name' => 'username',
            'placeholder' => 'Enter Username'

        );
        ?>

        <?php echo form_input($data); ?>

    </div>
    <div class="form-group align-left">

        <?php echo form_label("Password") . "<br />"; ?>

        <?php $data = array(

            'class' => 'form-control',
            'name' => 'password',
            'placeholder' => 'Enter Password'

        );
        ?>

        <?php echo form_password($data); ?>

    </div>

    <div class="form-group align-left">

        <?php echo form_label("Confirm Password") . "<br />"; ?>

        <?php $data = array(

            'class' => 'form-control',
            'name' => 'confirm_password',
            'placeholder' => 'Confirm Password'

        );
        ?>

        <?php echo form_password($data); ?>

    </div>

    <div class="form-group align-left">

        <?php $data = array(

            'class' => 'btn btn-primary',
            'name' => 'submit',
            'value' => 'Login'

        );
        ?>

        <?php echo form_submit($data); ?>

    </div>

    <?php echo form_close(); ?>


<? endif; ?>