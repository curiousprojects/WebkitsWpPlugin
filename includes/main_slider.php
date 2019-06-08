
<div class="container" id="main-slider">
    <div class="row">
        <div class="col-xs-11 col-md-12 col-centered feature-col">
            <div class="slick">
		        <?php echo $show; ?>


            </div>
            <div class="left carousel-control">

                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>

            </div>
            <div class="right carousel-control">

                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>

            </div>
            <!--<div id="carousel" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="" data-width="auto">
                <div class="carousel-inner">

                </div>

                <!-- Controls -->
                <!--<div class="left carousel-control">
                    <a href="#carousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                </div>
                <div class="right carousel-control">
                    <a href="#carousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>-->

        </div>
    </div>
</div>

<script>
jQuery(function($){
	'use strict';

	/*document.getElementsByTagName('html')[0].className += ' ' +
		(~window.navigator.userAgent.indexOf('MSIE') ? 'ie' : 'no-ie');

			var $example = $('#cycleitems');

	var $frame = $example.find('.frame'); window.frr = $frame;
	var sly = new Sly($frame, {
             slidee: jQuery('.list_holder'),
			horizontal: 1,
			itemNav: 'centered',
			smart: 1,
			activateOn: 'click',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			startAt: 0,
		scrollBar: $example.find('.scrollbar'),
			scrollBy: 1,
			//speed: 300,
			elasticBounds: 1,
			easing: 'easeOutExpo',
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,
		pagesBar: $example.find('.pages'),
			activatePageOn: 'click',
			// Cycling
			cycleBy: 'pages',
			//cycleInterval: 3000,
			pauseOnHover: 1,

			// Buttons
		prevPage: $example.find('.sliderprev'),
		nextPage: $example.find('.slidernext'),

		}).init();

	if(jQuery(window).width < 767)
    {
        sly.reload();
    }
    $(window).resize(function(){
        sly.reload();
    });
    ///jQuery('#cycleitemsmain .list_item ').css('width', 'auto');
       /* jQuery('#cycleitemsmain .list_holder').css('display','flex');
        jQuery('#cycleitemsmain .list_slider').css('display','flex');
        jQuery('#cycleitemsmain .list_holder').addClass('col-xs-12');
        jQuery('#cycleitemsmain .list_slider ').addClass('row');
        jQuery('#cycleitemsmain .list_img ').css('width', jQuery('#cycleitemsmain .list_slider ').width() - 30);
        jQuery('#cycleitemsmain .list_img ').css('height', 'auto');
        jQuery('#cycleitemsmain .list_info ').css('width', jQuery('#cycleitemsmain .list_slider ').width() - 30);
        jQuery('#cycleitemsmain .list_item ').css('width', 'auto');

        jQuery('#cycleitemsmain .list_item ').css('overflow', 'visible');
        jQuery('#cycleitemsmain .list_img ').css('overflow', 'visible');
        jQuery('#cycleitemsmain .list_img img').css('position', 'relative');
        jQuery('#cycleitemsmain .list_item ').css('padding', '0px');
        //jQuery('#cycleitemsmain .list_holder .list_item ').addClass('col-xs-12');*/


    $('.slick').slick({
        arrows: false,
        infinite: true,
        //speed: 500,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,

                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });

    $('.left span').click(function(){

        $('.slick').slick('slickPrev');
    });

    $('.right span').click(function(){
        $('.slick').slick('slickNext');
    });
    jQuery('#main-slider .slick img').css('position', 'relative');

   // jQuery('#main-slider .carousel-inner :first ').addClass('active');
});


			</script>