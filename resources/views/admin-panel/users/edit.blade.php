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
                <h3 class="mt-4">Edit: {{ $user['name'] }}</h3>
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <form action="{{ route('.users.update', [$user['id']]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <input type="hidden" name="id">
                                <label for="exampleFormControlInput1" class="form-label" >Full Name</label>
                                <input type="text" class="form-control form-control" id="exampleFormControlInput1" name="name" value="{{ old('name', $user['name']) }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label" >Email</label>
                                <input type="email" class="form-control form-control" id="exampleFormControlInput1" name="email" value="{{ old('email', $user['email']) }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label" >Password</label>
                                <input type="password" class="form-control form-control" id="exampleFormControlInput1" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Role</label>
                                <select class="form-select form-select-lg mb-3" name="roles">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
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
