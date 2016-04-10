
<?php if (is_post_type_archive( 'project') ): ?><!-- Project Post Type -->

	<a href="<?php the_permalink(); ?>">
	<article <?php post_class(); ?>>
	  <header>

	  	  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 nopadding article-box">
		  	<figure class="imghvr-shutter-in-out-horiz">
		  	    	<?php the_post_thumbnail('large', array('class' => 'img img-responsive img-project')); ?>
		  	    <figcaption>
		  	    	<h4 style="margin-top: 20px"><?php the_title(); ?></h4>
		  	    	<hr style="padding: 0px; margin: 0px; margin-bottom: 10px;">
		  	    	<?php echo get_field('short_desc'); ?>

		  	    	<h4 style="margin-top: 20px">Project Tools</h4>
		  	    	<hr style="padding: 0px; margin: 0px; margin-bottom: 10px;">
		  	    	<?php get_template_part('templates/icons'); ?>

		  	    </figcaption>
		  	</figure>    
	  	  </div>
	  </header>
	  <div class="entry-summary"></div>
	</article>	
	</a>
	


<?php elseif (is_post_type_archive( 'tutorial') ): ?><!-- Tutorial Post Type -->
	
	<article <?php post_class(); ?>>
	  <header>
	    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	    <?php get_template_part('templates/entry-meta'); ?>
	  </header>
	  <div class="entry-summary">
	    <?php the_excerpt(); ?>
	  </div>
	</article>	

<?php else: ?>	<!-- Normal Post Type -->
	
	<article <?php post_class(); ?>>
	  <header>
	    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	    <?php get_template_part('templates/entry-meta'); ?>
	  </header>
	  <div class="entry-summary">
	    <?php the_excerpt(); ?>
	  </div>
	</article>

<?php endif ?>

