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
                <li><a href="index.html">INFOGUE.ID</a></li>
                <li class="hidden-sm hidden-xs"><a href="admin_dashboard.html">Dashboard</a></li>
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
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-1" class="css-checkbox">
                                <label for="check-1" class="css-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/zizi.jpg"/>
                                <a href="profile.html" target="_blank">Nur Azizi</a>
                            </div>
                        </td>
                        <td><a href="mailto:zizi@gmail.com">zizi@gmail.com</a></td>
                        <td>21</td>
                        <td class="text-center"><div class="rating-wrapper pn" data-rating="2"></div></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="profile.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="admin_contributor_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-2" class="css-checkbox">
                                <label for="check-2" class="css-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/angga.jpg"/>
                                <a href="profile.html" target="_blank">Angga Ari</a>
                            </div>
                        </td>
                        <td><a href="mailto:angga@gmail.com">angga@gmail.com</a></td>
                        <td>345</td>
                        <td class="text-center"><div class="rating-wrapper pn" data-rating="4"></div></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="profile.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="admin_contributor_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-3" class="css-checkbox">
                                <label for="check-3" class="css-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/vivi.jpg"/>
                                <a href="profile.html" target="_blank">Vivi Rachmawati</a>
                            </div>
                        </td>
                        <td><a href="mailto:vivi23@gmail.com">vivi23@gmail.com</a></td>
                        <td>24</td>
                        <td class="text-center"><div class="rating-wrapper pn" data-rating="3"></div></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="profile.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="admin_contributor_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-4" class="css-checkbox">
                                <label for="check-4" class="css-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/lukman.jpg"/>
                                <a href="profile.html" target="_blank">Lukman Hidayatullah</a>
                            </div>
                        </td>
                        <td><a href="mailto:lukman@gmail.com">lukman@gmail.com</a></td>
                        <td>4</td>
                        <td class="text-center"><div class="rating-wrapper pn" data-rating="1"></div></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="profile.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="admin_contributor_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-5" class="css-checkbox">
                                <label for="check-5" class="css-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/pras.jpg"/>
                                <a href="profile.html" target="_blank">Risha Prasetya</a>
                            </div>
                        </td>
                        <td><a href="mailto:risha@yahoo.com">risha@yahoo.com</a></td>
                        <td>74</td>
                        <td class="text-center"><div class="rating-wrapper pn" data-rating="4"></div></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="profile.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="admin_contributor_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-6" class="css-checkbox">
                                <label for="check-6" class="css-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/lisna.jpg"/>
                                <a href="profile.html" target="_blank">Lisna Agustina</a>
                            </div>
                        </td>
                        <td><a href="mailto:lisna@hotmail.com">lisna@hotmail.com</a></td>
                        <td>64</td>
                        <td class="text-center"><div class="rating-wrapper pn" data-rating="3"></div></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="profile.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="admin_contributor_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-7" class="css-checkbox">
                                <label for="check-7" class="css-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/desi.jpg"/>
                                <a href="profile.html" target="_blank">Desi Wulandari</a>
                            </div>
                        </td>
                        <td><a href="mailto:desi@yahoo.com">desi@yahoo.com</a></td>
                        <td>81</td>
                        <td class="text-center"><div class="rating-wrapper pn" data-rating="2"></div></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="profile.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="admin_contributor_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-8" class="css-checkbox">
                                <label for="check-8" class="css-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/eta.jpg"/>
                                <a href="profile.html" target="_blank">Margareta Ester</a>
                            </div>
                        </td>
                        <td><a href="mailto:angga@gmail.com">margareta@gmail.com</a></td>
                        <td>763</td>
                        <td class="text-center"><div class="rating-wrapper pn" data-rating="3"></div></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="profile.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="admin_contributor_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-9" class="css-checkbox">
                                <label for="check-9" class="css-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/cindy.jpg"/>
                                <a href="profile.html" target="_blank">Cindy Cici</a>
                            </div>
                        </td>
                        <td><a href="mailto:cindy.cute@gmail.com">cindy.cute@gmail.com</a></td>
                        <td>12</td>
                        <td class="text-center"><div class="rating-wrapper pn" data-rating="1"></div></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="profile.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="admin_contributor_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-10" class="css-checkbox">
                                <label for="check-10" class="css-label"></label>
                            </div>
                        </td>
                        <td>
                            <div class="people">
                                <img src="images/contributors/bita.jpg"/>
                                <a href="profile.html" target="_blank">Bita Diflia</a>
                            </div>
                        </td>
                        <td><a href="mailto:bita23@gmail.com">bita23@gmail.com</a></td>
                        <td>746</td>
                        <td class="text-center"><div class="rating-wrapper pn" data-rating="1"></div></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="profile.html" target="_blank"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="admin_contributor_edit.html"><i class="fa fa-pencil"></i> Edit</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="table-footer">
                    <div class="status">
                        <p class="text-muted">3/120 Rows selected</p>
                        <p>Showing 1 to 10 of 40 entries</p>
                    </div>
                    <div class="pagination-wrapper">
                        <ul class="pagination">
                            <li>
                                <a href="#" aria-label="First">FIRST</a>
                            </li>
                            <li>
                                <a href="#" aria-label="Previous">PREV</a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                                <a href="#" aria-label="Next">NEXT</a>
                            </li>
                            <li>
                                <a href="#" aria-label="Last">LAST</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<div class="modal fade no-line" id="delete" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i> DELETE CONTRIBUTOR</h4>
                </div>
                <div class="modal-body">
                    <label class="mbn">Are you sure delete this article?</label>
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