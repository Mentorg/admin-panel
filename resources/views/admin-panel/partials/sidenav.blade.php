<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="{{ route('admin-dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#!" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Posts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @can('postList')
                            <a class="nav-link" href="{{ route('.posts.index') }}">All Posts</a>
                        @endcan
                        @can('postCreate')
                            <a class="nav-link" href="{{ route('.posts.create') }}">Add Post</a>
                        @endcan
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#!" data-bs-toggle="collapse" data-bs-target="#collapseFiles" aria-expanded="false" aria-controls="collapseFiles">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Files
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseFiles" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @can('fileList')
                            <a class="nav-link" href="{{ route('.files.index') }}">All Files</a>
                        @endcan
                        @can('fileCreate')
                            <a class="nav-link" href="{{ route('.files.create') }}">Add File</a>
                        @endcan
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Users/Roles
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @can('userList')
                            <a class="nav-link" href="{{ route('.users.index') }}">All Users</a>
                        @endcan
                        @can('userCreate')
                            <a class="nav-link" href="{{ route('.users.create') }}">Add User(s)</a>
                        @endcan
                        <hr>
                        @can('roleList')
                            <a class="nav-link" href="{{ route('.roles.index') }}">All Role(s)</a>
                        @endcan
                        @can('roleCreate')
                            <a class="nav-link" href="{{ route('.roles.create') }}">Add Role(s)</a>
                        @endcan
                    </nav>
                </div>
            </div>
        </div>
    </nav>
</div>
