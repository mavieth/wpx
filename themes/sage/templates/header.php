<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css">

<div class='cssload-loader-wrapper'>
  <div class='cssload-loader'>
    <div class='cssload-inner cssload-one'></div>
    <div class='cssload-inner cssload-two'></div>
    <div class='cssload-inner cssload-three'></div>
  </div>
</div>


<header class="banner navbar navbar-inverse navbar-static-top" role="banner">
  <ul id="color-bars" class="group">
    <li id="color-1"></li>
    <li id="color-2"></li>
    <li id="color-3"></li>
    <li id="color-4"></li>
    <li id="color-5"></li>
    <li id="color-6"></li>
  </ul>
  <div class="container-fluid">
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
      <div class="col-md-4 search-container pull-right">
          <form class="searchbox">
              <input type="search" placeholder="Search..." name="search" class="searchbox-input" onkeyup="buttonUp();" required>
              <input type="submit" class="searchbox-submit" value="Go">
              <span class="searchbox-icon"><i class="fa fa-search"></i></span>

          </form>
      </div>
    </nav>
    
  </div>
</header>

