@if (session('success'))
    <div class="alert alert-success position-absolute top left w-100" role="alert">
        {{ session('success') }}
    </div>
@endif
