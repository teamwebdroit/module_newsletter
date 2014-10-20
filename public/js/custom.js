function is_touch_device() {
  return !!('ontouchstart' in window);
}

/*--------------------------------------------------
  STICKY FOOTER
---------------------------------------------------*/
jQuery(window).load(function() {  

 var footer_fixed = true;
 
 if( is_touch_device() || !footer_fixed){
  jQuery('#footer, #wrapper').css({'position':'static', 'z-index':'0'});
  jQuery('#wrapper:last').css("margin-bottom", "0"); 
  jQuery("#footer").removeClass("fixed");
 
 }
 else {
  var wrapper_margin_bottom = jQuery('#footer').outerHeight()+'px';
   jQuery("#wrapper").after('<div style="height:' + wrapper_margin_bottom + '; float:left; width:100%;"></div>'); 
   jQuery("#footer").addClass("fixed");
 } 
});


/*--------------------------------------------------
	 BACK TO TOP
---------------------------------------------------*/
jQuery(document).ready(function($){
	$("#back-top").hide();
	
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		$('#back-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
}); 

