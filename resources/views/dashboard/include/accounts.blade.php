@if($accounts)
    @foreach($accounts as $name => $account)
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>{{ $name }}</h3>
                </div>
                <div class="panel-body">
                    <strong><p class="pull-right">sum: {{ '$' . number_format($account->getSum(), 2) }}</p></strong>
                </div>
                <ul class="list-group">
                    @foreach($account->getBalance() as $balance)
                        <li class="list-group-item">
                            <i class="cc {{ $balance->asset }}"></i>
                            <span>{{ $balance->asset }}</span>
                            <span class="pull-right">{{  $balance->amount . ' : $' . number_format($balance->usd, 2)}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
@endif