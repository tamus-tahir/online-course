<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    @php
        $setting = getSetting();
    @endphp

    <title>{{ $setting->app_name }} | {{ $title }}</title>
    <meta content="{{ $setting->description }}" name="description">
    <meta content="{{ $setting->keywords }}" name="keywords">
    <meta content="Tamus Tahir" name="author">

    <!-- Favicons -->

    <link href="{{ $setting->icon ? asset('storage/' . $setting->icon) : asset('backend/img/logo.png') }}"
        rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- datatables -->
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap5.css') }}" rel="stylesheet">

    <link href="{{ asset('backend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">

                <img src="{{ $setting->icon ? asset('storage/' . $setting->icon) : asset('backend/img/logo.png') }}"
                    alt="">
                <span class="d-none d-lg-block">{{ $setting->app_name }}</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ account()->avatar ? asset('storage/' . account()->avatar) : asset('backend/img/noprofil.png') }}"
                            alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ account()->name }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ account()->name }}</h6>
                            <span>{{ account()->role }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard.show') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard.edit') }}">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('home') }}">
                                <i class='bx bx-home-alt-2'></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal"
                                data-bs-target="#logoutModal">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            @if (account()->role == 'superadmin')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('setting.index') }}">
                        <i class='bx bx-cog'></i>
                        <span>Setting</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('user.index') }}">
                        <i class='bx bx-user-pin'></i>
                        <span>User</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('category.index') }}">
                        <i class='bx bx-list-minus'></i>
                        <span>Category</span>
                    </a>
                </li>
            @endif

            @if (account()->role == 'superadmin' || account()->role == 'lecture')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('course.index') }}">
                        <i class='bx bx-layer'></i>
                        <span>Course</span>
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('course-student.index') }}">
                    <i class='bx bx-wallet-alt'></i>
                    <span>Subscribe</span>
                </a>
            </li>

            @if (account()->role == 'superadmin' || account()->role == 'lecture')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('report.index') }}">
                        <i class='bx bxs-report'></i>
                        <span>Report</span>
                    </a>
                </li>
            @endif

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle card shadow p-3">
            <h1>{{ $title }}</h1>
        </div>

        {{ $slot }}

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>{{ $setting->copyright }}</span></strong>
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="alert-success" data-messsage="{{ session('success') ? session('success') : '' }}"></div>

    @stack('modal')

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        Are you sure you want to log out?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end Modal Logout -->

    <!-- Vendor JS Files -->
    <script src="{{ asset('backend/vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- datatables -->
    <script src="{{ asset('backend/vendor/datatables/dataTables.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap5.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>

    <script src="{{ asset('backend/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('backend/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/quill/quill.js') }}"></script>
    <script src="{{ asset('backend/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('backend/vendor/parsley/parsley.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/sweetalert2/sweetalert2@11') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('backend/js/main.js') }}"></script>
    <script>
        new DataTable('#example');

        $('#form').parsley({
            errorClass: 'is-invalid text-red',
            successClass: 'is-valid',
            errorsWrapper: '<span class="invalid-feedback"></span>',
            errorTemplate: '<span></span>',
            trigger: 'change'
        });

        let alertSuccess = $('#alert-success').data('messsage')
        if (alertSuccess) {
            Swal.fire({
                title: "Good job!",
                text: alertSuccess,
                icon: "success",
                timer: 1500
            });
        }
    </script>
    @stack('script')

</body>

</html>
