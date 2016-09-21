@extends('public')

@section('title', '- Wallet Transaction')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data" data-href="{{ Request::url() }}">
                                <h3 class="title">WALLET</h3>
                                <div class="content" id="wallet">
                                    @if(Session::has('status'))
                                        <div class="alert alert-{{ Session::get('status') }}" style="border-radius: 0; margin-bottom: 0">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <i class="fa fa-check"></i> &nbsp; {!! Session::get('message') !!}
                                        </div>
                                    @endif
                                    <div class="contributor-profile mini bg-primary" style="color: white">
                                        <div class="info pln">
                                            <h4 class="mbs"><strong>YOUR BALANCE</strong></h4>
                                            <h2 style="color: #fff;"><strong>IDR {{ number_format(Auth::user()->balance, 0, ',', '.') }}</strong>
                                                @if($deferred > 0)
                                                    /
                                                    <small class="text-muted" style="color: white">
                                                        IDR -{{ number_format($deferred, 0, ',', '.') }}
                                                        Still processed
                                                    </small>
                                                @endif
                                            </h2>
                                        </div>
                                        <button onclick="window.location = '{{ route('account.wallet.withdrawal') }}'" class="btn btn-primary btn-outline btn-light">
                                            <i class="fa fa-arrow-down"></i> &nbsp; WITHDRAW
                                        </button>

                                        <div class="clearfix pull-left mtm">
                                            <h4 class="mbs"><i class="fa fa-info-circle"></i> &nbsp; <strong>HOW DOES WALLET WORK</strong></h4>
                                            <p style="color: #fff;">Current article reward is
                                                <strong>IDR {{ number_format($site_settings['Article Reward'], 0, ',', '.') }}</strong>,
                                                your balance is accumulation of each published article.</p>
                                        </div>
                                    </div>
                                    <div class="data-filter mbn">
                                        <div class="data">
                                            <p class="hidden-xs">Transaction Filter</p>
                                            <div class="dropdown select">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-data" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    @if(Input::has('data')) {{ str_replace('-', ' ', ucwords(Input::get('data'))) }} @else All Data @endif
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdown-data">
                                                    <li><a href="#" data-value="all-data">All Data</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li class="dropdown-header">TRANSACTION</li>
                                                    <li><a href="#" data-value="reward">Reward</a></li>
                                                    <li><a href="#" data-value="withdraw">Withdraw</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="sort">
                                            <p class="hidden-xs">Sort By</p>
                                            <div class="dropdown select by">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-sort-type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    @if(Input::has('by')) {{ ucwords(Input::get('by')) }} @else Date @endif
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                                    <li><a href="#" data-value="date">Date</a></li>
                                                    <li><a href="#">Amount</a></li>
                                                    <li><a href="#">Status</a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown select method">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-sort-method" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    @if(Input::has('sort')) {{ ucwords(Input::get('sort')) }} @else Descending @endif
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort">
                                                    <li><a href="#" data-value="asc">Ascending</a></li>
                                                    <li><a href="#" data-value="desc">Descending</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @forelse($transactions as $transaction)
                                        <div class="contributor-profile mini">
                                            <?php
                                                $icon = "fa-arrow-up";
                                                if($transaction->type == \Infogue\Transaction::TYPE_WITHDRAWAL){
                                                    $icon = "fa-arrow-down";
                                                }

                                                $label = "success";
                                                if($transaction->status == \Infogue\Transaction::STATUS_PROCEED){
                                                    $label = "info";
                                                } else if($transaction->status == \Infogue\Transaction::STATUS_CANCEL){
                                                    $label = "danger";
                                                } else if($transaction->status == \Infogue\Transaction::STATUS_PENDING){
                                                    $label = "warning";
                                                }
                                            ?>
                                            <h4 class="mbs"><i class="fa {{ $icon }}"></i> &nbsp; <strong>{{ strtoupper($transaction->type) }}</strong>
                                                @if($transaction->status == \Infogue\Transaction::STATUS_PENDING)
                                                    <a href="#" data-id="{{ $transaction->id }}" data-target="#modal-cancel-transaction" data-toggle="modal" class="pull-right btn btn-danger btn-sm btn-cancel-transaction">CANCEL WITHDRAW</a>
                                                @endif
                                            </h4>
                                            <p class="mbs"><strong>Trans. ID #{{ $transaction->id }}</strong> &nbsp; {{ $transaction->description }}</p>
                                            <h2 class="text-primary">IDR {{ number_format($transaction->amount, 0, ',', '.') }}
                                                <span class="label label-{{ $label }} pull-right" style="font-size: 10px; padding: 7px 10px">{{ strtoupper($transaction->status) }}</span>
                                            </h2>
                                        </div>
                                    @empty
                                        <p class="center-block text-center pm">No transaction available</p>
                                    @endforelse

                                    <div class="center-block text-center">
                                        {!! $transactions->appends(Input::all())->links() !!}
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade no-line" id="modal-cancel-transaction" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('account.wallet.cancel') }}" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="transaction_id">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i> CANCEL TRANSACTION</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbn">Are you sure cancel this transaction?</label>
                        <p class="mbn"><small class="text-muted">Admin will notify this cancel process.</small></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">DISMISS</a>
                        <button type="submit" class="btn btn-danger">CANCEL TRANSACTION</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection