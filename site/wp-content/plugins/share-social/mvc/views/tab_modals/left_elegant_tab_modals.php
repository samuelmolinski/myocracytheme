<?php

	$social_channels = $view_data['settings']['left_elegant_tab']['social_channels'];

	$bar_layout_design = $view_data['settings']['left_elegant_tab']['bar_layout_design'];

	$call_to_action = $view_data['settings']['left_elegant_tab']['call_to_action'];

	$visibility_settings = $view_data['settings']['left_elegant_tab']['visibility_settings'];

	

	$channels = array(

					'Facebook'=>'Facebook',

					'Twitter'=>'Twitter',

					'Google'=>'Google',

					'Linkedin'=>'Linkedin',

					'Pinterest'=>'Pinterest',

					'Digg'=>'Digg',

					'Myspace'=>'Myspace',

					'Stumbleupon'=>'Stumbleupon',

					'Bebo'=>'Bebo',

					'Blogger'=>'Blogger',

					'Delicious'=>'Delicious',

					'Xing'=>'Xing',

					'Tumblr'=>'Tumblr',

					'Technorati'=>'Technorati',

					'Reddit'=>'Reddit',

					'Netlog'=>'Netlog',

					'Identi'=>'Identi',

					'Friendfeed'=>'Friendfeed',

					'Evernote'=>'Evernote',

					'Diigo'=>'Diigo',

					'VK'=>'VK',

					'Email'=>'Email',

				);

?>

<div id="left_elegant_tab_social_channels" class="modal hide fade in widget-settings" tabindex="-1" role="dialog" aria-labelledby="registerShareLabel" aria-hidden="true">

  <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

    <h3><?php echo $social_channels['settings_category']; ?></h3>

  </div>

  <div class="modal-body">

		<div class="drag-links">

            <div class="span2">

            	<h5>Active channels</h5>

                <form class="form-horizontal" id="social-channels-left_elegant_tab" novalidate="novalidate" title="<?php echo $social_channels['settings_category']; ?>">

                    <ul id="socialsuse" class="connected list" style="margin:0;">

                        <?php 

                        $socials = explode(',', $social_channels['socials']); 

                        foreach($socials as $social){

                            echo '<li class="'.$social.'"><div class="share-icns"></div><span>'.$social.'</span><input type="hidden" id="socials" name="options[socials][]" value="'.$social.'" /></li>';

                            unset($channels["{$social}"]);

                        }

                        ?>

                    </ul>

                    <div class="control-group" id="socials_target-group" style="margin-top: 20px;">

                        <h5>Open channel sharing in</h5>

                        <select class="selectpicker span2" name="options[socials_target]" id="socials_target" data-style="btn-default">

                            <option value="window" <?php echo($social_channels['socials_target'] == 'window')? 'selected': ''; ?>>New window</option>

                            <option value="tab" <?php echo($social_channels['socials_target'] == 'tab')? 'selected': ''; ?>>New tab</option>

                        </select>

                    </div>

                </form>

            </div>

            <div class="span1">

                <div class="between-connected">Drag to activate <span class="appz-undo-2"></span></div>

            </div>

            <div class="span2">

            	<h5>Inactive channels</h5>

                <ul class="connected list no2" style="margin:0;">

                   <?php 

					foreach($channels as $channel){

                    	echo '<li class="'.$channel.'"><div class="share-icns"></div><span>'.$channel.'</span><input type="hidden" id="socials" name="options[socials][]" value="'.$channel.'" /></li>';

                    }

                    ?>

                </ul>

            </div>

        </div>

        <div style="clear:both;"></div>

  </div>

  <div class="modal-footer">

    <button class="btn btn-icon btn-default circle_remove" data-dismiss="modal" aria-hidden="true"><i class="appz-close-3"></i> Close</button>

    <button type="submit" class="btn btn-icon btn-primary circle_ok save-widget-settings" settings="#social-channels-left_elegant_tab" layout="left_elegant_tab" data-loading-text="loading..."><i class="appz-checkmark-circle-2"></i> Save</button>

  </div>

</div><!--/Social Channels Settings-->



<div id="left_elegant_tab_bar_layout_design" class="modal hide fade in widget-settings" tabindex="-1" role="dialog" aria-labelledby="registerShareLabel" aria-hidden="true">

  <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

    <h3><?php echo $bar_layout_design['settings_category']; ?></h3>

  </div>

  <div class="modal-body">

    <form class="form-horizontal" id="bar-layout-left_elegant_tab" novalidate="novalidate" title="<?php echo $bar_layout_design['settings_category']; ?>">

    

		<div class="row-fluid">

        

        	<div class="span6">

            	<div class="control-group" id="bgcolor-group">

					<h5>Background color</h5>

                    <div class="input-append">

                        <input type="text" id="bgcolor-left_elegant_tab" name="options[bgcolor]" value="<?php echo $bar_layout_design['bgcolor']; ?>" class="span7"/>

                        <button href="javascript:void(0)" class="btn undo-color" target="#bgcolor-left_elegant_tab" original="<?php echo $bar_layout_design['bgcolor']; ?>"><i class="appz-undo"></i> Undo</button>

                    </div>

                    <br/><br/>

                    <div class="palette" target="#bgcolor-left_elegant_tab"></div>

				</div>

                                

                <div class="control-group" id="toolstyle-group">

                	<h5>Tooltip style</h5>

                    <select class="selectpicker span11" name="options[toolstyle]" id="toolstyle" data-style="btn-default">

                        <option value="darkminimal" <?php echo($bar_layout_design['toolstyle'] == 'darkminimal')? 'selected': ''; ?>>Dark minimal</option>

                        <option value="lightminimal" <?php echo($bar_layout_design['toolstyle'] == 'lightminimal')? 'selected': ''; ?>>Light minimal</option>

                        <option value="darkgray" <?php echo($bar_layout_design['toolstyle'] == 'darkgray')? 'selected': ''; ?>>Dark gray</option>

                    </select>

                </div>

                

                <div class="control-group" id="counter-group">

                	<h5>Show shared counter?</h5>

                    <select class="selectpicker span11" name="options[counter]" id="toolstyle" data-style="btn-default">

                        <option value="no" <?php echo($bar_layout_design['counter'] == 'no')? 'selected': ''; ?>>No</option>

                        <option value="yes" <?php echo($bar_layout_design['counter'] == 'yes')? 'selected': ''; ?>>Yes</option>

                    </select>

                </div>

            </div><!--/span6-->

            

            <div class="span6">

            	<div class="control-group" id="textcolor-group">

					<h5>Text color</h5>

                    <div class="input-append">

                        <input type="text" id="textcolor-left_elegant_tab" name="options[textcolor]" value="<?php echo $bar_layout_design['textcolor']; ?>" class="span7"/>

                        <button href="javascript:void(0)" class="btn undo-color" target="#textcolor-left_elegant_tab" original="<?php echo $bar_layout_design['textcolor']; ?>"><i class="appz-undo"></i> Undo</button>

                    </div>

                    <br/><br/>

                    <div class="palette" target="#textcolor-left_elegant_tab"></div>

				</div>

                                

                <div class="control-group" id="position-group">

                	<h5>Bar position</h5>

                    <select class="selectpicker span11" name="options[position]" id="position" data-style="btn-default">

                        <option value="center" <?php echo($bar_layout_design['position'] == 'center')? 'selected': ''; ?>>Center</option>

                        <option value="top" <?php echo($bar_layout_design['position'] == 'top')? 'selected': ''; ?>>Top</option>

                        <option value="bottom" <?php echo($bar_layout_design['position'] == 'bottom')? 'selected': ''; ?>>Bottom</option>

                    </select>

                </div>

                

                <div class="control-group" id="offleft-group">

					<h5>Offset left</h5>

                    <div class="input-append">

                        <input type="text" id="offleft" name="options[offleft]" value="<?php echo $bar_layout_design['offleft']; ?>" class="span7"/>

                        <span class="input-group-addon">px</span>

                    </div>

				</div>

            </div><!--/span6-->

			

        </div><!--/row-fluid-->

        

    </form>

  </div>

  <div class="modal-footer">

    <button class="btn btn-icon btn-default circle_remove" data-dismiss="modal" aria-hidden="true"><i class="appz-close-3"></i> Close</button>

    <button type="submit" class="btn btn-icon btn-primary circle_ok save-widget-settings" settings="#bar-layout-left_elegant_tab" layout="left_elegant_tab" data-loading-text="loading..."><i class="appz-checkmark-circle-2"></i> Save</button>

  </div>

</div><!--/Bar layout design Settings-->



<div id="left_elegant_tab_visibility_settings" class="modal hide fade in widget-settings" tabindex="-1" role="dialog" aria-labelledby="registerShareLabel" aria-hidden="true">

  <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

    <h3><?php echo $visibility_settings['settings_category']; ?></h3>

  </div>

  <div class="modal-body">

    <form class="form-horizontal" id="visibility-settings-left_elegant_tab" novalidate="novalidate" title="Visibility settings">

		<div class="row-fluid">

        

            <div class="span6">

                <div class="control-group span11" id="exclude_pages-group">

                	<h5>Hide widget on specific pages</h5>

                    <select name="options[exclude_pages][]" id="exclude_pages" multiple ui_select data-placeholder="Click to select pages" style="width: 100%;">

                    	<?php 

						  $pages = get_pages(); 

						  foreach ( $pages as $page ) {

								$option = '<option value="' . $page->ID . '" '.((in_array($page->ID, explode(',', $visibility_settings['exclude_pages'])))? 'selected' : '').'>';

								$option .= $page->post_title;

								$option .= '</option>';

								echo $option;

						  }

						 ?>

                    </select>

                </div>

                <div class="control-group span11" id="on_home-group">

                	<h5>Show widget on Home page</h5>

                    <div class="toggle-button" data-toggleButton-style-enabled="info">

                        <input data-toggle="value" target_id="on_home-left_elegant_tab" target_name="options[on_home]" type="checkbox" value="1" <?php echo($visibility_settings['on_home'] == 0)? '': 'checked="checked"'; ?>/>

                    </div>

                </div>

                <div class="control-group span11" id="on_posts-group">

                	<h5>Show widget on posts</h5>

                    <div class="toggle-button" data-toggleButton-style-enabled="info">

                        <input data-toggle="value" target_id="on_posts-left_elegant_tab" target_name="options[on_posts]" type="checkbox" value="1" <?php echo($visibility_settings['on_posts'] == 0)? '': 'checked="checked"'; ?>/>

                    </div>

                </div>

            </div><!--/span6-->

            

            <div class="span6">

                <div class="control-group span11" id="exclude_pages-group">

                	<h5>Hide widget on specific posts</h5>

                    <select name="options[exclude_posts][]" id="exclude_posts" multiple ui_select data-placeholder="Click to select posts" style="width: 100%;">

                    	<?php 

						  $posts = get_posts(); 

						  foreach ( $posts as $post ) {

								$option = '<option value="' . $post->ID . '" '.((in_array($post->ID, explode(',', $visibility_settings['exclude_posts'])))? 'selected' : '').'>';

								$option .= $post->post_title;

								$option .= '</option>';

								echo $option;

						  }

						 ?>

                    </select>

                </div>

                <div class="control-group span11" id="on_pages-group">

                	<h5>Show widget on pages</h5>

                    <div class="toggle-button" data-toggleButton-style-enabled="info">

                        <input data-toggle="value" target_id="on_pages-left_elegant_tab" target_name="options[on_pages]" type="checkbox" value="1" <?php echo($visibility_settings['on_pages'] == 0)? '': 'checked="checked"'; ?>/>

                    </div>

                </div>

                <div class="control-group span11" id="on_custom-group">

                	<h5>Show widget on custom post types</h5>

                    <select name="options[on_custom][]" id="on_custom" multiple ui_select data-placeholder="Click to select posts" style="width: 100%;">

                    	<?php 

							$args=array(

							  'public' => true,

							  '_builtin' => false

							);

						  $post_types=get_post_types($args,'names');

						  foreach ( $post_types as $post_type ) {

								$option = '<option value="' . $post_type . '" '.((in_array($post_type, explode(',', $visibility_settings['on_custom'])))? 'selected' : '').'>';

								$option .= $post_type;

								$option .= '</option>';

								echo $option;

						  }

						 ?>

                    </select>

                </div>

            </div><!--/span6-->

            

        </div><!--/row-fluid-->



    </form>

  </div>

  <div class="modal-footer">

    <button class="btn btn-icon btn-default circle_remove" data-dismiss="modal" aria-hidden="true"><i class="appz-close-3"></i> Close</button>

    <button type="submit" class="btn btn-icon btn-primary circle_ok save-widget-settings" settings="#visibility-settings-left_elegant_tab" layout="left_elegant_tab" data-loading-text="loading..."><i class="appz-checkmark-circle-2"></i> Save</button>

  </div>

</div><!--/Visibility Settings-->



<!---Preview Widget--->

<div id="preview_left_elegant_tab" class="modal hide fade in widget-preview-modal" tabindex="-1" role="dialog" wp_address="<?php echo get_site_url(); ?>/?cunjo=left_elegant_tab" aria-hidden="true" style="width: 1150px; margin-left: -575px;top:50%;">

  <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

    <h3>Preview</h3>

  </div>

  <div class="modal-body">

	Preview here

  </div>

  <div class="modal-footer">

    <button class="btn btn-icon btn-default circle_remove" data-dismiss="modal" aria-hidden="true"><i class="appz-close-3"></i> Close</button>

  </div>

</div><!--/Preview Widget-->

<?php //echo '<pre>'.print_r($view_data, true).'</pre>'; ?>