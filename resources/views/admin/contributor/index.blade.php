@extends('private')

@section('title', '- Contributors')

@section('content')

    <div id="content-wrapper">
        @include('admin.layouts._header')
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('index') }}" target="_blank">INFOGUE.ID</a></li>
                <li class="hidden-xs"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="active">Contributor</li>
            </ol>
            <div class="control">
                <a href="#" class="link" data-toggle="modal" data-target="#modal-search"><i class="fa fa-search"></i> SEARCH</a>
                <a href="#" class="link print"><i class="fa fa-print"></i> PRINT</a>
            </div>
        </div>
        <div class="content" id="content">
            <div class="title-section">
                <div class="title-wrapper">
                    <h1 class="title">Contributor</h1>
                    <p class="subtitle">List of article contributor</p>
                </div>
                <div class="control">
                    <div class="filter">
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
                                <li><a href="#"><i class="fa fa-trophy"></i>Popularity</a></li>
                                <li><a href="#"><i class="fa fa-file-text"></i>Article</a></li>
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
                        <a href="#" data-toggle="modal" data-target="#modal-delete" class="btn btn-danger btn-delete all btn-sm"><i class="fa fa-trash"></i> DELETE</a>
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
                <table class="table table-striped table-hover table-condensed mbs">
                    <thead>
                    <tr>
                        <th width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-all" class="css-checkbox">
                                <label for="check-all" class="css-label"></label>
                            </div>
                        </th>
                        <th>Contributor</th>
                        <th>Email</th>
                        <th>Article</th>
                        <th>Popularity</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($contributors as $contributor)
                        <tr data-id="{{ $contributor->id }}" data-author="{{ $contributor->name }}" data-author-id="{{ $contributor->id }}">
                            <td width="40">
                                <div class="checkbox">
                                    <input type="checkbox" name="row[]" value="{{ $contributor->id }}" id="check-{{ $contributor->id }}" class="css-checkbox checkbox-row">
                                    <label for="check-{{ $contributor->id }}" class="css-label"></label>
                                </div>
                            </td>
                            <td>
                                <div class="people">
                                    <img src="{{ asset('images/contributors/'.$contributor->avatar) }}"/>
                                    <a href="{{ route('contributor.stream', [$contributor->username]) }}" target="_blank">{{ $contributor->name }}</a>
                                </div>
                            </td>
                            <td><a href="mailto:{{ $contributor->email }}">{{ $contributor->email }}</a></td>
                            <td>{{ $contributor->articles()->count() }}</td>
                            <?php
                                $follower_total = $contributor->followers->count();
                                $following_total = $contributor->following->count();

                                $popularity = 0;
                                if($follower_total == null || $follower_total >= 0){
                                    $popularity = 1;
                                }
                                if($follower_total >= 5){
                                    $popularity = 2;
                                }
                                if($follower_total >= 10){
                                    $popularity = 3;
                                }
                                if($follower_total >= 30){
                                    $popularity = 4;
                                }
                                if($follower_total >= 50){
                                    $popularity = 5;
                                }
                            ?>
                            <td><div class="rating-wrapper pn" data-rating="{{ $popularity }}"></div></td>
                            <?php
                            $label = 'default';

                            if($contributor->status == 'activated'){
                                $label = 'success';
                            }
                            if($contributor->status == 'pending'){
                                $label = 'warning';
                            }
                            if($contributor->status == 'suspended'){
                                $label = 'danger';
                            }
                            ?>
                            <td><span class="label label-{{ $label }}">{{ strtoupper($contributor->status) }}</span></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        ACTION
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                        <li class="dropdown-header">CONTROL</li>
                                        <li><a href="#" class="btn-message" data-target="#send-message" data-toggle="modal"><i class="fa fa-envelope"></i> Send Message</a></li>
                                        <li><a href="{{ route('contributor.stream', [$contributor->username]) }}" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                        <li><a href="{{ route('admin.contributor.edit', [$contributor->username]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                                        <li><a href="#" data-label="{{ $contributor->name }}" class="btn-delete" data-target="#modal-delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No contributor available</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="table-footer">
                    <div class="status">
                        <p class="text-muted">{{ $contributors->currentPage() }}/{{ $contributors->lastPage() }} list of page</p>
                        <p>Showing {{ $contributors->perPage() * $contributors->currentPage() - 9 }} to {{ $contributors->perPage() * $contributors->currentPage() }} of {{ $contributors->total() }} entries</p>
                    </div>
                    <div class="pagination-wrapper">
                        {!! $contributors->appends(Input::all())->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade no-line" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" data-url="{{ url('admin/contributor/') }}" method="post">
                    {!! csrf_field() !!}
                    {!! method_field('delete') !!}
                    <input type="hidden" name="selected" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i> DELETE CONTRIBUTOR</h4>
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
                <form action="{{ route('admin.contributor.index') }}" method="get">
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