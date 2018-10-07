<div class="products owl-theme owl-carousel ">
    @foreach ($productCollection as  $products)
        <div class="product-group">
            @foreach ($products as  $product)

                @include('catalog.category.partial.product')

            @endforeach
        </div>
    @endforeach


</div>

<script>
    $('.home-4 .product-tab .products').owlCarousel({
        loop: true,
        margin: 30,
        autoplay: true,
        nav: false,
        dots: false,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            480: {
                items: 3,
            },
            769: {
                items: 4,
            },
            1025: {
                items: 5,
            }
        }
    });
</script>