@if($portfolio)
    <div class="col-lg-12">
        <div class="card bg-info mb-3">
            <div class="card-header text-white">
                <h3>Portfolio</h3>
            </div>
            <div class="card-body">
                <strong><p class="text-right text-white">sum: {{ '$' . number_format($portfolio->sum, 2) }}</p></strong>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($portfolio->assets as $asset => $currency)
                    <li class="list-group-item">
                        <i class="cc {{ $asset }}"></i>
                        <span>{{ $asset }}</span>
                        <span>{{ $currency->amount}}</span>
                        <span class="float-right">{{ '$' . number_format($currency->usd, 2)}}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif