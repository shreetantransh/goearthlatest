@extends('admin.layout.main')

@section('content')

    @include('admin.layout.partial.alert')

    {!! Form::open() !!}

    <div class="card">
        <div class="header clearfix">
            <h2 class="pull-left">
                {{ $product->getName() ?: 'Manage Product' }}
            </h2>

            <div class="pull-right">
                <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>
            </div>
        </div>

        <div class="body">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation"
                    class="{{ request()->route()->getName() == 'admin.catalog.product.tab.product' ? 'active' : '' }}">
                    <a href="{{ route('admin.catalog.product.tab.product', $product->id) }}" aria-expanded="true">Product
                        Information</a>
                </li>

                <li role="presentation"
                    class="{{ request()->route()->getName() == 'admin.catalog.product.tab.related' ? 'active' : '' }}">
                    <a id="product-tab" href="javascript:void(0)" data-content="{{ route('admin.catalog.product.tab.related', $product->id) }}"  aria-expanded="false">Related
                        Products</a>
                </li>
                <li role="presentation" class="{{ request()->route()->getName() == 'admin.catalog.product.tab.up-sell' ? 'active' : '' }}">
                    <a id="product-tab" href="javascript:void(0)" data-content="{{ route('admin.catalog.product.tab.up-sell', $product->id) }}" aria-expanded="false">Up Sells</a>
                </li>
                <li role="presentation" class="{{ request()->route()->getName() == 'admin.catalog.product.tab.cross-sell' ? 'active' : '' }}">
                    <a id="product-tab" href="javascript:void(0)" data-content="{{ route('admin.catalog.product.tab.cross-sell', $product->id) }}" aria-expanded="false">Cross Sells</a>
                </li>
                @if($product->type == 'product_type_configurable')
                    <li role="presentation" class="{{ request()->route()->getName() == 'admin.catalog.product.tab.configurable' ? 'active' : '' }}">
                        <a id="product-tab" href="javascript:void(0)" data-content="{{ route('admin.catalog.product.tab.configurable', $product->id) }}" aria-expanded="false">Configurable Products</a>
                    </li>
                @endif

            </ul>


            <div class="tab-content">
                @yield('tab-content')
            </div>
        </div>

        <div class="header clearfix">

            <div class="pull-right">
                <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>
            </div>
        </div>

    </div>

    {!! Form::close() !!}

    {!! Form::open(['url' => route('admin.catalog.attributes.attribute-group.destroy', $product->id), 'method' => 'delete', 'id' => 'delete']) !!}
    {!! Form::close() !!}
@endsection

@push('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
            $("#delete").on('click', function () {

                var _self = $(this);

                swal({
                    title: "Are you sure?",
                    text: "You are about to delete this Product.",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    $('form#delete').submit();
                });
            });
        });

        $(document).ready(function () {
            $("a#product-tab").on('click', function () {

                $this = jQuery(this);
                if(jQuery("#redirect-url").length >= 1)
                {
                    swal({
                        title: "Save Changes",
                        text: "Please save your changes.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, save it!",
                        closeOnConfirm: false
                    }, function () {
                        jQuery("#redirect-url").val($this.attr('data-content'));

                        $this.closest('form').submit();
                    });
                }else {
                    window.location.href = $this.attr('data-content');
                }
            });
        });


    </script>
@endpush