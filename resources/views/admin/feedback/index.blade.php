@extends('private')

@section('title', '- Feedback')

@section('content')

    <div id="content-wrapper">
        <header>
            <a href="#menu-toggle" class="toggle-nav"><i class="fa fa-bars"></i></a>
            <div class="title">
                <h1>Feedback</h1>
            </div>
            <div class="control hidden-xs">
                <div class="account clearfix">
                    <div class="avatar-wrapper">
                        <img src="{{ asset('images/contributors/'.Auth::guard('admin')->user()->avatar) }}" class="img-circle img-rounded">
                        <div class="notify"></div>
                    </div>
                    <p class="avatar-greeting pull-left hidden-sm">Hi, <strong>{{ Auth::guard('admin')->user()->name }}</strong></p>
                </div>
                <a href="{{ route('admin.login.destroy') }}" class="sign-out"><i class="fa fa-sign-out"></i> SIGN OUT</a>
            </div>
        </header>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('index') }}" target="_blank">INFOGUE.ID</a></li>
                <li class="hidden-xs"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="active">Feedback</li>
            </ol>
            <div class="control">
                <a href="#" data-toggle="modal" data-target="#modal-search" class="link"><i class="fa fa-search"></i> SEARCH</a>
                <a href="#" class="link print"><i class="fa fa-print"></i> PRINT</a>
            </div>
        </div>
        <div class="content" id="content">
            <div class="title-section">
                <div class="title-wrapper">
                    <h1 class="title">Feedback</h1>
                    <p class="subtitle">User feedback and questions</p>
                </div>
                <div class="control">
                    <div class="filter">
                        <div class="dropdown select data">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                @if(Input::has('data') && Input::get('data') != 'all')
                                    {{ strtoupper(Input::get('data')) }}
                                @else
                                    ALL DATA
                                @endif
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">FEEDBACK TYPE</li>
                                <li><a href="#"><i class="fa fa-navicon"></i>All Data</a></li>
                                <li><a href="#"><i class="fa fa-bookmark"></i>Important</a></li>
                                <li><a href="#"><i class="fa fa-archive"></i>Archived</a></li>
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
                                <li><a href="#"><i class="fa fa-clock-o"></i>Date</a></li>
                                <li><a href="#"><i class="fa fa-font"></i>Name</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i>Email</a></li>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Timestamp</th>
                        <th>Label</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($feedbacks as $feedback)
                        <?php
                        $label = 'default';
                        if($feedback->label == 'important'){
                            $label = 'danger';
                        }
                        else if($feedback->label == 'archived'){
                            $label = 'success';
                        }
                        ?>
                        <tr class="@if($label == 'danger'){{ $label }}@endif" data-id="{{ $feedback->id }}" data-name="{{ $feedback->name }}" data-email="{{ $feedback->email }}" data-message="{{ nl2br($feedback->message) }}" data-timestamp="@datetime($feedback->created_at)">
                            <td>
                                <div class="checkbox">
                                    <input type="checkbox" name="row[]" value="{{ $feedback->id }}" id="check-{{ $feedback->id }}" class="css-checkbox checkbox-row">
                                    <label for="check-{{ $feedback->id }}" class="css-label"></label>
                                </div>
                            </td>
                            <td>{{ $feedback->name }}</td>
                            <td><a href="mailto:{{ $feedback->email }}">{{ $feedback->email }}</a></td>
                            <td><a href="#" data-toggle="modal" data-target="#modal-detail" class="btn-feedback-detail">DETAIL</a></td>
                            <td>@fulldate($feedback->created_at)</td>
                            <td><span class="label label-{{ $label }}">{{ strtoupper($feedback->label) }}</span></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        ACTION
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                        <li class="dropdown-header">CONTROL</li>
                                        <li><a href="#" data-toggle="modal" data-target="#modal-detail" class="btn-feedback-detail"><i class="fa fa-eye"></i>View</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modal-reply" class="btn-feedback-reply" data-id="{{ $feedback->id }}"><i class="fa fa-pencil"></i>Reply</a></li>
                                        <li><a href="#" class="btn-delete" data-toggle="modal" data-target="#modal-delete" data-label="{{ $feedback->name }}"><i class="fa fa-trash"></i>Delete</a></li>
                                        <li class="dropdown-header">QUICK ACTION</li>
                                        <li><a href="#" class="btn-mark"><i class="fa fa-bookmark"></i>Important</a></li>
                                        <li><a href="#" class="btn-mark"><i class="fa fa-archive"></i>Archived</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No feedback available</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="table-footer">
                    <div class="status">
                        <p class="text-muted">{{ $feedbacks->currentPage() }}/{{ $feedbacks->lastPage() }} list of page</p>
                        <p>Showing {{ $feedbacks->perPage() * $feedbacks->currentPage() - 9 }} to {{ $feedbacks->perPage() * $feedbacks->currentPage() }} of {{ $feedbacks->total() }} entries</p>
                    </div>
                    <div class="pagination-wrapper">
                        {!! $feedbacks->appends(Input::all())->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade color" id="modal-detail" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-comments-o"></i> FEEDBACK DETAIL</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mbn">
                            <label>SENDER : </label> <span class="name">Name</span> &lt;<span class="email">Email</span>&gt;
                        </div>
                        <div class="form-group mbn">
                            <label>TIMESTAMP : </label> <span class="timestamp">Timestamp</span>
                        </div>
                        <div class="form-group mbn">
                            <label>MESSAGE : </label>
                            <p class="message">Message</p>
                        </div>
                        <input type="hidden" class="form-control" value="0"/>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">CLOSE</a>
                        <a href="#" data-toggle="modal" data-target="#modal-reply" data-dismiss="modal" class="btn btn-primary btn-feedback-reply">REPLY</a>
                        <a href="#" data-dismiss="modal" class="btn btn-danger btn-mark" data-id="">IMPORTANT</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade color" id="modal-reply" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.feedback.reply') }}" class="form-strip form-horizontal" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="name" value="">
                    <input type="hidden" name="email" value="">
                    <input type="hidden" name="message" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-comments-o"></i> FEEDBACK REPLY</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>REPLY TO : </label> <span class="name">Name</span>
                        </div>
                        <div class="form-group">
                            <label>EMAIL : </label> <a href="#" class="email-link"><span class="email">Email</span></a>
                        </div>
                        <div class="form-group">
                            <label for="reply-message" class="mbs">MESSAGE : </label>
                            <textarea name="reply" class="form-control message" id="reply-message" cols="30" rows="5" placeholder="Type message here" required></textarea>
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

    <div class="modal fade no-line" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" data-url="{{ url('admin/feedback/') }}" method="post">
                    {!! csrf_field() !!}
                    {!! method_field('delete') !!}
                    <input type="hidden" name="selected" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i> DELETE FEEDBACK</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbn">Are you sure delete the <span class="delete-title text-danger"></span>?</label>
                        <p class="mbn"><small class="text-muted">All related data will be deleted.</small></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">CANCEL</a>
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade no-line" id="modal-search" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.feedback.index') }}" method="get">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-search"></i> SEARCH QUERY</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbs">Search in Contributor Data</label>
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

    <form action="#" method="post" data-url="{{ url('admin/feedback/mark') }}" id="form-mark">
        {!! csrf_field() !!}
        {!! method_field('put') !!}
    </form>

@endsection