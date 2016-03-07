@if (count($errors) > 0)
<div class="alert alert-danger" style="text-align: left;">
    <strong>Whoops! Something went wrong!</strong>

    <br>

    <ul style="margin-bottom: 0; -webkit-padding-start: 20px;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif