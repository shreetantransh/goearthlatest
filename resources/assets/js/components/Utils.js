require('bootstrap4-datetimepicker');
require('rateyo/min/jquery.rateyo.min');

$('#banner-slider').slick({
    infinite: true,
    autoplay: true,
    arrows: false,
    fade: true
});

$('#testimonials-slider').slick({
    infinite: true,
    lazyLoad: 'ondemand',
    prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="fa fa-chevron-circle-right"></i></button>',
    nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="fa fa-chevron-circle-left"></i></button>'
});

$("#trending-slider").slick({
    arrows: false,
    infinite: true,
    asNavFor: '#trending-slider-pagination'

});

$('#trending-slider-pagination').slick({
    asNavFor: '#trending-slider',
    centerMode: true,
    slidesToShow: 9,
    infinite: true,
    focusOnSelect: true,
    prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="fa fa-chevron-circle-right"></i></button>',
    nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="fa fa-chevron-circle-left"></i></button>',
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 5,
                infinite: true,

            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 3,
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
    ]

});

$('#product-image-nav').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    //centerMode: true,
    dots: false,
    arrows: false,
    focusOnSelect: true
});

$('#related-slider').slick({
    dots: false,
    prevArrow: '<button class="slick-prev" aria-label="Previous" type="button"><i class="fa fa-chevron-circle-right"></i></button>',
    nextArrow: '<button class="slick-next" aria-label="Next" type="button"><i class="fa fa-chevron-circle-left"></i></button>',
    infinite: true,
    autoPlay: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 4,
                infinite: true,

            }
        },
        {
            breakpoint: 650,
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
    ]
});



$("#product-base-image img").elevateZoom();

$('#product-image-nav a').on('click', function (e) {

    e.preventDefault();

    var ez = $('#product-base-image img').data('elevateZoom');

    var smallImage = $(this).attr('data-image');
    var largeImage = $(this).attr('data-zoom-image');

    ez.swaptheimage(smallImage, largeImage);
});

$('input#change_password').on('change', function (e) {

    e.preventDefault();

    if ($(this).is(':checked')) {
        $('#password-box').addClass('d-block');
    } else {
        $('#password-box').removeClass('d-block');
    }
});

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-tooltip]').tooltip();
});

$('#datepicker').datetimepicker({
    format: 'DD/MM/YYYY'
});

$('#rating-star').each(function () {

    $(this).rateYo({
        fullStar: true,
        multiColor: {
            "startColor": "#cc0000",
            "endColor": "#388e3c"
        },
        onChange: function (rating) {
            $(this).next().val(rating);
        }
    });
})

