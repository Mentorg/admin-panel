@include('admin-panel.partials.head')
<div id="layoutSidenav">
    @include('admin-panel.partials.sidenav')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="back-btn mt-3">
                    <a href="{{ route('.roles.index') }}">&laquo; Go back</a>
                </div>
                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group mt-4 ms-4">
                            <h2>Name: {{ $roles['roles']['name'] }}</h2>
                            <table style="margin-top: 2em">
                                <thead style="border: 1px solid #5f5f5f">
                                    <tr>
                                        <th style="padding: 0.5em">Permissions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($roles['permissions']))
                                        @foreach($roles['permissions'] as $permission)
                                            <tr style="border: 1px solid #5f5f5f">
                                                <td style="color: #5c636a; padding: 0.5em; text-transform: capitalize">{{ $permission->name }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        @include('admin-panel.partials.footer')
    </div>
</div>
