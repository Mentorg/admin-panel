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
                        <h3 class="mt-4">Add New User</h3>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <form action="{{ route('.users.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" placeholder="Full Name" name="name">
                                            <label for="floatingInput">Full Name</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
                                            <label for="floatingInput">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                                            <label for="floatingPassword">Password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <div class="form-group">
                                                <select class="form-select form-select-lg mb-3" name="roles">
                                                    <option value="0">Chose role</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            @include('admin-panel.partials.footer')
        </div>
    </div>
