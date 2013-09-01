<?php

	//d($mb_candidate_search); 
	$cp_meta = $mb_candidate_search->the_meta();
	//$cp_meta = $cp_meta[0];
	//d($cp_meta);

	$args = array(
		'post_status'=>'publish',
		'tax_query' => array(
				array(
					'taxonomy' => 'current_issues_cat',
					'field' => 'slug',
					'terms' => array( 'civil-rights' )
				)
			)
		);
	$civil_rights = new WP_Query( $args );
	$args = array(
		'post_status'=>'publish',
		'tax_query' => array(
				array(
					'taxonomy' => 'current_issues_cat',
					'field' => 'slug',
					'terms' => array( 'education' )
				)
			)
		);
	$education = new WP_Query( $args );
	$args = array(
		'post_status'=>'publish',
		'tax_query' => array(
				array(
					'taxonomy' => 'current_issues_cat',
					'field' => 'slug',
					'terms' => array( 'immigration' )
				)
			)
		);
	$immigration = new WP_Query( $args );
	$args = array(
		'post_status'=>'publish',
		'tax_query' => array(
				array(
					'taxonomy' => 'current_issues_cat',
					'field' => 'slug',
					'terms' => array( 'economy' )
				)
			)
		);
	$economy = new WP_Query( $args );
	$args = array(
		'post_status'=>'publish',
		'tax_query' => array(
				array(
					'taxonomy' => 'current_issues_cat',
					'field' => 'slug',
					'terms' => array( 'criminal-justice' )
				)
			)
		);
	$criminal_justice = new WP_Query( $args );
	$args = array(
		'post_status'=>'publish',
		'tax_query' => array(
				array(
					'taxonomy' => 'current_issues_cat',
					'field' => 'slug',
					'terms' => array( 'energy' )
				)
			)
		);
	$energy = new WP_Query( $args );
	//d($civil_rights->posts);

?>
<form method="post" id="um_form_extras" class="NiceIt" onsubmit="<!-- umInsertUser(this);return false; -->" action="<?php the_permalink() ?>" enctype="multipart/form-data">
<div class="advanceSearch clearfix">
	<div class="slide clearfix">
		<div class="fullwidth">
			<div class="threecol first clearfix">					
				<h3 class="slide-title">SELECT EXTRAS</h3>
				<div class="slide-content">					
					<div class="um_field_container ">
						<select name="office_sought" id="um_field_12_extras" class="um_field_12 um_input " >
							<option value="" selected="selected">Office Sought</option>
							<option value="State Senate">State Senate</option>
							<option value="US Senate">US Senate</option>
							<option value="State House of Representatives (of Delegates or State Assembly)">State House of Representatives (of Delegates or State Assembly)</option>
							<option value="US House of Representatives">US House of Representatives</option>
							<option value="President">President</option>
							<option value="Vice President">Vice President</option>
							<option value="Governor">Governor</option>
							<option value="Lieutenant Governor">Lieutenant Governor</option>
							<option value="Attorney General">Attorney General</option>
							<option value="Judge">Judge</option>
						</select>  
					</div>
					<div class="um_field_container ">
						<select name="state" id="um_field_13_extras" class="um_field_13 um_input " >
							<option value="" selected="selected">State</option>
							<option value="Alabama">Alabama</option>
							<option value="Alaska">Alaska</option>
							<option value="American Samoa">American Samoa</option>
							<option value="Arizona">Arizona</option>
							<option value="Arkansas">Arkansas</option>
							<option value="California">California</option>
							<option value="Colorado">Colorado</option>
							<option value="Connecticut">Connecticut</option>
							<option value="Delaware">Delaware</option>
							<option value="District of Columbia">District of Columbia</option>
							<option value="Florida">Florida</option>
							<option value="Georgia">Georgia</option>
							<option value="Guam">Guam</option>
							<option value="Hawaii">Hawaii</option>
							<option value="Idaho">Idaho</option>
							<option value="Illinois">Illinois</option>
							<option value="Indiana">Indiana</option>
							<option value="Iowa">Iowa</option>
							<option value="Kansas">Kansas</option>
							<option value="Kentucky">Kentucky</option>
							<option value="Louisiana">Louisiana</option>
							<option value="Maine">Maine</option>
							<option value="Maryland">Maryland</option>
							<option value="Massachusetts">Massachusetts</option>
							<option value="Michigan">Michigan</option>
							<option value="Minnesota">Minnesota</option>
							<option value="Mississippi">Mississippi</option>
							<option value="Missouri">Missouri</option>
							<option value="Montana">Montana</option>
							<option value="Nebraska">Nebraska</option>
							<option value="Nevada">Nevada</option>
							<option value="New Hampshire">New Hampshire</option>
							<option value="New Jersey">New Jersey</option>
							<option value="New Mexico">New Mexico</option>
							<option value="New York">New York</option>
							<option value="North Carolina">North Carolina</option>
							<option value="North Dakota">North Dakota</option>
							<option value="Northern Marianas Islands">Northern Marianas Islands</option>
							<option value="Ohio">Ohio</option>
							<option value="Oklahoma">Oklahoma</option>
							<option value="Oregon">Oregon</option>
							<option value="Pennsylvania">Pennsylvania</option>
							<option value="Puerto Rico">Puerto Rico</option>
							<option value="Rhode Island">Rhode Island</option>
							<option value="South Carolina">South Carolina</option>
							<option value="South Dakota">South Dakota</option>
							<option value="Tennessee">Tennessee</option>
							<option value="Texas">Texas</option>
							<option value="Utah">Utah</option>
							<option value="Vermont">Vermont</option>
							<option value="Virginia">Virginia</option>
							<option value="Virgin Islands">Virgin Islands</option>
							<option value="Washington">Washington</option>
							<option value="West Virginia">West Virginia</option>
							<option value="Wisconsin">Wisconsin</option>
							<option value="Wyoming">Wyoming</option>
						</select>  
					</div>
					<div class="um_field_container ">
						<select name="political_party" id="um_field_11_extras" class="um_field_11 um_input " >
							<option value="" selected="selected">Political Party</option>
							<option value="Democrat">Democrat</option>
							<option value="Green Party">Green Party</option>
							<option value="Independent">Independent</option>
							<option value="Republican">Republican</option>
							<option value="Libertarian">Libertarian</option>
						</select>  
					</div>
					<div class="um_field_container "> 
						<select name="incumbent" id="um_field_14_extras" class="um_field_11 um_input ">
							<option value="" selected="selected">Incumbent</option>
							<option value="No">No</option>
							<option value="Yes">Yes</option>
						</select> 
						<div class="um_clear"></div>
					</div>
				</div>
			</div>
			<div class="sixcol clearfix">		
				<h3 class="slide-title">SELECT ISSUES</h3>
				<div class="slide-content">	
					<div class="um_field_container ">
						<select name="civil_right" id="" class="um_input " >								
							<option value="" selected="selected">civil rights</option>
							<?php 
								foreach ($civil_rights->posts as $post) {
									echo "<option value='{$post->ID}'>{$post->post_title}</option>";
								}
							?>
						</select>    
						<select name="education" id="" class="um_input ">								
							<option value="" selected="selected">education</option>
							<?php 
								foreach ($education->posts as $post) {
									echo "<option value='{$post->ID}'>{$post->post_title}</option>";
								}
							?>
						</select>  
						<select name="immigration" id="" class="um_input ">								
							<option value="" selected="selected">immigration</option>
							<?php 
								foreach ($immigration->posts as $post) {
									echo "<option value='{$post->ID}'>{$post->post_title}</option>";
								}
							?>
						</select>  
						<select name="economy" id="" class="um_input ">								
							<option value="" selected="selected">economy</option>
							<?php 
								foreach ($economy->posts as $post) {
									echo "<option value='{$post->ID}'>{$post->post_title}</option>";
								}
							?>
						</select>  
						<select name="criminal_justice" id="" class="um_input ">								
							<option value="" selected="selected">criminal justice</option>
							<?php 
								foreach ($criminal_justice->posts as $post) {
									echo "<option value='{$post->ID}'>{$post->post_title}</option>";
								}
							?>
						</select>  
						<select name="energy" id="" class="um_input ">								
							<option value="" selected="selected">enegry</option>
							<?php 
								foreach ($energy->posts as $post) {
									echo "<option value='{$post->ID}'>{$post->post_title}</option>";
								}
							?>
						</select>  
					</div>
				</div>
			</div>
			<div class="threecol clearfix">		
				<h3 class="slide-title">ENTER NAME</h3>
				<div class="slide-content">
					<input type="text" name="candidate_name" placeholder="e.g George Washington"/>
					<input type="submit" class="btn btn-submit" value="FIND CANDIDATE" />
				</div>
			</div>
		</div>	
	</div>
</div>
<div class="flexslider">
	<ul class="slides">
	<?php 
	foreach ($cp_meta['slide'] as $key => $slide) {
		//d($slide['slideType']);
		if($slide['slideType']=='statement') { ?>
		<li class="slide lvl-1">
			<h3 class="slide-title"><?php echo $slide['title'] ?></h3>
			<div class="slide-content"><?php echo $slide['content'] ?></div>
			<div class="slide-controls">
				<a href="#" class="btn btn-slider-back">◄ <?php echo $slide['btn-back'] ?></a>
				<a href="#" class="btn btn-slider-next"><?php echo $slide['btn-next'] ?> ►</a>
			</div>
		</li>
		<?php
		} else if($slide['slideType']=='choice') { ?>
		<li class="slide lvl-3">
			<h3 class="slide-title"><?php echo $slide['title'] ?></h3>
			<div class="slide-content"><?php echo $slide['content'] ?></div>
			<div class="slide-controls">
				<input type="hidden" value="false" name="<?php echo $slide['topic-code'] ?>" id="topic-code-<?php echo $slide['topic-code'] ?>"/>
				<a href="#" class="btn btn-slider-back">◄ <?php echo $slide['btn-back'] ?></a>
				<a href="#" class="btn btn-slider-agree"><?php echo $slide['btn-agree'] ?> ►</a>
				<a href="#" class="btn btn-slider-disagree"><?php echo $slide['btn-disagree'] ?> ►</a>
				<a href="#" class="btn btn-slider-skip"><?php echo $slide['btn-skip'] ?></a>
			</div>
		</li>
		<?php
		} else if($slide['slideType']=='process') { ?>
		<li class="slide lvl-1">
			<h3 class="slide-title"><?php echo $slide['title'] ?></h3>
			<div class="slide-content"><?php echo $slide['content'] ?></div>
			<div class="slide-controls">
				<a href="#" class="btn btn-slider-back">◄ <?php echo $slide['btn-back'] ?></a>
				<a href="#" class="btn btn-slider-process"><?php echo $slide['btn-process'] ?> ►</a>
			</div>
		</li>
		<?php
		} else if($slide['slideType']=='result') { ?>
		<li class="slide lvl-1">
			<div class="fullwidth">
				<div class="ninecol">					
					<h3 class="slide-title"><?php echo $slide['title'] ?></h3>
					<div class="slide-content">
						<?php echo $slide['content'] ?>
						<div class="mediaShare"></div>
					</div>
				</div>
				<div class="threecol">
					<div class="saveResults"></div>
				</div>
			</div>	
			<div class="slide-controls">
				<a href="#" class="btn btn-slider-restart">◄ Start Over</a>
			</div>
		</li>
		<?php
		}
	}
	?>
	</ul>
</div>
</form>
<script type="text/javascript">
(function($, window, undefined){

	var pnt;
	jQuery(document).ready(function(){

		$('form.NiceIt').NiceIt();
		jQuery('.flexslider').flexslider({
			animation: "fade",
			animationLoop: false,
			slideshow: false,
			directionNav: false,
			touch: false,
			keyboard: false,
			//controlNav: false
			start: function(){resizeQueue();}
		});

		$('.btn-slider-back').click(function(){
			log('slider-back');
			jQuery('.flexslider').flexslider('prev');
			return false;
		});
		$('.btn-slider-next').click(function(){
			log('slider-next');
			jQuery('.flexslider').flexslider('next');
			return false;
		});
		$('.btn-slider-agree').click(function(){
			log('slider-agree');
			jQuery('.flexslider').flexslider('next');
			pnt = $(this).parent();
			chld = $(pnt).find('input').val('true');
			log(pnt);
			log(chld);
			return false;
		});
		$('.btn-slider-disagree').click(function(){
			log('slider-disagree');
			jQuery('.flexslider').flexslider('next');
			return false;
		});
		$('.btn-slider-process').click(function(){
			log('slider-process');
			//jQuery('.flexslider').flexslider('next');
			return false;
		});
		$('.btn-slider-restart').click(function(){
			log('slider-restart');
			jQuery('.flexslider').flexslider(0);
			jQuery('.flexslider .slide input').val("false");
			return false;
		});
		$('.btn-slider-skip').click(function(){
			log('slider-skip');
			jQuery('.flexslider').flexslider('next');
			return false;
		});
		$('#slider').data('flexslider');
		$(".gotoSearch").click(function() {
			//$('#candidate-slider .flexslider').fadeToggle();
			if ($(this).hasClass("upp")) {
				$('#candidate-slider .flexslider').animate({'bottom':-$('#candidate-slider .flexslider').outerHeight()}, 1000);
				$(this).removeClass("upp");
			} else {
				$('#candidate-slider .flexslider').animate({'bottom':0}, 1000);
				$(this).addClass("upp");
			}
		});
	});
})(jQuery,window);
</script>