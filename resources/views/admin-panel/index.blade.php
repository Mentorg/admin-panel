@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h2 class="mt-4 pb-4">Dashboard</h2>
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card bg-muted text-black mb-4">
                            <div class="card-body">View Recent Posts</div>
                            <div class="card-footer d-flex align-items-center justify-content-start">
                                @can('postCreate')
                                    <a class="btn btn-primary" href="{{ route('.posts.create') }}">Add a Post</a>
                                @endcan
                                @can('postList')
                                    <a class="btn btn-success ms-3" href="{{ route('.posts.index') }}">Manage Posts</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="card bg-muted text-black mb-4">
                            <div class="card-body">View Recent File Changes</div>
                            <div class="card-footer d-flex align-items-center justify-content-start">
                                @can('fileCreate')
                                    <a class="btn btn-primary" href="{{ route('.files.create') }}">Add a File</a>
                                @endcan
                                @can('fileList')
                                    <a class="btn btn-success ms-3" href="{{ route('.files.index') }}">Manage Files</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="card bg-muted text-black mb-4">
                            <div class="card-body">Changes in User / Role management</div>
                            <div class="card-footer d-flex align-items-center justify-content-start">
                                @can('userCreate')
                                    <a class="btn btn-primary" href="{{ route('.users.create') }}">Add a User</a>
                                @endcan
                                @can('userList')
                                    <a class="btn btn-success ms-3" href="{{ route('.users.index') }}">Manage Users</a>
                                @endcan
                                @can('roleCreate')
                                    <a class="btn btn-primary ms-3" href="{{ route('.roles.create') }}">Add a Role</a>
                                @endcan
                                @can('roleList')
                                    <a class="btn btn-success ms-3" href="{{ route('.roles.index') }}">Manage Roles</a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
@include('admin-panel.partials.footer')
