@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-4">Edit: {{ $file['file_name'] }}</h3>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <form action="{{ route('.files.update', $file['id']) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="formDescription" class="form-label">Edit File Description</label>
                                <textarea class="form-control" type="text" id="file_description" name="file_description" rows="10"></textarea>
                            </div>
                            <div class="mb-3">
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
