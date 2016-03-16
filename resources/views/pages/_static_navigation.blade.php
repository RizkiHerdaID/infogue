<nav class="static-nav hidden-xs hidden-sm">
    <?php $segment = Request::segment(1); ?>
    <ul>
        <li @if($segment == 'editorial'){!! 'class="active"' !!}@endif><a href="{{ route('page.editorial') }}">Editorial</a></li>
        <li @if($segment == 'privacy'){!! 'class="active"' !!}@endif><a href="{{ route('page.privacy') }}">Privacy</a></li>
        <li @if($segment == 'disclaimer'){!! 'class="active"' !!}@endif><a href="{{ route('page.disclaimer') }}">Disclaimer</a></li>
        <li @if($segment == 'terms'){!! 'class="active"' !!}@endif><a href="{{ route('page.terms') }}">Terms</a></li>
        <li @if($segment == 'career'){!! 'class="active"' !!}@endif><a href="{{ route('page.career') }}">Career</a></li>
        <li @if($segment == 'faq'){!! 'class="active"' !!}@endif><a href="{{ route('page.faq') }}">FAQ</a></li>
        <li><a href="{{ route('page.contact') }}">Contact</a></li>
    </ul>
</nav>