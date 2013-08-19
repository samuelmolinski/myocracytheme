			<footer class="footer" role="contentinfo">
				<div id="inner-footer" class="wrap clearfix">		
					<div class="strip clearfix">			
						
						<?php if ( is_active_sidebar( 'footer1' ) ) { ?>

							<?php dynamic_sidebar( 'footer1' ); ?>

						<?php } ?>
						<nav role="navigation">
	    					<?php bones_footer_links(); ?>
		                </nav>
		                <div class="share42init" data-url="<?php the_permalink() ?>" data-title="<?php the_title() ?>"></div>

						<p class="clearfix source-org copyright">all rights reserved &copy; <?php echo date('Y'); ?> myocracy.org</p>					
				
					</div> 
				</div><!-- end #inner-footer -->
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
		
		<!-- all js scripts are loaded in library/bones.php -->
		<?php wp_footer(); ?>
		<!--<script type="text/javascript" src="http://site.name/share42/share42.js"></script>-->
	</body>

</html> <!-- end page. what a ride! -->