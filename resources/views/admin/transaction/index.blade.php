@extends('private')

@section('title', '- Transactions')

@section('content')

    <div id="content-wrapper">
        @include('admin.layouts._header')
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('index') }}" target="_blank">INFOGUE.ID</a></li>
                <li class="hidden-xs hidden-sm"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="active">Transaction</li>
            </ol>
            <div class="control">
                <a href="#" data-toggle="modal" data-target="#modal-search" class="link"><i class="fa fa-search"></i> SEARCH</a>
                <a href="#" class="link print"><i class="fa fa-print"></i> PRINT</a>
            </div>
        </div>
        <div class="content" id="content">
            <div class="title-section">
                <div class="title-wrapper">
                    <h1 class="title">Transaction</h1>
                    <p class="subtitle" style="letter-spacing: -1px">Reward <strong>IDR {{ number_format($sumReward, 0, ',', '.') }}</strong> ({{ $countReward }}x) | Withdraw <strong>IDR {{ number_format($sumWithdrawal, 0, ',', '.') }}</strong> ({{ $countWithdrawal }}x)</p>
                </div>
                <div class="control">
                    <div class="filter">
                        <div class="dropdown select data">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                @if(Input::has('data') && Input::get('data') != 'all')
                                    {{ str_replace('-', ' ', strtoupper(Input::get('data'))) }}
                                @else
                                    ALL DATA
                                @endif
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdown-data">
                                <li><a href="#"><i class="fa fa-navicon"></i>All Data</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#" data-value="withdrawal">Withdrawal</a></li>
                                <li><a href="#" data-value="reward">Reward</a></li>
                            </ul>
                        </div>
                        <div class="dropdown select status">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                @if(Input::has('status') && Input::get('status') != 'all')
                                    {{ strtoupper(Input::get('status')) }}
                                @else
                                    ALL STATUS
                                @endif
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">TRANSACTION STATUS</li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i>All Status</a></li>
                                <li><a href="#"><i class="fa fa-clock-o"></i>Pending</a></li>
                                <li><a href="#"><i class="fa fa-spinner"></i>Proceed</a></li>
                                <li><a href="#"><i class="fa fa-check"></i>Success</a></li>
                                <li><a href="#"><i class="fa fa-remove"></i>Cancel</a></li>
                            </ul>
                        </div>
                        <div class="dropdown select by">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                @if(Input::has('by'))
                                    {{ strtoupper(Input::get('by')) }}
                                @else
                                    TIMESTAMP
                                @endif
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">SORT BY</li>
                                <li><a href="#"><i class="fa fa-calendar"></i>Date</a></li>
                                <li><a href="#"><i class="fa fa-font"></i>Name</a></li>
                                <li><a href="#"><i class="fa fa-money"></i>Amount</a></li>
                                <li><a href="#"><i class="fa fa-info-circle"></i>Status</a></li>
                            </ul>
                        </div>
                        <div class="dropdown select method">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                @if(Input::has('sort'))
                                    @if(Input::get('sort') == 'asc')
                                        ASCENDING
                                    @else
                                        DESCENDING
                                    @endif
                                @else
                                    DESCENDING
                                @endif
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">METHOD</li>
                                <li><a href="#"><i class="fa fa-arrow-up"></i>Ascending</a></li>
                                <li><a href="#"><i class="fa fa-arrow-down"></i>Descending</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="group-control">
                        <a href="#" data-toggle="modal" data-target="#modal-delete" class="btn btn-danger btn-sm btn-delete all"><i class="fa fa-trash"></i> DELETE</a>
                        <!-- <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> APPROVE</a> -->
                    </div>
                </div>
            </div>
            @include('errors.common')
            @if(Session::has('status'))
                <div class="alert alert-{{ Session::get('status') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {!! Session::get('message') !!}
                </div>
            @endif
            <div class="content-section">
                <table class="table table-responsive table-striped table-hover table-condensed mbs">
                    <thead>
                    <tr>
                        <th width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-all" class="css-checkbox">
                                <label for="check-all" class="css-label"></label>
                            </div>
                        </th>
                        <th>Trans.ID</th>
                        <th>Contributor</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($transactions as $transaction)
                        <tr data-id="{{ $transaction->id }}"
                            data-author="{{ $transaction->name }}"
                            data-author-id="{{ $transaction->contributor_id }}"
                            data-bank="{{ $transaction->bank }}"
                            data-bank-code="{{ $transaction->code }}"
                            data-bank-name="{{ $transaction->account_name }}"
                            data-bank-number="{{ $transaction->account_number }}">

                            <td width="40">
                                <div class="checkbox">
                                    <input type="checkbox" name="check-{{ $transaction->id }}" value="{{ $transaction->id }}" id="check-{{ $transaction->id }}" class="css-checkbox checkbox-row">
                                    <label for="check-{{ $transaction->id }}" class="css-label"></label>
                                </div>
                            </td>
                            <td>{{ $transaction->id }}</td>
                            <td>
                                <div class="people">
                                    <img src="{{ asset('images/contributors/'.$transaction->avatar) }}"/>
                                    <a href="{{ route('contributor.stream', [$transaction->username]) }}">{{ $transaction->name }}</a>
                                </div>
                            </td>
                            <?php
                                $type = "success";
                                $transType = $transaction->type;
                                if($transType == \Infogue\Transaction::TYPE_WITHDRAWAL){
                                    $type = "danger";
                                }
                            ?>
                            <td><span class="label label-{{ $type }}">{{ strtoupper($transType) }}</span></td>
                            <td>IDR {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                            <?php
                            $status = "success";
                            $tranStatus = $transaction->status;
                            if($tranStatus == \Infogue\Transaction::STATUS_PENDING){
                                $status = "warning";
                            } else if($tranStatus == \Infogue\Transaction::STATUS_PROCEED){
                                $status = "info";
                            } else if($tranStatus == \Infogue\Transaction::STATUS_CANCEL){
                                $status = "danger";
                            }
                            ?>
                            <td><span class="label label-{{ $status }}">{{ strtoupper($tranStatus) }}</span></td>
                            <td class="text-center">
                                @if($transaction->type == \Infogue\Transaction::TYPE_WITHDRAWAL)
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        ACTION
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                        <li class="dropdown-header">INFO</li>
                                        <li><a href="#" class="btn-bank-detail" data-toggle="modal" data-target="#modal-bank"><i class="fa fa-credit-card"></i> Bank Info</a></li>
                                        <li><a href="#" class="btn-message" data-target="#send-message" data-toggle="modal"><i class="fa fa-envelope"></i> Send Message</a></li>
                                        @if($tranStatus == \Infogue\Transaction::STATUS_PENDING)
                                            <li class="dropdown-header">TRANSACTION ACTION</li>
                                            <li><a href="#" class="btn-update-transaction" data-value="proceed" data-toggle="modal" data-target="#modal-update-transaction"><i class="fa fa-spinner"></i> Proceed</a></li>
                                            <li><a href="#" class="btn-update-transaction" data-value="success" data-toggle="modal" data-target="#modal-update-transaction"><i class="fa fa-check"></i> Complete</a></li>
                                            <li><a href="#" class="btn-update-transaction" data-value="cancel" data-toggle="modal" data-target="#modal-update-transaction"><i class="fa fa-close"></i> Cancel</a></li>
                                        @elseif($tranStatus == \Infogue\Transaction::STATUS_PROCEED)
                                            <li class="dropdown-header">TRANSACTION ACTION</li>
                                            <li><a href="#" class="btn-update-transaction" data-value="success" data-toggle="modal" data-target="#modal-update-transaction"><i class="fa fa-check"></i> Complete</a></li>
                                            <li><a href="#" class="btn-update-transaction" data-value="cancel" data-toggle="modal" data-target="#modal-update-transaction"><i class="fa fa-close"></i> Cancel</a></li>
                                        @endif
                                    </ul>
                                </div>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No transaction available</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="table-footer">
                    <div class="status">
                        <p class="text-muted">{{ $transactions->currentPage() }}/{{ $transactions->lastPage() }} list of page</p>
                        <p>Showing {{ $transactions->perPage() * $transactions->currentPage() - 9 }} to {{ $transactions->perPage() * $transactions->currentPage() }} of {{ $transactions->total() }} entries</p>
                    </div>
                    <div class="pagination-wrapper">
                        {!! $transactions->appends(Input::all())->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade color" id="modal-bank" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" class="form-strip form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-file-text-o"></i> BANK INFO</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>BANK</label>
                                </div>
                                <div class="col-sm-8">
                                    <p class="acc_bank">Bank</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>BANK CODE</label>
                                </div>
                                <div class="col-sm-8">
                                    <p class="acc_code">Code</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>ACCOUNT NAME</label>
                                </div>
                                <div class="col-sm-8">
                                    <p class="acc_name">Acc name</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>ACCOUNT NUMBER</label>
                                </div>
                                <div class="col-sm-8">
                                    <p class="acc_number">Acc number</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">CLOSE</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade no-line" id="modal-update-transaction" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" data-url="{{ url('admin/transaction/update/status/') }}" method="post">
                    {!! csrf_field() !!}
                    {!! method_field('put') !!}
                    <input type="hidden" name="contributor_id" value="">
                    <input type="hidden" name="transaction_id" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> UPDATE TRANSACTION STATUS</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbn">Set this transaction <strong class="transaction-status text-danger"></strong>?</label>
                        <p class="mbn"><small class="text-muted">You acknowledge the process can't be undo.</small></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">CANCEL</a>
                        <button type="submit" class="btn btn-primary">SET <span class="transaction-status"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade no-line" id="modal-search" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.transaction.index') }}" method="get">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-search"></i> SEARCH QUERY</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbs">Search in Transaction Data</label>
                        <div class="search">
                            <input type="search" name="query" id="query" class="form-control pull-left" placeholder="Type keywords here"/>
                            <button type="submit" class="btn btn-primary pull-right">SEARCH</button>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade color" id="send-message" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.message.send') }}" id="form-message" class="form-strip form-horizontal" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" id="contributor_id" name="contributor_id" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i> SEND MESSAGE</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>SEND TO : </label> <span class="message-to"></span>
                        </div>
                        <div class="form-group">
                            <label for="message" class="mbs">MESSAGE : </label>
                            <textarea name="message" class="form-control" id="message" cols="30" rows="5" placeholder="Type message here" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-danger">DISCARD</a>
                        <button type="submit" class="btn btn-primary">SEND</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection