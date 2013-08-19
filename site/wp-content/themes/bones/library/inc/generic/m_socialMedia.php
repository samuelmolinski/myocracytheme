<?php

function get_facebook_count($url) {
	$fql  = "SELECT url, normalized_url, share_count, like_count, comment_count, ";
	$fql .= "total_count, commentsbox_count, comments_fbid, click_count FROM ";
	$fql .= "link_stat WHERE url = '$url'";
	
	$apifql="http://api.facebook.com/method/fql.query?format=json&query=".urlencode($fql);
	$json=file_get_contents($apifql);
	$data = json_decode($json);
	
	
	if (is_array($data)) {
		return $data[0];
	} else {
		return FALSE;
	}
}

function socialMediaStrip($url) { ?>
	<div class="socialMediaStrip">
	<div class="sm-face">	
		<div class="fb-like" data-href="<?php echo $url ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true" data-font="arial"></div>
	</div>
	<div class="sm-twitter">
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $url ?>" data-via="DepRodrigoMaia">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>
	<div class="sm-gplus">
		<g:plusone></g:plusone>
		<script type="text/javascript">
		  window.___gcfg = {lang: 'pt-BR'};	
		  (function() {
		    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		    po.src = 'https://apis.google.com/js/plusone.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>
	</div>
	</div>
<?php }

function FB_OG($imgURL = '', $title = '', $description = '', $URL = '', $type = '') {
	/* The OG/FB settings should be set in the config.php of m_toolbox.
	 * empty quotes are used instead of 'null' because the default values of 
	 * m_toolbox config.php are blank, this way they match.
	 * 
	 */
	if('' != FB_ID) {echo "<meta property='fb:admins' content='".FB_ADMINS."'/>";}
	if('' != FB_ADMINS) {echo "<meta property='fb:app_id' content='".FB_ID."'/>";}
	if('' != $type) {echo "<meta property='og:type' content='$type'/>";}
	if('' != $title) {echo "<meta property='og:title' content='$title'/>";}
	if('' != $imgURL) {echo "<meta property='og:image' content='$imgURL'/>";}
	if('' != $URL) {echo "<meta property='og:url' content='$URL'/>";}
	if('' != $description) {echo "<meta property='og:description' content='$description'/>";}
	
}

/*
    Parse Twitter Feeds
    based on code from http://spookyismy.name/old-entries/2009/1/25/latest-twitter-update-with-phprss-part-three.html
    and cache code from http://snipplr.com/view/8156/twitter-cache/
    and other cache code from http://wiki.kientran.com/doku.php?id=projects:twitterbadge
*/
function parse_cache_twitter_feed($usernames, $limit) {
    $username_for_feed = str_replace(" ", "+OR+from%3A", $usernames);
    $feed = "http://search.twitter.com/search.atom?q=from%3A" . $username_for_feed . "&rpp=" . $limit . "&since=2011-05-01";
    $usernames_for_file = str_replace(" ", "-", $usernames);
    $cache_file = dirname(__FILE__).'/twitter/' . $usernames_for_file . '-twitter-cache';
    $last = filemtime($cache_file);
    $now = time();
    $interval = 600; // ten minutes
    // check the cache file
    if ( !$last || (( $now - $last ) > $interval) ) {
        // cache file doesn't exist, or is old, so refresh it
        
        $ch = curl_init();
        $timeout = 5; // set to zero for no timeout
        curl_setopt ($ch, CURLOPT_URL, $feed);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $cache_rss = curl_exec($ch);
        curl_close($ch);
        
        //$cache_rss = file_get_contents($feed);
        
        if (!$cache_rss) {
            // we didn't get anything back from twitter
            echo "<!-- ERROR: Twitter feed was blank! Using cache file. -->";
        } else {
            // we got good results from twitter
            echo "<!-- SUCCESS: Twitter feed used to update cache file -->";
            $cache_static = fopen($cache_file, 'wb');
            fwrite($cache_static, serialize($cache_rss));
            fclose($cache_static);
        }
        // read from the cache file
        $rss = @unserialize(file_get_contents($cache_file));
    }
    else {
        // cache file is fresh enough, so read from it
        echo "<!-- SUCCESS: Cache file was recent enough to read from -->";
        $rss = @unserialize(file_get_contents($cache_file));
    }
    // clean up and output the twitter feed
    $feed = str_replace("&amp;", "&", $rss);
    $feed = str_replace("&lt;", "<", $feed);
    $feed = str_replace("&gt;", ">", $feed);
    $feed = str_replace("&quot;", '"', $feed);
    $feed = str_replace('<a ', '<a target="blank" ', $feed);    
    $clean = explode("<entry>", $feed);
    $amount = count($clean) - 1;
    if ($amount) { // are there any tweets? ?>
    
        <div id="twitter-content" class="social-content">
    
        <?php for ($i = 1; $i <= $amount; $i++) {
            $entry_close = explode("</entry>", $clean[$i]);
            $clean_content_1 = explode("<content type=\"html\">", $entry_close[0]);
            $clean_content = explode("</content>", $clean_content_1[1]);
            $clean_name_2 = explode("<name>", $entry_close[0]);
            $clean_name_1 = explode("(", $clean_name_2[1]);
            $clean_name = explode(")</name>", $clean_name_1[1]);
            $clean_user = explode(" (", $clean_name_2[1]);
            $clean_lower_user = strtolower($clean_user[0]);
            $clean_uri_1 = explode("<uri>", $entry_close[0]);
            $clean_uri = explode("</uri>", $clean_uri_1[1]);
            $clean_time_1 = explode("<published>", $entry_close[0]);
            $clean_time = explode("</published>", $clean_time_1[1]);
            $unix_time = strtotime($clean_time[0]);
            //$pretty_time = relativeTime($unix_time);
            
            $linha = ($i==1)?("first"):("");
            ?>

               <p class="<?php echo $linha;?>"><?php echo $clean_content[0]; ?></p>

            <?php
        }
    ?>
        </div>
    <?php
    } else { // if there aren't any tweets
        ?>
        
        <?php
    }
}