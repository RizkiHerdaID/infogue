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
                <a href="#" data-toggle="modal" data-target="#modal-category" class="link create"><i class="fa fa-plus"></i> CATEGORY</a>
                <a href="#" data-toggle="modal" data-target="#modal-subcategory" class="link create"><i class="fa fa-plus"></i> SUB</a>
            </div>
        </div>
        <div class="content">
            <div class="title-section">
                <div class="title-wrapper">
                    <h1 class="title">Category</h1>
                    <p class="subtitle">List of article category</p>
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
                        <a href="#delete" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> DELETE</a>
                    </div>
                </div>
            </div>
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
                    @foreach($categories as $category)
                        <tr data-target="#sub{{ $category->id }}">
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
                            <?php $rating = round($category->articles()->join('ratings', 'articles.id', '=', 'article_id')->avg('rate')); ?>
                            <td class="text-center"><div class="rating-wrapper pn" data-rating="{{ $rating }}"></div></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        ACTION
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                        <li class="dropdown-header">CONTROL</li>
                                        <li><a href="category.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                        <li><a href="#edit" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</a></li>
                                        <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
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
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="checkbox checkbox-inline">
                                                <input type="checkbox" name="rowsub[]" id="subcheck-{{ $category->id.$subcategory->id }}" class="css-checkbox checkbox-row-sub">
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
                                                    <li><a href="category.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                                    <li><a href="#edit-sub" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</a></li>
                                                    <li><a href="#delete-sub" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">NO SUB CATEGORY AVAILABLE</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </div>
                        </tr>
                    @endforeach
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
                <form action="#" class="form-strip form-horizontal">
                    <input type="hidden" class="form-control" value="0"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-navicon"></i> CREATE CATEGORY</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="category">CATEGORY</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="category" class="form-control" placeholder="Category name"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="keywords">KEYWORDS</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="keywords" class="form-control" placeholder="Separated by coma" data-role="tagsinput"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="description">DESCRIPTION</label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="5" placeholder="Short category description"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-danger">DISCARD</a>
                        <button type="submit" class="btn btn-primary">CREATE CATEGORY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade color" id="modal-subcategory" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" class="form-strip form-horizontal">
                    <input type="hidden" class="form-control" value="0"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-navicon"></i> CREATE SUB CATEGORY</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="category-list-edit">CATEGORY</label>
                                </div>
                                <div class="col-sm-9">
                                    <label for="category-list" class="css-select">
                                        <select name="category-list" id="category-list" class="form-control" required>
                                            <option value="">Select Category</option>
                                            <option value="1">News</option>
                                            <option value="2">Economic</option>
                                            <option value="5">Entertainment</option>
                                            <option value="4">Sport</option>
                                            <option value="4">Health</option>
                                            <option value="4">Science</option>
                                            <option value="4">Technology</option>
                                            <option value="4">Photo</option>
                                            <option value="4">Video</option>
                                            <option value="4">Others</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="sub-category">SUB CATEGORY</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="sub-category" class="form-control" placeholder="Sub category name"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="label-edit">GROUP LABEL</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="label-edit" class="form-control" placeholder="Label group in menu"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="description-sub">DESCRIPTION</label>
                                </div>
                                <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="description-sub" cols="30" rows="5" placeholder="Short sub category description">
                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-danger">DISCARD</a>
                        <button type="submit" class="btn btn-primary">CREATE SUB</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade color" id="edit" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" class="form-strip form-horizontal">
                    <input type="hidden" class="form-control" value="0"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-navicon"></i> EDIT CATEGORY</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="cateogry-edit">CATEGORY</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="cateogry-edit" class="form-control" placeholder="Category name" value="Entertainment"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="keywords-edit">KEYWORDS</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="keywords-edit" class="form-control" placeholder="Separated by coma" data-role="tagsinput" value="Game, Music, Film"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="description-edit">DESCRIPTION</label>
                                </div>
                                <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="description-edit" cols="30" rows="5" placeholder="Short category description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, alias atque consequatur cupiditate explicabo impedit magnam maxime minus, molestias, neque nihil porro quaerat quam sequi tempora tempore vel veniam voluptas.
                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-danger">DISCARD</a>
                        <button type="submit" class="btn btn-primary">UPDATE CATEGORY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade color" id="edit-sub" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" class="form-strip form-horizontal">
                    <input type="hidden" class="form-control" value="0"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-navicon"></i> EDIT SUB CATEGORY</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="category-list-edit">CATEGORY</label>
                                </div>
                                <div class="col-sm-9">
                                    <label for="category-list-edit" class="css-select">
                                        <select name="category-list-edit" id="category-list-edit" class="form-control" required>
                                            <option value="">Select Category</option>
                                            <option value="1">News</option>
                                            <option value="2">Economic</option>
                                            <option value="5" selected>Entertainment</option>
                                            <option value="4">Sport</option>
                                            <option value="4">Health</option>
                                            <option value="4">Science</option>
                                            <option value="4">Technology</option>
                                            <option value="4">Photo</option>
                                            <option value="4">Video</option>
                                            <option value="4">Others</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="sub-category-edit">SUB CATEGORY</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="sub-category-edit" class="form-control" placeholder="Sub category name" value="Music"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="label-edit">GROUP LABEL</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="label-edit" class="form-control" placeholder="Label group in menu" value="Extravaganza"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="description-sub-edit">DESCRIPTION</label>
                                </div>
                                <div class="col-sm-9">
                                <textarea name="description" class="form-control" id="description-sub-edit" cols="30" rows="5" placeholder="Short sub category description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, alias atque consequatur cupiditate explicabo impedit magnam maxime minus, molestias, neque nihil porro quaerat quam sequi tempora tempore vel veniam voluptas.
                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-danger">DISCARD</a>
                        <button type="submit" class="btn btn-primary">UPDATE SUB</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade no-line" id="delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i> DELETE CATEGORY</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbn">Are you sure delete this category?</label>
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

    <div class="modal fade no-line" id="delete-sub" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i> DELETE SUB CATEGORY</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbn">Are you sure delete this sub category?</label>
                        <p class="mbn"><small class="text-muted">This sub is part of Entertainment category</small></p>
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