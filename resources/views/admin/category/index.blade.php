@extends('private')

@section('title', '- Categories')

@section('content')

    <div id="content-wrapper">
        <header>
            <a href="#menu-toggle" class="toggle-nav"><i class="fa fa-bars"></i></a>
            <div class="title">
                <h1>Category</h1>
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
                <li class="active">Category</li>
            </ol>
            <div class="control">
                <a href="#" data-toggle="modal" data-target="#modal-category" class="link btn-category-create"><i class="fa fa-plus"></i> CATEGORY</a>
                <a href="#" data-toggle="modal" data-target="#modal-subcategory" class="link btn-subcategory-create"><i class="fa fa-plus"></i> SUBCATEGORY</a>
            </div>
        </div>
        <div class="content">
            <div class="title-section">
                <div class="title-wrapper">
                    <h1 class="title">Category</h1>
                    <p class="subtitle">Click list of category to reveal subs</p>
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
                                <li><a href="#"><i class="fa fa-calendar"></i>Timestamp</a></li>
                                <li><a href="#"><i class="fa fa-font"></i>Title</a></li>
                                <li><a href="#"><i class="fa fa-navicon"></i>Sub</a></li>
                                <li><a href="#"><i class="fa fa-file-text"></i>Article</a></li>
                                <li><a href="#"><i class="fa fa-eye"></i>View</a></li>
                                <li><a href="#"><i class="fa fa-trophy"></i>Popularity</a></li>
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
                <table class="table table-responsive table-striped table-hover table-condensed table-multiple mbs">
                    <thead>
                    <tr>
                        <th width="5%">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-all" class="css-checkbox">
                                <label for="check-all" class="css-label"></label>
                            </div>
                        </th>
                        <th width="20%">Category</th>
                        <th width="15%">Sub</th>
                        <th width="15%">Article Total</th>
                        <th width="10%">Views</th>
                        <th width="20%" class="text-center">Popularity</th>
                        <th width="15%" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr data-target="#sub{{ $category->id }}" data-id="{{ $category->id }}" data-category="{{ $category->category }}" data-description="{{ $category->description }}">
                            <td>
                                <div class="checkbox">
                                    <input type="checkbox" name="row[]" value="{{ $category->id }}" id="check-{{ $category->id }}" class="css-checkbox checkbox-row">
                                    <label for="check-{{ $category->id }}" class="css-label"></label>
                                </div>
                            </td>
                            <td><a href="{{ route('article.category', str_slug($category->category)) }}" target="_blank">{{ strtoupper($category->category) }}</a></td>
                            <td>{{ $category->subcategory_total }} SUBS</td>
                            <td>{{ $category->article_total }} Articles</td>
                            <td>{{ $category->view_total }} X</td>
                            <td class="text-center"><div class="rating-wrapper pn" data-rating="{{ $category->rating_total }}"></div></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        ACTION
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                        <li class="dropdown-header">CONTROL</li>
                                        <li><a href="category.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modal-category" class="btn-category-edit"><i class="fa fa-pencil"></i> Edit</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modal-delete" data-label="{{ $category->category }}" class="btn-delete btn-delete-category"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                            <div class="sub-table">
                                <tbody class="sub-table" id="sub{{ $category->id }}">
                                <tr class="sub-head">
                                    <th width="5%"></th>
                                    <th width="20%">SUB CATEGORY</th>
                                    <th width="15%">LABEL</th>
                                    <th width="15%">ARTICLES</th>
                                    <th class="30%" colspan="2">DESCRIPTION</th>
                                    <th width="15%" class="text-center"></th>
                                </tr>
                                <?php $subcategories = $category->subcategories; ?>
                                @forelse($subcategories as $subcategory)
                                    <tr data-id="{{ $subcategory->id }}" data-category="{{ $subcategory->category_id }}" data-subcategory="{{ $subcategory->subcategory }}" data-label="{{ $subcategory->label }}" data-description="{{ $subcategory->description }}">
                                        <td></td>
                                        <td>
                                            <div class="checkbox checkbox-inline">
                                                <input type="checkbox" name="rowsub[]" value="{{ $subcategory->id }}" id="subcheck-{{ $category->id.$subcategory->id }}" class="css-checkbox checkbox-row-sub">
                                                <label for="subcheck-{{ $category->id.$subcategory->id }}" class="css-label"></label>
                                            </div>
                                            <a href="{{ route('article.subcategory', [str_slug($category->category), str_slug($subcategory->subcategory)]) }}"></a>{{ strtoupper($subcategory->subcategory) }}
                                        </td>
                                        <td>{{ $subcategory->label }}</td>
                                        <td>{{ $subcategory->articles()->count() }} Articles</td>
                                        <td colspan="2">{{ $subcategory->description }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    ACTION
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                                    <li class="dropdown-header">CONTROL</li>
                                                    <li><a href="{{ route('article.subcategory', [str_slug($category->category), str_slug($subcategory->subcategory)]) }}" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modal-subcategory" class="btn-subcategory-edit"><i class="fa fa-pencil"></i> Edit</a></li>
                                                    <li><a href="#" data-toggle="modal" data-target="#modal-delete" data-label="{{ $subcategory->subcategory }}" class="btn-delete btn-delete-subcategory"><i class="fa fa-trash"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">NO SUB CATEGORY AVAILABLE, <a href="#" data-toggle="modal" data-target="#modal-subcategory" class="btn-subcategory-create">CREATE ONE</a></td>
                                    </tr>
                                @endforelse
                                @if(count($subcategories) > 0)
                                <tr>
                                    <td colspan="7" class="text-center"><a href="#" data-toggle="modal" data-target="#modal-subcategory" class="btn-subcategory-create" style="border-top: 2px solid; display: block">CREATE NEW SUB {{ strtoupper($category->category) }}</a></td>
                                </tr>
                                @endif
                                </tbody>
                            </div>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">NO CATEGORY AVAILABLE, <a href="#" data-toggle="modal" data-target="#modal-category" class="btn-category-create">CREATE ONE</a></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="table-footer">
                    <div class="status">
                        <p class="text-muted">{{ $categories->currentPage() }}/{{ $categories->lastPage() }} list of page</p>
                        <p>Showing {{ $categories->perPage() * $categories->currentPage() - 9 }} to {{ $categories->perPage() * $categories->currentPage() }} of {{ $categories->total() }} entries</p>
                    </div>
                    <div class="pagination-wrapper">
                        {!! $categories->appends(Input::all())->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade color" id="modal-category" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" data-url="{{ route('admin.category.store') }}" method="post" id="form-category" class="form-strip form-horizontal">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" class="method" value=""/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-navicon"></i> <span class="title">CREATE</span> CATEGORY</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="category">CATEGORY</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="category" name="category" value="{{ old('category') }}" class="form-control" placeholder="Category name" required maxlength="20"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="description">DESCRIPTION</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea id="description" name="description" class="form-control" cols="30" rows="3" placeholder="Short category description" maxlength="50">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-danger">DISCARD</a>
                        <button type="submit" class="btn btn-primary"><span class="title-button">CREATE</span> CATEGORY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade color" data-url="{{ route('admin.subcategory.store') }}" id="modal-subcategory" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" data-url="{{ route('admin.subcategory.store') }}" method="post" class="form-strip form-horizontal" id="form-subcategory">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" class="method" value=""/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-navicon"></i> <span class="title">CREATE</span> SUB CATEGORY</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="category_id">CATEGORY</label>
                                </div>
                                <div class="col-sm-9">
                                    <label for="category" class="css-select">
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach($site_menus as $category)

                                                <option value="{{ $category->id }}" @if(old('category_id') == $category->id) selected @endif>{{ $category->category }}</option>

                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="subcategory">SUB CATEGORY</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="subcategory" name="subcategory" class="form-control" value="{{ old('subcategory') }}" placeholder="Sub category name"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="label">GROUP LABEL</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="label" name="label" class="form-control" value="{{ old('label') }}" placeholder="Label group in menu"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="description">DESCRIPTION</label>
                                </div>
                                <div class="col-sm-9">
                                <textarea class="form-control" id="description" name="description" cols="30" rows="3" placeholder="Short sub category description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-danger">DISCARD</a>
                        <button type="submit" class="btn btn-primary"><span class="title-button">CREATE</span> SUB CATEGORY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade no-line" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" data-url="{{ url('admin/') }}" method="post">
                    {!! csrf_field() !!}
                    {!! method_field('delete') !!}
                    <input type="hidden" name="selected" value="">
                    <input type="hidden" name="selected_sub" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i> DELETE<span class="title">CATEGORY</span></h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbn">Are you sure delete the <span class="delete-title text-danger"></span>?</label>
                        <p class="mbn"><small class="text-muted">All related data will be deleted.</small></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">CANCEL</a>
                        <button type="submit" class="btn btn-danger">DELETE<span class="title">CATEGORY</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection