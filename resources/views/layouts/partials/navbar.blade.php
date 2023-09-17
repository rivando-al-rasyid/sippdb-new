<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">

        <!-- Breadcrumbs -->

        <!-- Collapsible Navbar Content -->
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">

            <!-- Search Input -->
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                    <label class="form-label">Type here...</label>
                    <input type="text" class="form-control">
                </div>
            </div>

            <!-- User Dropdown Menu -->
            <!-- ... (previous code) ... -->

            <!-- User Dropdown Menu -->
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user me-sm-1"></i> <!-- Font Awesome user icon -->
                        <span class="d-sm-inline d-none">{{ Auth::guard('admin')->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">

                        <!-- User Profile Link -->
                        <li>
                            <a href="{{ route('admin.profile.edit') }}" class="dropdown-item">
                                <i class="fa fa-user-circle me-2"></i> <!-- Font Awesome user-circle icon -->
                                Profile
                            </a>
                        </li>

                        <!-- Logout Form -->
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <a href="{{ route('admin.logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fa fa-sign-out-alt me-2"></i> <!-- Font Awesome sign-out-alt icon -->
                                    Log Out
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
