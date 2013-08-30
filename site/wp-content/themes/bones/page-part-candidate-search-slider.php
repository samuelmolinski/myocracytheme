<?php
	
	//d($mb_candidate_search); 
	$cp_meta = $mb_candidate_search->the_meta();
	//$cp_meta = $cp_meta[0];
	//d($cp_meta);

?>
<form action="" method="">
<div class="advanceSearch clearfix">
	<div class="slide lvl-1">
		<div class="fullwidth">
			<div class="fourcol first">					
				<h3 class="slide-title">SELECT EXTRAS</h3>
				<div class="slide-content">
					asdf
				</div>
			</div>
			<div class="fourcol">		
				<h3 class="slide-title">SELECT ISSUES</h3>
				<div class="slide-content">
					asdfasd
				</div>
			</div>
			<div class="fourcol">		
				<h3 class="slide-title">ENTER NAME</h3>
				<div class="slide-content">
					asdfasdf
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
		jQuery('.flexslider').flexslider({
			animation: "fade",
			animationLoop: false,
			slideshow: false,
			directionNav: false,
			touch: false,
			keyboard: false,
			//controlNav: false
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
	});
})(jQuery,window);
</script>