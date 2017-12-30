<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Play_U</title>
</head>
<body>
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
<button id="get_songs" class="btn btn-danger">Get Songs</button>

<?php echo "<p>" . $this->session->flashdata('video_title') . "</p>"; ?>

<section id="video_section">
    <iframe id="myVideo" width="420" height="315"
            src="<?php echo $this->session->flashdata('video_src'); ?>">
    </iframe>

</section>
<section id="playlist">
    <div class="video_row" id="row_title"><span>Rank</span><span>Title</span><span>Source</span><span class="count-span"><span>Votes</span><span>Up || Dw</span></span></div>

</section>
<script src="<?php echo base_url(); ?>assets/js/playlist.js"></script>
</body>
</html>
