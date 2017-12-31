<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users View</title>
</head>
<body>
<?php if ($this->session->userdata('logged_in') === true): ?>
    <p class="alert-success">
        <?php if ($this->session->flashdata('login_success') == TRUE): ?>

            <?php echo $this->session->flashdata('login_success'); ?>

        <?php endif ?>

    </p>
    <p class="alert-danger">
        <?php if ($this->session->flashdata('login_failed') == TRUE): ?>

            <?php echo $this->session->flashdata('login_failed'); ?>

        <?php endif ?>

    </p>

    <h2>Welcome to <b>PlayU</b></h2>
    <section class="center" id="yt_video_form_wrap">
        <?php $attributes = array('id' => 'yt_video_form', 'class' => 'form_horizontal'); ?>
        <?php echo form_open('app/video', $attributes); ?>
        <!--calls the users controller and its signup method in the action attribute of the form-->
        <div class="form-group align-left">

            <!--    --><?php //echo form_label("Youtube Video URL") . "<br />"; ?>

            <?php $data = array(

                'class' => 'form-control',
                'id' => 'yt_video',
                'name' => 'yt_url',
                'placeholder' => 'Enter a Youtube Video URL'

            );
            ?>

            <?php echo form_input($data); ?>

        </div>

        <div class="form-group align-left">

            <?php $data = array(

                'class' => 'btn btn-primary',
                'name' => 'submit',
                'value' => 'Add'

            );
            ?>

            <?php echo form_submit($data); ?>

        </div>

        <?php echo form_close(); ?>
    </section>
    <div id="just-added">
        <?php if ($this->session->flashdata('video_title')): ?>
            <?php echo "<p class='text-info'>You just added:</p>" ?>
            <?php echo "<p class='text-info'>" . $this->session->flashdata('video_title') . "</p>"; ?>
        <?php endif ?>
    </div>
    <section id="user_features">
        <button id="single_user_enable" class="btn btn-outline-info">Enable Single User Mode</button>
<!--        <button id="single_user_disable" class="btn btn-outline-danger">Disable Single User Mode</button>-->
        <button id="stop_audio" class="btn btn-danger">Stop Audio</button>
        <div id="info">

            <p class="text-info">This enables audio reproduction in your own browser.<br/> Other connected users may change still change the order of tracks</p>
            <p class="text-danger">Do not enable this if there's and admin playing audio in your office or party</p>
        </div>
    </section>
    <section id="user_video_section">
        <iframe id="myVideo" width="420" height="315"
                src="">
            <!--            --><?php //echo $this->session->flashdata('video_src'); ?>
        </iframe>

    </section>
    <section id="playlist">
        <div class="video_row" id="row_title"><span>Rank</span><span>Title</span><span>Source</span><span
                    class="count-span"><span>Votes</span><span>Up || Dw</span></span></div>

    </section>

<?php else:
    echo "<h2>Please Login or Signup to see this page</h2>"
    ?>

<?php endif ?>
<script src="<?php echo base_url(); ?>assets/js/user_playlist.js"></script>
</body>
</html>