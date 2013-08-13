function addShortcode() {
	var shortcodevalue;
	var style = document.getElementById('mb2_shordoces_container');
	if (style.className.indexOf('current') != -1) {
		var selected_shortcode = document.getElementById('mb2_shordoces_select').value;





/*-----------------------------------------------------------------------------------*/
/*	Accordions and Tabs
/*-----------------------------------------------------------------------------------*/	
/*accordion*/
if (selected_shortcode == 'accorion'){
shortcodevalue = "[accordion]<br/><br/>[toggle title='Accordion 1 Title Here...']Content of accordion 1 here...[/toggle]<br/>[toggle title='Accordion 2 Title Here...']Content of accordion 2 here...[/toggle]<br/>[toggle title='Accordion 3 Title Here...']Content of accordion 3 here...[/toggle]<br/><br/>[/accordion][clear]";	
}


/*tabs*/
if (selected_shortcode == 'tabs'){
shortcodevalue = "[tabs tab1='Tab 1' tab2='Tab 2' tab3='Tab 3']<br/><br/>[tab]Content of tab 1 here...[/tab]<br/>[tab]Content of tab 2 here...[/tab]<br/>[tab]Content of tab 3 here...[/tab]<br/><br/>[/tabs][clear]";	
}






/*-----------------------------------------------------------------------------------*/
/*	Audio
/*-----------------------------------------------------------------------------------*/	
/*audio default
if (selected_shortcode == 'audio_default'){
shortcodevalue = "[audio url='' width='450' align='' preload='none']";
}

*/






/*-----------------------------------------------------------------------------------*/
/*	Boxes
/*-----------------------------------------------------------------------------------*/	
/*box style 1*/
if (selected_shortcode == 'box_gray'){
shortcodevalue = "[box style='gray' title='Box gray style']<br/>Lorem ipsum dolor sit amet, <a href='#'>consectetur</a> adipiscing elit. Phasellus at magna libero, quis viverra libero. Donec sit amet tortor in elit mollis eleifend. Nunc a lacinia mauris. In hac habitasse platea dictumst.<br/>[/box]";	
}




/*box blue*/
if (selected_shortcode == 'box_blue'){
shortcodevalue = "[box style='blue' title='Box blue style']<br/>Lorem ipsum dolor sit amet, <a href='#'>consectetur</a> adipiscing elit. Phasellus at magna libero, quis viverra libero. Donec sit amet tortor in elit mollis eleifend. Nunc a lacinia mauris. In hac habitasse platea dictumst.<br/>[/box]";	
}




/*box green*/
if (selected_shortcode == 'box_green'){
shortcodevalue = "[box style='green' title='Box green style']<br/>Lorem ipsum dolor sit amet, <a href='#'>consectetur</a> adipiscing elit. Phasellus at magna libero, quis viverra libero. Donec sit amet tortor in elit mollis eleifend. Nunc a lacinia mauris. In hac habitasse platea dictumst.<br/>[/box]";	
}






/*box red*/
if (selected_shortcode == 'box_red'){
shortcodevalue = "[box style='red' title='Box red style']<br/>Lorem ipsum dolor sit amet, <a href='#'>consectetur</a> adipiscing elit. Phasellus at magna libero, quis viverra libero. Donec sit amet tortor in elit mollis eleifend. Nunc a lacinia mauris. In hac habitasse platea dictumst.<br/>[/box]";	
}






/*box bag*/
if (selected_shortcode == 'box_bag'){
shortcodevalue = "[box style='bag' title='Box bag style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}




/*box box*/
if (selected_shortcode == 'box_box'){
shortcodevalue = "[box style='box' title='Box box style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}




/*box check*/
if (selected_shortcode == 'box_check'){
shortcodevalue = "[box style='check' title='Box check style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}




/*box contact*/
if (selected_shortcode == 'box_contact'){
shortcodevalue = "[box style='contact' title='Box contact style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}




/*box download*/
if (selected_shortcode == 'box_download'){
shortcodevalue = "[box style='download' title='Box download style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}



/*box exchage*/
if (selected_shortcode == 'box_exchange'){
shortcodevalue = "[box style='exchange' title='Box exchange style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}



/*box mail*/
if (selected_shortcode == 'box_mail'){
shortcodevalue = "[box style='mail' title='Box mail style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}






/*box note*/
if (selected_shortcode == 'box_note'){
shortcodevalue = "[box style='note' title='Box note style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}






/*box presentation*/
if (selected_shortcode == 'box_presentation'){
shortcodevalue = "[box style='presentation' title='Box presentation style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}





/*box search*/
if (selected_shortcode == 'box_search'){
shortcodevalue = "[box style='search' title='Box search style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}





/*box shoppingcart*/
if (selected_shortcode == 'box_shoppingcart'){
shortcodevalue = "[box style='shoppingcart' title='Box shoppingcart style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}






/*box settings*/
if (selected_shortcode == 'box_settings'){
shortcodevalue = "[box style='settings' title='Box settings style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}





/*box upload*/
if (selected_shortcode == 'box_upload'){
shortcodevalue = "[box style='upload' title='Box upload style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...[/box]";	
}













/*-----------------------------------------------------------------------------------*/
/*	Buttons
/*-----------------------------------------------------------------------------------*/	
/*arrow link*/
if (selected_shortcode == 'arrow_link'){
shortcodevalue = "[arrow_link link='#' target='_self']";	
}


/*button small*/
if (selected_shortcode == 'button_small'){
shortcodevalue = "[button link='#' value='Button text here...']";	
}



/*button blue*/
if (selected_shortcode == 'button_blue'){
shortcodevalue = "[button link='#' value='Button text here...' color='#ffffff' background='#1392d4']";	
}



/*button green*/
if (selected_shortcode == 'button_green'){
shortcodevalue = "[button link='#' value='Button text here...' color='#ffffff' background='#40bb20']";	
}



/*button orange*/
if (selected_shortcode == 'button_orange'){
shortcodevalue = "[button link='#' value='Button text here...' color='#ffffff' background='#f27a2a']";	
}



/*button yellow*/
if (selected_shortcode == 'button_yellow'){
shortcodevalue = "[button link='#' value='Button text here...' color='#ffffff' background='#e3d20f']";	
}



/*button big*/
if (selected_shortcode == 'button_big'){
shortcodevalue = "[button_big link='#' value='Button text here...']";	
}



/*button blue*/
if (selected_shortcode == 'button_big_blue'){
shortcodevalue = "[button_big link='#' value='Button text here...' color='#ffffff' background='#1392d4']";	
}



/*button green*/
if (selected_shortcode == 'button_big_green'){
shortcodevalue = "[button_big link='#' value='Button text here...' color='#ffffff' background='#40bb20']";	
}



/*button orange*/
if (selected_shortcode == 'button_big_orange'){
shortcodevalue = "[button_big link='#' value='Button text here...' color='#ffffff' background='#f27a2a']";	
}



/*button yellow*/
if (selected_shortcode == 'button_big_yellow'){
shortcodevalue = "[button_big link='#' value='Button text here...' color='#ffffff' background='#e3d20f']";	
}



/*button archive icon*/
if (selected_shortcode == 'button_big_archive'){
shortcodevalue = "[button_big link='#' style='archive' value='Button text here...' color='' background='']";	
}



/*button bag icon*/
if (selected_shortcode == 'button_big_bag'){
shortcodevalue = "[button_big link='#' style='bag' value='Button text here...' color='' background='']";	
}



/*button cart icon*/
if (selected_shortcode == 'button_big_cart'){
shortcodevalue = "[button_big link='#' style='cart' value='Button text here...' color='' background='']";	
}



/*button document icon*/
if (selected_shortcode == 'button_big_document'){
shortcodevalue = "[button_big link='#' style='document' value='Button text here...' color='' background='']";	
}



/*button download icon*/
if (selected_shortcode == 'button_big_download'){
shortcodevalue = "[button_big link='#' style='download' value='Button text here...' color='' background='']";	
}



/*button image icon*/
if (selected_shortcode == 'button_big_image'){
shortcodevalue = "[button_big link='#' style='image' value='Button text here...' color='' background='']";	
}



/*button link icon*/
if (selected_shortcode == 'button_big_link'){
shortcodevalue = "[button_big link='#' style='link' value='Button text here...' color='' background='']";	
}



/*button mail icon*/
if (selected_shortcode == 'button_big_mail'){
shortcodevalue = "[button_big link='#' style='mail' value='Button text here...' color='' background='']";	
}



/*button upload icon*/
if (selected_shortcode == 'button_big_upload'){
shortcodevalue = "[button_big link='#' style='upload' value='Button text here...' color='' background='']";	
}



/*button video icon*/
if (selected_shortcode == 'button_big_video'){
shortcodevalue = "[button_big link='#' style='video' value='Button text here...' color='' background='']";	
}



/*button width lightbox link*/
if (selected_shortcode == 'button_big_video_lightbox'){
shortcodevalue = "[button_big lightbox_link='http://www.youtube.com/watch?v=v_GUm4aOUiM' style='video' value='Button text here...' color='' background='']";	
}







/*-----------------------------------------------------------------------------------*/
/*	Clear div
/*-----------------------------------------------------------------------------------*/	
if (selected_shortcode == 'clear'){
shortcodevalue = "[clear]";	
}






/*-----------------------------------------------------------------------------------*/
/*	Columns
/*-----------------------------------------------------------------------------------*/	
/*columns 50/50*/
if (selected_shortcode == 'columns_50_50'){
shortcodevalue = "[one_two_first]<br/>First column content here...<br/>[/one_two_first]<br/><br/>[one_two_last]<br/>Two column content here...<br/>[/one_two_last]<br/><br/>[clear]";	
}



/*columns 30/30/30*/
if (selected_shortcode == 'columns_30_30_30'){
shortcodevalue = "[one_three_first]<br/>First column content here...<br/>[/one_three_first]<br/><br/>[one_three]<br/>Two column content here...<br/>[/one_three]<br/><br/>[one_three_last]<br/>Three column content here...<br/>[/one_three_last]<br/><br/>[clear]";	
}



/*columns 25/25/25/25*/
if (selected_shortcode == 'columns_25_25_25_25'){
shortcodevalue = "[one_four_first]<br/>First column content here...<br/>[/one_four_first]<br/><br/>[one_four]<br/>Two column content here...<br/>[/one_four]<br/><br/>[one_four]<br/>Three column content here...<br/>[/one_four]<br/><br/>[one_four_last]<br/>Four column content here...<br/>[/one_four_last]<br/><br/>[clear]";	
}



/*columns 60/30*/
if (selected_shortcode == 'columns_60_30'){
shortcodevalue = "[two_three_first]<br/>First column content here...<br/>[/two_three_first]<br/><br/>[one_three_last]<br/>Two column content here...<br/>[/one_three_last]<br/><br/>[clear]";	
}



/*columns 30/60*/
if (selected_shortcode == 'columns_30_60'){
shortcodevalue = "[one_three_first]<br/>First column content here...<br/>[/one_three_first]<br/><br/>[two_three_last]<br/>Two column content here...<br/>[/two_three_last]<br/><br/>[clear]";	
}



/*columns 50/25/25*/
if (selected_shortcode == 'columns_50_25_25'){
shortcodevalue = "[one_two_first]<br/>First column content here...<br/>[/one_two_first]<br/><br/>[one_four]<br/>Two column content here...<br/>[/one_four]<br/><br/>[one_four_last]<br/>Three column content here...<br/>[/one_four_last]<br/><br/>[clear]";	
}



/*columns 25/25/50*/
if (selected_shortcode == 'columns_25_25_50'){
shortcodevalue = "[one_four_first]<br/>First column content here...<br/>[/one_four_first]<br/><br/>[one_four]<br/>Two column content here...<br/>[/one_four]<br/><br/>[one_two_last]<br/>Three column content here...<br/>[/one_two_last]<br/><br/>[clear]";	
}



/*columns 75/25*/
if (selected_shortcode == 'columns_75_25'){
shortcodevalue = "[three_four_first]<br/>First column content here...<br/>[/three_four_first]<br/><br/>[one_four_last]<br/>Two column content here...<br/>[/one_four_last]<br/><br/>[clear]";	
}



/*columns 25/75*/
if (selected_shortcode == 'columns_25_75'){
shortcodevalue = "[one_four_first]<br/>First column content here...<br/>[/one_four_first]<br/><br/>[three_four_last]<br/>Two column content here...<br/>[/three_four_last]<br/><br/>[clear]";	
}






/*-----------------------------------------------------------------------------------*/
/*	Dropcaps
/*-----------------------------------------------------------------------------------*/	
/*dropcap style 1*/
if (selected_shortcode == 'dropcap_style1'){
shortcodevalue = "[dropcap value='A' style='style1']";
}



/*dropcap style 2*/
if (selected_shortcode == 'dropcap_style2'){
shortcodevalue = "[dropcap value='B' style='style2']";
}



/*dropcap style 3*/
if (selected_shortcode == 'dropcap_style3'){
shortcodevalue = "[dropcap value='C' style='style3']";
}








/*-----------------------------------------------------------------------------------*/
/*	Images
/*-----------------------------------------------------------------------------------*/	
/*image default*/
if (selected_shortcode == 'image_default'){
shortcodevalue = "[image url='' link='#' align='left' width='280' height='180' title='']";	
}




/*image lightbox*/
if (selected_shortcode == 'image_lightbox'){
shortcodevalue = "[image url='' link='#' align='left' width='280' height='180' title='' lightbox='true']";	
}




/*video youtube*/
if (selected_shortcode == 'video_youtube_fixed'){
shortcodevalue = "[youtube id='UX7GycmeQVo' flexible='0' width='600' height='320']";	
}



/*video youtube (flexible)*/
if (selected_shortcode == 'video_youtube_flexible'){
shortcodevalue = "[youtube id='UX7GycmeQVo']";	
}




/*video vimeo*/
if (selected_shortcode == 'video_vimeo_fixed'){
shortcodevalue = "[vimeo id='23534361' flexible='0' width='600' height='337']";	
}



/*video vimeo (flexible)*/
if (selected_shortcode == 'video_vimeo_flexible'){
shortcodevalue = "[vimeo id='23534361']";	
}




/*video lightbox*/
if (selected_shortcode == 'video_lightbox'){
shortcodevalue = "[video_lightbox video_url='' thumbnail_url='' width='280' height='180' title='' align='left']";}




/*image gallery lightbox*/
if (selected_shortcode == 'gallery_image_lightbox'){
shortcodevalue = "[gall_container id='']<br/><br/>[image gallery_id='1' url='' width='280' height='180' title='' lightbox='true']<br/>[image gallery_id='1' url='' width='280' height='180' title='' lightbox='true']<br/>[image gallery_id='1' url='' width='280' height='180' title='' lightbox='true']<br/><br/>[/gall_container][clear]";
}




/*video gallery lightbox*/
if (selected_shortcode == 'gallery_video_lightbox'){
shortcodevalue = "[gall_container id='']<br/><br/>[video_lightbox gallery_id='2' video_url='' thumbnail_url='' width='280' height='180' title='']<br/>[video_lightbox gallery_id='2' video_url='' thumbnail_url='' width='280' height='180' title='']<br/>[video_lightbox gallery_id='2' video_url='' thumbnail_url='' width='280' height='180' title='']<br/><br/>[/gall_container][clear]";	
}





/*mixed gallery lightbox*/
if (selected_shortcode == 'gallery_mixed_lightbox'){
shortcodevalue = "[gall_container id='']<br/><br/>[video_lightbox gallery_id='3' video_url='' thumbnail_url='' width='280' height='180' title='']<br/>[image gallery_id='3' url='' width='280' height='180' title='' lightbox='true']<br/>[video_lightbox gallery_id='3' video_url='' thumbnail_url='' width='280' height='180' title='']<br/><br/>[/gall_container][clear]";	
}









/*-----------------------------------------------------------------------------------*/
/*	Lists
/*-----------------------------------------------------------------------------------*/	
/*lost ordered*/
if (selected_shortcode == 'list_ordered'){
shortcodevalue = "[ol_list]<br/><br/>[li]List text here...[/li]<br/>[li]List text here...[/li]<br/><br/>[/ol_list]";	
}




/*list unordered*/
if (selected_shortcode == 'list_unordered'){
shortcodevalue = "[list]<br/><br/>[li]List text here...[/li]<br/>[li]List text here...[/li]<br/><br/>[/list]";	
}




/*list style arrow*/
if (selected_shortcode == 'list_style_arrow'){
shortcodevalue = "[list style='arrow']<br/><br/>[li]List text here...[/li]<br/>[li]List text here...[/li]<br/><br/>[/list]";	
}




/*list style check*/
if (selected_shortcode == 'list_style_check'){
shortcodevalue = "[list style='check']<br/><br/>[li]List text here...[/li]<br/>[li]List text here...[/li]<br/><br/>[/list]";	
}




/*list style document*/
if (selected_shortcode == 'list_style_document'){
shortcodevalue = "[list style='document']<br/><br/>[li]List text here...[/li]<br/>[li]List text here...[/li]<br/><br/>[/list]";	
}




/*list style mail*/
if (selected_shortcode == 'list_style_mail'){
shortcodevalue = "[list style='mail']<br/><br/>[li]List text here...[/li]<br/>[li]List text here...[/li]<br/><br/>[/list]";	
}




/*list style phone*/
if (selected_shortcode == 'list_style_phone'){
shortcodevalue = "[list style='phone']<br/><br/>[li]List text here...[/li]<br/>[li]List text here...[/li]<br/><br/>[/list]";	
}




/*list style star*/
if (selected_shortcode == 'list_style_star'){
shortcodevalue = "[list style='star']<br/><br/>[li]List text here...[/li]<br/>[li]List text here...[/li]<br/><br/>[/list]";	
}




/*list style menu1*/
if (selected_shortcode == 'list_style_menu1'){
shortcodevalue = "[list style='menu1' title='Menu 1' text_align='center']<br/><br/>[li]<a href='#'>Menu item here...</a>[/li]<br/>[li]<a href='#'>Menu item here...</a>[/li]<br/><br/>[/list]";	
}




/*list style menu2*/
if (selected_shortcode == 'list_style_menu2'){
shortcodevalue = "[list style='menu2' title='Menu 2']<br/><br/>[li]<a href='#'>Menu item here...</a>[/li]<br/>[li]<a href='#'>Menu item here...</a>[/li]<br/><br/>[/list]";	
}




/*list style menu3*/
if (selected_shortcode == 'list_style_menu3'){
shortcodevalue = "[list style='menu3' title='Menu 3']<br/><br/>[li]<a href='#'>Menu item here...</a>[/li]<br/>[li]<a href='#'>Menu item here...</a>[/li]<br/><br/>[/list]"; 	
}





/*-----------------------------------------------------------------------------------*/
/*	Messages
/*-----------------------------------------------------------------------------------*/	
/*message blue*/
if (selected_shortcode == 'message_blue'){
shortcodevalue = "[message type='blue']<br/>Lorem ipsum dolor sit amet, adipiscing elit. Phasellus at magna libero, quis viverra libero. Donec sit amet tortor in elit mollis eleifend. Nunc a lacinia mauris. <a href='#'>Link text</a><br/>[/message]";	
}




/*message green*/
if (selected_shortcode == 'message_green'){
shortcodevalue = "[message type='green']<br/>Lorem ipsum dolor sit amet, adipiscing elit. Phasellus at magna libero, quis viverra libero. Donec sit amet tortor in elit mollis eleifend. Nunc a lacinia mauris. <a href='#'>Link text</a><br/>[/message]";	
}




/*message red*/
if (selected_shortcode == 'message_red'){
shortcodevalue = "[message type='red']<br/>Lorem ipsum dolor sit amet, adipiscing elit. Phasellus at magna libero, quis viverra libero. Donec sit amet tortor in elit mollis eleifend. Nunc a lacinia mauris. <a href='#'>Link text</a><br/>[/message]";	
}




/*message green*/
if (selected_shortcode == 'message_yellow'){
shortcodevalue = "[message type='yellow']<br/>Lorem ipsum dolor sit amet, adipiscing elit. Phasellus at magna libero, quis viverra libero. Donec sit amet tortor in elit mollis eleifend. Nunc a lacinia mauris. <a href='#'>Link text</a><br/>[/message]";	
}










/*-----------------------------------------------------------------------------------*/
/*	Pages
/*-----------------------------------------------------------------------------------*/	
/*Home page 1*/
if (selected_shortcode == 'page_home_1'){
shortcodevalue = "[one_two_first]<br/><br/>[image url='' link='' align='left' width='213' height='200' title='' ]<br/>[h4]In non mollis ante[/h4]<br/><br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit nibh libero id lorem. Nulla molestie sollicitudin dictum. Curabitur sit amet varius eros. Sed a arcu eu mauris dictum Sed a iaculis metus. Aliquam urna dolor, vestibulum….<br/><br/>[arrow_link link='#' value='Read More']<br/><br/>[/one_two_first]<br/><br/>[one_two_last]<br/><br/>[box style='gray' title='Phasellus at magna' text_align='center']<br/><br/>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at magna libero, quis viverra libero. Donec sit amet tortor in elit mollis eleifend. Nunc a lacinia mauris. In hac habitasse platea dictumst. Sed a iaculis metus. Aliquam urna dolor, vestibulum ac mattis id, semper in justo.<br/><br/>[button_big lightbox_link='http://www.youtube.com/watch?v=v_GUm4aOUiM' style='video' value='Watch Video']<br/><br/>[/box]<br/><br/>[/one_two_last]<br/>[clear]<br/><br/>[separator margin_top='10' margin_bottom='30']<br/><br/>[one_four_first]<br/><br/>[list style='menu1' text_align='center' title='Mauris eleifend']<br/><br/>[li]<a href='#'>Pellentesque fermentum</a>[/li]<br/>[li active='true']<a href='#'>Donec vulputate</a>[/li]<br/>[li]<a href='#'>Suspendisse eget</a>[/li]<br/>[li]<a href='#'>Duis aliquet ultricies enim</a>[/li]<br/>[li]<a href='#'>Aliquam eu erat at</a>[/li]<br/><br/>[/list]<br/><br/>[/one_four_first]<br/><br/>[one_four]<br/><br/>[image url='' lightbox='true' gallery_id='gallery1' align='center' width='480' height='320' title='']<br/>[h4]Suscipit nibh[/h4]<br/><br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit nibh libero id lorem<br/><br/>[button link='#' value='Read more']<br/><br/>[/one_four]<br/><br/>[one_four]<br/><br/>[image url='' lightbox='true' gallery_id='gallery1' align='center' width='480' height='320' title='']<br/>[h4]Suscipit nibh[/h4]<br/><br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit nibh libero id lorem<br/><br/>[button link='#' value='Read more']<br/><br/>[/one_four]<br/><br/>[one_four_last]<br/>[image url='' lightbox='true' gallery_id='gallery1' align='center' width='480' height='320' title='']<br/>[h4]Suscipit nibh[/h4]<br/><br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit nibh libero id lorem<br/><br/>[button link='#' value='Read more']<br/><br/>[/one_four_last]<br/>[clear]<br/><br/>[separator margin_top='10' margin_bottom='30']<br/><br/>[one_four_first]<br/><br/>[box style='bag' title='Box bag style']<br/><br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit....<br/><br/>[arrow_link link='#' target='_self'][/box]<br/><br/>[/one_four_first]<br/><br/>[one_four]<br/><br/>[box style='box' title='Box box style']<br/><br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit....<br/><br/>[arrow_link link='#' target='_self'][/box]<br/><br/>[/one_four]<br/><br/>[one_four]<br/><br/>[box style='settings' title='Box settings style']<br/><br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit....<br/><br/>[arrow_link link='#' target='_self'][/box]<br/><br/>[/one_four]<br/><br/>[one_four_last]<br/><br/>[box style='exchange' title='Box exchange style']<br/><br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit....<br/><br/>[arrow_link link='#' target='_self'][/box]<br/><br/>[/one_four_last]<br/>[clear]";	
}





/*Home page 2*/
if (selected_shortcode == 'page_home_2'){
shortcodevalue = "[center]<br/><br/>[h2 style='no-margin']Mauris ac dorta malna [span size='28' weight='' transform='uppercase' style='' color='#5d89b4']mauris commodo[/span] eleifend iuis in hac habitasse[/h2]<br/>[h4][span size='18' weight='normal' transform='' style='italic' color='#a8a8a8']Ut laoreet nibh id risus molestie non laoreet ante volutpat[/span][/h4]<br/><br/>[button_big style='bag' link='#' value='Portfolio']<br/>[button_big style='cart' link='#' value='Get It Now' color='#ffffff' background='#f27a2a']<br/><br/>[/center]<br/>[clear]<br/><br/>[gap height='25']<br/><br/>[h4 style='title1']Latest Projects[/h4]<br/><br/>[recent_projects column='4' thumbnail_width='450' thumbnail_height='250' gallery_style='false']<br/>[clear]<br/><br/>[gap height='10']<br/><br/>[one_three_first]<br/><br/>[accordion]<br/><br/>[toggle title='Service One']<br/><br/>Pellentesque eu nulla erat. Mauris faucibus eleifend neque a consectetur. Nullam dapibus auctor convallis. Suspendisse gravida imperdiet<br/><br/>[arrow_link link='#' target='_self']<br/><br/>[/toggle]<br/><br/>[toggle title='Service Two']<br/><br/>Pellentesque eu nulla erat. Mauris faucibus eleifend neque a consectetur. Nullam dapibus auctor convallis. Suspendisse gravida imperdiet<br/><br/>[arrow_link link='#' target='_self']<br/><br/>[/toggle]<br/><br/>[toggle title='Service Three']<br/><br/>Pellentesque eu nulla erat. Mauris faucibus eleifend neque a consectetur. Nullam dapibus auctor convallis. Suspendisse gravida imperdiet<br/><br/>[arrow_link link='#' target='_self']<br/><br/>[/toggle]<br/><br/>[/accordion]<br/>[clear]<br/><br/>[/one_three_first]<br/><br/>[two_three_last]<br/><br/>[tabs tab1='Pellentesque' tab2='Fusce' tab3='Suspendisse']<br/><br/>[tab]<br/>[image url='' link='' align='left' width='280' height='180' title='']<br/>[h6]Mauris faucibus eleifend[/h6]<br/><br/>Pellentesque eu nulla erat. Mauris faucibus eleifend neque a consectetur. Nullam dapibus auctor convallis. Suspendisse gravida imperdiet sapien ut bibendum. Fusce sodales velit non neque hendrerit molestie. Integer porttitor, sapien vitae iaculis scelerisque, orci tortor adipiscing lorem.<br/><br/>[button link='#' value='Read More']<br/>[/tab]<br/><br/>[tab]<br/>[image url='' link='' align='left' width='280' height='180' title='']<br/>[h6]Mauris faucibus eleifend[/h6]<br/><br/>Pellentesque eu nulla erat. Mauris faucibus eleifend neque a consectetur. Nullam dapibus auctor convallis. Suspendisse gravida imperdiet sapien ut bibendum. Fusce sodales velit non neque hendrerit molestie. Integer porttitor, sapien vitae iaculis scelerisque, orci tortor adipiscing lorem.<br/><br/>[button link='#' value='Read More']<br/>[/tab]<br/><br/>[tab]<br/>[image url='' link='' align='left' width='280' height='180' title='']<br/>[h6]Mauris faucibus eleifend[/h6]<br/><br/>Pellentesque eu nulla erat. Mauris faucibus eleifend neque a consectetur. Nullam dapibus auctor convallis. Suspendisse gravida imperdiet sapien ut bibendum. Fusce sodales velit non neque hendrerit molestie. Integer porttitor, sapien vitae iaculis scelerisque, orci tortor adipiscing lorem.<br/><br/>[button link='#' value='Read More']<br/>[/tab]<br/><br/>[/tabs]<br/>[clear]<br/><br/>[/two_three_last]<br/>[clear]";	
}












/*Home page 3*/
if (selected_shortcode == 'page_home_3'){
shortcodevalue = "[one_two_first]<br/><br/>[box style='gray' title='Some Welcome Text']<br/><br/>Suspendisse ullamcorper mollis porta. Suspendisse tincidunt consequat purus id aliquam. Morbi sed turpis at libero pulvinar aliquet vel id turpis. Pellentesque eleifend ornare sem, mollis faucibus magna sagittis eu.<br/><br/>[arrow_link link='#' target='_self']<br/><br/>[/box]<br/><br/>[/one_two_first]<br/><br/>[one_two_last]<br/><br/>[tabs tab1='Morbi' tab2='Suspendisse' tab3='Faucibus']<br/><br/>[tab]<br/>[image url='' link='#' align='left' width='120' height='100' title='']<br/>[h6]Donec tristique augue[/h6]<br/><br/>Sed ipsum lobortis et placerat ante mattis. Quisque sem leo, pharetra porttitor sagittis id, mattis et elit. In posuere diam id nulla iaculis id laoreet nisl gravida. <a href='#'>More...</a><br/><br/>[/tab]<br/><br/>[tab]<br/>[image url='' link='#' align='left' width='120' height='100' title='']<br/>[h6]Donec tristique augue[/h6]<br/><br/>Sed ipsum lobortis et placerat ante mattis. Quisque sem leo, pharetra porttitor sagittis id, mattis et elit. In posuere diam id nulla iaculis id laoreet nisl gravida. <a href='#'>More...</a><br/><br/>[/tab]<br/><br/>[tab]<br/>[image url='' link='#' align='left' width='120' height='100' title='']<br/>[h6]Donec tristique augue[/h6]<br/><br/>Sed ipsum lobortis et placerat ante mattis. Quisque sem leo, pharetra porttitor sagittis id, mattis et elit. In posuere diam id nulla iaculis id laoreet nisl gravida. <a href='#'>More...</a><br/><br/>[/tab]<br/><br/>[/tabs]<br/>[clear]<br/><br/>[/one_two_last]<br/>[clear]<br/><br/>[gap height='10']<br/><br/>[h4 style='title1']Some Features[/h4]<br/><br/>[one_three_first]<br/>[image url='' link='' align='left' width='450' height='250' title='']<br/>[h4]Vestibulum velit nisl[/h4]<br/><br/>Vestibulum velit nisl, condimentum at volutpat eu, mattis et odio. Etiam varius pharetra sem, eget sollic itudin erat sollicitudin eget.<br/><br/>[button link='#' value='Read More']<br/><br/>[/one_three_first]<br/><br/>[one_three]<br/><br/>[image url='' link='' align='left' width='450' height='250' title='']<br/>[h4]Vestibulum velit nisl[/h4]<br/><br/>Vestibulum velit nisl, condimentum at volutpat eu, mattis et odio. Etiam varius pharetra sem, eget sollic itudin erat sollicitudin eget.<br/><br/>[button link='#' value='Read More']<br/><br/>[/one_three]<br/><br/>[one_three_last]<br/><br/>[image url='' link='' align='left' width='450' height='250' title='']<br/>[h4]Vestibulum velit nisl[/h4]<br/><br/>Vestibulum velit nisl, condimentum at volutpat eu, mattis et odio. Etiam varius pharetra sem, eget sollic itudin erat sollicitudin eget.<br/><br/>[button link='#' value='Read More']<br/><br/>[/one_three_last]<br/>[clear]<br/><br/>[gap height='10']<br/><br/>[h4 style='title1']Services[/h4]<br/><br/>[one_three_first]<br/><br/>[dropcap value='1' style='style2']Vivamus aliquet tincidunt justo. Curabitur rutrum risus vel augue venenatis consequat. Nam scelerisque fringilla velit, sollicitudin gravida sem hendrerit auctor tiam sagittis...<br/>[/one_three_first]<br/><br/>[one_three]<br/><br/>[dropcap value='2' style='style2']Vivamus aliquet tincidunt justo. Curabitur rutrum risus vel augue venenatis consequat. Nam scelerisque fringilla velit, sollicitudin gravida sem hendrerit auctor tiam sagittis...<br/><br/>[/one_three]<br/><br/>[one_three_last]<br/><br/>[dropcap value='3' style='style2']Vivamus aliquet tincidunt justo. Curabitur rutrum risus vel augue venenatis consequat. Nam scelerisque fringilla velit, sollicitudin gravida sem hendrerit auctor tiam sagittis...<br/><br/>[/one_three_last]<br/>[clear]";	
}









/*page about us*/
if (selected_shortcode == 'page_about'){
shortcodevalue = "[one_two_first]<br/><br/>[slider]<br/><br/>[slide]<br/>[image url='' link='' width='700' height='400' title='']<br/>[/slide]<br/>[slide]<br/>[image url='' link='' width='700' height='400' title='']<br/>[/slide]<br/>[slide]<br/>[image url='' link='' width='700' height='400' title='']<br/>[/slide]<br/><br/>[/slider]<br/><br/>[/one_two_first]<br/><br/>[one_two_last]<br/>[h4 style='title2']We Are Here[/h4]<br/><br/>Aenean accumsan sollicitudin interdum. Cras non erat eros, vel vulputate augue. Ut nisl arcu, congue ut scelerisque sed, pharetra eu magna. Pellentesque at vestibulum dui. Nullam erat risus, adipiscing et egestas sed, auctor in nisl. Integer quam risus, [highlight]tincidunt eget varius[/highlight] a, consectetur vel nisi. Suspendisse interdum neque sit amet mauris egestas sed venenatis odio ultricies. Pellentesque ut commodo diam. Nulla vehicula erat at augue laoreet at euismod augue aliquam. Etiam vitae scelerisque diam. Mauris gravida sem sed quam vehicula ac molestie massa pellentesque. Proin arcu tortor, varius ut ultrices vel, lobortis a purus.<br/><br/>[/one_two_last]<br/>[clear]<br/><br/>[gap height='10']<br/><br/>[h4 style='title1']Our Team[/h4]<br/><br/>[one_three_first]<br/><br/>[team photo='' photo_width='480' photo_height='350' name='Jane Doe' position='CEO-Founder' phone='12 345 678' mail='name@website.com' facebook='#' twitter='#' skype='#']<br/><br/>Aenean accumsan sollicitudin interdum. Cras non erat eros, vel vulputate augue. Ut nisl arcu, congue ut scele risque sed, pharetra eu magna. Pellentesque at vest ibulum dui. Nullam erat risus.<br/><br/>[/team]<br/><br/>[/one_three_first]<br/><br/>[one_three]<br/><br/>[team photo='' photo_width='480' photo_height='350' name='Jane Doe' position='Developer' phone='12 345 678' mail='name@website.com' facebook='#' twitter='#' skype='#']<br/><br/>Aenean accumsan sollicitudin interdum. Cras non erat eros, vel vulputate augue. Ut nisl arcu, congue ut scele risque sed, pharetra eu magna. Pellentesque at vest ibulum dui. Nullam erat risus.<br/><br/>[/team]<br/><br/>[/one_three]<br/><br/>[one_three_last]<br/><br/>[team photo='' photo_width='480' photo_height='350' name='Jane Doe' position='Designer' phone='12 345 678' mail='name@website.com' facebook='#' twitter='#' skype='#']<br/><br/>Aenean accumsan sollicitudin interdum. Crasnon erat eros, vel vulputate augue. Ut nisl arcu, congue ut scele risque sed, pharetra eu magna. Pellentesque at vest ibulum dui. Nullam erat risus.<br/><br/>[/team]<br/><br/>[/one_three_last]<br/>[clear]";	
}




/*page services*/
if (selected_shortcode == 'page_services'){
shortcodevalue = "[one_two_first]<br/><br/>[slider]<br/><br/>[slide]<br/>[image url='' link='' width='720' height='420' title='']<br/>[/slide]<br/>[slide]<br/>[image url='' link='' width='720' height='420' title='']<br/>[/slide]<br/>[slide]<br/>[image url='' link='' width='720' height='420' title='']<br/>[/slide]<br/><br/>[/slider]<br/><br/>[/one_two_first]<br/><br/>[one_two_last]<br/><br/>[h4 style='title2']Why Choose Us?[/h4]<br/><br/>[dropcap value='A' style='style1']liquam erat volutpat. Aliquam iaculis semper congue. Ut dictum, tortor sed tincidunt cursus, lacus diam scelerisque turpis, eget vulputate.<br/><br/>[dropcap value='B' style='style1'] liquam erat volutpat. Aliquam iaculis semper congue. Ut dictum, tortor sed tincidunt cursus, lacus diam scelerisque turpis, eget vulputate.<br/><br/>[dropcap value='C' style='style1'] liquam erat volutpat. Aliquam iaculis semper congue. Ut dictum, tortor sed tincidunt cursus, lacus diam scelerisque turpis, eget vulputate.<br/><br/>[/one_two_last]<br/>[clear]<br/><br/>[separator margin_top='10' margin_bottom='30']<br/><br/>[one_four_first]<br/><br/>[box style='bag' title='Box bag style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...<br/>[/box]<br/><br/>[/one_four_first]<br/><br/>[one_four]<br/><br/>[box style='box' title='Box box style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...<br/>[/box]<br/><br/>[/one_four]<br/><br/>[one_four]<br/><br/>[box style='settings' title='Box settings style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...<br/>[/box]<br/><br/>[/one_four]<br/><br/>[one_four_last]<br/><br/>[box style='exchange' title='Box exchange style']<br/>Mauris eleifend, risus et tempus convallis, libero leo eleifend ipsum, ut suscipit. Suspendisse sapien odio, pulvinar et ...<br/>[/box]<br/><br/>[/one_four_last]<br/>[clear]";	
}











/*-----------------------------------------------------------------------------------*/
/*	Posts
/*-----------------------------------------------------------------------------------*/	
/*recent projects*/
if(selected_shortcode == 'recent_projects'){
shortcodevalue = "[recent_projects column='4' thumbnail_width='480' thumbnail_height='280' gallery_style='false']";	
}



/*recent posts*/
if(selected_shortcode == 'recent_posts'){
shortcodevalue = "[recent_posts column='3' thumbnail_width='480' thumbnail_height='280' category_id='' word_count='20' readmore='Read More' readmore_button='true']";	
}





/*-----------------------------------------------------------------------------------*/
/*	Slider
/*-----------------------------------------------------------------------------------*/
/*slider full width*/
if (selected_shortcode == 'slider_full_width'){
shortcodevalue = "[slider align='none']<br/><br/>[slide]<br/>[image url='' link='#' align='left' width='800' height='600' title='' ]<br/>[/slide]<br/><br/>[slide]<br/>[image url='' link='#' align='left' width='800' height='600' title='' ]<br/>[/slide]<br/><br/>[slide]<br/>[image url='' link='#' align='left' width='800' height='600' title='' ]<br/>[/slide]<br/><br/>[/slider]";	
}



/*Slider align leftr*/
if (selected_shortcode == 'slider_left'){
shortcodevalue = "[slider align='left' width='380']<br/><br/>[slide]<br/>[image url='' link='#' align='left' width='800' height='600' title='' ]<br/>[/slide]<br/><br/>[slide]<br/>[image url='' link='#' align='left' width='800' height='600' title='' ]<br/>[/slide]<br/><br/>[slide]<br/>[image url='' link='#' align='left' width='800' height='600' title='' ]<br/>[/slide]<br/><br/>[/slider]";	
}



/*Slider align right*/
if (selected_shortcode == 'slider_right'){
shortcodevalue = "[slider align='right' width='380']<br/><br/>[slide]<br/>[image url='' link='#' align='left' width='800' height='600' title='' ]<br/>[/slide]<br/><br/>[slide]<br/>[image url='' link='#' align='left' width='800' height='600' title='' ]<br/>[/slide]<br/><br/>[slide]<br/>[image url='' link='#' align='left' width='800' height='600' title='' ]<br/>[/slide]<br/><br/>[/slider]";	
}







/*-----------------------------------------------------------------------------------*/
/*	Social Icons
/*-----------------------------------------------------------------------------------*/	
/*social icon - delicous*/
if (selected_shortcode == 'social_delicious'){
shortcodevalue = "[icon name='delicious' link='#' target='_blank']";	
}



/*social icon - digg*/
if (selected_shortcode == 'social_digg'){
shortcodevalue = "[icon name='digg' link='#' target='_blank']";	
}



/*social icon - dribble*/
if (selected_shortcode == 'social_dribble'){
shortcodevalue = "[icon name='dribble' link='#' target='_blank']";	
}



/*social icon - facebook*/
if (selected_shortcode == 'social_facebook'){
shortcodevalue = "[icon name='facebook' link='#' target='_blank']";	
}



/*social icon - googlebuzz*/
if (selected_shortcode == 'social_googlebuzz'){
shortcodevalue = "[icon name='googlebuzz' link='#' target='_blank']";	
}



/*social icon - google +*/
if (selected_shortcode == 'social_googleplus'){
shortcodevalue = "[icon name='googleplus' link='#' target='_blank']";	
}




/*social icon - lastfm*/
if (selected_shortcode == 'social_lastfm'){
shortcodevalue = "[icon name='lastfm' link='#' target='_blank']";	
}



/*social icon - linkedin*/
if (selected_shortcode == 'social_linkedin'){
shortcodevalue = "[icon name='linkedin' link='#' target='_blank']";	
}



/*social icon - mobypicture*/
if (selected_shortcode == 'social_mobypicture'){
shortcodevalue = "[icon name='mobypicture' link='#' target='_blank']";	
}



/*social icon - plixi*/
if (selected_shortcode == 'social_plixi'){
shortcodevalue = "[icon name='plixi' link='#' target='_blank']";	
}



/*social icon - skype*/
if (selected_shortcode == 'social_skype'){
shortcodevalue = "[icon name='skype' link='#' target='_blank']";	
}



/*social icon - stubleupon*/
if (selected_shortcode == 'social_stubleupon'){
shortcodevalue = "[icon name='stubleupon' link='#' target='_blank']";	
}



/*social icon - tumbler*/
if (selected_shortcode == 'social_tumbler'){
shortcodevalue = "[icon name='tumbler' link='#' target='_blank']";	
}



/*social icon - twitter*/
if (selected_shortcode == 'social_twitter'){
shortcodevalue = "[icon name='twitter' link='#' target='_blank']";	
}



/*social icon - delicous*/
if (selected_shortcode == 'social_delicious'){
shortcodevalue = "[icon name='delicious' link='#' target='_blank']";	
}



/*social icon - vimeo*/
if (selected_shortcode == 'social_vimeo'){
shortcodevalue = "[icon name='vimeo' link='#' target='_blank']";	
}



/*social icon - youtube*/
if (selected_shortcode == 'social_youtube'){
shortcodevalue = "[icon name='youtube' link='#' target='_blank']";	
}







/*-----------------------------------------------------------------------------------*/
/*	Headings and Titles
/*-----------------------------------------------------------------------------------*/	
/*heading 1*/
if (selected_shortcode == 'heading_h1'){
shortcodevalue = "[h1]Heading H1 Text Here...[/h1]";	
}


/*heading 2*/
if (selected_shortcode == 'heading_h2'){
shortcodevalue = "[h2]Heading H2 Text Here...[/h2]";	
}



/*heading 3*/
if (selected_shortcode == 'heading_h3'){
shortcodevalue = "[h3]Heading H3 Text Here...[/h3]";	
}



/*heading 4*/
if (selected_shortcode == 'heading_h4'){
shortcodevalue = "[h4]Heading H4 Text Here...[/h4]";	
}



/*heading 5*/
if (selected_shortcode == 'heading_h5'){
shortcodevalue = "[h5]Heading H5 Text Here...[/h5]";	
}



/*heading 6*/
if (selected_shortcode == 'heading_h6'){
shortcodevalue = "[h6]Heading H6 Text Here...[/h6]";	
}



/*title style 1*/
if (selected_shortcode == 'title_style1'){
shortcodevalue = "[h4 style='title1']Heading H4 Text Here...[/h4]";	
}



/*title style 2*/
if (selected_shortcode == 'title_style2'){
shortcodevalue = "[h4 style='title2']Heading H4 Text Here...[/h4]";	
}






/*-----------------------------------------------------------------------------------*/
/*	Quotes
/*-----------------------------------------------------------------------------------*/	
/*quote default*/
if (selected_shortcode == 'quote'){
shortcodevalue = "[quote]<br/><br/>Quote text here...<br/><br/>[/quote]";	
}



/*quote with author*/
if (selected_shortcode == 'quote_author'){
shortcodevalue = "[quote author='Author Name']<br/><br/>Quote text here...<br/><br/>[/quote]";	
}



/*quote with aauthor link*/
if (selected_shortcode == 'quote_author_link'){
shortcodevalue = "[quote author='Author Name Link' author_link='#']<br/><br/>Quote text here...<br/><br/>[/quote]";	
}



/*quote default*/
if (selected_shortcode == 'quote_left'){
shortcodevalue = "[quote align='left']<br/><br/>Quote text here...<br/><br/>[/quote]";	
}



/*quote default*/
if (selected_shortcode == 'quote_right'){
shortcodevalue = "[quote align='right']<br/><br/>Quote text here...<br/><br/>[/quote]";	
}





/*-----------------------------------------------------------------------------------*/
/*	Other
/*-----------------------------------------------------------------------------------*/	
/*break line*/
if (selected_shortcode == 'breakline'){
shortcodevalue = "[br]";	
}




/*code*/
if (selected_shortcode == 'code'){
shortcodevalue = "[code]<br/>&lt;div class='some-class'&gt;<br/>&lt;p&gt;Paragraph text &lt;a href='#'Link text&lt;/a&gt;.&lt;/p&gt;<br/>&lt;/div&gt;<br/>[/code]";	
}



/*highlight default color*/
if (selected_shortcode == 'highlight'){
shortcodevalue = "[highlight]Highlight text here...[/highlight]";	
}



/*highlight dark*/
if (selected_shortcode == 'highlight_dark'){
shortcodevalue = "[highlight color='#fbfbfb' background='#4d4d4d']Highlight text here...[/highlight]";		
}



/*highlight gray*/
if (selected_shortcode == 'highlight_gray'){
shortcodevalue = "[highlight color='#787878' background='#f2f2f2']Highlight text here...[/highlight]";	
}



/*google map*/
if (selected_shortcode == 'map'){
shortcodevalue = "[map adress='13/2+Elizabeth+St+Melbourne+VIC+3000+Australia' link='http://goo.gl/maps/O5o9k' width='480' height='280' align='none' zoom='14' alt='Envato']";	
}



/*progressbar*/
if (selected_shortcode == 'progressbar'){
shortcodevalue = "[progressbar name='Skill Name' value='68']";	
}



/*scoll to top*/
if (selected_shortcode == 'scroll_top'){
shortcodevalue = "[scroll_top]Scroll To Top[/scroll_top]";	
}





/*separator*/
if (selected_shortcode == 'separator'){
shortcodevalue = "[separator margin_top='0' margin_bottom='0']";	
}



/*separator*/
if (selected_shortcode == 'gap'){
shortcodevalue = "[gap height='10']";	
}





/*team*/
if (selected_shortcode == 'team'){
shortcodevalue = "[team photo='' photo_width='350' photo_height='220' name='Jane Doe' position='CEO-Founder' phone='12 345 678' mail='name@website.com' facebook='#' twitter='#' skype='#']<br/><br/>Some description here...<br/><br/>[/team]";	
}
		
		
		
		

if ( selected_shortcode == 0 ){tinyMCEPopup.close();}}
if(window.tinyMCE) {
window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodevalue);
tinyMCEPopup.editor.execCommand('mceRepaint');
tinyMCEPopup.close();
}return;
}