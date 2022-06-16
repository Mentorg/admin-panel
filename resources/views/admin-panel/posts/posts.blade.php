@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="back-btn mt-3">
                    <a href="/">&laquo; Go back</a>
                </div>
                <h3 class="mt-3 pb-3">All Posts</h3>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-xl-12">
                        <div class="col-xl-3">
                            <form class="search-bar" action="{{ route('.posts.index') }}" method="GET">
                                <input type="text" name="search">
                                <button class="btn btn-secondary" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    @if (!$posts->isEmpty())
                        @foreach($posts as $post)
                            <div class="col-xl-3 col-md-3">
                                <div class="card mt-5">
                                    <div class="card-body">
                                        @can('view', $post)
                                            <h5 class="card-title"><a href="{{ route('.posts.show', $post['id']) }}">{{ $post['post_title'] }}</a></h5>
                                        @endcan
                                        <p style="color: #5c636a;font-size: 0.8em; font-weight: 600">{{ $post['user']['name'] }}</p>
                                        <p class="card-text">{{ \Illuminate\Support\Str::limit($post['post_content'], 100) }}</p>
                                        <ul class="list-group list-group-horizontal">
                                            @can('update', $post)
                                                <a href="{{ route('.posts.edit', $post['id']) }}" class="btn btn-secondary">Edit</a>
                                            @endcan
                                            @can('delete', $post)
                                                <form action="{{ route('.posts.destroy', $post['id']) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger ms-3"
                                                            onclick="return confirm('Are you sure you want to delete this post?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-center" style="margin-top: 5em">
                            {!! $posts->links() !!}
                        </div>
                    @else
                        <div class="col-xl-3 col-md-3">
                            <div class="card-body mt-3 p-0">
                                <a href="{{ route('.posts.create') }}" class="btn btn-primary">Add New Post</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
