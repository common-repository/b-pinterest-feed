(function($){

	"use strict";

	var $document = $(document);



	async function galleryInit(){
	 
        var $pinterest = $(this);
		var $pinterest_options = ( $pinterest.attr('data-pinterest-options')) ? $pinterest.data('pinterest-options') : {}; 

		$pinterest.pgallery($pinterest_options);

		console.log($pinterest.pgallery($pinterest_options));
		
			const gutterX = parseInt($pinterest_options.column_gap);
			const gutterY = parseInt($pinterest_options.row_gap);
			const column = parseInt($pinterest_options.masonry_column);
			const slider_column = parseInt($pinterest_options.slider_column);
			const slider_col_tablet = parseInt($pinterest_options.slider_col_tablet);
			const slider_col_mobile = parseInt($pinterest_options.slider_col_mobile);
			const slider_item_gap = parseInt($pinterest_options.slider_item_gap);
			const slider_loop = $pinterest_options.loop;
			const mouse_wheel = $pinterest_options.mouseWheel;
			const auto_play = $pinterest_options.autoPlay;
			const slider_effect = $pinterest_options.effect;
			const slider_delay = $pinterest_options.delay;
			const justified_margin = $pinterest_options.justified_margin;
			const isCssAnimation = $pinterest_options.isCssAnimation;
			const lastrow = $pinterest_options.lastrow;

			let i = 0;
			let interval = setInterval(() => {
			if(i <= 10){
				clearInterval(interval)
			}
			i++;

			const item = $(this).find('.masonry .single-item');
			if(item ){
				clearInterval(interval)
				setTimeout(() => {
					console.log(($(this).innerWidth() -  gutterX * (column+1)) / 3);
					var masonry1 = new MiniMasonry({
						container: '.masonry',
						baseWidth: ($(this).innerWidth() -  gutterX * (column+1)) / column,
						gutterX: gutterX,
						gutterY: gutterY
						});
				}, 200);
			}
		}, 500);
		

	      // allow magnificPopup
		if($(".allow-popup").length > 0) {
			var pinterest_id = $(this).attr('id');
				
			$('#'+pinterest_id).magnificPopup({
		        delegate: 'a', // the selector for gallery item
				type: 'image',
				gallery: {
				enabled:true
				}
			});
		}

		// Swiper 
		const swiperEl = document.querySelector(".swiper");
		if(swiperEl) {
			const swiperConfig = {
				loop: slider_loop == 1 ? true : false,
				mousewheel: mouse_wheel == 1 ? true : false,
				effect: slider_effect,
				navigation: {
				  nextEl: '.swiper-button-next',
				  prevEl: '.swiper-button-prev',
				},
				breakpoints: {
				  // Mobile devices (0px to 576px)
			        0: {
					slidesPerView: slider_col_mobile,
					spaceBetween: slider_item_gap
				  },
				  // Tablet devices (577px to 768px)
				  	577: {
					slidesPerView: slider_col_tablet,
					spaceBetween: slider_item_gap
				  },
				  // Small Desktop devices (769px to 1024px)
				  	769: {
					slidesPerView: slider_column,
					spaceBetween: slider_item_gap
				  	},
				  // Large Desktop devices (1025px and above)
				  	1025: {
					slidesPerView: slider_column,
					spaceBetween: slider_item_gap
				  }
				}
			  };

			  // Conditionally add autoplay settings
			if (auto_play == 1) {
				swiperConfig.autoplay = {
				delay: slider_delay, // Set the delay to 2.5 seconds (adjust as needed)
				disableOnInteraction: false, // Continue autoplay after user interaction
				};
			}

			// Initialize Swiper with the configuration
			const swiper = new Swiper('.swiper', swiperConfig);
		}
		
		// Justified  
		let check = 0;
		let interval1 = setInterval(() => {
			if(check <= 10){
			clearInterval(interval1)
			}
			check++;

			const item = $(this).find('.justified');
			console.log(item);
			
			if(item ){
				clearInterval(interval1)
				setTimeout(() => {
					$(".justified").justifiedGallery({
						margins : justified_margin,
						captions:false,
						cssAnimation: isCssAnimation == 1 ? false : true,
						imagesAnimationDuration:100,
						waitThumbnailsLoad: false,
						maxRowHeight: 800,
						lastRow: lastrow,
						
					});
				}, 200);
			}
		}, 200);
	}

	$document.on('ready',  function(){
		$('.swiper-wrapper').each(galleryInit); 
		$('.bp_pinterest_pins').each(galleryInit); 
	});

})(jQuery);
