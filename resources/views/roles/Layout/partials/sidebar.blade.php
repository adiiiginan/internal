<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <!--begin::Wrapper-->
    <div class="app-sidebar-wrapper">
        <div id="kt_app_sidebar_wrapper" class="hover-scroll-y my-5 my-lg-2 mx-4" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper"
            data-kt-scroll-offset="5px">

            <!--begin::Sidebar menu-->
            <div data-kt-menu="true"
                class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-3 mb-5">

                <!-- Dashboard -->
                <div class="menu-item">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <span class="menu-icon"><i class="ki-outline ki-home-2 fs-2"></i></span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>

                <!-- Menu untuk Role Admin (idrole = 1) -->
                @if (
                    (session()->has('user_role') && in_array(session('user_role'), [1, 2])) ||
                        (Auth::check() && in_array(Auth::user()->role, ['admin', 'superadmin'])))
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon"><i class="ki-outline ki-setting fs-2"></i></span>
                            <span class="menu-title">Permintaan Barang</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <a href="{{ route('role.admin') }}" class="menu-link">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title fw-bold">List Permintaan Barang</span>
                            </a>
                        </div>
                        <div class="menu-sub menu-sub-accordion">
                            <a href="{{ route('admin.permintaan.onprogress') }}" class="menu-link">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title fw-bold">Permintaan Process</span>
                            </a>
                        </div>
                        <div class="menu-sub menu-sub-accordion">
                            <a href="{{ route('admin.permintaan.done') }}" class="menu-link">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title fw-bold">Permintaan Selesai</span>
                            </a>
                        </div>
                        <div class="menu-sub menu-sub-accordion">
                            <a href="{{ route('roles.gudang.masuk') }}" class="menu-link">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title fw-bold">List Barang Masuk</span>
                            </a>
                        </div>

                        <!-- User Management -->

                    </div>
                @endif

                @if (
                    (session()->has('user_role') && in_array(session('user_role'), [1])) ||
                        (Auth::check() && in_array(Auth::user()->role, ['superadmin'])))
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon"><i class="ki-outline ki-user fs-2"></i></span>
                            <span class="menu-title">User Management</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!-- User Management -->
                        <div class="menu-sub menu-sub-accordion">
                            <a href="{{ route('roles.users.index') }}" class="menu-link">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title fw-bold">List User</span>
                            </a>
                        </div>
                        <div class="menu-sub menu-sub-accordion">
                            <a href="{{ route('roles.users.create') }}" class="menu-link">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title fw-bold">Create User</span>
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Perjalanan Dinas for Finance & Superadmin -->
                @if (
                    (session()->has('user_role') && in_array(session('user_role'), [4, 5])) ||
                        (Auth::check() && in_array(Auth::user()->role, ['finance', 'superadmin'])))
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon"><i class="ki-outline ki-setting fs-2"></i></span>
                            <span class="menu-title">Perjalanan Dinas</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <a href="{{ route('roles.finance.index') }}" class="menu-link">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title fw-bold">List Perdin Pending</span>
                            </a>
                        </div>
                        <div class="menu-sub menu-sub-accordion">
                            <a href="{{ route('roles.finance.approved') }}" class="menu-link">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title fw-bold">List Perdin Approve</span>
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Menu untuk Role Kunjungan (idrole = 2) -->

                <!-- Menu untuk Role 5 (akses semua menu) -->

                @if (
                    (session()->has('user_role') && in_array(session('user_role'), [2, 5])) ||
                        (Auth::check() && in_array(Auth::user()->role, ['sales', 'superadmin'])))
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon"><i class="ki-outline ki-setting fs-2"></i></span>
                            <span class="menu-title">Kunjungan</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <a href="" class="menu-link">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title fw-bold">List Kunjungan</span>
                            </a>
                        </div>
                    </div>
                @endif


                <!-- Menu untuk Role Admin (idrole = 1) -->
                @if (
                    (session()->has('user_role') && in_array(session('user_role'), [3, 5])) ||
                        (Auth::check() && in_array(Auth::user()->role, ['gudang', 'superadmin'])))
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon"><i class="ki-outline ki-setting fs-2"></i></span>
                            <span class="menu-title">Gudang </span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div class="menu-sub menu-sub-accordion">
                            <a href="{{ route('roles.gudang.masuk') }}" class="menu-link">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title fw-bold">List Barang Masuk</span>
                            </a>
                        </div>
                    </div>
                @endif

            </div>
            <!--end::Sidebar menu-->
        </div>
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Sidebar-->
