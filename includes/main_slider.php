<div class="wrap" id="cycleitems<?php echo $args['class'];?>">
<!--			<div class="scrollbar">
				<div class="handle">
					<div class="mousearea"></div>
				</div>
			</div>-->			
			<div class="controls right">
				<button class="btn sliderprev"><i class="icon-chevron-left"></i> &lsaquo;</button>
				<button class="btn slidernext">&rsaquo; <i class="icon-chevron-right"></i></button>
			</div>
			<div class="frame list_slider"  >
				<ul class="list_holder">
					<?php echo $show; ?>
				</ul>
			</div>


		</div>

			<Script>

jQuery(function($){
	'use strict';

	document.getElementsByTagName('html')[0].className += ' ' +
		(~window.navigator.userAgent.indexOf('MSIE') ? 'ie' : 'no-ie');

			var $example = $('#cycleitems<?php echo $args['class'];?>');

	var $frame = $example.find('.frame'); window.frr = $frame;
	var sly = new Sly($frame, {
			horizontal: 1,
			itemNav: 'basic',
			smart: 1,
			activateOn: 'click',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			startAt: 0,
		scrollBar: $example.find('.scrollbar'),
			scrollBy: 1,
			speed: 300,
			elasticBounds: 1,
			easing: 'easeOutExpo',
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,
		pagesBar: $example.find('.pages'),
			activatePageOn: 'click',
			// Cycling
			cycleBy: 'items',
			cycleInterval: 3000,
			pauseOnHover: 1,

			// Buttons
		prevPage: $example.find('.sliderprev'),
		nextPage: $example.find('.slidernext')
		}).init();;



});

			</script>