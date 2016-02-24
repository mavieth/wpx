<?php
  // This file assumes that you have included the nav walker from https://github.com/twittem/wp-bootstrap-navwalker
  // somewhere in your theme.
  // In Sage function.php file add wp_bootstrap_nav_walker.php to included files:

  // $sage_includes = [
  //   'lib/assets.php',    // Scripts and stylesheets
  //   'lib/extras.php',    // Custom functions
  //   'lib/setup.php',     // Theme setup
  //   'lib/titles.php',    // Page titles
  //   'lib/wrapper.php',                   // Theme wrapper class
  //   'lib/wp_bootstrap_nav_walker.php',   // Theme wrapper class
  //   'lib/customizer.php'                 // Theme customizer
  // ];

?>
<header class="banner navbar navbar-inverse navbar-static-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    </div>

    <nav class="collapse navbar-collapse" role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav navbar-nav']);
      endif;
      ?>
    </nav>
  </div>
</header>