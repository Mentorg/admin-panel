@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="back-btn mt-3">
                    <a href="{{ route('.files.index') }}">&laquo; Go back</a>
                </div>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($files as $file)
                        <div class="col-xl-6 col-md-6">
                            <div class="card-body">
                                <h1 class="mt-4">{{ $file['file_name'] }}</h1>
                                <p class="card-text"><strong>Author:</strong> {{ $file_author }}</p>
                                <p class="card-text">{{ $file['file_description'] }}</p>
                                <p class="card-text"><strong>Created at:</strong> {{ $file['created_at']->format('d-m-Y') }}</p>
                                <ul class="file-single-btn-list mt-4">
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
