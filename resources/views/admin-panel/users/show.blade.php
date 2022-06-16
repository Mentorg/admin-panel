@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="back-btn mt-3">
                    <a href="{{ route('.users.index') }}">&laquo; Go back</a>
                </div>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($users as $user)
                        <div class="col-xl-6 col-md-6">
                            <div class="card-body">
                                <h1 class="mt-4">{{ $user['name'] }}</h1>
                                @foreach($user_role as $role)
                                    <p class="card-text"><strong>Role:</strong> {{ ucfirst($role->name) }}</p>
                                @endforeach
                                <p class="card-text"><strong>Email:</strong> {{ $user['email'] }}</p>
                                <p class="card-text"><strong>Created at:</strong> {{ $user['created_at']->format('d-m-Y') }}</p>
                                <ul class="file-single-btn-list mt-3">
                                    <li>
                                        <a class="btn btn-primary" href="{{ route('.users.edit', $user['id']) }}">Edit</a>
                                        <form action="{{ route('.users.destroy', $user['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
