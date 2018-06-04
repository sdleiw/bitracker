@extends('bitracker::layouts.app')

@section('meta-title')
    {{ '$' . number_format($portfolio->sum, 2) }}
@endsection

@section('css')
    <link href="{{ asset('vendor/bitracker/webfont/cryptocoins.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                @include('bitracker::dashboard.include.portfolio')
            </div>
            <div class="col-sm-12 col-md-6">
                @include('bitracker::dashboard.include.accounts')
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        (function(){
            // no need to reload the page, refactor with ajax call
            var reload = 10 * 60 * 1000; // 10 min
            setInterval("location.reload(true);", reload)
        })();
    </script>
@endsection