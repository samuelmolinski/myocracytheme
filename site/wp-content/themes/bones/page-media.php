<?php
/*
Template Name: Media
*/
if($cat){	
	$cat = array(
		array(
			'taxonomy' => 'current_video_cat',
			'field' => 'slug',
			'terms' => array(explode(',',$cat))
		));
} else {
	$cat = array();
}

$args = array( 
	'post_type' => 'video_type', 
	'posts_per_page' => 10, 
	'page'=> $page,
	'tax_query' => $cat
);

$loop = new WP_Query( $args );

$featuredVideos = get_featured_posts('video_type', 3);
//d($featuredVideos);
?>

<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix">
			
				    <div id="main" class="twelvecol first clearfix" role="main">
				    	

				    	<?php echo videoSearch(); ?>

						<div class="matte">
				    	<?php  ?>
				    	<div class="flexslider mediaSlider">
							<ul class="slides">
								<?php foreach ($featuredVideos->posts as $key => $value) {
									//d($value);
									global $mb_blogDeVideo;
									$mb_blogDeVideo->the_meta($value->ID);
									$meta = $mb_blogDeVideo->meta;
									//d($meta);
									$url = youtubeVideoURL(getVideoCode($meta['videoURL']));

									echo '<li class="slide lvl-1">';
									echo "<iframe class='youtube_iframe' src='$url' frameborder='0' allowfullscreen></iframe>";
									echo "<div class='metabox clearfix'><h2>".$value->post_title."</h2>";
									echo "<div class='content'>".$value->post_content."</div>";
									echo '</div></li>';
								  } ?>
							</ul>
							<script type="text/javascript">
							jQuery(document).ready(function($){
								log("init slider")
								jQuery('.flexslider').flexslider({
									animation: "fade",
									//animationLoop: true,
									slideshow: true,
									directionNav: true,
									touch: true,
									keyboard: true,
									controlNav: false
									//start: function(){resizeQueue();}
								});
							});
								
							</script>
						</div>

					    <?php if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); 

					    		global $mb_blogDeVideo;
								$mb_blogDeVideo->the_meta($post->ID);
								$meta = $mb_blogDeVideo->meta;
					    ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
						    <header class="article-header">
						
						    </header> <!-- end article header -->
					
						    <section class="entry-content clearfix">
						    	<section class="entry-content">
							    <div class="zilla-one-half video-wrap clearfix"><iframe class="youtube_iframe" src="<?php echo youtubeVideoURL(getVideoCode($meta['videoURL'])); ?>" frameborder="0" allowfullscreen></iframe></div>
								<div class="zilla-one-half zilla-column-last clearfix"><span class="h1"><?php the_title(); ?></span><?php the_content(); ?>
		    						<div class="clearfix share">
										<a href="#" class="share-icon facebook">f</a>
										<a href="#" class="share-icon twtter">t</a>
									</div></div><div class="clear"></div>
						    </section>
							    
						    </section> <!-- end article section -->
						
						    <footer class="article-footer">
							    <p class="clearfix"><?php the_tags('<span class="tags">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?></p>
							
						    </footer> <!-- end article footer -->
					
					    </article> <!-- end article -->
					
					    <?php endwhile; ?>	
					
					    <?php else : ?>
					
        					<article id="post-not-found" class="hentry clearfix">
        					    <header class="article-header">
        						    <h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
        						</header>
        					    <section class="entry-content">
        						    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
        						</section>
        						<footer class="article-footer">
        						    <p><?php _e("This is the error message in the page-custom.php template.", "bonestheme"); ?></p>
        						</footer>
        					</article>
					
					    <?php endif; ?>
						</div>
				    </div> <!-- end #main -->
    
				    <?php //get_sidebar(); ?>
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
