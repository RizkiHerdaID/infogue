@extends('public')

@section('title', '- Contact')

@section('content')

    <div class="map" style="background: url('{{ asset('images/misc/map.jpg') }}') no-repeat center / cover"></div>
    <div class="container">
        <div class="section">
            <div class="title">
                <h1>GET IN TOUCH</h1>
                <p class="lead">
                    Avenue Street 34 - East Java, Indonesia 61112  - Tel. <a href="tel:+628565547868">(+62) 8565547868</a>
                    <br/>
                    email: <a href="mailto:editor@infogue.com">editor@infogue.com</a>
                </p>
            </div>
            <div class="content">
                <form action="{{ route("feedback.store") }}" method="post">
                    {!! csrf_field() !!}

                    @if(Session::has('status'))
                        <div class="row">
                            <div class="col-md-8  col-md-push-2">
                                <div class="alert alert-success">
                                    {!! '<p>'.Session::get('status').'</p>' !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4 col-md-push-2 col-sm-6">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Your Name">
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-md-push-2 col-sm-6">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address">
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-push-2">
                            <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                                <textarea class="form-control" id="message" name="message" rows="7" placeholder="Type Your Message">{{ old('message') }}</textarea>
                                {!! $errors->first('message', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary center-block pll prl mtm">SEND</button>
                            </div>
                        </div>
                    </div>
                </form>

                <ul class="list-inline center-block text-center mtm lead contact-social">
                    <li class="pm pbn"><a href="http://www.facebook.com" target="_blank">Facebook</a></li>
                    <li class="pm pbn"><a href="http://www.twitter.com" target="_blank">Twitter</a></li>
                    <li class="pm pbn"><a href="http://plus.google.com" target="_blank">Google+</a></li>
                    <li class="pm pbn"><a href="http://www.instagram.com" target="_blank">Instagram</a></li>
                </ul>
            </div>
        </div>

        <div class="section">
            <div class="title">
                <h1>SUPPORTED BY</h1>
                <p class="lead">InfoGue.id was supported by awesome startup and company</p>
            </div>
            <ul class="company-list">
                <li><a href="http://www.google.com?q=mountain" target="_blank">
                        <img src="images/misc/mountain.png" alt="Sleeping Mountain"/></a>
                </li>
                <li><a href="http://www.google.com?q=redcode" target="_blank">
                        <img src="images/misc/redcode.png" alt="Redcode Deliver"/></a>
                </li>
                <li><a href="http://www.google.com?q=vana" target="_blank">
                        <img src="images/misc/vana.png" alt="Vana Internet Provider"/></a>
                </li>
                <li><a href="http://www.google.com?q=express" target="_blank">
                        <img src="images/misc/express.png" alt="Express"/></a>
                </li>
                <li><a href="http://www.google.com?q=magnive" target="_blank">
                        <img src="images/misc/magnive.png" alt="Magnive"/></a>
                </li>
                <li><a href="http://www.google.com?q=frezze" target="_blank">
                        <img src="images/misc/frezze.png" alt="Frezzer"/></a>
                </li>
                <li><a href="http://www.google.com?q=bluewave" target="_blank">
                        <img src="images/misc/bluewave.png" alt="Bluewave"/></a>
                </li>
                <li><a href="http://www.google.com?q=smiles" target="_blank">
                        <img src="images/misc/smiles.png" alt="Smiles"/></a>
                </li>
            </ul>
        </div>
    </div>

@endsection