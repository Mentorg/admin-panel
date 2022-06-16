@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="back-btn mt-3">
                    <a href="{{ route('.files.index') }}">&laquo; Go back</a>
                </div>
                <h3 class="mt-3 pb-3">All Posts</h3>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($files->isNotEmpty())
                        <div class="col-xl-12 col-md-12">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Last Modified</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Added By</th>
                                    <th scope="col">Modify</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $file)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td><a href="{{ route('.files.show', $file['id']) }}">{{ $file['file_name'] }}</a></td>
                                        <td>{{ \Illuminate\Support\Str::limit($file['file_description'], 75) }}</td>
                                        <td>{{ date('d-m-Y, G:i', strtotime($file['updated_at'])) }}</td>
                                        <td>{{ date('d-m-Y, G:i', strtotime($file['created_at'])) }}</td>
                                        <td>{{ $file['user']['name'] }}</td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a class="btn btn-success" href="{{ route('.fileDownload', $file['id']) }}">Download</a>
                                                    <a class="btn btn-primary" href="{{ route('.files.edit', $file['id']) }}">Edit</a>
                                                    <form action="{{ route('.files.destroy', $file['id']) }}" method="POST">
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
                            <h2>No files found</h2>
                        </div>
                    @endif
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
