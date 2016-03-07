@extends('private')

@section('title', '- Dashboard')

@section('content')

    <div id="content-wrapper">
        <header>
            <a href="#menu-toggle" class="toggle-nav"><i class="fa fa-bars"></i></a>
            <div class="title">
                <h1>Dashboard</h1>
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
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="blank"></li>
            </ol>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="title-section">
                        <h1 class="title">Activities</h1>
                        <p class="subtitle">User behavior, logs and activities <a href="#" class="pull-right">{{ $activities->total() }} More</a></p>
                    </div>
                    <div class="content-section">
                        @forelse($activities as $activity)
                            <div class="list-activity">
                                <img src="{{ asset('images/contributors/'.$activity->contributor->avatar) }}"/>
                                <div class="info">
                                    <p class="name"><a href="{{ route('contributor.stream', [$activity->contributor->username]) }}" style="color: inherit" target="_blank">{{ $activity->contributor->name }}</a> <span class="pull-right timestamp"><time class="timeago" datetime="{{ $activity->created_at }}">{{ $activity->created_at }}</time></span></p>
                                    <p class="description">{!! $activity->activity !!}</p>
                                </div>
                            </div>
                        @empty
                            <div class="list-activity">
                                No activity available
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="title-section">
                        <h1 class="title">Visitor</h1>
                        <p class="subtitle">Web visitor statistic <a href="#" class="pull-right">View History</a></p>
                    </div>
                    <div class="content-section">
                        <div class="row">
                            <div class="col-sm-1 col-xs-2 prn">
                                <div class="legend-left">
                                    <ul class="list-unstyled">
                                        <li>70</li>
                                        <li>60</li>
                                        <li>50</li>
                                        <li>40</li>
                                        <li>30</li>
                                        <li>20</li>
                                        <li>10</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-11 col-xs-10 pln">
                                <div class="chart">
                                    @for($i = count($visitors) - 1; $i >= 0; $i--)
                                        <div class="bar @if($i < 4) {!! 'sm-screen' !!} @endif @if($i <4 && $i > 1) {!! 'md-screen' !!} @endif">
                                            <div class="bar-wrapper">
                                                <div class="base"></div>
                                                <div class="fill" data-value="{{ $visitors[$i]->unique }}"></div>
                                            </div>
                                            <p>{{ Carbon\Carbon::parse($visitors[$i]->date)->format('d/m') }}</p>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="legend-bottom">
                            <?php $from = ''; $until = ''; ?>
                            @if(count($visitors) > 0)
                                <?php
                                    $from = \Carbon\Carbon::parse($visitors->last()->date)->format('d F');
                                    $until = \Carbon\Carbon::parse($visitors->first()->date)->format('d F'); ?>
                            @endif
                            <p class="center-block text-center">Daily Visitor report <strong>{{ $from }} - {{ $until }}</strong></p>
                            <ul class="list-inline center-block text-center">
                                <li>VISITOR</li>
                                <li>TARGET</li>
                            </ul>
                        </div>
                    </div>
                    <div class="title-section">
                        <h1 class="title">Statistics</h1>
                        <p class="subtitle">Several data information <a href="#" class="pull-right">View Details</a></p>
                    </div>
                    <div class="content-section">
                        <div class="row statistic-box">
                            @foreach($statistics as $statistic => $value)
                                <div class="col-md-4 col-xs-6">
                                    <div class="box">
                                        <h1>{{ $value }}</h1>
                                        <p>{{ $statistic }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> <!-- End of page-content-wrapper -->

@endsection