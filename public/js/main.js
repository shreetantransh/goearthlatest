(function() {
	"use strict";
	
	// ==== Initial Google Map ====
	function initialize(latitude, longitude, address, zoom) {
		var latlng = new google.maps.LatLng(latitude,longitude);

		var myOptions = {
			zoom: zoom,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControl: false
		};
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

		var marker = new google.maps.Marker({
			position: latlng, 
			map: map, 
			title: "location : " + address
		});
	}
	
	// ==== Mobile Header ====
	function mobile_header() {
		// Search, Cart
		if ($('body').attr('class').indexOf('home-5') != 5) {
			$('.header-top .block-cart').before($('.header-top .form-search').detach());
		}
		
		// Menu
		$('#all').after('<div id="mobile-menu">'
							+ '<div class="mobile-menu-wrap">'
								+ '<div class="close-mobile-menu">'
									+ '<span class="close-menu"><i class="zmdi zmdi-close"></i></span>'
								+ '</div>'
							+ '</div>'
						+ '</div>');
		$('#main-menu .menu').detach().appendTo('.mobile-menu-wrap');

		$('.mobile-menu-wrap .menu li.dropdown, .mobile-menu-wrap .menu li.dropdown-submenu').each(function() {
			$(this).find('a').first().after('<span class="icon-down"><i class="zmdi zmdi-chevron-down"></i></span>');
		});
		
		$('#toggle-mobile-menu').on('click', function (e) {
			e.preventDefault();
			$('body').toggleClass('mainmenu-active');
			
			return false;
		});
		
		$('.close-mobile-menu .close-menu').on('click', function (e) {
			e.preventDefault();
			$('body').removeClass('mainmenu-active');
			
			return false;
		});
		
		$('.icon-down').on('click', function (e) {
			$(this).closest('li').find('.dropdown-menu').first().toggleClass('tiva-active');
			
			return false;
		});
	}
	
	$(document).ready(function() {
		// ==== Go Up button ====
		$('.go-up').hide();
		
		$(window).on('scroll', function () {
			if ($(this).scrollTop() > 400) {
				$('.go-up').fadeIn();
			} else {
				$('.go-up').fadeOut();
			}
			
			return false;
		});
		
		$('.go-up a').on('click', function (e) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop: 0
			}, 600);
			
			return false;
		});
		
		// ===== Page Loader ======
		setTimeout(function(){
        	$('#page-preloader').fadeOut();
		}, 2000);
		
		// ===== Toggle Topbar ======
		$('#toggle-topbar').on('click', function (e) {
			$(this).parent().addClass('active');
			$('.topbar-content').slideDown(100);
			$('#header').css('border-top', '0');
			$('#toggle-topbar').hide();
			$('.close-topbar').show();
		});
		$('.close-topbar').on('click', function (e) {
			$(this).parent().removeClass('active');
			$('.topbar-content').slideUp(100);
			$('#toggle-topbar').show();
			$('#header').css('border-top', '8px solid #78b144');
			$('.close-topbar').hide();
		});
		
		// ===== Mobile - Header Top ======
		if ($(window).width() <= 991) {
			mobile_header();
		}

		// ===== Slideshow ======
		$('#tiva-slideshow').nivoSlider({ 
			effect: 'random',
			animSpeed: 1000,
			pauseTime: 5000,
			directionNav: true,
			controlNav: true,
			pauseOnHover: true
		});
	
		// // ===== Slider range ======
		// if ($("#price-filter").length) {
		// 	$("#price-filter").slider({
		// 		from: 0,
		// 		to: 100,
		// 		step: 1,
		// 		smooth: true,
		// 		round: 0,
		// 		dimension: "&nbsp;",
		// 		skin: "plastic"
        //
		// 	});
		// }

		// ==== Google Map ====
		var address = jQuery('.contact-address').html();
		var width = '100%';
		var height = '500px';
		var zoom = 16;
	   
		// Create map html
		if (address) {
			$('#map').html('<div id="map_canvas" style="width:' + width + '; height:' + height + '"></div>');
			
			var geocoder = new google.maps.Geocoder();

			geocoder.geocode({'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();
					initialize(latitude, longitude, address, zoom);
				}
			});
		}
		
		// ==== Countdown ====
		$('.product-countdown').each(function(index) {
			var date 	= (typeof $(this).attr('data-date') != 'undefined') ? $(this).attr('data-date') : new Date();
			
			$(this).countdown(date, function(event) {
				var totalHours = event.offset.totalDays * 24 + event.offset.hours;
				if ($(this).closest('.products-block').attr('class').indexOf('layout-2') != -1) {
					$(this).html(event.strftime(''
						+ '<div class="item"><img src="img/icon-countdown.png" alt="Countdown Image"><span class="number">' + totalHours + '</span><span class="text">Hours</span></div>'
						+ '<div class="item"><img src="img/icon-countdown.png" alt="Countdown Image"><span class="number">%M</span><span class="text">Minutes</span></div>'
						+ '<div class="item"><img src="img/icon-countdown.png" alt="Countdown Image"><span class="number">%S</span><span class="text">Seconds</span></div>'
					));
				} else {
					$(this).html(event.strftime(''
						+ '<div class="item"><span class="text">Hours</span><span class="number"><span>' + totalHours + '</span></span></div>'
						+ '<div class="item"><span class="text">Mins</span><span class="number"><span>%M</span></span></div>'
						+ '<div class="item"><span class="text">Secs</span><span class="number"><span>%S</span></span></div>'
					));	
				}
			});
		});
		
		// ==== Carousel ====
		$('.deals-of-day .products').owlCarousel({
			loop: true,
			margin: 30,
			autoplay: true,
			nav: true,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				480:{
					items: 2,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				1025:{
					items: 3,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				}
			}
		});
		
		$('.best-sellers .products').owlCarousel({
			loop: true,
			margin: 30,
			autoplay: true,
			nav: true,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
					navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
				},
				480:{
					items: 2,
					navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
				},
				769:{
					items: 4,
					navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
				},
				1025:{
					items: 6,
					navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>']
				}
			}
		});
		
		$('.home-2 .new-arrivals .products').owlCarousel({
			loop: true,
			margin: 30,
			autoplay: true,
			nav: true,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				480:{
					items: 2,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				769:{
					items: 2,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				1025:{
					items: 3,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				}
			}
		});
		
		$('.home-1 .new-arrivals .products').owlCarousel({
			loop: true,
			margin: 30,
			autoplay: true,
			nav: false,
			dots: true,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
				},
				480:{
					items: 2,
				},
				991:{
					items: 3,
				}
			}
		});
		
		$('.home-3 .testimonial .testimonial-wrap').owlCarousel({
			loop: true,
			margin: 50,
			autoplay: true,
			nav: false,
			dots: true,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
				},
				480:{
					items: 1,
				},
				991:{
					items: 3,
				}
			}
		});
		
		$('.testimonial .testimonial-wrap').owlCarousel({
			loop: true,
			margin: 30,
			autoplay: true,
			nav: false,
			dots: true,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			items: 1
		});
		
		var space 		= ($(window).width() <= 1024) ? 10 : 30;
		var carousel 	= ($(window).width() < 991) ? true : false;
		$('.product-category .categories').owlCarousel({
			margin: space,
			mouseDrag: carousel,
			touchDrag: carousel,
			responsive:{
				0:{
					items: 1,
				},
				480:{
					items: 3,
				},
				991:{
					items: 5,
				}
			}
		});
		
		$('.partners .partners-wrap').owlCarousel({
			loop: true,
			margin: 30,
			autoplay: true,
			nav: false,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 2,
				},
				480:{
					items: 4,
				},
				991:{
					items: 6,
				}
			}
		});
		
		$('.flash-deals .products').owlCarousel({
			loop: true,
			margin: 30,
			autoplay: true,
			nav: true,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				480:{
					items: 2,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				992:{
					items: 1,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				}
			}
		});
		
		$('.category-tab .products').owlCarousel({
			loop: true,
			autoplaytimeout: 6000,
			margin: 20,
			autoplay: true,
			nav: false,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
				},
				480:{
					items: 2,
				},
				769:{
					items: 3,
				},
				1025:{
					items: 4,
				}
			}
		});
		
		$('.home-3 .category-double .products').owlCarousel({
			loop: true,
			autoplaytimeout: 6000,
			margin: 0,
			autoplay: true,
			nav: true,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				480:{
					items: 3,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				769:{
					items: 2,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				1025:{
					items: 3,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				}
			}
		});
		
		$('.category-double .products').owlCarousel({
			loop: true,
			autoplaytimeout: 6000,
			margin: 0,
			autoplay: true,
			nav: true,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				480:{
					items: 2,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				991:{
					items: 2,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				}
			}
		});
		
		$('.home-3 .product-tab .products').owlCarousel({
			loop: true,
			margin: 30,
			autoplay: true,
			nav: false,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
				},
				480:{
					items: 3,
				},
				991:{
					items: 4,
				}
			}
		});
		
		$('.home-4 .product-tab .products').owlCarousel({
			loop: true,
			margin: 30,
			autoplay: true,
			nav: false,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
				},
				480:{
					items: 3,
				},
				769:{
					items: 4,
				},
				1025:{
					items: 5,
				}
			}
		});
		
		$('.home-5 .product-tab .products').owlCarousel({
			loop: true,
			margin: 15,
			autoplay: true,
			nav: false,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
				},
				480:{
					items: 2,
				},
				769:{
					items: 3,
				},
				1025:{
					items: 5,
				}
			}
		});
		
		// ==== Product Detail ====
		$('.product-detail .horizontal .thumb-images').owlCarousel({
			loop: false,
			margin: 10,
			autoplay: false,
			nav: false,
			dots: false,
			mouseDrag: false,
			touchDrag: false,
			items: 4
		});
		
		if ($('.product-detail .main-image img').length) {
			$('.product-detail .main-image img').elevateZoom({zoomType:"inner", cursor:"crosshair", easing:true, scrollZoom:false});
		}
		
		$('.product-detail .thumb-images img').on('click', function (e) {
			$('.product-detail .main-image').html('<img class="img-responsive" src="' + $(this).attr('src') + '" alt="Product Image">').find('img').elevateZoom({zoomType:"inner", cursor:"crosshair", easing:true, scrollZoom:false});
			
			return false;
		});
		
		// ==== Related Products ====
		$('.related-products.item-4 .products').owlCarousel({
			loop: true,
			autoplaytimeout: 6000,
			margin: 30,
			autoplay: true,
			nav: true,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				480:{
					items: 2,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				991:{
					items: 4,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				}
			}
		});
		
		$('.related-products .products').owlCarousel({
			loop: true,
			autoplaytimeout: 6000,
			margin: 30,
			autoplay: true,
			nav: true,
			dots: false,
			autoplayTimeout: 5000,
			autoplayHoverPause: true,
			responsiveClass: true,
			responsive:{
				0:{
					items: 1,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				480:{
					items: 2,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				},
				991:{
					items: 3,
					navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>']
				}
			}
		});
		
		// ==== Popup Screen ====
		if ($('.newsletter-popup').length) {
			// Control when window small
			if (screen.width < 500) {
				$('.newsletter-popup .popup').css('width', '80%');
			}
			
			// Click to close popup
			$('html').on('click', function (e) {
				if (e.target.id == 'newsletter-popup') {
					$('.newsletter-popup').remove();
				}
			});
			
			$('.newsletter-popup .popup .close').on('click', function (e) {
				e.preventDefault();
				$('.newsletter-popup').remove();
			});
			
			// Screen duration
			setTimeout(function() {
				$('.newsletter-popup').remove();
			}, 20 * 1000);
		}


    	//rest of three collapse should be disabled
        $('[href="#collapseTwo"]').prop('disabled',true);
        $('[href="#collapseThree"]').prop('disabled',true);
        $('[href="#collapseFour"]').prop('disabled',true);

		$('#continue_checkout').on('click', function(event){
            $('[href="#collapseOne"]').prop('disabled',false);
            $('#collapseOne').collapse('hide');
            $('#collapseTwo').collapse('show');
		})

        $('.deliver_here').on('click', function(event){
            //select delivery address from multiple address
            $("input[name='delivery_address_id']").val($(this).attr('data-address-id'));
            $('[href="#collapseTwo"]').prop('disabled',false);
			$('#collapseTwo').collapse('hide');
            $('#collapseThree').collapse('show');
        })

        $('#proceed_to_payment').on('click', function(event){
            $('[href="#collapseThree"]').prop('disabled',false);
            $('#collapseThree').collapse('hide');
            $('#collapseFour').collapse('show');
        })

        $('#apply_voucher').on('click', function(event){
			const code =$("#voucher_code").val();

            $.post( "/checkout/apply-voucher", {'code':code, _token : $('meta[name="csrf-token"]').attr('content')},function( data ) {
            	if(data.error){
                    $( ".voucher-msg p.invalid-feedback" ).html( data.msg );
                    $("input#voucher_code").addClass('is-invalid');
                    $( ".voucher-msg p.text-success" ).html('');
				}
				else {
                    $( ".voucher-msg p.invalid-feedback" ).html( '');
                    $( ".voucher-msg p.text-success" ).html(data.msg);
                    $("input#voucher_code").removeClass('is-invalid');
                    $( ".discount-value" ).html( data.discount );
                    $( ".total-amount-value" ).html( data.total_amount );
				}

            });
		})
	});
})()

jQuery(document).ready(function () {
	jQuery("a#home-category-anchor").on('click', function () {
		jQuery("#home-category-anchor").closest('#home_links').find('li').removeClass('active');
		jQuery(this).closest("li").addClass('active');
    });
});


$('body').on('click', '#checkout_qty_updater', function () {
	var currentCartItemInstance = $(this).closest('.product-row');
    var currentValue = parseInt(currentCartItemInstance.find('#product_qty').val());
    if ($(this).hasClass('minus')) {
    	if (currentValue > 1) {
            currentCartItemInstance.find('#product_qty').val(currentValue - 1);
        }
    } else {
        currentCartItemInstance.find('#product_qty').val(currentValue + 1);
    }
});


