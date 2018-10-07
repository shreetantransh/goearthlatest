@foreach ($productCollection as $product)
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        @include('catalog.category.partial.product')
    </div>
@endforeach