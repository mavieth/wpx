<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?>
        <small class="pull-right">
          <?php get_template_part('templates/entry-meta-project'); ?>
        </small>
    </h1>
      
    </header>
    <?php  
    $start = get_field('start_date');
    $end = get_field('end_date');
    $starty = substr($start, 0, 4);
    $startm = substr($start, 4, 2);
    $startd = substr($start, 6, 2);
    $endy = substr($end, 0, 4);
    $endm = substr($end, 4, 2);
    $endd = substr($end, 6, 2);
    $a = strtotime("{$startd}-{$startm}-{$starty}");
    $b = strtotime("{$endd}-{$endm}-{$endy}");

    if ($b == "January 1970") {
      $final = date('F Y', $a) . " - " . "Current";
    } else {
      $final = date('F Y', $a) . " - " . date('F Y', $b);
    }
    ?>

    <style type="text/css">.iScreen {background: url("<?php echo the_post_thumbnail_url('full', array('class' => 'center-block img img-responsive single-project')); ?>");background-size: cover;}</style>

    <div class="entry-content">
      <h3>Overview <small class="pull-right"><?php echo $final ?></small></h3>

      <hr>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <?php the_content(); ?>  

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class='macbook'>
            <div class='screen'>
              <div class='browser'>
                <div class='toolbar'>
                  <div class='row_one'>
                    <div class='dot'></div>
                    <div class='dot'></div>
                    <div class='dot'></div>
                  </div>
                  <div class='row_two'>
                    <div class='nav'>
                      <div class='prev'>&laquo;</div>
                      <div class='next'>&raquo;</div>
                    </div>
                    <div class='address_bar'>
                      
                      <?php echo get_field('url'); ?>
                    </div>
                    <div class='search_bar'></div>
                  </div>
                </div>
                <div class='content'>
                  <iframe class='frame' height='100%' src='<?php echo get_field('url'); ?>' width='100%'></iframe>
                </div>
              </div>
            </div>
            <div class='mac-body'></div>
          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 center-block">
          <a href='<?php echo get_field('url'); ?>'><button type="button" class="btn btn-primary btn-lg" target="_blank">Visit <?php the_title(); ?></button></a>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="iPhone">
            <div class="iPhoneInner">
              <div class="camera"></div>
              <div class="smallTopCirc"></div>
              <div class="oval"></div>
              <div class="iScreen">
                <div class="usman">
                <img src="http://img4.wikia.nocookie.net/__cb20101110140759/headhuntersholosuite/images/6/6d/Starfleet_logo.png" />
                </div>
              </div>
              <div class="circButton"></div>
            </div>
          </div>

        </div>
      </div>
      <?php
      echo "<h3>Tools</h3>";
      echo "<hr>";


      ?>
      <?php get_template_part('templates/icons'); ?>
      <div class="row"></div>
      <?php
      $location = get_field('location');
      if( ! empty($location) ): ?>
      <h3>Location</h3>
      <hr>

      <div id="view1">
        <div id="map" style="width: 100%; height: 350px;" class="pull-left"></div>  
        <script src='http://maps.googleapis.com/maps/api/js?sensor=false' type='text/javascript'></script>

        <script type="text/javascript">
        //<![CDATA[
        function load() {
          var lat = <?php echo $location['lat']; ?>;
          var lng = <?php echo $location['lng']; ?>;
          // coordinates to latLng
          var latlng = new google.maps.LatLng(lat, lng);
          // map Options
          var myOptions = {
          zoom: 15,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          styles: [{"elementType":"geometry","stylers":[{"hue":"#ff4400"},{"saturation":-68},{"lightness":-4},{"gamma":0.72}]},{"featureType":"road","elementType":"labels.icon"},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"hue":"#0077ff"},{"gamma":3.1}]},{"featureType":"water","stylers":[{"hue":"#00ccff"},{"gamma":0.44},{"saturation":-33}]},{"featureType":"poi.park","stylers":[{"hue":"#44ff00"},{"saturation":-23}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"hue":"#007fff"},{"gamma":0.77},{"saturation":65},{"lightness":99}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"gamma":0.11},{"weight":5.6},{"saturation":99},{"hue":"#0091ff"},{"lightness":-86}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"lightness":-48},{"hue":"#ff5e00"},{"gamma":1.2},{"saturation":-23}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"saturation":-64},{"hue":"#ff9100"},{"lightness":16},{"gamma":0.47},{"weight":2.7}]}],
          };
          //draw a map
          var map = new google.maps.Map(document.getElementById("map"), myOptions);
          var marker = new google.maps.Marker({
          position: map.getCenter(),
          map: map
        });
        }
        // call the function
        load();
        //]]>
        </script>
      <?php endif; ?> 


    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
  </article>
<?php endwhile; ?>
