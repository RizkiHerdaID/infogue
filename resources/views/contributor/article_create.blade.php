@extends('public')

@section('title', '- Create Article')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data">
                                <h3 class="title">CREATE ARTICLE</h3>
                                <div class="content">
                                    <form action="{{ route('account.article.store') }}" class="form-horizontal form-strip" method="post" id="form-article" enctype="multipart/form-data">
                                        {!! csrf_field() !!}
                                        <fieldset>
                                            <legend>INFORMATION</legend>
                                            @if(Session::has('status'))
                                                <div class="form-group">
                                                    <div class="alert alert-{{ Session::get('status') }}">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        {{ Session::get('message') }}
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                <label for="title" class="col-sm-3 control-label">Title</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Post Title" required maxlength="70">
                                                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                                                <label for="slug" class="col-sm-3 control-label">Slug</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Custom slug for URL friendly" required maxlength="100">
                                                    @if(!$errors->has('slug')) <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Default slug is good enough.</span> @endif
                                                    {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                                <label for="standard" class="col-sm-3 control-label">Post Format</label>
                                                <div class="col-sm-9">
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="type" id="standard" value="standard" class="css-radio" required @if(old('type', 'standard') == 'standard') checked @endif>
                                                        <label for="standard" class="css-label">Standard</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="type" id="gallery" value="gallery" class="css-radio" @if(old('type', '') == 'gallery') checked @endif>
                                                        <label for="gallery" class="css-label">Photo</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="type" id="video" value="video" class="css-radio" @if(old('type', '') == 'video') checked @endif>
                                                        <label for="video" class="css-label">Video</label>
                                                    </div>
                                                    {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>CATEGORY & TAGS</legend>
                                            <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                                                <label for="category" class="col-sm-3 control-label">Category</label>
                                                <div class="col-sm-9">
                                                    <label for="category" class="css-select">
                                                        <select name="category" id="category" class="form-control" required>
                                                            <option value="">Select Category</option>
                                                            @foreach($categories as $id => $category)

                                                                <option value="{{ $id }}" @if(old('category', '') == $id) selected @endif>{{ $category }}</option>

                                                            @endforeach
                                                        </select>
                                                    </label>
                                                    {!! $errors->first('category', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('subcategory') ? 'has-error' : '' }}">
                                                <label for="subcategory" class="col-sm-3 control-label">Sub Category</label>
                                                <div class="col-sm-9">
                                                    <label for="subcategory" class="css-select">
                                                        <select name="subcategory" id="subcategory" class="form-control" required>
                                                            <option value="">Select Subcategory</option>
                                                            <?php $label = ''; $isFirst = true; $counter = 1; ?>
                                                            @if($subcategories != null || $subcategories != '')
                                                                @foreach($subcategories as $subcategory)
                                                                    @if($subcategory->label != $label)
                                                                        @if(!$isFirst)
                                                                            {!! '</optgroup>' !!}
                                                                        @endif

                                                                        {!! "<optgroup label='{$subcategory->label}'>" !!}

                                                                        <?php $isFirst = false; ?>
                                                                        <?php $label = $subcategory->label ?>
                                                                    @endif

                                                                    <option value="{{ $subcategory->id }}" @if(old('subcategory', '') == $subcategory->id) selected @endif>{{ $subcategory->subcategory }}</option>

                                                                    @if($counter == $subcategories->count())
                                                                        {!! '</optgroup>' !!}
                                                                    @endif

                                                                    <?php $counter++ ?>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </label>
                                                    {!! $errors->first('subcategory', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('tags') ? 'has-error' : '' }}">
                                                <label for="tags" class="col-sm-3 control-label">Tags</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control typeahead" id="tags" name="tags" value="{{ old('tags') }}" placeholder="Tag separated by coma" data-role="tagsinput" required maxlength="200">
                                                    {!! $errors->first('tags', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>ARTICLE</legend>
                                            <div class="form-group {{ $errors->has('featured') ? 'has-error' : '' }}">
                                                <label for="featured" class="col-sm-3 control-label">Featured</label>
                                                <div class="col-sm-9">
                                                    <div class="css-file">
                                                        <span class="file-info">No file selected</span>
                                                        <button class="btn btn-primary" type="button">SELECT FEATURED</button>
                                                        <input type="file" class="file-input" id="featured" name="featured" accept="image/*" required/>
                                                    </div>
                                                    @if(!$errors->has('featured')) <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Cover image for your post.</span> @endif
                                                    {!! $errors->first('featured', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                                                <label for="content" class="col-sm-3 control-label">Content</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control summernote" name="content" id="content" cols="30" rows="10" placeholder="Write article here" required>{!! old('content') !!}</textarea>
                                                    {!! $errors->first('content', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                                                <label for="excerpt" class="col-sm-3 control-label">Excerpt</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="excerpt" id="excerpt" cols="30" rows="2" placeholder="Write an excerpt (optional)" maxlength="300">{{ old('excerpt') }}</textarea>
                                                    @if(!$errors->has('excerpt')) <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Add footer text for conclusion or quote.</span> @endif
                                                    {!! $errors->first('excerpt', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                                <label for="published" class="col-sm-3 control-label">Status</label>
                                                <div class="col-sm-9">
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="status" id="published" value="pending" class="css-radio" required @if(old('status', 'pending') == 'pending') checked @endif>
                                                        <label for="published" class="css-label">Published</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="status" id="draft" value="draft" class="css-radio" @if(old('status') == 'draft') checked @endif>
                                                        <label for="draft" class="css-label">Draft</label>
                                                    </div>
                                                    @if(!$errors->has('status')) <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Wait administrator confirmation.</span> @endif
                                                    {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group no-line">
                                                <div class="col-sm-offset-3 col-sm-9 pts pbm">
                                                    <button class="btn btn-primary">CREATE ARTICLE</button>
                                                    <a href="#" data-toggle="modal" data-target="#modal-discard" class="btn btn-danger">DISCARD</a>
                                                </div>
                                            </div>
                                        </fieldset>
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
                    <h4 class="modal-title"><i class="fa fa-save"></i> DISCARD ARTICLE</h4>
                </div>
                <div class="modal-body">
                    <label class="mbn">Are you sure want to discard the article?</label>
                    <p class="mbn"><small class="text-muted">All filled content will be lost.</small></p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-primary">NO</a>
                    <a href="{{ route('account.article.index') }}" class="btn btn-danger">YES</a>
                </div>
            </div>
        </div>
    </div>
@endsection