@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="back-btn mt-3">
                    <a href="/">&laquo; Go back</a>
                </div>
                <h3 class="mt-3 pb-3">All Files</h3>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="col-xl-3">
                            <form class="search-bar" action="{{ route('.files.index') }}" method="GET">
                                <input type="text" name="search">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    @if (!$files->isEmpty())
                    <div class="col-xl-12 col-md-12">
                            <table class="table table-striped mt-5">
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
                                        @can('view', $file)
                                            <td><a href="{{ route('.files.show', $file['id']) }}">{{ $file['file_name'] }}</a></td>
                                        @endcan
                                        <td>{{ \Illuminate\Support\Str::limit($file['file_description'], 75) }}</td>
                                        <td>{{ $file['updated_at']->format('d-m-Y, G:i') }}</td>
                                        <td>{{ $file['created_at']->format('d-m-Y, G:i') }}</td>
                                        <td>{{ $file['user']['name'] }}</td>
                                        <td>
                                            <ul>
                                                <li>
                                                    @can('download', $file)
                                                        <a class="btn btn-success" href="{{ route('.fileDownload', $file['id']) }}">Download</a>
                                                    @endcan
                                                    @can('update', $file)
                                                        <a class="btn btn-primary" href="{{ route('.files.edit', $file['id']) }}">Edit</a>
                                                    @endcan
                                                    @can('delete', $file)
                                                        <form action="{{ route('.files.destroy', $file['id']) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want delete this file?')">Delete</button>
                                                        </form>
                                                    @endcan
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {!! $files->links() !!}
                        </div>
                    @else
                        <div class="col-xl-3 col-md-3">
                            <div class="card-body mt-3 p-0">
                                <a href="{{ route('.files.create') }}" class="btn btn-primary">Add New File</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
