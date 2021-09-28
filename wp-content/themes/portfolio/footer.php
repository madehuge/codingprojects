<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage galussothemes
 * @since galussothemes 1.0
 */
?>
		</div><!-- .site-content -->
	</div><!-- .site-inner -->
	    <!-- footer -->
    <div id="main-footer" class="main-footer">

    	<div class="container">
	        <!-- 1/4 -->
	        <div class="four columns footer1">
	            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-1-widget') ) ?>
	        </div>
	        <!-- /End 1/4 -->
	        <!-- 2/4 -->
	        <div class="four columns footer2">
	            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-2-widget') ) ?>
	        </div>
	        <!-- /End 2/4 -->
	        <!-- 3/4 -->
	        <div class="four columns footer3">
	            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-3-widget') ) ?>
	        </div>
	        <!-- /End 3/4 -->
	        <!-- 4/4 -->
	        <div class="four columns footer4">
	            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-4-widget') ) ?>
	        </div>
	        <!-- /End 4/4 -->
	    </div>
    </div>
    <!-- /End Footer -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php
				{
				?>
				<div class="footer-custom-code">
						<?php
						dynamic_sidebar('custom-footer');
						?>	
				</div>
				<?php	
				}
			?>
			<div class="site-info container">
				<?php
					/**
					 * Fires before the galussothemes footer text for footer customization.
					 *
					 * @since galussothemes 1.0
					 */
					do_action( 'galussothemes_credits' );
				?>
				<div class="et-footer">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('copyright-widget') ) ?>
			    </div>
			</div><!-- .site-info -->

			
		</footer><!-- .site-footer -->
<?php wp_footer(); ?>
</div><!-- .site -->
</body>
</html>
