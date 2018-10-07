@extends('admin.catalog.products.layout')

@section('tab-content')
    {!! $grid !!}

    @if($configured_product->count())
        <div id="hiddenInputs">
        @foreach($configured_product as $con_prdoct)
            <input name="grid_items[]" type="checkbox" value="{{ $con_prdoct->id }}" id="grid_item_{{ $con_prdoct->id }}" class="hiddenItem" style="display: none">
        @endforeach
        </div>

    @endif

    <script>
        jQuery(".grid-check-item").on('click', function () {
            var $thisId = jQuery(this).attr('id');

            jQuery("#hiddenInputs").find("#" + $thisId).remove();


        });
    </script>

@endsection