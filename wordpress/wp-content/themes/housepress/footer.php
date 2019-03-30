<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package housepress
 */

?>

	</div><!-- #row -->
	</div><!-- #content -->

</div><!-- #page -->



<footer>
	<section class="footer-info">
		<div class="container">

			<div class="pull-left float-right"> <?php echo __('Copyright ','housepress');  echo bloginfo(); ?> <?php echo esc_attr(date("Y")); ?>. 
			<?php echo __('All Rights Reserved.','housepress'); ?> | <?php echo __('Design by :','housepress'); ?> <a href="https://phantomthemes.com"><?php echo __('Phantom Themes','housepress'); ?> </a></div>
			<div class="pull-right float-right">
				<?php 
					wp_nav_menu( 
						array( 
							'theme_location' => 'secondary',
							'menu_id' => 'secondary-menu',
							'fallback_cb' => 'housepress_wp_nav_default_secondary_menu' 
						) ); 
				?>
    	    </div>
	</section>


		</footer>



<?php wp_footer(); ?>

</body>
</html>
