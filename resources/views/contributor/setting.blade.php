@extends('public')

@section('title', '- Error404')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data">
                                <h3 class="title">ACCOUNT SETTING</h3>
                                <div class="content">
                                    <form class="form-horizontal form-strip">
                                        <fieldset>
                                            <legend>INFORMATION</legend>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-3 control-label">Full Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="name" placeholder="Your name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="male" class="col-sm-3 control-label">Gender</label>
                                                <div class="col-sm-9">
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="format" id="male" class="css-radio" checked>
                                                        <label for="male" class="css-label">Male</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="format" id="female" class="css-radio">
                                                        <label for="female" class="css-label">Female</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="format" id="undefined" class="css-radio">
                                                        <label for="undefined" class="css-label">Undefined</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="date" class="col-sm-3 control-label">Date of Birth</label>
                                                <div class="col-sm-9">
                                                    <label for="date" class="css-select select-inline">
                                                        <select name="date" id="date" class="form-control" required>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                            <option value="21">21</option>
                                                            <option value="22">22</option>
                                                            <option value="23">23</option>
                                                            <option value="24">24</option>
                                                            <option value="25">25</option>
                                                            <option value="26">26</option>
                                                            <option value="27">27</option>
                                                            <option value="28">28</option>
                                                            <option value="29">29</option>
                                                            <option value="30">30</option>
                                                            <option value="31">31</option>
                                                        </select>
                                                    </label>
                                                    <label for="month" class="css-select select-inline">
                                                        <select name="month" id="month" class="form-control" required>
                                                            <option value="1">January</option>
                                                            <option value="2">February</option>
                                                            <option value="3">March</option>
                                                            <option value="4">April</option>
                                                            <option value="5">May</option>
                                                            <option value="6">June</option>
                                                            <option value="7">July</option>
                                                            <option value="8">August</option>
                                                            <option value="9">September</option>
                                                            <option value="10">October</option>
                                                            <option value="11">November</option>
                                                            <option value="12">December</option>
                                                        </select>
                                                    </label>
                                                    <label for="year" class="css-select select-inline">
                                                        <select name="year" id="year" class="form-control" required>
                                                            <option value="1991">1991</option>
                                                            <option value="1992">1992</option>
                                                            <option value="1993">1993</option>
                                                            <option value="1994">1994</option>
                                                            <option value="1995">1995</option>
                                                            <option value="1996">1996</option>
                                                            <option value="1997">1997</option>
                                                            <option value="1998">1998</option>
                                                            <option value="1999">1999</option>
                                                            <option value="2000">2000</option>
                                                        </select>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="location" class="col-sm-3 control-label">Location</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="location" placeholder="Current location">
                                                    <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Eg. Jakarta, Indonesia</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="contact" class="col-sm-3 control-label">Contact</label>
                                                <div class="col-sm-9">
                                                    <input type="tel" class="form-control" id="contact" placeholder="Your contact">
                                                    <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Your mobile number or fax office</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="about" class="col-sm-3 control-label">About</label>
                                                <div class="col-sm-9">
                                                <textarea class="form-control" name="excerpt" id="about" cols="30"
                                                          rows="2" placeholder="Tell about you"></textarea>
                                                    <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>About will appear on your main profile</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>ACCOUNT</legend>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Username</label>
                                                <div class="col-sm-9">
                                                    <p class="form-control-static">imelda.agustine</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                    <p class="form-control-static">imelda@gmail.com</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Member Since</label>
                                                <div class="col-sm-9">
                                                    <p class="form-control-static">January, 2016</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cover" class="col-sm-3 control-label">Cover Image</label>
                                                <div class="col-sm-9">
                                                    <div class="css-file">
                                                        <span class="file-info">No file selected</span>
                                                        <button class="btn btn-primary" type="button">SELECT COVER</button>
                                                        <input type="file" class="file-input" id="cover" accept="image/*"/>
                                                    </div>
                                                    <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Cover image for your profile</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="avatar" class="col-sm-3 control-label">Avatar</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4">
                                                            <div class="contributor-profile">
                                                                <img src="images/contributors/cici.png" class="img-circle img-responsive avatar"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-sm-8">
                                                            <p class="mtm">Select and Crop Your Avatar</p>
                                                            <p class="small text-muted mbs">Format like .png .jpg .gif</p>
                                                            <div class="css-file">
                                                                <span class="file-info">No file selected</span>
                                                                <button class="btn btn-primary" type="button">SELECT AVATAR</button>
                                                                <input type="file" class="file-input" id="avatar" accept="image/*"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>SOCIAL NETWORK</legend>
                                            <div class="form-group">
                                                <label for="instagram" class="col-sm-3 control-label">Instagram</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="instagram" placeholder="Eg. anggadarkprince">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="facebook" class="col-sm-3 control-label">Facebook</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="facebook" placeholder="Eg. angga.ari">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="twitter" class="col-sm-3 control-label">Twitter</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="twitter" placeholder="Eg. @anggadarkprince">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="googleplus" class="col-sm-3 control-label">Google+</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="googleplus" placeholder="Eg. +AnggaAriWijaya">
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>SUBSCRIPTION</legend>
                                            <div class="form-group">
                                                <label for="password" class="col-sm-3 control-label">Notification</label>
                                                <div class="col-sm-9">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="subscription" id="subscription" class="css-checkbox">
                                                        <label for="subscription" class="css-label">Subscribe new articles</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="message" id="message" class="css-checkbox">
                                                        <label for="message" class="css-label">Email me when I got a message</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="follow" id="follow" class="css-checkbox">
                                                        <label for="follow" class="css-label">Email me when people follow me</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="stream" id="stream" class="css-checkbox">
                                                        <label for="stream" class="css-label">Email me when people who I follow post new article</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="col-sm-3 control-label">Mobile</label>
                                                <div class="col-sm-9">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="push-notification" id="push-notification" class="css-checkbox">
                                                        <label for="push-notification" class="css-label">Enable Push Notification</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>CHANGE PASSWORD</legend>
                                            <div class="form-group">
                                                <label for="password" class="col-sm-3 control-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="password" placeholder="Current password">
                                                    <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Password is required for save</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="new-password" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="new-password" placeholder="Create new password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="confirm-password" class="col-sm-3 control-label">Confirm</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="confirm-password" placeholder="Retype new password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9 pts pbm">
                                                    <button class="btn btn-primary">SAVE CHANGES</button>
                                                    <a href="contributor_stream.html" class="btn btn-danger">DISCARD</a>
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
@endsection