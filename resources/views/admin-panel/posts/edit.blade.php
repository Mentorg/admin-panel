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
                <h3 class="mt-4">Edit Post</h3>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <form action="{{ route('.posts.update', $post['id']) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label" >Post Title</label>
                                <input type="text" class="form-control form-control-lg" id="exampleFormControlInput1" name="post_title" value="{{ old('post_title', $post->post_title) }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Post Content</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="20" name="post_content"></textarea>
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
