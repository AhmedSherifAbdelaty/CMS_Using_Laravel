@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{  $error === 'role_id' ? ' role' : $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
