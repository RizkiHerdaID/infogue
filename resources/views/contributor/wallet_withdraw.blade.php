@extends('public')

@section('title', '- Withdrawal Application')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data" data-href="{{ Request::url() }}">
                                <h3 class="title">WITHDRAWAL APPLICATION</h3>
                                <div class="content" id="wallet">
                                    <div class="contributor-profile mini">
                                        <div class="mbm">
                                            <h4 class="mbs"><i class="fa fa-info-circle"></i> &nbsp; <strong>WITHDRAWAL PROCESS</strong></h4>
                                            <p class="text-muted">
                                                You must sent withdrawal application below, then wait for admin confirmation,
                                                if your application was proceed you will not able to cancel the transaction.
                                                We will notify you any progress via email or message.
                                            </p>
                                        </div>

                                        <div class="info pln">
                                            <h4 class="mbs"><strong>YOUR BALANCE</strong></h4>
                                            <h2><strong>
                                                    IDR {{ number_format(Auth::user()->balance, 0, ',', '.') }}
                                                </strong>
                                                @if($deferred > 0)
                                                /
                                                <small class="text-muted">
                                                    IDR -{{ number_format($deferred, 0, ',', '.') }}
                                                    Still processed
                                                </small>
                                                @endif
                                            </h2>
                                        </div>
                                    </div>

                                    <form action="{{ route('account.wallet.withdraw') }}" class="form-horizontal form-strip" method="post" id="form-withdraw">
                                        {!! csrf_field() !!}
                                        <fieldset>
                                            <legend>BANK ACCOUNT</legend>

                                            @include('errors.common')

                                            @if(Session::has('status'))
                                                <div class="alert alert-{{ Session::get('status') }}" style="border-radius: 0">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    {!! Session::get('message') !!}
                                                </div>
                                            @endif

                                            <?php
                                                $bank = Auth::user()->bank;
                                                $name = Auth::user()->account_name;
                                                $number = Auth::user()->account_number;
                                                $incomplete = false;
                                            ?>
                                            @if(empty(trim($bank)) || empty(trim($bank)) || empty(trim($number)))
                                                <?php $incomplete = true ?>
                                                <div class="alert alert-danger }}" style="border-radius: 0">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    Your bank account is incomplete! please update the settings
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Bank</label>
                                                <div class="col-sm-9">
                                                    @if($bank != "")
                                                        <img src="{{ asset('images/banks/' . $bank->logo) }}"><br>
                                                        <label>{{ $bank->bank }}</label>
                                                    @else
                                                        <p style="margin-top: 4px">No data</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Account Name</label>
                                                <div class="col-sm-9">
                                                    <p style="margin-top: 4px">
                                                        @if($name != "")
                                                            {{ $name }}
                                                        @else
                                                            No data
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Account Number</label>
                                                <div class="col-sm-9">
                                                    <p style="margin-top: 4px">
                                                        @if($number != "")
                                                            {{ $number }}
                                                        @else
                                                            No data
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9 pts pbm">
                                                <a href="{{ route('account.setting') }}#subscription" class="btn btn-primary">EDIT BANK ACCOUNT</a>
                                            </div>
                                        </div>
                                        <fieldset>
                                            <legend>WITHDRAWAL</legend>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Withdrawal Min</label>
                                                <div class="col-sm-9">
                                                    <p style="margin-top: 4px">
                                                        IDR {{ number_format($site_settings['Withdrawal Minimum'], 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Your Max Fund</label>
                                                <div class="col-sm-9">
                                                    <p style="margin-top: 4px">
                                                        <?php $maxWithdraw = Auth::user()->balance - $deferred; ?>
                                                        @if($maxWithdraw < 5000000)
                                                            IDR {{ number_format($maxWithdraw, 0, ',', '.') }}
                                                        @else
                                                            <?php $maxWithdraw = 5000000  ?>
                                                            IDR 5.000.000
                                                        @endif

                                                        @if($maxWithdraw < $site_settings['Withdrawal Minimum'])
                                                            &nbsp; <strong class="text-danger"><i class="fa fa-warning"></i> Insufficient balance</strong>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                                                <label for="amount" class="col-sm-3 control-label">Withdraw Amount</label>
                                                <div class="col-sm-9">
                                                    <input type="number" step="1000" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" placeholder="Withdrawal amount" required min="{{ $site_settings['Withdrawal Minimum'] }}" max="{{ $maxWithdraw }}">
                                                    {!! $errors->first('amount', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9 pts pbm">
                                                <button class="btn btn-primary" @if($incomplete) disabled @endif>WITHDRAW</button>
                                                <a href="#" data-toggle="modal" data-target="#modal-discard" class="btn btn-danger">DISCARD</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade no-line" id="modal-discard" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-save"></i> DISCARD WITHDRAWAL</h4>
                </div>
                <div class="modal-body">
                    <label class="mbn">Are you sure want to discard the transaction?</label>
                    <p class="mbn"><small class="text-muted">This transaction never record in database.</small></p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-primary">NO</a>
                    <a href="{{ route('account.wallet') }}" class="btn btn-danger">YES</a>
                </div>
            </div>
        </div>
    </div>

@endsection