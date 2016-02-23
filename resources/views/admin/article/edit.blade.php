@extends('private')

@section('title', '- Create Article')

@section('content')

    <div id="content-wrapper">
        <header>
            <a href="#menu-toggle" class="toggle-nav"><i class="fa fa-bars"></i></a>
            <div class="title">
                <h1>Article</h1>
            </div>
            <div class="control hidden-xs">
                <div class="account clearfix">
                    <div class="avatar-wrapper">
                        <img src="images/contributors/cici.png" class="img-circle img-rounded">
                        <div class="notify"></div>
                    </div>
                    <p class="avatar-greeting pull-left hidden-sm">Hi, <strong>Imelda Agustine</strong></p>
                </div>
                <a href="admin_login.html" class="sign-out"><i class="fa fa-sign-out"></i> SIGN OUT</a>
            </div>
        </header>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li class="hidden-xs"><a href="index.html">INFOGUE.ID</a></li>
                <li><a href="admin_article.html">Article</a></li>
                <li class="active">Edit</li>
            </ol>
        </div>
        <div class="content">
            <div class="title-section">
                <h1 class="title">Edit Article</h1>
                <p class="subtitle">Administrator edit article and post <a href="#" class="pull-right hidden-xs reset-article">RESET FORM</a></p>
            </div>
            <div class="content-section">
                <form class="form-horizontal form-strip" id="form-article">
                    @include('admin.article.form')
                </form>
            </div>
        </div>
    </div>

@endsection

<div class="modal fade no-line" id="discard" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-save"></i> DISCARD ARTICLE</h4>
                </div>
                <div class="modal-body">
                    <label class="mbn">Are you sure want to discard this article?</label>
                    <p class="mbn"><small class="text-muted">All updated content will be lost.</small></p>
                    <input type="hidden" class="form-control" value="0"/>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-primary">NO</a>
                    <a href="admin_article.html" class="btn btn-danger">YES</a>
                </div>
            </form>
        </div>
    </div>
</div>