if(!window.log) {window.log = function() {log.history = log.history || [];log.history.push(arguments);if(this.console) {console.log(Array.prototype.slice.call(arguments));}};}
/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
    window.getComputedStyle = function(el, pseudo) {
        this.el = el;
        this.getPropertyValue = function(prop) {
            var re = /(\-([a-z]){1})/g;
            if (prop == 'float') prop = 'styleFloat';
            if (re.test(prop)) {
                prop = prop.replace(re, function () {
                    return arguments[2].toUpperCase();
                });
            }
            return el.currentStyle[prop] ? el.currentStyle[prop] : null;
        }
        return this;
    }
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {

    /*
    Responsive jQuery is a tricky thing.
    There's a bunch of different ways to handle
    it, so be sure to research and find the one
    that works for you best.
    */
    
    /* getting viewport width */
    var responsive_viewport = $(window).width();
    
    /* if is below 481px */
    if (responsive_viewport < 481) {
    
    } /* end smallest screen */
    
    /* if is larger than 481px */
    if (responsive_viewport > 481) {
        
    } /* end larger than 481px */
    
    /* if is above or equal to 768px */
    if (responsive_viewport >= 768) {
    
        /* load gravatars */
        $('.comment img[data-gravatar]').each(function(){
            $(this).attr('src',$(this).attr('data-gravatar'));
        });
        
    }
    
    /* off the bat large screen actions */
    if (responsive_viewport > 1030) {
        
    }
    
	
	// add all your scripts here
    resizeQueue();
    $(window).resize(function() {
      resizeQueue();
    });

    $("#btn-repeat").click(function(){

        addAction(this);

        return false;
    });
    initRepeatFields();
    $('form.register-voter, form.register-politician').NiceIt();

}); /* end of as page load scripts */


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
    var doc = w.document;
    if( !doc.querySelector ){ return; }
    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
		x, y, z, aig;
    if( !meta ){ return; }
    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true; }
    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false; }
    function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );

function resizeQueue() {
    var cf_height = jQuery('#candidate-slider .flexslider').height();
    var ca_height = jQuery('#candidate-slider .advanceSearch').height();
    jQuery('#candidate-slider .advanceSearch').height(cf_height);
    //jQuery('form.register-voter, form.register-politician').NiceIt();
}

function sumRepeating() {
    var entries = jQuery(".um_field_container.repeate-me");
    var allfields = [];
        log("entries",entries);
    jQuery(entries).each(function(){ 
        log("this",this);
        var arr = [];     
        inputs = jQuery(this).find(".repeat-input");  
        var item = '{';
        inputs.each(function(){

            log("this.value",this.value);
            log("this.name",this.name);
            if((this.value !=null)&&(this.value !="")){
                if(item != '{'){
                    item += ',';
                }
                item += '"'+this.name+'" : "'+this.value+'"';
                log(item);
            }        
        });
                item += '}';
                item = JSON.parse(item);
            log("item",item);
        allfields.push(item);
        log("allfields",allfields);
    });
    jQuery("input[name=youtube]").val(JSON.stringify(allfields));
}

function addAction(){
    log("click");
    var num = jQuery(".repeatingField .um_field_container").length;
    jQuery(".repeatingField").append(getNewField(num , '', '', ''));
    log("append");
    jQuery(".repeatingField .repeat-input").off().change(function(){
        sumRepeating();
        log('change');
    }).blur(function(){log('blur');sumRepeating();});

    jQuery(".repeatingField input.btn-remove-video").off().click(function(){
        removeAction(this)
    });
}

function removeAction(youtubeItem) {    
    log('removeAction start ---');
    var Rfield = jQuery(youtubeItem).parent();
    log('Rfield',Rfield);
    var youtude_pid = jQuery(youtubeItem).find(".youtube-pid").val();
    var toRemoveField = jQuery("input[name=youtube_remove]").val();
    
    log('toRemove',toRemoveField);

    if((toRemoveField==null)||(toRemoveField=='')||(toRemoveField==undefined)){
        toRemove = [];
        toRemove.push(youtude_pid);
    } else {
        toRemove = JSON.parse(toRemoveField);
        log("toRemoveField", toRemoveField);
        toRemove.push(youtude_pid);
    }

    jQuery("input[name=youtube_remove]").val(JSON.stringify(toRemove));
    Rfield.remove();
    sumRepeating();
    if(jQuery('.repeate-me').length ==0) {
        addAction();
    }
    log('removeAction end ----');
}

function initRepeatFields(){
    log('initRepeatFields');
    if(jQuery("input[name=youtube]").length) {
        var v = jQuery("input[name=youtube]").val();
        //log("v",v);
        if(v != ""){
            var inputsVals = JSON.parse(v);
            //log("inputsVals", inputsVals);
            var length = inputsVals.length,
            element = null;
        } else {
            length = 0;
            i=0;
        }
        
        for (var i = 0; i < length; i++) {
            element = inputsVals[i];
            log("element", element);
            jQuery(".repeatingField").append(getNewField(i, element.name, element.url, element.pid));
        }

        i++;
        jQuery(".repeatingField").append( getNewField(i, '', '', ''));

        // Event handlers after we create the items
        jQuery(".repeatingField .repeat-input").off().change(function(){
            sumRepeating();
            log('change');
        }).blur(function(){log('blur');sumRepeating();});


        jQuery(".repeatingField input.btn-remove-video").off().click(function(){
            removeAction(this);
        });
    }
}

function getNewField(i, title, url, pid){
    var pid = pid ? pid : '';
    return [
        '<div class="um_field_container repeate-me" >',
        '<label class="um_label_top" for="youtube-t-'+i+'t">YouTube Title</label>',
        '<input type="text" name="name" id="youtube-t-'+i+'" class="um_field um_input repeat-input" label_id="youtube-t-'+i+'" value="'+title+'">',
        '<br/>',
        '<label class="um_label_top" for="youtube-u-'+i+'">YouTube URL</label>',
        '<input type="text" name="url" id="youtube-u-'+i+'" class="um_field um_input repeat-input" label_id="youtube-u-'+i+'" value="'+url+'">',
        '<input value="Remove" type="button" class="btn btn-remove-video" />',
        '<input class="youtube-pid" name="pid" value="'+pid+'" type="hidden" />',
        '</div>'
    ].join('');
}