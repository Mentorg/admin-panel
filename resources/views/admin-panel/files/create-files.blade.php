@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-4">Add New File(s)</h3>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <form action="{{ route('.files.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Add your file</label>
                                <input class="form-control" type="file" id="formFile" name="file">
                            </div>
                            <div class="mb-3">
                                <label for="formDescription" class="form-label">File Description</label>
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
