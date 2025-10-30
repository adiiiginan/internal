<!DOCTYPE html>
<html lang="en">


<head>
    @include('roles.Layout.partials.header')
    <title>@yield('title', 'Dashboard')</title>
</head>


<body id="kt_app_body" class="app-default">
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!-- HEADER MULAI DI SINI -->
            <div id="kt_app_header" class="app-header">
                @include('roles.Layout.partials.navbar')
            </div>
            <!-- HEADER SELESAI -->
            <div class="app-wrapper d-flex flex-row flex-row-fluid" id="kt_app_wrapper">
                @include('roles.Layout.partials.sidebar')
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        @yield('content')
                    </div>

                    <!--begin::Footer-->
                    @include('roles.Layout.partials.footer')
                    <!--end::Footer-->
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('roles.Layout.partials.scripts')
</body>

</html>
