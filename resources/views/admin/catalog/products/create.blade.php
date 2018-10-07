@extends('admin.layout.edit')

@section('title')
    <div class="block-header">
        <h2>{{ $product->id ? 'UPDATE' : 'ADD NEW' }} PRODUCT</h2>
    </div>
@endsection

@section('form')

    {!! Form::open() !!}
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="header">
                    <h2>GENERAL INFORMATION</h2>
                </div>
                <div class="body">

                    <div class="form-group">
                        {!! Form::materialSelect('Attribute Set', 'attribute_set_id', $attribute_sets , $product->attribute_set_id, $errors->first('attribute_set_id')) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::materialSelect('Products', 'type', ['product_type_simple' => 'Simple', 'product_type_configurable' => 'configurable'] , $product->type, $errors->first('type')) !!}
                    </div>

                </div>
            </div>

        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="header">
                    <h2>ADDITIONAL INFORMATION</h2>
                </div>
                <div class="body">
                    <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
