@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="back-btn mt-3">
                    <a href="{{ route('.users.index') }}">&laquo; Go back</a>
                </div>
                <h3 class="mt-3 pb-3">All Posts</h3>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(count($users) > 0)
                        <div class="col-xl-12 col-md-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Account Created</th>
                                    <th scope="col">Account Updated</th>
                                    <th scope="col">Modify</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user['id'] }}</th>
                                        <td><a href="{{ route('.users.show', $user['id']) }}">{{ $user['name'] }}</a></td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>{{ date('d-m-Y, G:i', strtotime($user['created_at'])) }}</td>
                                        <td>{{ date('d-m-Y, G:i', strtotime($user['updated_at'])) }}</td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a class="btn btn-primary" href="{{ route('.users.edit', $user['id']) }}">Edit</a>
                                                    <form action="{{ route('.users.destroy', $user['id']) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger">Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                    <div>
                        <h2>No users found</h2>
                    </div>
                    @endif
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
