@extends('admin.layout.edit')

@section('title')
    <div class="block-header">
        <h2>{{ $voucher->id ? 'UPDATE' : 'ADD NEW' }} VOUCHER </h2>
    </div>
@endsection

@section('form')

    @if($voucher->id)
        {!! Form::model($voucher, ['method' => 'put', 'route' => ['admin.voucher.update', $voucher->id]]) !!}
    @else
        {!! Form::open(['route' => 'admin.voucher.store', 'files' => true]) !!}
    @endif

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="header">
                    <h2>GENERAL INFORMATION</h2>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Name', 'name', old('name', $voucher->name), $errors->first('name')) !!}
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Code', 'code', old('code', $voucher->code), $errors->first('code')) !!}
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialSelect('Type', 'type', ['' => 'Select Type', '1' => 'Amount', '2' => 'Percentage'], old('type', $voucher->type), $errors->first('url')) !!}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Discount', 'discount', old('discount', $voucher->discount), $errors->first('discount')) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Cart Min Amount required', 'min_cart_amount', old('min_cart_amount', $voucher->min_cart_amount), $errors->first('min_cart_amount')) !!}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Max Discount on Percentage Type', 'max_discount', old('max_discount', $voucher->max_discount), $errors->first('max_discount')) !!}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Apply only product sku', 'product_sku', old('product_sku', $voucher->product_sku), $errors->first('product_sku')) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Valid From', 'valid_from', old('valid_from', $voucher->valid_from), $errors->first('valid_from'), ['class' => 'form-control datepicker']) !!}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                {!! Form::materialText('Valid To', 'valid_to', old('valid_to', $voucher->valid_to), $errors->first('valid_to'), ['class' => 'form-control datepicker']) !!}
                            </div>
                        </div>

                        <div class="clarfix"></div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="categories[]">Apply on categories</label>
                                {!! Form::select('categories[]', $categories, old('type', $voucher->categories), ['multiple'=>'multiple', 'class' => 'form-control']); !!}
                            </div>
                        </div>

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

                    <div class="form-group">
                        {!! Form::checkbox('is_active', 1, old('is_active', $voucher->is_active), ['class' => 'filled-in chk-col-blue', 'id' => 'is_active']) !!}
                        <label for="is_active">Publish</label>
                    </div>

                    <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>
                    @if($voucher->id)
                        <button data-delete-url="" id="delete" type="button" class="btn btn-danger btn-lg waves-effect">
                            DELETE
                        </button>
                    @endif
                </div>
            </div>

            <div class="card" id="typeAttributes" style="display: none">
                <div class="header">
                    <h2>Attribute Types
                        <button class="btn btn-sm btn-primary add_more_button pull-right">Add More</button>
                    </h2>
                </div>

            </div>
        </div>

    </div>
    </div>
    {!! Form::close() !!}

    {!! Form::open(['route' => ['admin.voucher.delete', $voucher->id], 'method' => 'delete', 'id' => 'delete']) !!}
    {!! Form::close() !!}
@endsection

@push('scripts')



    <script type="text/javascript">

        $(document).ready(function () {

            showBox(jQuery("#type").val());

            jQuery("#type").on('change', function () {

                var thisVal = jQuery(this).val();

                showBox(thisVal);
            });

            function showBox(thisVal) {
                if (thisVal == 'dropdown' || thisVal == 'checkbox' || thisVal == 'radio' | thisVal == 'multiselect') {
                    jQuery("#typeAttributes").show();
                } else {
                    jQuery("#typeAttributes").hide();
                }
            }


            $("#delete").on('click', function () {

                var _self = $(this);

                swal({
                    title: "Are you sure?",
                    text: "You are about to delete this attribute_set",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    $('form#delete').submit();
                });
            });

            jQuery("#type").on('change', function () {

                var txt = jQuery("#type option:selected" ).text();
                if(jQuery("#type option:selected" ).val() != '')
                {
                    jQuery("#amount").closest('.form-group').find('label').html(txt);
                }

            });

        });

    </script>




@endpush