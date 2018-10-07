@extends('template.1column')

@section('content')

    <div class="user-container">
        <div class="only-content  m-b-0">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="card">

                    <div class="container-fluid">
                        <div class="col-md-12">
                            <h2 class="page-title text-center">Success</h2>
                        </div>
                    </div>


                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="shoping-cart">
                                    @if(session()->has('successMessage'))
                                        <h5 class="text-center">{{ session()->get('successMessage') }}</h5>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <br><br>
    <br><br><br>
@stop