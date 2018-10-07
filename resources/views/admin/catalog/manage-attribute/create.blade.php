@extends('admin.layout.edit')

@section('title')
    <div class="block-header">
        <h2>MANAGE ATTRIBUTES</h2>
    </div>
@endsection

@section('form')


    {!! Form::open(['route' => 'admin.catalog.attributes.manage-attribute.store']) !!}


    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="header">
                    <h2>GENERAL INFORMATION</h2>
                </div>
                <div class="body">

                    <div class="row">
                        <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                            <b>Attribute Sets</b>

                            @foreach($attribute_sets as $key => $set)

                                <div class="panel-group" id="accordion_{{ $key }}" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading_{{ $key }}">
                                            <h4 class="panel-title panel-title-gray">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion_{{ $key }}"
                                                   href="#collapse_{{ $key }}" aria-expanded="false" aria-controls="collapse_{{ $key }}"
                                                   class="collapsed">
                                                    {{ $set->getName() }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_{{ $key }}" class="panel-collapse collapse" role="tabpanel"
                                             aria-labelledby="heading_{{ $key }}" aria-expanded="false" style="height: 0px;">
                                            <div class="panel-body">

                                                @forelse($set->groups as $group)

                                                    <div class="col-md-3"><label>{{ $group->getName() }}</label></div>
                                                    <div class="col-md-9">

                                                        {!! Form::select('attribute_id['. $group->id .'][]', $attributes, $group->attributes->pluck('id'), ['multiple'=>'multiple', 'class' => 'form-control']); !!}
                                                    </div>

                                                @empty

                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach


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
                    <button id="save" type="submit" class="btn btn-primary btn-lg waves-effect">SAVE</button>

                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}


@endsection

@push('scripts')
    <script type="text/javascript">

        $(document).ready(function () {
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
        });

    </script>
@endpush