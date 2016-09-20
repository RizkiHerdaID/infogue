@extends('public')

@section('title', '- Withdraw Preview')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data" data-href="{{ Request::url() }}">
                                <h3 class="title">WITHDRAWAL CONFIRMATION</h3>
                                <div class="content" id="wallet">
                                    <form action="{{ route('account.wallet.withdraw') }}?confirm=true" class="form-horizontal form-strip" method="post" id="form-withdraw">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="amount" value="{{ $withdraw }}">
                                        <fieldset>
                                            <legend>BANK ACCOUNT</legend>
                                            <h2 class="pm pbn">Acknowledge Withdrawal Process</h2>
                                            <p class="pm">
                                                I agree and follow infogue withdrawal process. I'm aware withdraw money from my wallet account could
                                                takes some time in hours or days. Regarding about my request I sent this application to
                                                complete the procedure and condition:
                                            </p>
                                            <?php
                                                $bank = Auth::user()->bank;
                                                $name = Auth::user()->account_name;
                                                $number = Auth::user()->account_number;
                                            ?>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Bank Account</label>
                                                <div class="col-sm-8">
                                                    @if($bank != "")
                                                        <img src="{{ asset('images/banks/' . $bank->logo) }}"><br>
                                                        <label>{{ $bank->bank }}</label>
                                                    @else
                                                        <p style="margin-top: 4px">No data</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Account Name</label>
                                                <div class="col-sm-8">
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
                                                <label class="col-sm-4 control-label">Account Number</label>
                                                <div class="col-sm-8">
                                                    <p style="margin-top: 4px">
                                                        @if($number != "")
                                                            {{ $number }}
                                                        @else
                                                            No data
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">My Last Balance</label>
                                                <div class="col-sm-8">
                                                    <p style="margin-top: 4px">
                                                        IDR {{ number_format($balance, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Deferred Transaction</label>
                                                <div class="col-sm-8">
                                                    <p style="margin-top: 4px">
                                                        IDR {{ number_format($deferred, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Withdraw Amount</label>
                                                <div class="col-sm-8">
                                                    <p style="margin-top: 4px; font-size: 18px">
                                                        <strong class="text-primary">IDR {{ number_format($withdraw, 0, ',', '.') }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Balance</label>
                                                <div class="col-sm-8">
                                                    <p style="margin-top: 4px; font-size: 18px">
                                                        <strong class="text-danger">IDR {{ number_format($balance - $deferred - $withdraw, 0, ',', '.') }}</strong>
                                                    </p>
                                                    <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Your withdrawal never proceed until you click confirm button.</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9 pts pbm">
                                                <button class="btn btn-primary">CONFIRM WITHDRAW</button>
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