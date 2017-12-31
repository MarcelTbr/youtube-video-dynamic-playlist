<p class="alert-danger">
    <?php if ($this->session->flashdata('login_failed') == TRUE): ?>

        <?php echo $this->session->flashdata('login_failed'); ?>

    <?php endif ?>

</p>

<h2><?php echo "What is PlayU?"; ?></h2>
<div class="lighter-text" id="what-is">
<br/>
<p>An online jukebox</p>
<p>A collaborative track-list maker</p>
<p>A DJ-request machine at the tip of your fingers</p>
<p>A nicer way to hear music in the office or at a house-party</p>
<br/>
</div>
<h2>How to use it?</h2>
<div class="lighter-text">
<br/>
<p>Signup or Login with your account</p>
<p>Copy-paste a youtube video url in the text-field</p>
<p>Click 'Add' and put it in the list with an initial value of '0 votes'</p>
<p>Upvote your favorite tracks and downvote the boring stuff (and yes, you can have negative votes)</p>
<p>Feel like a child requesting songs on the radio <3</p>
</div>