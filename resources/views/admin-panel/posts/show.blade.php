@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="back-btn mt-3">
                    <a href="{{ route('.posts.index') }}">&laquo; Go back</a>
                </div>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach($posts as $post)
                        <div class="col-xl-6 col-md-6">
                            <div class="card-body">
                                <h1 class="card-title">{{ $post['post_title'] }}</h1>
                                <p><strong>{{ $post_author }}</strong></p>
                                <p class="card-text" style="font-style: italic">{{ $post['updated_at']->format('d-m-Y') }}</p>
                                <p class="card-text">{{ $post['post_content'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
