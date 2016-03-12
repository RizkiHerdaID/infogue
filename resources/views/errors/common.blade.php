@if (count($errors) > 0)
<div class="alert alert-danger" style="text-align: left; border-radius: 0">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong class="mbs" style="display: block">Whoops! Something went wrong!</strong>

    <ul style="margin-bottom: 0; margin-left: 20px; list-style: inherit">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif