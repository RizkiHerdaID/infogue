@extends('private')

@section('title', '- Categories')

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
                <li class="active">Feedback</li>
            </ol>
            <div class="control">
                <a href="#search" data-toggle="modal" class="link"><i class="fa fa-search"></i> SEARCH</a>
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
                        <div class="dropdown select">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                ALL DATA
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">FEEDBACK TYPE</li>
                                <li><a href="#"><i class="fa fa-navicon"></i> All Data</a></li>
                                <li><a href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
                            </ul>
                        </div>
                        <div class="dropdown select">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                TIMESTAMP
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">SORT BY</li>
                                <li><a href="#"><i class="fa fa-clock-o"></i> Timestamp</a></li>
                                <li><a href="#"><i class="fa fa-font"></i> Name</a></li>
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
                        <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> DELETE</a>
                    </div>
                </div>
            </div>
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
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-1" class="css-checkbox">
                                <label for="check-1" class="css-label"></label>
                            </div>
                        </td>
                        <td>Lika Ayunda</td>
                        <td>lika.ayu@gmail.com</td>
                        <td><a href="#detail" data-toggle="modal">DETAIL</a></td>
                        <td>27 Feb 2016</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="#reply" data-toggle="modal"><i class="fa fa-pencil"></i> Reply</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                    <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-2" class="css-checkbox">
                                <label for="check-2" class="css-label"></label>
                            </div>
                        </td>
                        <td>Dewi Purnasari</td>
                        <td>dewi33@yahoo.com</td>
                        <td><a href="#detail" data-toggle="modal">DETAIL</a></td>
                        <td>27 Feb 2016</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="#reply" data-toggle="modal"><i class="fa fa-pencil"></i> Reply</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                    <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-3" class="css-checkbox">
                                <label for="check-3" class="css-label"></label>
                            </div>
                        </td>
                        <td>Diaz Azura</td>
                        <td>diaz.azu@outlook.com</td>
                        <td><a href="#detail" data-toggle="modal">DETAIL</a></td>
                        <td>26 Feb 2016</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="#reply" data-toggle="modal"><i class="fa fa-pencil"></i> Reply</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                    <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-4" class="css-checkbox">
                                <label for="check-4" class="css-label"></label>
                            </div>
                        </td>
                        <td>Selly Riana</td>
                        <td>selly34@yahoo.com</td>
                        <td><a href="#detail" data-toggle="modal">DETAIL</a></td>
                        <td>24 Feb 2016</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="#reply" data-toggle="modal"><i class="fa fa-pencil"></i> Reply</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                    <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-5" class="css-checkbox">
                                <label for="check-5" class="css-label"></label>
                            </div>
                        </td>
                        <td>Jerom Archa</td>
                        <td>jerom.ultimate@gmail.com</td>
                        <td><a href="#detail" data-toggle="modal">DETAIL</a></td>
                        <td>16 Jan 2016</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="#reply" data-toggle="modal"><i class="fa fa-pencil"></i> Reply</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                    <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr class="warning">
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-6" class="css-checkbox">
                                <label for="check-6" class="css-label"></label>
                            </div>
                        </td>
                        <td>Skay Illium</td>
                        <td>sky4537@yahoo.com</td>
                        <td><a href="#detail" data-toggle="modal">DETAIL</a></td>
                        <td>14 Jan 2016</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="#reply" data-toggle="modal"><i class="fa fa-pencil"></i> Reply</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                    <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr class="danger">
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-7" class="css-checkbox">
                                <label for="check-7" class="css-label"></label>
                            </div>
                        </td>
                        <td>Friska Persvita</td>
                        <td>friska235@gmail.com</td>
                        <td><a href="#detail" data-toggle="modal">DETAIL</a></td>
                        <td>12 Feb 2016</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="#reply" data-toggle="modal"><i class="fa fa-pencil"></i> Reply</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                    <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-8" class="css-checkbox">
                                <label for="check-8" class="css-label"></label>
                            </div>
                        </td>
                        <td>Levi Ardiana Diana</td>
                        <td>levi19940814@gmail.com</td>
                        <td><a href="#detail" data-toggle="modal">DETAIL</a></td>
                        <td>9 Feb 2016</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="#reply" data-toggle="modal"><i class="fa fa-pencil"></i> Reply</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                    <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr class="danger">
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-9" class="css-checkbox">
                                <label for="check-9" class="css-label"></label>
                            </div>
                        </td>
                        <td>Angga Ari Wijaya</td>
                        <td>anggadarkprince@gmail.com</td>
                        <td><a href="#detail" data-toggle="modal">DETAIL</a></td>
                        <td>8 Feb 2016</td>
                        <td class="text-center">
                            <div class="dropdown dropup">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="#reply" data-toggle="modal"><i class="fa fa-pencil"></i> Reply</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                    <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-10" class="css-checkbox">
                                <label for="check-10" class="css-label"></label>
                            </div>
                        </td>
                        <td>Fillia Egasari</td>
                        <td>fillia45@yahoo.com</td>
                        <td><a href="#detail" data-toggle="modal">DETAIL</a></td>
                        <td>5 Feb 2016</td>
                        <td class="text-center">
                            <div class="dropdown dropup">
                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    ACTION
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                    <li class="dropdown-header">CONTROL</li>
                                    <li><a href="#detail" data-toggle="modal"><i class="fa fa-eye"></i> View</a></li>
                                    <li><a href="#reply" data-toggle="modal"><i class="fa fa-pencil"></i> Reply</a></li>
                                    <li><a href="#delete" data-toggle="modal"><i class="fa fa-trash"></i> Delete</a></li>
                                    <li class="dropdown-header">QUICK ACTION</li>
                                    <li><a href="#"><i class="fa fa-bookmark"></i> Important</a></li>
                                    <li><a href="#"><i class="fa fa-archive"></i> Archive</a></li>
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

<div class="modal fade color" id="detail" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-comments-o"></i> FEEDBACK DETAIL</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group mbn">
                        <label>SENDER : </label> Angga Ari Wijaya &lt;anggadarkprince@gmail.com&gt;
                    </div>
                    <div class="form-group mbn">
                        <label>TIMESTAMP : </label> 26 January 2016 At 08:30 AM
                    </div>
                    <div class="form-group mbn">
                        <label>MESSAGE : </label>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aspernatur blanditiis
                            doloribus esse iste quasi quisquam veniam vitae? A animi eum temporibus? Eaque est eum expedita
                            repudiandae, sed sunt vitae!
                        </p>
                    </div>
                    <input type="hidden" class="form-control" value="0"/>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-primary">CLOSE</a>
                    <a href="#reply" data-toggle="modal" data-dismiss="modal" class="btn btn-primary">REPLY</a>
                    <a href="#" data-dismiss="modal" class="btn btn-danger">MARK AS IMPORTANT</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade color" id="reply" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" class="form-strip form-horizontal">
                <input type="hidden" class="form-control" value="0"/>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-comments-o"></i> FEEDBACK REPLY</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>REPLY TO : </label> Angga Ari Wijaya
                    </div>
                    <div class="form-group">
                        <label>EMAIL : </label> <a href="mailto:anggadarkprince@gmail.com">anggadarkprince@gmail.com</a>
                    </div>
                    <div class="form-group">
                        <label for="reply-message">MESSAGE : </label>
                        <textarea name="message" class="form-control" id="reply-message" cols="30" rows="5" placeholder="Type message here"></textarea>
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

<div class="modal fade no-line" id="delete" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i> DELETE FEEDBACK</h4>
                </div>
                <div class="modal-body">
                    <label class="mbn">Are you sure delete this feedback?</label>
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