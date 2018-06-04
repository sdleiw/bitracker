@if($accounts)
    @foreach($accounts as $name => $account)
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $name }}</h3>
                </div>
                <div class="card-body">
                    <strong><p class="text-right">sum: {{ '$' . number_format($account->getSum(), 2) }}</p></strong>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach($account->getBalance() as $balance)
                        <li class="list-group-item">
                            <i class="cc {{ $balance->asset }}"></i>
                            <span>{{ $balance->asset }}</span>
                            <span>{{ $balance->amount }}</span>
                            <span class="float-right">{{  '$' . number_format($balance->usd, 2)}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
@endif