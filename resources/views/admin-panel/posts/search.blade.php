@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="back-btn mt-3">
                    <a href="{{ route('.posts.index') }}">&laquo; Go back</a>
                </div>
                <h3 class="mt-3 pb-3">All Posts</h3>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($posts->isNotEmpty())
                        @foreach ($posts as $post)
                            <div class="col-xl-3 col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="{{ route('.posts.show', $post['id']) }}">{{ $post['post_title'] }}</a></h5>
                                        <p style="color: #5c636a;font-size: 0.8em; font-weight: 600">{{ $post['user']['name'] }}</p>
                                        <p class="card-text">{{ \Illuminate\Support\Str::limit($post['post_content'], 100) }}</p>
                                        <ul class="list-group list-group-horizontal">
                                            <a href="{{ route('.posts.edit', $post['id']) }}" class="btn btn-secondary">Edit</a>
                                            <form action="{{ route('.posts.destroy', $post['id']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div>
                            <h2>No posts found</h2>
                        </div>
                    @endif
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
