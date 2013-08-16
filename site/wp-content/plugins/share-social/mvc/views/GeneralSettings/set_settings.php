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
                    <li>General Settings</li>
                </ul><!--/breadcrumb-->
                
            	<div class="separator"></div>
                
                <div class="row-fluid" style="margin: 0 10px;width: auto;">
                    <div class="span12">
                    <table class="share-pages-desc">
                    	<tr>
                        	<td><i class="appz-cog"></i></td>
                            <td>On this page you setup !Share's general/global settings, which are quite important. Ie. your !Share ID, widgets language, activate/deactivate widgets social analytics.</td>
                        </tr>
                    </table>
                    </div><!--/span12-->
                </div><!--/row-fluid-->
                
                <div class="separator"></div>
                
                <div class="well">
                
                	<div class="widget widget-2 widget-tabs widget-tabs-2">
                    	<div class="widget-head">
                            <ul>
                                <li class="active"><a class="glyphicons" href="#general-settings-tab" data-toggle="tab" id="general-settings" style="padding: 0 15px;"><span class="appz-equalizer-2 icon-tabs"></span> <span class="text-tabs">General Settings</span></a></li>
                            </ul>
                        </div><!--/widget-head-->
                        <div class="widget-body">
                        <form class="form-horizontal" id="general_settings-form">
                            <div class="tab-pane active" id="general-settings-tab">
								<?php if(!isset($view_data['wp_options']['cunjoshare_shareid']) || empty($view_data['wp_options']['cunjoshare_shareid']) || $view_data['wp_options']['cunjoshare_shareid'] == ''): ?>
                                <div class="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Warning!</strong> You wil not be able to use any of the features if you do not have a !Share ID. <a id="cunjo_registerShare" data-toggle="modal" data-target="#registerShare" class="btn btn-inverse">CLICK HERE</a> to register one!
                                </div>
                                <?php endif; ?>
                            	<div class="row-fluid">
                                	<div class="span6">
                                    	<div class="control-group" id="shareid-group">
                                            <label class="control-label" for="cunjo_shareid">!Share ID</label>
                                            <div class="controls">
                                                <input type="text" name="shareid" id="cunjo_shareid" class="span10" value="<?php echo(isset($view_data['wp_options']['cunjoshare_shareid']))? $view_data['wp_options']['cunjoshare_shareid'] : ''; ?>">
                                                <span style="margin: 0;" class="btn-action single glyphicons" data-toggle="tooltip" data-placement="top" data-original-title="Your registered !Share ID"><span class="appz-question-2" style="display:inline-block"></span></span>
                                            </div>
                                        </div><!--/shareid-group-->
                                        <div class="control-group" id="has_analytics-group">
                                            <label class="control-label" for="cunjo_shareid">Analytics Status</label>
                                            <div class="controls">
                                                <div id="has_analytics-wrap" class="toggle-button" data-toggleButton-style-enabled="success">
                                                    <input type="checkbox" id="has_analytics" <?php echo(isset($view_data['wp_options']['cunjoshare_has_analytics']) && $view_data['wp_options']['cunjoshare_has_analytics'] == 'yes')? 'checked' : ''; ?>/>
                                                </div>
                                                <span style="margin: 0;" class="btn-action single glyphicons" data-toggle="tooltip" data-placement="top" data-original-title="Enable/Disable Social Analytics tracking features"><span class="appz-question-2" style="display:inline-block"></span></span>
                                            </div>
                                        </div><!--/has_analytics-group-->
                                        <div class="control-group" id="analytics-group">
                                            <label class="control-label" for="cunjo_shareid" style="padding-top: 2px;">Analytics Account</label>
                                            <div class="controls">
                                                <div class="uniformjs">
                                                    <label class="checkbox" style="margin-bottom: 0px;">
                                                        <div class="checker" id="register-analytics-check"><span><input type="checkbox" class="checkbox" id="require_analytics_account" value="1" style="opacity: 0;"></span></div>
                                                        <span style="vertical-align:middle;">Check this box if you DO NOT have a !Share Analytics account.</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div><!--/analytics-group-->
                                        <div class="analytics-register widget widget-2">
                                        	<div class="widget-head">
                                                <h4 class="heading"><i class="appz-stats"></i> !Share Analytics Registration</h4>
                                            </div>
                                        	<div class="widget-body">
                                            	<div class="control-group" id="analyticsregister-email">
                                                    <label class="control-label" for="cunjo_analyticsregister-email">Email address</label>
                                                    <div class="controls">
                                                        <input type="text" name="_cunjo_analyticsregister-email" id="cunjo_analyticsregister-email" class="span9">
                                                        <span style="margin: 0;" class="btn-action single glyphicons" data-toggle="tooltip" data-placement="top" data-original-title="If you already registered for a !Share ID please use the same Email address"><span class="appz-question-2" style="display:inline-block"></span></span>
                                                    </div>
                                                </div><!--/analyticsregister-email-->
                                                <div class="control-group" id="analyticsregister-password">
                                                    <label class="control-label" for="cunjo_analyticsregister-password">Password</label>
                                                    <div class="controls">
                                                        <input type="password" name="_cunjo_analyticsregister-password" id="cunjo_analyticsregister-password" class="span9">
                                                        <span style="margin: 0;" class="btn-action single glyphicons" data-toggle="tooltip" data-placement="top" data-original-title="The password for login to your !Share Analytics account"><span class="appz-question-2" style="display:inline-block"></span></span>
                                                    </div>
                                                </div><!--/analyticsregister-email-->
                                                <div class="alert alert-info">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    You will receive a confirmation email, after that you will be able to login on the Social Analytics to view your stats.
                                                </div>
                                            </div>
                                        </div><!--/analytics-register-->
                                    </div><!--/span6-->
                                    <div class="span6">
                                    	<div class="control-group" id="lang-group">
                                            <label class="control-label" for="cunjo_lang">Widget's Language</label>
                                            <div class="controls">
                                                <select class="span11" name="lang" id="cunjo_lang">
                                                    <option value="EN" <?php echo(isset($view_data['wp_options']['cunjoshare_lang']) && $view_data['wp_options']['cunjoshare_lang'] == 'EN')? 'selected' : ''; ?>>English</option>
                                                    <option value="FR" <?php echo(isset($view_data['wp_options']['cunjoshare_lang']) && $view_data['wp_options']['cunjoshare_lang'] == 'FR')? 'selected' : ''; ?>>French</option>
                                                    <option value="IT" <?php echo(isset($view_data['wp_options']['cunjoshare_lang']) && $view_data['wp_options']['cunjoshare_lang'] == 'IT')? 'selected' : ''; ?>>Italian</option>
                                                    <option value="ES" <?php echo(isset($view_data['wp_options']['cunjoshare_lang']) && $view_data['wp_options']['cunjoshare_lang'] == 'ES')? 'selected' : ''; ?>>Spanish</option>
                                                    <option value="DE" <?php echo(isset($view_data['wp_options']['cunjoshare_lang']) && $view_data['wp_options']['cunjoshare_lang'] == 'DE')? 'selected' : ''; ?>>German</option>
                                                    <option value="NL" <?php echo(isset($view_data['wp_options']['cunjoshare_lang']) && $view_data['wp_options']['cunjoshare_lang'] == 'NL')? 'selected' : ''; ?>>Dutch</option>
                                                    <option value="RU" <?php echo(isset($view_data['wp_options']['cunjoshare_lang']) && $view_data['wp_options']['cunjoshare_lang'] == 'RU')? 'selected' : ''; ?>>Russian</option>
                                                    <option value="CH" <?php echo(isset($view_data['wp_options']['cunjoshare_lang']) && $view_data['wp_options']['cunjoshare_lang'] == 'CH')? 'selected' : ''; ?>>Chinese</option>
                                                    <option value="AR" <?php echo(isset($view_data['wp_options']['cunjoshare_lang']) && $view_data['wp_options']['cunjoshare_lang'] == 'AR')? 'selected' : ''; ?>>Arabic</option>
                                                    <option value="RO" <?php echo(isset($view_data['wp_options']['cunjoshare_lang']) && $view_data['wp_options']['cunjoshare_lang'] == 'RO')? 'selected' : ''; ?>>Romanian</option>
                                                    <option value="BG" <?php echo(isset($view_data['wp_options']['cunjoshare_lang']) && $view_data['wp_options']['cunjoshare_lang'] == 'BG')? 'selected' : ''; ?>>Bulgarian</option>
                                                </select>
                                                <span style="margin: 0;" class="btn-action single glyphicons" data-toggle="tooltip" data-placement="top" data-original-title="Select the Language of your weidgets. If you find the phrases poorly translated and wnat to help out, please contact us."><span class="appz-question-2" style="display:inline-block"></span></span>
                                            </div>
                                        </div><!--/lang-group-->
                                        <div class="control-group" id="category-group">
                                            <label class="control-label" for="category">General Category</label>
                                            <div class="controls">
                                                <select class="span11" name="category" id="cunjo_category">
                                                    <option value="0">Select..</option>
                                                    <option value="Arts & Entertainment" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Arts & Entertainment')? 'selected' : ''; ?>>Arts & Entertainment</option>
                                                    <option value="Automotive" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Automotive')? 'selected' : ''; ?>>Automotive</option>
                                                    <option value="Beauty" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Beauty')? 'selected' : ''; ?>>Beauty</option>
                                                    <option value="Business" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Business')? 'selected' : ''; ?>>Business</option>
                                                    <option value="Clothing" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Clothing')? 'selected' : ''; ?>>Clothing</option>
                                                    <option value="Consumer Electronics" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Consumer Electronics')? 'selected' : ''; ?>>Consumer Electronics</option>
                                                    <option value="Education" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Education')? 'selected' : ''; ?>>Education</option>
                                                    <option value="Family & Parenting" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Family & Parenting')? 'selected' : ''; ?>>Family & Parenting</option>
                                                    <option value="Finance" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Finance')? 'selected' : ''; ?>>Finance</option>
                                                    <option value="Fitness" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Fitness')? 'selected' : ''; ?>>Fitness</option>
                                                    <option value="Food & Drinks" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Food & Drinks')? 'selected' : ''; ?>>Food & Drinks</option>
                                                    <option value="Games" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Games')? 'selected' : ''; ?>>Games</option>
                                                    <option value="Government" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Government')? 'selected' : ''; ?>>Government</option>
                                                    <option value="Health" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Health')? 'selected' : ''; ?>>Health</option>
                                                    <option value="Home Gardening" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Home Gardening')? 'selected' : ''; ?>>Home Gardening</option>
                                                    <option value="Investments" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Investments')? 'selected' : ''; ?>>Investments</option>
                                                    <option value="Jewelry" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Jewelry')? 'selected' : ''; ?>>Jewelry</option>
                                                    <option value="Jobs" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Jobs')? 'selected' : ''; ?>>Jobs</option>
                                                    <option value="Legal" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Legal')? 'selected' : ''; ?>>Legal</option>
                                                    <option value="Music" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Music')? 'selected' : ''; ?>>Music</option>
                                                    <option value="Pets" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Pets')? 'selected' : ''; ?>>Pets</option>
                                                    <option value="Real Estate" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Real Estate')? 'selected' : ''; ?>>Real Estate</option>
                                                    <option value="Religion" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Religion')? 'selected' : ''; ?>>Religion</option>
                                                    <option value="Science" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Science')? 'selected' : ''; ?>>Science</option>
                                                    <option value="Sports" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Sports')? 'selected' : ''; ?>>Sports</option>
                                                    <option value="Technology" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Technology')? 'selected' : ''; ?>>Technology</option>
                                                    <option value="Travel" <?php echo(isset($view_data['wp_options']['cunjoshare_category']) && $view_data['wp_options']['cunjoshare_category'] == 'Travel')? 'selected' : ''; ?>>Travel</option>
                                                </select>
                                                <span style="margin: 0;" class="btn-action single glyphicons" data-toggle="tooltip" data-placement="top" data-original-title="The category choosen here will be used to record shared category on homepage and posts/pages that do not have a !Share Category assigned."><span class="appz-question-2" style="display:inline-block"></span></span>
                                            </div>
                                        </div><!--/category-group-->
                                    </div><!--/span6-->
                                </div>
                                <div style="text-align:center;width:100%;">
                                	<a href="javascript:void(0)" class="btn btn-primary" id="general_settings-submit" data-loading-text="loading...">Save general settings</a>
                                </div>
                            </div><!--/general-settings-tab-->
                        </form>
                        </div><!--/widget-body-->
                    </div><!--/widget-->
                
                </div><!--/well-->

            </div><!--/content-->
    	
        </div><!--/wrapper-->
   
    </div><!--/container-fluid-->
</div>

<!--Modals-->
<div id="registerShare" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="registerShareLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3 id="myModalLabel">Register !Share ID</h3>
  </div>
  <div class="modal-body">
    <div class="alert alert-info">
        <i class="appz-info-2"></i> <span>You can use your !Share ID for as many websites as you like.</span>
    </div>
    <form class="form-horizontal" id="redisterid-form" novalidate="novalidate">
        <div class="control-group" id="email_register-group">
            <label class="control-label" for="cunjo_email">Email Address*</label>
            <div class="controls">
                <input type="text" name="cunjo_email" id="cunjo_email" type="email">
                <span style="margin: 0;" class="btn-action single glyphicons" data-toggle="tooltip" data-placement="top" data-original-title="Your email address so we can send you securely your !Share ID"><span class="appz-question-2" style="display:inline-block"></span></span>
            </div>
        </div><!--/email_register-group-->
        <div class="control-group" id="firstname_register-group">
            <label class="control-label" for="cunjo_firstname">First name</label>
            <div class="controls">
                <input type="text" name="cunjo_firstname" id="cunjo_firstname" >
                <span style="margin: 0;" class="btn-action single glyphicons" data-toggle="tooltip" data-placement="top" data-original-title="Please type your First name (optional field)"><span class="appz-question-2" style="display:inline-block"></span></span>
            </div>
        </div><!--/firstname_register-group-->
        <div class="control-group" id="lastname_register-group">
            <label class="control-label" for="cunjo_lastname">Last name</label>
            <div class="controls">
                <input type="text" name="cunjo_lastname" id="cunjo_lastname" >
                <span style="margin: 0;" class="btn-action single glyphicons" data-toggle="tooltip" data-placement="top" data-original-title="Please type your Last name (optional field)"><span class="appz-question-2" style="display:inline-block"></span></span>
            </div>
        </div><!--/lastname_register-group-->
        <div class="control-group">
        	<div class="controls">
            	<small>Fields marked with * are mandatory</small>
            </div>
        </div>
    </form>
  </div>
  <div class="modal-footer">
    <div class="uniformjs" style="float: left;">
        <label class="checkbox">
            <div class="checker" id="registerid-terms"><span><input type="checkbox" class="checkbox" value="1" style="opacity: 0;"></span></div>
            I agree with <a href="http://share.cunjo.com/cunjo-share-terms-conditions" target="_blank">Terms & Conditions</a>
        </label>
    </div>
    <button class="btn btn-icon btn-default circle_remove" data-dismiss="modal" aria-hidden="true"><i class="appz-close-3"></i> Close</button>
    <button type="submit" class="btn btn-icon btn-primary circle_ok" id="submit-registerid" data-loading-text="loading..."><i class="appz-checkmark-circle-2"></i> Register</button>
  </div>
</div>
<?php //echo '<pre>'.print_r($view_data, true).'</pre>'; ?>