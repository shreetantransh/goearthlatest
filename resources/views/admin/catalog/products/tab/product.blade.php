@extends('admin.catalog.products.layout')

@section('tab-content')



@if($product->attributeSet->groups()->count())
    @foreach($product->attributeSet->groups()->get() as $key => $group)
        <div class="panel-group" id="accordion_{{ $key }}" role="tablist"
             aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading_{{ $key }}">
                    <h4 class="panel-title panel-title-gray">
                        <a role="button" data-toggle="collapse" data-parent="#accordion_{{ $key }}"
                           href="#collapse_{{ $key }}" aria-expanded="false"
                           aria-controls="collapse_{{ $key }}"
                           class="collapsed">
                            {{ $group->getName() }}
                        </a>
                    </h4>
                </div>
                <div id="collapse_{{ $key }}"
                     class="panel-collapse collapse{{ $key == 0 ? ' in' : '' }}" role="tabpanel"
                     aria-labelledby="heading_{{ $key }}" aria-expanded="false">
                    <div class="panel-body">
                        @if ($group->getName() == 'Media')

                            @include('admin.catalog.products.upload')

                        @elseif($group->getName() == 'Categories')

                            @if($categories->count())

                                <div class="form-group">
                                    <select class="form-control show-tick" id="category"
                                            name="category[]" multiple>
                                        <option>Select Category</option>
                                        @include('admin.catalog.category.multi-category', ['categories' =>  $categories, 'dash' => '', 'selected' => $product->categories->pluck('id')->toArray()])
                                    </select>
                                </div>

                            @endif

                        @elseif($group->getName() == 'Stock')
                            @include('admin.catalog.products.stock', ['product' => $product])
                        @else
                            @foreach($group->attributes()->get() as $attribute)
                                @if(View::exists('admin.catalog.attribute.inputs.' . $attribute->type))
                                    @include('admin.catalog.attribute.inputs.' . $attribute->type,  ['attribute' => $attribute, 'product' => $product])
                                @else
                                    @include('admin.catalog.attribute.inputs.text', ['attribute' => $attribute])
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>


            </div>
        </div>
    @endforeach

    <input type="hidden" id="redirect-url" name="redirect_url">
@endif



@endsection