<?php
/*
Template Name: Candidate Search
*/

	//d($_POST);

	$meta_query = array( 'relation' => 'AND');
	$first = true;
	if(isset($_POST['office_sought'])&&($_POST['office_sought'])) {
		$office_sought = $_POST['office_sought'];
		$meta_query[] = array(
			'key'     => 'office_sought',
			'value'   => $office_sought,
			'compare' => '='
			);
	}
	if(isset($_POST['state'])&&($_POST['state'])) {
		$state = $_POST['state'];
		$meta_query[] = array(
			'key'     => 'state',
			'value'   => $state,
			'compare' => '='
			);
	}
	if(isset($_POST['political_party'])&&($_POST['political_party'])) {
		$political_party = $_POST['political_party'];
		$meta_query[] = array(
			'key'     => 'political_party',
			'value'   => $political_party,
			'compare' => '='
			);
	}
	if(isset($_POST['incumbent'])&&($_POST['incumbent'])) {
		$incumbent = $_POST['incumbent'];
		$meta_query[] = array(
			'key'     => 'incumbent',
			'value'   => $incumbent,
			'compare' => '='
			);
	}
	if(isset($_POST['civil_right'])&&($_POST['civil_right'])) {
		$civil_right = $_POST['civil_right'];
		$meta_query[] = array(
			'key'     => 'issues_i_support',
			'value'   => ":\"$civil_right\"",
			'compare' => 'LIKE'
			);
	}
	if(isset($_POST['education'])&&($_POST['education'])) {
		$education = $_POST['education'];
		$meta_query[] = array(
			'key'     => 'issues_i_support',
			'value'   => ":\"$education\"",
			'compare' => 'LIKE'
			);
	}
	if(isset($_POST['immigration'])&&($_POST['immigration'])) {
		$immigration = $_POST['immigration'];
		$meta_query[] = array(
			'key'     => 'issues_i_support',
			'value'   => ":\"$immigration\"",
			'compare' => 'LIKE'
			);
	}
	if(isset($_POST['economy'])&&($_POST['economy'])) {
		$economy = $_POST['economy'];
		$meta_query[] = array(
			'key'     => 'issues_i_support',
			'value'   => ":\"$economy\"",
			'compare' => 'LIKE'
			);
	}
	if(isset($_POST['criminal_justice'])&&($_POST['criminal_justice'])) {
		$criminal_justice = $_POST['criminal_justice'];
		$meta_query[] = array(
			'key'     => 'issues_i_support',
			'value'   => ":\"$criminal_justice\"",
			'compare' => 'LIKE'
			);
	}
	if(isset($_POST['energy'])&&($_POST['energy'])) {
		$energy = $_POST['energy'];
		$meta_query[] = array(
			'key'     => 'issues_i_support',
			'value'   => ":\"$energy\"",
			'compare' => 'LIKE'
			);
	}
	//$where = array( 'meta_query' => $meta_query);
	$where = array('role' => 'politician', 'meta_query' => $meta_query);
	if(isset($_POST['candidate_name'])&&($_POST['candidate_name'])) {
		$candidate_name = $_POST['candidate_name'];
		$where["search"] = $candidate_name;
		$where['search_columns'] = array( 'user_nicename');

		$user_query = new WP_User_Query( $where );
		//d($user_query);
		//d($user_query->query_where);
		$uids=array();

	     $usermeta_affected_ids = $wpdb -> get_results("SELECT DISTINCT user_id FROM ".$wpdb->base_prefix."usermeta WHERE (meta_key='first_name' OR meta_key='last_name') AND LOWER(meta_value) LIKE '%".$candidate_name."%'");

        foreach($usermeta_affected_ids as $maf) {
            array_push($uids,$maf->user_id);
        }

        $users_affected_ids = $wpdb -> get_results("SELECT DISTINCT ID FROM ".$wpdb->base_prefix."users WHERE LOWER(user_nicename) LIKE '%".$candidate_name."%' OR LOWER(user_email) LIKE '%".$candidate_name."%'");

        foreach($users_affected_ids as $maf) {
            if(!in_array($maf->ID,$uids)) {
                array_push($uids,$maf->ID);
            }
        }

        $id_string = implode(",",$uids);

        $needle = "user_nicename LIKE '$candidate_name'";
        $trade = "ID IN(".$id_string.")";
        $subject = $user_query->query_where;
        $newWhere = str_ireplace($needle, $trade, $subject);
        $user_query -> query_where = $newWhere;
	}
	
	if($office_sought||$state||$political_party||$incumbent||$civil_right||$education||$immigration||$economy||$criminal_justice||$energy||$candidate_name) {
		$canSearch = true;
	}
	

	if(!$user_query && $canSearch) {
		$user_query = new WP_User_Query( $where );
		$user_query->query();


		$reduce = array();
		foreach ($user_query->results as $k => $user) {
			if(!in_array($user, $reduce))
				$reduce[] = $user;
		}

		//d($reduce);
		$pagination = new pagination($reduce, (isset($_GET['page']) ? $_GET['page'] : 1), 10);
		$pagination->setShowFirstAndLast(true);
		$pagination->setMainSeperator(' | ');
		$candidates = $pagination->getResults();
		//add metadata
		$cand = array();
		foreach ($candidates as $key => $candidate) {
			$metas =  $wpdb -> get_results("SELECT * FROM ".$wpdb->base_prefix."usermeta WHERE user_id={$candidate->data->ID}");
			//d($metas);
			$temp = array();
			foreach ($metas as $meta) {
				$temp[$meta->meta_key] = $meta->meta_value;
			}
			$cand[] = array("candidate"=>$candidate, "metadata"=>$temp);
		}

		$upload_dir = wp_upload_dir();
		//d($upload_dir);
	}
	
?>

<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix">
			
				    <div id="main" class="twelvecol first clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="candidates" <?php post_class(array('clearfix')); ?> role="article">
						
						    <div id="candidate-slider" class="clearfix">
						    	<?php include('page-part-candidate-search-slider.php'); ?>
						    </div><!-- candidate-slider -->
						    <div class="gotoSearch upp"><span>GO TO QUICK SEARCH</span><span class="counterclockwise">e</span></div>
						    
					
						    <section class="entry-content matte">
								<h1 class="page-title">Candidates</h1>
							    <?php 
							    	if (!empty($cand)) { 
					    				foreach ($cand as $candidate) { ?>
					    				<div class="candidate matte-06 clearfix">
					    					<div class="fourcol first"><img class="cand-image" src="<?php bloginfo("template_url"); ?>/library/timthumb/timthumb.php?src=<?php echo $upload_dir['baseurl']. $candidate['metadata']['user_image'] ?>&w=325&h=225&zc=1"></div>
					    					<div class="eightcol cand-info clearfix">
				    							<h2 class="title"><?php echo $candidate['candidate']->data->user_nicename ?></h2>
												<div class="details clearfix">
													<span class="party"><?php echo $candidate['metadata']['political_party'] ?></span><br>
													<span class="position"><?php echo $candidate['metadata']['office_sought'] ?></span><br>
													<span class="location"><?php echo $candidate['metadata']['state_name'] ?></span><br>
												</div>
					    						<div class="clearfix share">
													<a href="#" class="share-icon facebook">f</a>
													<a href="#" class="share-icon twtter">t</a>
													<a href="#" class="donate"><span class="give">Donate</span></a>
												</div>
					    					</div>
					    				</div>
					    		<?php
					    			 	} 
					    			} else {  ?>
				                  <p class="byline vcard">No candidates match or are selected at this time.</p>
					    		<?php
					    			}
					    		?>
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
			
				    </div> <!-- end #main -->
    
				    <?php //get_sidebar(); ?>
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
