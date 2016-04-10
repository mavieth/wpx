<!-- 
<body class="home-body" id="home-container">
    <div class="card container-fluid">
        <div class="home-content">
            <h1 class="light">Hello<span class="dark">.</span></h1>
            <p class="medium">My name is Michael Vieth and I am a <a class="light" href="#">Web Developer.</a></p>
            <p class="medium">very special honor by large candy.</p>
            <div class="column">
                <h6 class="dark">Stuff</h6><br>
                <h5 class="medium">I have lots of good</h5>
                <h5 class="medium">really skills</h5>
            </div>
            <div class="column">
                <h6 class="dark">Things</h6><br>
                <h5 class="medium">Skills dont do good</h5>
                <h5 class="medium">slick fonts</h5>
            </div>
            
    </div>
</body> -->

<?php the_content(); ?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3>What I Do</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>        
    </div>
</div>

<?php  $count_posts = wp_count_posts( 'project' )->publish; ?>
    <div class="row facts-row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3>Facts &amp; Figures About The Event</h3>
        <div class="facts-counter">
            <div class="col-md-3 col-sm-6 col-xs-6">
                <strong class="icons-wrap"><i class="icon-group2"></i></strong>
                <div class="kf_counter">
                    <strong class="counter"><?php print_r($count_posts); ?></strong> <span>Websites</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <strong class="icons-wrap"><i class="icon-file942"></i></strong>
                <div class="kf_counter">
                    <strong class="counter"><?php print_r($count_posts); ?></strong> <span>Tools</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <strong class="icons-wrap"><i class="icon-child132"></i></strong>
                <div class="kf_counter">
                    <strong class="counter">145</strong> <span>Sponsor</span>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <strong class="icons-wrap"><i class="icon-international122"></i></strong>
                <div class="kf_counter">
                    <strong class="counter">24</strong> <span>Countries</span>
                </div>
            </div>
        </div><!-- Kode-Fatcs -Counterup End -->
    </div>
    </div>
</div>

<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
