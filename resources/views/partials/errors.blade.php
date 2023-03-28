@if ($errors->any())
    <div class="alert alert-danger position-absolute top left w-100">
        <ul class="list-group">
            @foreach ($errors->all() as $error)
                <li class="list-group-item">
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
