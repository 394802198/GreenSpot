/**
 * Created by Steven on 2015/6/20.
 */
var timer = null;

app.directive('homeDirective', ['$interval', '$timeout', '$document', '$window', function($interval, $timeout, $document, $window){
    return {
        restrict : 'A',
        link : function(scope, element, attr){

            var preTop = 0;
            var preNavigatorTagValue = '';

            function getTop(){

                $('.page-body-outer').css('position', 'static');

                var iObjOffsetTop = 74;
                // If width less than 768px then offset top 50
                if($(document).width()+17 < 768){
                    iObjOffsetTop = 50;
                }

                var home_top_bg_div = $('#home_top_bg_div').offset().top+1;
                var how_it_works = $('#how_it_works').offset().top-iObjOffsetTop;
                var promotion_bg_div = $('#promotion_bg_div').offset().top-iObjOffsetTop;
                var related_method = $('#related_method').offset().top-iObjOffsetTop;
                var price_div = $('#price_div').offset().top-iObjOffsetTop;

                var all_tops = {
                    'home_top_bg_div':home_top_bg_div,
                    'how_it_works':how_it_works,
                    'promotion_bg_div':promotion_bg_div,
                    'related_method':related_method,
                    'price_div':price_div
                };

                $('.page-body-outer').css('position', 'relative');

                return all_tops;

            }
            getTop();

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
                if($('.page-body-outer').scrollTop() <= $($window).height()/2){
                    $('#header_navigator').hide("fast","linear");
                } else {
                    $('#header_navigator').show("fast","linear");
                }
            };
            $('.page-body-outer').scroll(function(){
                showHideNavigator();
            });
            showHideNavigator();


            // Hide Navigator
            // Smooth Scroll
            var timer;

            function startMove(iTarget){
                var oPage = $('.page-body-outer');

                $interval.cancel(timer);

                timer = $interval(function(){
                    var iSpeed = (iTarget-oPage.scrollTop())/8;
                    iSpeed = iSpeed>0?Math.ceil(iSpeed):Math.floor(iSpeed);

                    if(oPage.scrollTop()==iTarget || (oPage.scrollTop()!=iTarget && iTarget===0)){
                        $interval.cancel(timer);
                    } else {
                        oPage.scrollTop(preTop+iSpeed);
                    }

                    if(oPage.scrollTop()===0){
                        $interval.cancel(timer);
                    }

                    preTop = oPage.scrollTop();

                }, 15);
            }
            $('a[data-name="navigator_target"]').click(function(){

                if(preNavigatorTagValue !== $(this).attr('data-val')){

                    startMove(getTop()[$(this).attr('data-val')]);

                }
                preNavigatorTagValue = $(this).attr('data-val');

            });

            var scrollFunc = function (e) {
                e = e || window.event;
                if (e.wheelDelta) {  //IE, Chrome Mouse Scroll Event
                    if (e.wheelDelta > 0) { // Scroll Up
                        $interval.cancel(timer);
                    }
                    if (e.wheelDelta < 0) { // Scroll Down
                        $interval.cancel(timer);
                    }
                } else if (e.detail) {  // Firefox Scroll Event
                    if (e.detail> 0) { // Scroll Up
                        $interval.cancel(timer);
                    }
                    if (e.detail< 0) { // Scroll Down
                        $interval.cancel(timer);
                    }
                }
            };
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

                    $(this).removeClass('collapsed');

                    $('#collapseOne').collapse('show');

                } else {

                    $('#technical_information_span').transition({ rotate: '0deg' });

                    $(this).addClass('collapsed');

                    $('#collapseOne').collapse('hide');

                }
            });
        }
    };
}]);