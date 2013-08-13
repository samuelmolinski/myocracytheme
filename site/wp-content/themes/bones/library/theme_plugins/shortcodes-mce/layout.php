<?php
$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {$wp_include = "../$wp_include";}
require($wp_include);
?>

<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Shortcodes</title>
		<script type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
		<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/framework/theme_plugins/shortcodes-mce/shortcodes-mce.js"></script>	
	</head>	
<body onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display: none" id="link">
	
    <form name="mb2_shordoces_form" action="#">
		<div style="height:100px;width:350px;margin:0 auto;padding-top:35px;text-align:center;" class="shortcodes_wrap">        
        	<div id="mb2_shordoces_container" class="current" style="height:50px;">
				<fieldset style="border:0;width:350px;text-align:center;">
					<select id="mb2_shordoces_select" name="mb2_shordoces_select" style="width:350px;padding:6px 4px;">
                        <option value="0"><?php _e('-------- Select Shortcodes --------', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        	<option value="0"></option>
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Accordions and Tabs --------', 'aquilo'); ?></option>
                        <option value="accorion"><?php _e('Accordion', 'aquilo'); ?></option>
                        <option value="tabs"><?php _e('Tabs', 'aquilo'); ?></option>
                          	<option value="0"></option>                    
                        	<option value="0"></option>
                        	<option value="0"></option>
                        <option value="0"><?php _e('-------- Boxes --------', 'aquilo'); ?></option>
                        <option value="box_gray"><?php _e('Box Gray', 'aquilo'); ?></option>
                        <option value="box_blue"><?php _e('Box Blue', 'aquilo'); ?></option>
                        <option value="box_green"><?php _e('Box Green', 'aquilo'); ?></option>
                        <option value="box_red"><?php _e('Box Red', 'aquilo'); ?></option>    	                       
                        	<option value="0"></option>
                        <option value="box_bag"><?php _e('Box Bag', 'aquilo'); ?></option>
                        <option value="box_box"><?php _e('Box Box', 'aquilo'); ?></option>
                        <option value="box_check"><?php _e('Box Check', 'aquilo'); ?></option>
                        <option value="box_contact"><?php _e('Box Contact', 'aquilo'); ?></option>
                        <option value="box_download"><?php _e('Box Download', 'aquilo'); ?></option>
                        <option value="box_exchange"><?php _e('Box Exchange', 'aquilo'); ?></option>
                        <option value="box_mail"><?php _e('Box Mail', 'aquilo'); ?></option>
                        <option value="box_note"><?php _e('Box Note', 'aquilo'); ?></option>
                        <option value="box_presentation"><?php _e('Box Presentation', 'aquilo'); ?></option>
                        <option value="box_search"><?php _e('Box Search', 'aquilo'); ?></option>
                        <option value="box_shoppingcart"><?php _e('Box Shopping Cart', 'aquilo'); ?></option>
                        <option value="box_settings"><?php _e('Box Settings', 'aquilo'); ?></option>
                        <option value="box_upload"><?php _e('Box Upload', 'aquilo'); ?></option>    	                       
                        	<option value="0"></option>
                        	<option value="0"></option>
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Buttons --------', 'aquilo'); ?></option>
                        <option value="arrow_link"><?php _e('Arrow Link', 'aquilo'); ?></option>  
                        	<option value="0"></option>
                        <option value="button_small"><?php _e('Button Small', 'aquilo'); ?></option>                        
                        <option value="button_blue"><?php _e('Button Small Blue', 'aquilo'); ?></option>
                        <option value="button_green"><?php _e('Button Small Green', 'aquilo'); ?></option>
                        <option value="button_orange"><?php _e('Button Small Orange', 'aquilo'); ?></option>
                        <option value="button_yellow"><?php _e('Button Small Yellow', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        <option value="button_big"><?php _e('Button Big', 'aquilo'); ?></option>
                        <option value="button_big_blue"><?php _e('Button Big Blue', 'aquilo'); ?></option>
                        <option value="button_big_green"><?php _e('Button Big Green', 'aquilo'); ?></option>
                        <option value="button_big_orange"><?php _e('Button Big Orange', 'aquilo'); ?></option>
                        <option value="button_big_yellow"><?php _e('Button Big Yellow', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        <option value="button_big_archive"><?php _e('Button Big Archive', 'aquilo'); ?></option>
                        <option value="button_big_bag"><?php _e('Button Big Bag', 'aquilo'); ?></option>
                        <option value="button_big_cart"><?php _e('Button Big Cart', 'aquilo'); ?></option>
                        <option value="button_big_document"><?php _e('Button Big Document', 'aquilo'); ?></option>
                        <option value="button_big_download"><?php _e('Button Big Download', 'aquilo'); ?></option>
                        <option value="button_big_image"><?php _e('Button Big Image', 'aquilo'); ?></option>
                        <option value="button_big_link"><?php _e('Button Big Link', 'aquilo'); ?></option>
                        <option value="button_big_mail"><?php _e('Button Big Mail', 'aquilo'); ?></option>
                        <option value="button_big_upload"><?php _e('Button Big Upload', 'aquilo'); ?></option>
                        <option value="button_big_video"><?php _e('Button Big Video', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        <option value="button_big_video_lightbox"><?php _e('Button Big Lightbox Link', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        	<option value="0"></option>
                            <option value="0"></option>
						<option value="0"><?php _e('-------- Columns --------', 'aquilo'); ?></option>
						<option value="columns_50_50"><?php echo '50/50'; ?></option>
                        <option value="columns_30_30_30"><?php echo '30/30/30'; ?></option>
                        <option value="columns_25_25_25_25"><?php echo '25/25/25/25'; ?></option>
                        <option value="columns_60_30"><?php echo '60/30'; ?></option>
                        <option value="columns_30_60"><?php echo '30/60'; ?></option>
                        <option value="columns_50_25_25"><?php echo '50/25/25'; ?></option>
                        <option value="columns_25_25_50"><?php echo '25/25/50'; ?></option>
                        <option value="columns_75_25"><?php echo '75/25'; ?></option>
                        <option value="columns_25_75"><?php echo '25/75'; ?></option>
                        	<option value="0"></option>
                        	<option value="0"></option>
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Dropcaps --------', 'aquilo'); ?></option>
						<option value="dropcap_style1"><?php _e('Dropcap Style 1', 'aquilo'); ?></option>
                        <option value="dropcap_style2"><?php _e('Dropcap Style 2', 'aquilo'); ?></option>
                        <option value="dropcap_style3"><?php _e('Dropcap Style 3', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        	<option value="0"></option> 
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Highlights --------', 'aquilo'); ?></option>                           
                        <option value="highlight"><?php _e('Highlight Default Color', 'aquilo'); ?></option>
                        <option value="highlight_dark"><?php _e('Highlight Dark', 'aquilo'); ?></option>
                        <option value="highlight_gray"><?php _e('Highlight Gray', 'aquilo'); ?></option>                   
                            <option value="0"></option>
                        	<option value="0"></option> 
                            <option value="0"></option>                     	               
                        <option value="0"><?php _e('-------- Images and Videos --------', 'aquilo'); ?></option>
						<?php /*?><option value="audio_default"><?php _e('Audio', 'aquilo'); ?></option>
                        	<option value="0"></option><?php */?>
                        <option value="image_default"><?php _e('Image', 'aquilo'); ?></option>
                        <option value="image_lightbox"><?php _e('Image in Lightbox', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        <option value="video_youtube_fixed"><?php _e('Video Youtube Fixed Width and Height', 'aquilo'); ?></option>
                        <option value="video_youtube_flexible"><?php _e('Video Youtube Flexible', 'aquilo'); ?></option>
                        <option value="video_vimeo_fixed"><?php _e('Video Vimeo Fixed Width and Height', 'aquilo'); ?></option>
                        <option value="video_vimeo_flexible"><?php _e('Video Vimeo Flexible', 'aquilo'); ?></option>
                        <option value="video_lightbox"><?php _e('Video in Lightbox', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        <option value="gallery_image_lightbox"><?php _e('Gallery Images in Lightbox', 'aquilo'); ?></option>
                        <option value="gallery_video_lightbox"><?php _e('Gallery Videos in Lightbox', 'aquilo'); ?></option>
                        <option value="gallery_mixed_lightbox"><?php _e('Gallery Mixed in Lightbox', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        	<option value="0"></option>
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Lists and Menus --------', 'aquilo'); ?></option>
                        <option value="list_ordered"><?php _e('List Ordered', 'aquilo'); ?></option>
                        <option value="list_unordered"><?php _e('List Unordered', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        <option value="list_style_menu1"><?php _e('Menu 1', 'aquilo'); ?></option>
                        <option value="list_style_menu2"><?php _e('Menu 2', 'aquilo'); ?></option>
                        <option value="list_style_menu3"><?php _e('Menu 3', 'aquilo'); ?></option>
                            <option value="0"></option>
                        <option value="list_style_arrow"><?php _e('List Style Arrow', 'aquilo'); ?></option>
                        <option value="list_style_check"><?php _e('List Style Check', 'aquilo'); ?></option>
                        <option value="list_style_document"><?php _e('List Style Document', 'aquilo'); ?></option>
                        <option value="list_style_mail"><?php _e('List Style Mail', 'aquilo'); ?></option>
                        <option value="list_style_phone"><?php _e('List Style Phone', 'aquilo'); ?></option>
                        <option value="list_style_star"><?php _e('List Style Star', 'aquilo'); ?></option>                        
                        	<option value="0"></option>
                        	<option value="0"></option>
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Messages --------', 'aquilo'); ?></option>
                        <option value="message_blue"><?php _e('Message Blue', 'aquilo'); ?></option>
                        <option value="message_green"><?php _e('Message Green', 'aquilo'); ?></option>                       
                        <option value="message_red"><?php _e('Message Red', 'aquilo'); ?></option>
                        <option value="message_yellow"><?php _e('Message Yellow', 'aquilo'); ?></option>             	                       
                        	<option value="0"></option>
                        	<option value="0"></option>
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Pages --------', 'aquilo'); ?></option>                        
                        <option value="page_home_1"><?php _e('Page Home Default', 'aquilo'); ?></option>
                        <option value="page_home_2"><?php _e('Page Home 2', 'aquilo'); ?></option>
                        <option value="page_home_3"><?php _e('Page Home 3', 'aquilo'); ?></option>
                        <option value="page_about"><?php _e('Page About Us', 'aquilo'); ?></option>
                        <option value="page_services"><?php _e('Page Services', 'aquilo'); ?></option>
                       	 	<option value="0"></option> 
                        	<option value="0"></option>
                            <option value="0"></option> 
                        <option value="0"><?php _e('-------- Posts --------', 'aquilo'); ?></option>
                        <option value="recent_posts"><?php _e('Recent Posts', 'aquilo'); ?></option>
                        <option value="recent_projects"><?php _e('Recent Projects', 'aquilo'); ?></option>
                        	<option value="0"></option>
                            <option value="0"></option>
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Slides --------', 'aquilo'); ?></option>
                        <option value="slider_full_width"><?php _e('Slider Full Width', 'aquilo'); ?></option>
                        <option value="slider_left"><?php _e('Slider Align Left', 'aquilo'); ?></option>
                        <option value="slider_right"><?php _e('Slider Align Right', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        	<option value="0"></option>
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Social Icons --------', 'aquilo'); ?></option>
                        <option value="social_delicious"><?php echo 'Delicious'; ?></option>
                        <option value="social_digg"><?php echo 'Digg'; ?></option>
                        <option value="social_ddribble"><?php echo 'Dribble'; ?></option>
                        <option value="social_facebook"><?php echo 'Facebook'; ?></option>
                        <option value="social_googlebuzz"><?php echo 'Googlebuzz'; ?></option>
                        <option value="social_googleplus"><?php echo 'Google +'; ?></option>
                        <option value="social_lastfm"><?php echo 'Lastfm'; ?></option>
                        <option value="social_linkedin"><?php echo 'Linkedin'; ?></option>
                        <option value="social_mobypicture"><?php echo 'MobyPicture'; ?></option>
                        <option value="social_plixi"><?php echo 'Plixi'; ?></option>
                        <option value="social_skype"><?php echo 'Skype'; ?></option>
                        <option value="social_stubleupon"><?php echo 'Stubleupon'; ?></option>
                        <option value="social_tumbler"><?php echo 'Tumbler'; ?></option>
                        <option value="social_twitter"><?php echo 'Twitter'; ?></option>
                        <option value="social_vimeo"><?php echo 'Vimeo'; ?></option>
                        <option value="social_youtube"><?php echo 'Youtube'; ?></option>
                        	<option value="0"></option>
                        	<option value="0"></option>
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Headings and Titles --------', 'aquilo'); ?></option>
                        <option value="heading_h1"><?php _e('Heading H1', 'aquilo'); ?></option>
                        <option value="heading_h2"><?php _e('Heading H2', 'aquilo'); ?></option>
                        <option value="heading_h3"><?php _e('Heading H3', 'aquilo'); ?></option>
                        <option value="heading_h4"><?php _e('Heading H4', 'aquilo'); ?></option>
                        <option value="heading_h5"><?php _e('Heading H5', 'aquilo'); ?></option>
                        <option value="heading_h6"><?php _e('Heading H6', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        <option value="title_style1"><?php _e('Title 1', 'aquilo'); ?></option>
                        <option value="title_style2"><?php _e('Title 2', 'aquilo'); ?></option>                        
                        	<option value="0"></option>
                        	<option value="0"></option>
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Quotes --------', 'aquilo'); ?></option>
                        <option value="quote"><?php _e('Quote Default', 'aquilo'); ?></option>
                        <option value="quote_author"><?php _e('Quote with Author', 'aquilo'); ?></option>
                        <option value="quote_author_link"><?php _e('Quote with Author Link', 'aquilo'); ?></option>
                        <option value="quote_left"><?php _e('Quote Left', 'aquilo'); ?></option>
                        <option value="quote_right"><?php _e('Quote Right', 'aquilo'); ?></option>
                        	<option value="0"></option>
                            <option value="0"></option>
                            <option value="0"></option>
                        <option value="0"><?php _e('-------- Other --------', 'aquilo'); ?></option>
                        <option value="breakline"><?php _e('Break Line', 'aquilo'); ?></option>
                        <option value="clear"><?php _e('Clear', 'aquilo'); ?></option>
                        <option value="code"><?php _e('Code', 'aquilo'); ?></option>
                        <option value="map"><?php _e('Google Map', 'aquilo'); ?></option>
                        <option value="separator"><?php _e('Separator', 'aquilo'); ?></option>
                        <option value="gap"><?php _e('Gap', 'aquilo'); ?></option>
                        <option value="team"><?php _e('Team', 'aquilo'); ?></option>
                        	<option value="0"></option>
                        	<option value="0"></option>
                            <option value="0"></option>
					</select>
				</fieldset>
			</div>
            <div style="float:left;margin-right:10px;margin-left:5px;"><input style="color:#04a204;" type="submit" id="insert" name="insert" value="<?php _e('Insert', 'aquilo'); ?>" onClick="addShortcode();" /></div>
			<div style="float:left;"><input style="color:#f32b10;" type="button" id="cancel" name="cancel" value="<?php _e('Cancel', 'aquilo'); ?>" onClick="tinyMCEPopup.close();" /></div>			
		</div>
	</form>
    
    
    
</body>
</html>