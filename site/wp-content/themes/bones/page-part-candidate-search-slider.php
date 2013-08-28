<?php
	
	//d($mb_candidate_search); 
	$cp_meta = $mb_candidate_search->the_meta();
	//$cp_meta = $cp_meta[0];
	//d($cp_meta);

?>
<div class="flexslider">
	<ul class="slides">
	<?php 
	foreach ($cp_meta['slide'] as $key => $slide) {
		//d($slide['slideType']);
		if($slide['slideType']=='statement') { ?>
		<li class="slide">
			<h3 class="slide-title"><?php echo $slide['title'] ?></h3>
			<div class="slide-content"><?php echo $slide['content'] ?></div>
		</li>
		<?php
		} else if($slide['slideType']=='choice') { ?>
		<li class="slide">
			<h3 class="slide-title"><?php echo $slide['title'] ?></h3>
			<div class="slide-content"><?php echo $slide['content'] ?></div>
		</li>
		<?php
		} else if($slide['slideType']=='process') { ?>
		<li class="slide">
			<h3 class="slide-title"><?php echo $slide['title'] ?></h3>
			<div class="slide-content"><?php echo $slide['content'] ?></div>
		</li>
		<?php
		} else if($slide['slideType']=='result') { ?>
		<li class="slide">
			<h3 class="slide-title"><?php echo $slide['title'] ?></h3>
			<div class="slide-content"><?php echo $slide['content'] ?></div>
		</li>
		<?php
		}
	}
	?>
	</ul>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.flexslider').flexslider({
			animation: "slide",
			animationLoop: false,
			slideshow: false,
			directionNav: false,
			touch: false,
			keyboard: false,
			//controlNav: false
		});
	});
</script>