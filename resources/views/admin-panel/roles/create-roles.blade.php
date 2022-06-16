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
        <main style="padding: 2em">
            <h3 class="mt-3 pb-3">Create Role</h3>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <form action="{{ route('.roles.store') }}" method="POST">
                        @csrf
                        <div class="form-group mt-2 ms-2">
                            <input type="text" placeholder="Role" class="form-control" name="name">
                        </div>
                        <div class="form-group mt-2 ms-2">
                            @foreach($permission as $value)
                                <input type="checkbox" name="permission[]" value="{{$value->id}}"> {{ ucfirst(trans($value->name)) }}<br>
                            @endforeach
                        </div>
                        <div class="form-group mt-2 ms-2">
                            <input type="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
