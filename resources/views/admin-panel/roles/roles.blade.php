@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="back-btn mt-3">
                    <a href="/">&laquo; Go back</a>
                </div>
                <h3 class="mt-3 pb-3">All Roles</h3>
                <div class="row">
                    <table class="table table-bordered mt-3 pb-3">
                        <tr>
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ $role['name'] }}</td>
                                <td>
                                    @can('view', $role)
                                        <a class="btn btn-info" href="{{ route('.roles.show', $role['id']) }}">Show</a>
                                    @endcan
                                    @can('update', $role)
                                        <a class="btn btn-primary ms-3" href="{{ route('.roles.edit', $role['id']) }}">Edit</a>
                                    @endcan
                                    @can('delete', $role)
                                        <form action="{{ route('.roles.destroy', $role['id']) }}" style="display:inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this role?')"
                                                    class="btn btn-danger ms-3">Delete</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
