@if (count($errors) > 0)
<div class="alert alert-danger" style="text-align: left;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Whoops! Something went wrong!</strong>

    <br>

    <ul style="margin-bottom: 0; -webkit-padding-start: 20px; margin-left: 20px">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif