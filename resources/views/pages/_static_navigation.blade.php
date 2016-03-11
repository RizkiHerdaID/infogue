<nav class="static-nav hidden-xs hidden-sm">
    <ul>
        <li @if(Request::segment(1) == 'editorial'){!! 'class="active"' !!}@endif><a href="{{ route('page.editorial') }}">Editorial</a></li>
        <li @if(Request::segment(1) == 'privacy'){!! 'class="active"' !!}@endif><a href="{{ route('page.privacy') }}">Privacy</a></li>
        <li @if(Request::segment(1) == 'disclaimer'){!! 'class="active"' !!}@endif><a href="{{ route('page.disclaimer') }}">Disclaimer</a></li>
        <li @if(Request::segment(1) == 'terms'){!! 'class="active"' !!}@endif><a href="{{ route('page.terms') }}">Terms</a></li>
        <li @if(Request::segment(1) == 'career'){!! 'class="active"' !!}@endif><a href="{{ route('page.career') }}">Career</a></li>
        <li @if(Request::segment(1) == 'faq'){!! 'class="active"' !!}@endif><a href="{{ route('page.faq') }}">FAQ</a></li>
        <li><a href="{{ route('page.contact') }}">Contact</a></li>
    </ul>
</nav>