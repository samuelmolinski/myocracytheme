			<footer class="footer" role="contentinfo">
				<div id="inner-footer" class="wrap clearfix">		
					<div class="strip clearfix">			
						
						<?php if ( is_active_sidebar( 'footer1' ) ) { ?>

							<?php dynamic_sidebar( 'footer1' ); ?>

						<?php } ?>
						<nav role="navigation">
	    					<?php bones_footer_links(); ?>
		                </nav>
		                		
						<p class="clearfix source-org copyright">all rights reserved &copy; <?php echo date('Y'); ?> myocracy.org</p>					
				
					</div> 
				</div><!-- end #inner-footer -->
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
		
		<!-- all js scripts are loaded in library/bones.php -->
		<?php wp_footer(); ?>

	</body>

</html> <!-- end page. what a ride! -->