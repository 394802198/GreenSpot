/*
 *		Author: Steven Chen
 *		Date: Feb 2015
 */

(function($){
	
    $('#play_video').click(function(){
        $('#viewVideoModal').modal('show');
        $('#ytplayer').html('<iframe id="youtube_player" frameborder="0" vspace="0" hspace="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" scrolling="auto" height="auto" width="auto" src="//www.youtube.com/embed/PrXy9B-6OOM?controls=1&amp;hd=1&amp;autoplay=1&amp;showinfo=0&amp;rel=0"></iframe>');
    });
    $('#viewVideoModal').on('hidden.bs.modal', function(){
        $('#ytplayer').html('');
    });
	
	// Carousel Fire On Switch
	$('#mobileStepCarousel').on('slid.bs.carousel', function () {
		  var step = $('.carousel-inner').children('.active').attr('data-step');
		  $('li[data-name="carousel_steps_guide_list_li"]').removeClass();
		  $('li[data-step="'+step+'"]').addClass('active');
	});


	// Navigator Adjust
	var showHideNavigator = function(){
		if($(this).scrollTop() <= $(window).height()/2){
			$('#header_navigator').hide("fast","linear");
		} else {
			$('#header_navigator').show("fast","linear");
		}
	}
	$(window).scroll(function(){
		showHideNavigator();
	});
	showHideNavigator();
	


	// Hide Navigator
	// Smooth Scroll
	var isRunning = false;
	var timer;
	
	function startMove(iTarget){
		var oDoc = $(document);
		
		clearInterval(timer);
		timer = setInterval(function(){
			var iSpeed = (iTarget-oDoc.scrollTop())/8;
			iSpeed = iSpeed>0?Math.ceil(iSpeed):Math.floor(iSpeed);

			isRunning = true;
			if(oDoc.scrollTop()==iTarget || (oDoc.scrollTop()!=iTarget && iTarget==0)){
				isRunning = false;
				clearInterval(timer);
			} else {
				oDoc.scrollTop(oDoc.scrollTop()+iSpeed);
			}
			
		}, 30);
	}
	$('a[data-name="navigator_target"]').click(function(){
		$('#navbar_site').css('display','none');
		$('#navbar_site').removeClass('in');
		var iObjOffsetTop = 74;
		// If width less than 768px then offset top 50
		if($(document).width()+17 < 768){
			iObjOffsetTop = 50;
		}
		var top;
		if($(this).attr('data-val')=='home_top_bg_div'){
			top = $('#'+$(this).attr('data-val')).offset().top+1;
		} else {
			top = $('#'+$(this).attr('data-val')).offset().top-iObjOffsetTop;
		}
		
		startMove(parseInt(top));
		
	});
	
	var scrollFunc = function (e) {
        var direct = 0;
        e = e || window.event;
        if (e.wheelDelta) {  //IE, Chrome Mouse Scroll Event             
            if (e.wheelDelta > 0) { // Scroll Up
        		clearInterval(timer);
            }
            if (e.wheelDelta < 0) { // Scroll Down
        		clearInterval(timer);
            }
        } else if (e.detail) {  // Firefox Scroll Event
            if (e.detail> 0) { // Scroll Up
        		clearInterval(timer);
            }
            if (e.detail< 0) { // Scroll Down
        		clearInterval(timer);
            }
        }
    }
    // Bind Mouse Scroll Event To The Page
    if (document.addEventListener) {
        document.addEventListener('DOMMouseScroll', scrollFunc, false);
    }
    // Trigger scrollFunc function while scrolling
    window.onmousewheel = document.onmousewheel = scrollFunc;
	
    
	$('button[data-target="#navbar_site"]').click(function(){
		if($('#navbar_site').hasClass('in')){
			$('#navbar_site').css('display','none');
		} else {
			$('#navbar_site').css('display','block');
		}
	});
	
	
	$('#technical_information_a').click(function(){
		if($(this).hasClass('collapsed')){
			
			$('#technical_information_span').transition({ rotate: '45deg' });
			
		} else {
			
			$('#technical_information_span').transition({ rotate: '0deg' });
			
		}
	});
	
})(jQuery);