<!-- sidebar -->
<div id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/misc/logo-administrator.png') }}">
        </a>
    </div>
    <div class="sidebar-statistic">
        <div>
            <h3>{{ formatSortNumeric($site_statistic['article']) }}</h3>
            <p>ARTICLES</p>
        </div>
        <div>
            <h3>{{ formatSortNumeric($site_statistic['member']) }}</h3>
            <p>MEMBERS</p>
        </div>
    </div>
    <a href="{{ route('admin.article.create') }}" class="btn btn-outline btn-light create">CREATE ARTICLE</a>
    <nav role="navigation">
        <?php $segment = Request::segment(2); ?>
        <ul>
            <li @if($segment == 'dashboard'){!! 'class="active"' !!}@endif>
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i>Dashboard</a>
            </li>
            <li @if($segment == 'setting') {!! 'class="active"' !!}@endif>
                <a href="{{ route('admin.setting') }}"><i class="fa fa-wrench"></i>Setting</a>
            </li>
            <li @if($segment == 'contributor') {!! 'class="active"' !!}@endif>
                <a href="{{ route('admin.contributor.index') }}"><i class="fa fa-child"></i>Contributor</a>
            </li>
            <li @if($segment == 'article') {!! 'class="active"' !!}@endif>
                <a href="{{ route('admin.article.index') }}"><i class="fa fa-file-text-o"></i>Article</a>
            </li>
            <li @if($segment == 'category') {!! 'class="active"' !!}@endif>
                <a href="{{ route('admin.category.index') }}"><i class="fa fa-bars"></i>Category</a>
            </li>
            <li @if($segment == 'message') {!! 'class="active"' !!}@endif>
                <a href="{{ route('admin.message.index') }}"><i class="fa fa-envelope"></i>Messages</a>
            </li>
            <li @if($segment == 'feedback') {!! 'class="active"' !!}@endif>
                <a href="{{ route('admin.feedback.index') }}"><i class="fa fa-comments-o"></i>Feedback</a>
            </li>
            <li @if($segment == 'about') {!! 'class="active"' !!}@endif>
                <a href="{{ route('admin.about') }}"><i class="fa fa-info-circle"></i>About</a>
            </li>
            <li class="visible-xs">
                <a href="{{ route('admin.login.destroy') }}"><i class="fa fa-sign-out"></i>Sign Out</a>
            </li>
        </ul>
    </nav>

    <div class="copyright">
        <img src="{{ asset('images/misc/logo-small.png') }}"/>
        <p>&copy; {{ date('Y') }} All Rights Reserved.</p>
    </div>
</div>
<!-- end of sidebar -->