@extends('private')

@section('title', '- Contributors')

@section('content')

    <div id="content-wrapper">
        <header>
            <a href="#menu-toggle" class="toggle-nav"><i class="fa fa-bars"></i></a>
            <div class="title">
                <h1>Contributor</h1>
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
                <li class="active">Contributor</li>
            </ol>
            <div class="control">
                <a href="#search" class="link" data-toggle="modal"><i class="fa fa-search"></i> SEARCH</a>
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
                        <div class="dropdown select">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                TIMESTAMP
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">SORT BY</li>
                                <li><a href="#"><i class="fa fa-clock-o"></i> Timestamp</a></li>
                                <li><a href="#"><i class="fa fa-font"></i> Name</a></li>
                                <li><a href="#"><i class="fa fa-trophy"></i> Popularity</a></li>
                                <li><a href="#"><i class="fa fa-file-text"></i> Article</a></li>
                            </ul>
                        </div>
                        <div class="dropdown select">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                DESCENDING
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">METHOD</li>
                                <li><a href="#"><i class="fa fa-arrow-up"></i> Ascending</a></li>
                                <li><a href="#"><i class="fa fa-arrow-down"></i> Descending</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="group-control">
                        <a href="#delete" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> DELETE</a>
                    </div>
                </div>
            </div>
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
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($contributors as $contributor)
                        <tr>
                            <td width="40">
                                <div class="checkbox">
                                    <input type="checkbox" name="check-all" id="check-1" class="css-checkbox">
                                    <label for="check-1" class="css-label"></label>
                                </div>
                            </td>
                            <td>
                                <div class="people">
                                    <img src="{{ asset('images/contributors/'.$contributor->avatar) }}"/>
                                    <a href="profile.html" target="_blank">{{ $contributor->name }}</a>
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
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        ACTION
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                        <li class="dropdown-header">CONTROL</li>
                                        <li><a href="{{ route('contributor.stream', [$contributor->username]) }}" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                        <li><a href="{{ route('admin.contributor.edit', [$contributor->username]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                                        <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No contributor available</td>
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
                        {!! $contributors->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade no-line" id="delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i> DELETE CONTRIBUTOR</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbn">Are you sure delete this contributor?</label>
                        <p class="mbn"><small class="text-muted">All related data will be deleted.</small></p>
                        <input type="hidden" class="form-control" value="0"/>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">CANCEL</a>
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade no-line" id="search" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-search"></i> SEARCH QUERY</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbs">Search in Contributor Data</label>
                        <div class="search">
                            <input type="search" class="form-control pull-left" placeholder="Type keywords here"/>
                            <button type="submit" class="btn btn-primary pull-right">SEARCH</button>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </form>
            </div>
        </div>
    </div>

@endsection