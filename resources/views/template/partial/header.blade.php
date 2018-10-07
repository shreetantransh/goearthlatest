@if(request()->route()->getAction('controller') == \App\Http\Controllers\Frontend\HomeController::class)
    @include('template.partial.header-home')
@else
    @include('template.partial.header-inner')
@endif