<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="d-flex justify-content-between w-100">
        <div>
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <div>
            <!-- Page Title -->
            <h1 class="mt-2 h4 text-gray-800">{{ $title ?? 'Welcome' }}</h1>
        </div>
        <!-- User Information and Logout Section -->
        <div>
            <ul class="navbar-nav ml-auto">
                <!-- Other existing topbar content -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <!-- Dropdown items -->
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End of Topbar -->
