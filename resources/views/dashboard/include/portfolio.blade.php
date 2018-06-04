@if($portfolio)
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3>Portfolio</h3>
            </div>
            <div class="panel-body">
                <strong><p class="pull-right">sum: {{ '$' . number_format($portfolio->sum, 2) }}</p></strong>
            </div>
            <ul class="list-group">
                @foreach($portfolio->assets as $asset => $currency)
                    <li class="list-group-item">
                        <i class="cc {{ $asset }}"></i>
                        <span>{{ $asset }}</span>
                        <span>{{ $currency->amount}}</span>
                        <span class="pull-right">{{ '$' . number_format($currency->usd, 2)}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif