@extends('template.1column')

@section('content')

    <div class="customer-tab-view customer-custom-tab">
        <div class="container-flued margin-left-right">
            <div class="row">
                <div class="col-sm-12 col-md-2 col-lg-2 col-12 customer-site-view">
                    <div class="nav flex-row flex-lg-column flex-md-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach( $_customer_tabs as $route => $tab )
                            <a class="nav-link{{ request()->is($tab['pattern']) ? ' active' : '' }}"
                               id="v-pills-home-tab" href="{{ route($route) }}"
                               role="tab"
                               aria-controls="v-pills-home" aria-selected="true">
                                <i class="{{ $tab['icon'] }}"></i>
                                <span>{{ $tab['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="col-sm-12 col-md-10 col-lg-10 col-12 customer-main-view">
                   <div class="col-md-12 col-lg-12 col-sm-12 ">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane active" id="v-pills-home" role="tabpanel"
                             aria-labelledby="v-pills-home-tab">

                            @include('template.partial.alert')

                            @yield('tab-content')
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection