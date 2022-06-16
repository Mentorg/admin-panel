@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="back-btn mt-3">
                    <a href="/">&laquo; Go back</a>
                </div>
                <h3 class="mt-3 pb-3">All Users</h3>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="col-xl-2">
                            <form class="search-bar" action="{{ route('.users.index') }}" method="GET">
                                <input type="text" name="search" required/>
                                <button class="btn btn-primary" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    @if(count($users) > 0)
                        <div class="col-xl-12 col-md-12">
                            <table class="table table-striped mt-5">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Account Created</th>
                                    <th scope="col">Account Updated</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Modify</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user['id'] }}</th>
                                    <td><a href="{{ route('.users.show', $user['id']) }}">{{ $user['name'] }}</a></td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['created_at']->format('d-m-Y, G:i') }}</td>
                                    <td>{{ $user['updated_at']->format('d-m-Y, G:i') }}</td>
                                    <td>{{ $user->roles->pluck('name')->first() }}</td>
                                    <td>
                                        <ul>
                                            <li>
                                                <a class="btn btn-primary" href="{{ route('.users.edit', $user['id']) }}">Edit</a>
                                                <form action="{{ route('.users.destroy', $user['id']) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this user?')"
                                                            class="btn btn-danger">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {!! $users->links() !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
