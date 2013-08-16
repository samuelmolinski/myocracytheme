<div id="header-container">
	
    <div class="row">		
            
        <div class="header-navigation">
            
            <div class="logo three columns">
            
                        
            <a href="http://share2.cunjo.com" title="!Share" rel="home" target="_blank">
        
                            
                     <h1 class="logo_text">!Share</h1>
                     
                              
            </a>
    
                    
            </div><!-- END .logo -->
                            
        </div><!-- END .header-navigation -->
        
        <a href="http://share2.cunjo.com/register/" target="_blank" class="premium-upgrade" ><i class="appz-king"></i> Upgrade to Premium</a>
    </div><!-- END .row -->
    
</div>
<div id="cunjo_body">
    <div class="container-fluid menu-hidden">
    	
        <div id="wrapper">
    		
            <div id="content">
            	
                <ul class="breadcrumb">
                    <li><a href="index.html?lang=en" class="glyphicons home"><i></i> !Share</a></li>
                    <li class="divider"></li>
                    <li>!Share Widgets</li>
                </ul><!--/breadcrumb-->
                
            	<div class="separator"></div>
                
                <div class="row-fluid" style="margin: 0 10px;width: auto;">
                    <div class="span12">
                    <table class="share-pages-desc">
                    	<tr>
                        	<td><i class="appz-archive"></i></td>
                            <td>This is the !Share social widgets library. You have available a range of apps to help you harness the benefits of social media and make your website truly popular.</td>
                        </tr>
                    </table>
                    </div><!--/span12-->
                </div><!--/row-fluid-->
                
                <div class="separator"></div>
                
                <div class="well">
                
                	<div class="widget widget-2 widget-tabs widget-tabs-2 border-bottom-none">
                    	<div class="widget-head">
                            <ul>
                                <li class="active"><a class="glyphicons" href="#bars-tab" data-toggle="tab" id="bars-widgets" style="padding: 0 15px;">Bars</a></li>
                                <li><a class="glyphicons" href="#buttons-tab" data-toggle="tab" id="buttons-widgets" style="padding: 0 15px;">Buttons</a></li>
                                <li><a class="glyphicons" href="#modals-tab" data-toggle="tab" id="modals-widgets" style="padding: 0 15px;">Modals</a></li>
                                <li><a class="glyphicons" href="#extras-tab" data-toggle="tab" id="extras-widgets" style="padding: 0 15px;">Extras</a></li>
                            </ul>
                        </div><!--/widget-head-->
                        <div class="widget-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="bars-tab">
                                <div class="row-fluid">
                                    <?php 
                                        foreach($view_data['layouts'] as $key => $widget):
                                            if($widget->category == 'Bars'):
                                    ?>
                                                <div class="span3">
                                                <?php if(!empty($view_data['settings']) && array_key_exists($key, $view_data['settings'])): ?>
                                                    <div class="widget widget-2 cunjo_widget">
                                                        <div class="cunjo_widget-header">
                                                            <div class="dropdown">
                                                                <button class="btn btn-default widget-settings" id="<?php echo $key; ?>_list" data-toggle="dropdown" href="#" plus-toggle="tooltip" title="Widget Settings"><i class="appz-cog"></i></button>
                                                                <ul class="dropdown-menu" role="menu" aria-labelledby="<?php echo $key; ?>_list">
                                                                    <?php 
                                                                        foreach($view_data['settings'][$key] as $skey => $settings): 
                                                                    ?>
                                                                        <li><a data-toggle="modal" href="#<?php echo $key.'_'.$skey; ?>"><?php echo $settings['settings_category']; ?></a></li>
                                                                    <?php 
                                                                        endforeach; 
                                                                    ?>
                                                                </ul>
                                                                <button class="btn btn-default widget-preview" id="<?php echo $key; ?>_list" data-toggle="modal" href="#preview_<?php echo $key; ?>" plus-toggle="tooltip" title="Widget Preview"><i class="appz-eye"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="widget-body">
                                                            <div class="thumbnail">
                                                                <img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: auto;" src="<?php echo $widget->screenshot; ?>">
                                                            </div>
                                                            <div class="cunjo_widget-description">
                                                                <h4><?php echo $widget->title; ?> <small class="muted">- v.<?php echo $widget->version; ?></small></h4>
                                                                <?php echo $widget->description; ?>
                                                            </div>
                                                        </div>
                                                        <span class="widget-status-label" layout="<?php echo $key; ?>">
                                                            <?php echo($view_data['settings'][$key]['visibility_settings']['is_active'] == 1)? '<span class="badge badge-success"></span> Active Widget' : '<span class="badge"></span> Installed Widget'; ?>
                                                        </span>
                                                        <div class="cunjo_widget-footer" layout="<?php echo $key; ?>">
                                                            <?php echo($view_data['settings'][$key]['visibility_settings']['is_active'] == 1)? '<button class="btn btn-block btn-info btn-small deactivate-widget" layout="'.$key.'" data-loading-text="loading...">Deactivate</button>' : '<button class="btn btn-block btn-primary btn-small activate-widget" layout="'.$key.'" data-loading-text="loading...">Activate</button>'; ?>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="widget widget-2 cunjo_widget">
                                                        <div class="cunjo_widget-header">
                                                            <div class="dropdown">
                                                                <button class="btn btn-default widget-settings" id="<?php echo $key; ?>_list" href="javascript:void(0)" plus-toggle="tooltip" title="Install to view settings"><i class="appz-lock-2"></i></button>
                                                                <button class="btn btn-default widget-preview" id="<?php echo $key; ?>_list" href="javascript:void(0)" plus-toggle="tooltip" title="Install to preview"><i class="appz-lock-2"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="widget-body">
                                                            <div class="thumbnail">
                                                                <img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: auto;" src="<?php echo $widget->screenshot; ?>">
                                                            </div>
                                                            <div class="cunjo_widget-description">
                                                                <h4><?php echo $widget->title; ?> <?php echo($widget->price > 0)? '<span class="label label-warning" style="vertical-align: middle;">&#36;'.$widget->price.'</span>' : ''; ?> <small class="muted">- v.<?php echo $widget->version; ?></small></h4>
                                                                <?php echo $widget->description; ?>
                                                            </div>
                                                        </div>
                                                        <span class="widget-status-label">
                                                            <?php echo($widget->price == 0)? '<span class="badge badge-inverse"></span> Free Widget' : '<span class="badge badge-warning"></span> Premium Widget'; ?>
                                                        </span>
                                                        <div class="cunjo_widget-footer" layout="<?php echo $key; ?>">
                                                            <?php echo($widget->price == 0)? '<a href="'.$widget->link.'" class="btn btn-block btn-inverse btn-small" layout="'.$key.'" target="_blank">Download</a>' : '<a href="'.$widget->link.'" class="btn btn-block btn-warning btn-small" layout="'.$key.'" target="_blank">Purchase</a>'; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                </div>
                                    <?php
                                            endif;
                                        endforeach;
                                    ?>
                                </div>
                                </div><!--/bars-tab-->
                                <div class="tab-pane" id="buttons-tab">
                                <div class="row-fluid">
                                    <?php 
                                        foreach($view_data['layouts'] as $key => $widget):
                                            if($widget->category == 'Buttons'):
                                    ?>
                                                <div class="span3">
                                                <?php if(!empty($view_data['settings']) && array_key_exists($key, $view_data['settings'])): ?>
                                                    <div class="widget widget-2 cunjo_widget">
                                                        <div class="cunjo_widget-header">
                                                            <div class="dropdown">
                                                                <button class="btn btn-default widget-settings" id="<?php echo $key; ?>_list" data-toggle="dropdown" href="#" plus-toggle="tooltip" title="Widget Settings"><i class="appz-cog"></i></button>
                                                                <ul class="dropdown-menu" role="menu" aria-labelledby="<?php echo $key; ?>_list">
                                                                    <?php 
                                                                        foreach($view_data['settings'][$key] as $skey => $settings): 
                                                                    ?>
                                                                        <li><a data-toggle="modal" href="#<?php echo $key.'_'.$skey; ?>"><?php echo $settings['settings_category']; ?></a></li>
                                                                    <?php 
                                                                        endforeach; 
                                                                    ?>
                                                                </ul>
                                                                <button class="btn btn-default widget-preview" id="<?php echo $key; ?>_list" data-toggle="modal" href="#preview_<?php echo $key; ?>" plus-toggle="tooltip" title="Widget Preview"><i class="appz-eye"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="widget-body">
                                                            <div class="thumbnail">
                                                                <img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: auto;" src="<?php echo $widget->screenshot; ?>">
                                                            </div>
                                                            <div class="cunjo_widget-description">
                                                                <h4><?php echo $widget->title; ?> <small class="muted">- v.<?php echo $widget->version; ?></small></h4>
                                                                <?php echo $widget->description; ?>
                                                            </div>
                                                        </div>
                                                        <span class="widget-status-label" layout="<?php echo $key; ?>">
                                                            <?php echo($view_data['settings'][$key]['visibility_settings']['is_active'] == 1)? '<span class="badge badge-success"></span> Active Widget' : '<span class="badge"></span> Installed Widget'; ?>
                                                        </span>
                                                        <div class="cunjo_widget-footer" layout="<?php echo $key; ?>">
                                                            <?php echo($view_data['settings'][$key]['visibility_settings']['is_active'] == 1)? '<button class="btn btn-block btn-info btn-small deactivate-widget" layout="'.$key.'" data-loading-text="loading...">Deactivate</button>' : '<button class="btn btn-block btn-primary btn-small activate-widget" layout="'.$key.'" data-loading-text="loading...">Activate</button>'; ?>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="widget widget-2 cunjo_widget">
                                                        <div class="cunjo_widget-header">
                                                            <div class="dropdown">
                                                                <button class="btn btn-default widget-settings" id="<?php echo $key; ?>_list" href="javascript:void(0)" plus-toggle="tooltip" title="Install to view settings"><i class="appz-lock-2"></i></button>
                                                                <button class="btn btn-default widget-preview" id="<?php echo $key; ?>_list" href="javascript:void(0)" plus-toggle="tooltip" title="Install to preview"><i class="appz-lock-2"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="widget-body">
                                                            <div class="thumbnail">
                                                                <img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: auto;" src="<?php echo $widget->screenshot; ?>">
                                                            </div>
                                                            <div class="cunjo_widget-description">
                                                                <h4><?php echo $widget->title; ?> <?php echo($widget->price > 0)? '<span class="label label-warning" style="vertical-align: middle;">&#36;'.$widget->price.'</span>' : ''; ?> <small class="muted">- v.<?php echo $widget->version; ?></small></h4>
                                                                <?php echo $widget->description; ?>
                                                            </div>
                                                        </div>
                                                        <span class="widget-status-label">
                                                            <?php echo($widget->price == 0)? '<span class="badge badge-inverse"></span> Free Widget' : '<span class="badge badge-warning"></span> Premium Widget'; ?>
                                                        </span>
                                                        <div class="cunjo_widget-footer" layout="<?php echo $key; ?>">
                                                            <?php echo($widget->price == 0)? '<a href="'.$widget->link.'" class="btn btn-block btn-inverse btn-small" layout="'.$key.'" target="_blank">Download</a>' : '<a href="'.$widget->link.'" class="btn btn-block btn-warning btn-small" layout="'.$key.'" target="_blank">Purchase</a>'; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                </div>
                                    <?php
                                            endif;
                                        endforeach;
                                    ?>
                                </div>
                                </div><!--/buttons-tab-->
                                <div class="tab-pane" id="modals-tab">
                                <div class="row-fluid">
                                    <?php 
                                        foreach($view_data['layouts'] as $key => $widget):
                                            if($widget->category == 'Modals'):
                                    ?>
                                                <div class="span3">
                                                <?php if(!empty($view_data['settings']) && array_key_exists($key, $view_data['settings'])): ?>
                                                    <div class="widget widget-2 cunjo_widget">
                                                        <div class="cunjo_widget-header">
                                                            <div class="dropdown">
                                                                <button class="btn btn-default widget-settings" id="<?php echo $key; ?>_list" data-toggle="dropdown" href="#" plus-toggle="tooltip" title="Widget Settings"><i class="appz-cog"></i></button>
                                                                <ul class="dropdown-menu" role="menu" aria-labelledby="<?php echo $key; ?>_list">
                                                                    <?php 
                                                                        foreach($view_data['settings'][$key] as $skey => $settings): 
                                                                    ?>
                                                                        <li><a data-toggle="modal" href="#<?php echo $key.'_'.$skey; ?>"><?php echo $settings['settings_category']; ?></a></li>
                                                                    <?php 
                                                                        endforeach; 
                                                                    ?>
                                                                </ul>
                                                                <button class="btn btn-default widget-preview" id="<?php echo $key; ?>_list" data-toggle="modal" href="#preview_<?php echo $key; ?>" plus-toggle="tooltip" title="Widget Preview"><i class="appz-eye"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="widget-body">
                                                            <div class="thumbnail">
                                                                <img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: auto;" src="<?php echo $widget->screenshot; ?>">
                                                            </div>
                                                            <div class="cunjo_widget-description">
                                                                <h4><?php echo $widget->title; ?> <small class="muted">- v.<?php echo $widget->version; ?></small></h4>
                                                                <?php echo $widget->description; ?>
                                                            </div>
                                                        </div>
                                                        <span class="widget-status-label" layout="<?php echo $key; ?>">
                                                            <?php echo($view_data['settings'][$key]['visibility_settings']['is_active'] == 1)? '<span class="badge badge-success"></span> Active Widget' : '<span class="badge"></span> Installed Widget'; ?>
                                                        </span>
                                                        <div class="cunjo_widget-footer" layout="<?php echo $key; ?>">
                                                            <?php echo($view_data['settings'][$key]['visibility_settings']['is_active'] == 1)? '<button class="btn btn-block btn-info btn-small deactivate-widget" layout="'.$key.'" data-loading-text="loading...">Deactivate</button>' : '<button class="btn btn-block btn-primary btn-small activate-widget" layout="'.$key.'" data-loading-text="loading...">Activate</button>'; ?>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="widget widget-2 cunjo_widget">
                                                        <div class="cunjo_widget-header">
                                                            <div class="dropdown">
                                                                <button class="btn btn-default widget-settings" id="<?php echo $key; ?>_list" href="javascript:void(0)" plus-toggle="tooltip" title="Install to view settings"><i class="appz-lock-2"></i></button>
                                                                <button class="btn btn-default widget-preview" id="<?php echo $key; ?>_list" href="javascript:void(0)" plus-toggle="tooltip" title="Install to preview"><i class="appz-lock-2"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="widget-body">
                                                            <div class="thumbnail">
                                                                <img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: auto;" src="<?php echo $widget->screenshot; ?>">
                                                            </div>
                                                            <div class="cunjo_widget-description">
                                                                <h4><?php echo $widget->title; ?> <?php echo($widget->price > 0)? '<span class="label label-warning" style="vertical-align: middle;">&#36;'.$widget->price.'</span>' : ''; ?> <small class="muted">- v.<?php echo $widget->version; ?></small></h4>
                                                                <?php echo $widget->description; ?>
                                                            </div>
                                                        </div>
                                                        <span class="widget-status-label">
                                                            <?php echo($widget->price == 0)? '<span class="badge badge-inverse"></span> Free Widget' : '<span class="badge badge-warning"></span> Premium Widget'; ?>
                                                        </span>
                                                        <div class="cunjo_widget-footer" layout="<?php echo $key; ?>">
                                                            <?php echo($widget->price == 0)? '<a href="'.$widget->link.'" class="btn btn-block btn-inverse btn-small" layout="'.$key.'" target="_blank">Download</a>' : '<a href="'.$widget->link.'" class="btn btn-block btn-warning btn-small" layout="'.$key.'" target="_blank">Purchase</a>'; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                </div>
                                    <?php
                                            endif;
                                        endforeach;
                                    ?>
                                </div>
                                </div><!--/modals-tab-->
                                <div class="tab-pane" id="extras-tab">
                                <div class="row-fluid">
                                    <?php 
                                        foreach($view_data['layouts'] as $key => $widget):
                                            if($widget->category == 'Extras'):
                                    ?>
                                                <div class="span3">
                                                <?php if(!empty($view_data['settings']) && array_key_exists($key, $view_data['settings'])): ?>
                                                    <div class="widget widget-2 cunjo_widget">
                                                        <div class="cunjo_widget-header">
                                                            <div class="dropdown">
                                                                <button class="btn btn-default widget-settings" id="<?php echo $key; ?>_list" data-toggle="dropdown" href="#" plus-toggle="tooltip" title="Widget Settings"><i class="appz-cog"></i></button>
                                                                <ul class="dropdown-menu" role="menu" aria-labelledby="<?php echo $key; ?>_list">
                                                                    <?php 
                                                                        foreach($view_data['settings'][$key] as $skey => $settings): 
                                                                    ?>
                                                                        <li><a data-toggle="modal" href="#<?php echo $key.'_'.$skey; ?>"><?php echo $settings['settings_category']; ?></a></li>
                                                                    <?php 
                                                                        endforeach; 
                                                                    ?>
                                                                </ul>
                                                                <button class="btn btn-default widget-preview" id="<?php echo $key; ?>_list" data-toggle="modal" href="#preview_<?php echo $key; ?>" plus-toggle="tooltip" title="Widget Preview"><i class="appz-eye"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="widget-body">
                                                            <div class="thumbnail">
                                                                <img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: auto;" src="<?php echo $widget->screenshot; ?>">
                                                            </div>
                                                            <div class="cunjo_widget-description">
                                                                <h4><?php echo $widget->title; ?> <small class="muted">- v.<?php echo $widget->version; ?></small></h4>
                                                                <?php echo $widget->description; ?>
                                                            </div>
                                                        </div>
                                                        <span class="widget-status-label" layout="<?php echo $key; ?>">
                                                            <?php echo($view_data['settings'][$key]['visibility_settings']['is_active'] == 1)? '<span class="badge badge-success"></span> Active Widget' : '<span class="badge"></span> Installed Widget'; ?>
                                                        </span>
                                                        <div class="cunjo_widget-footer" layout="<?php echo $key; ?>">
                                                            <?php echo($view_data['settings'][$key]['visibility_settings']['is_active'] == 1)? '<button class="btn btn-block btn-info btn-small deactivate-widget" layout="'.$key.'" data-loading-text="loading...">Deactivate</button>' : '<button class="btn btn-block btn-primary btn-small activate-widget" layout="'.$key.'" data-loading-text="loading...">Activate</button>'; ?>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="widget widget-2 cunjo_widget">
                                                        <div class="cunjo_widget-header">
                                                            <div class="dropdown">
                                                                <button class="btn btn-default widget-settings" id="<?php echo $key; ?>_list" href="javascript:void(0)" plus-toggle="tooltip" title="Install to view settings"><i class="appz-lock-2"></i></button>
                                                                <button class="btn btn-default widget-preview" id="<?php echo $key; ?>_list" href="javascript:void(0)" plus-toggle="tooltip" title="Install to preview"><i class="appz-lock-2"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="widget-body">
                                                            <div class="thumbnail">
                                                                <img data-src="holder.js/260x180" alt="260x180" style="width: 260px; height: auto;" src="<?php echo $widget->screenshot; ?>">
                                                            </div>
                                                            <div class="cunjo_widget-description">
                                                                <h4><?php echo $widget->title; ?> <?php echo($widget->price > 0)? '<span class="label label-warning" style="vertical-align: middle;">&#36;'.$widget->price.'</span>' : ''; ?> <small class="muted">- v.<?php echo $widget->version; ?></small></h4>
                                                                <?php echo $widget->description; ?>
                                                            </div>
                                                        </div>
                                                        <span class="widget-status-label">
                                                            <?php echo($widget->price == 0)? '<span class="badge badge-inverse"></span> Free Widget' : '<span class="badge badge-warning"></span> Premium Widget'; ?>
                                                        </span>
                                                        <div class="cunjo_widget-footer" layout="<?php echo $key; ?>">
                                                            <?php echo($widget->price == 0)? '<a href="'.$widget->link.'" class="btn btn-block btn-inverse btn-small" layout="'.$key.'" target="_blank">Download</a>' : '<a href="'.$widget->link.'" class="btn btn-block btn-warning btn-small" layout="'.$key.'" target="_blank">Purchase</a>'; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                </div>
                                    <?php
                                            endif;
                                        endforeach;
                                    ?>
                                </div>
                                </div><!--/extras-tab-->
                            </div>    
                        </div><!--/widget-body-->
                    </div><!--/widget-->
                
                </div><!--/well-->

            </div><!--/content-->
    	
        </div><!--/wrapper-->
   
    </div><!--/container-fluid-->
</div>

<?php
	//echo "<pre>" . print_r($view_data, TRUE) . "</pre>";
    do_action('cunjo_widgets_settings', $view_data);
?>
