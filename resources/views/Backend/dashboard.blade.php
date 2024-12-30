@extends('Backend.Layout.app')
@section('main-content')
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->

<div class="page-breadcrumb">

    @php
    use Carbon\Carbon;
    // Dapatkan waktu simulasi pengujian
    $currentTime = Carbon::now();
    $appointments = App\Models\Appointment::select(
    'appointments.App_Id',
    'appointments.App_Date',
    'appointments.App_Time',
    'appointments.App_Duration',
    'appointments.App_Price',
    'appointments.App_Desc',
    'appointments.App_Status',
    'appointments.Customer_Id',
    'customer.Customer_Name',
    'customer.Customer_HP',
    'customer.Customer_Address',
    )
    ->join('customer', 'appointments.Customer_Id', '=', 'customer.Customer_Id')
    ->where('appointments.App_Status','=','upcoming')
    ->orderBy('appointments.App_Date', 'asc')
    ->get();

    $showToast = false; // Variabel untuk menentukan apakah harus menampilkan toast
    $timeDifference = ''; // Variabel untuk menyimpan jarak waktu

    foreach ($appointments as $appointment) {
    $appointmentDateTime = Carbon::parse($appointment->App_Date . ' ' . $appointment->App_Time);
    $id=$appointment->App_Id;
    $time=$appointment->App_Time;
    if ($currentTime->diffInDays($appointmentDateTime) <= 1) { $showToast=true; // Set variabel $showToast menjadi true $toastClass='show' ; // Tambahkan kelas 'show' untuk menampilkan toast $timeDifference=$currentTime->diffForHumans($appointmentDateTime); // Hitung jarak waktu
        break; // Keluar dari loop setelah menemukan janji dokter yang memenuhi kondisi
        }
        }

        // Reset waktu yang disimulasikan setelah pengujian selesai
        Carbon::setTestNow();
        @endphp

        @if($showToast)
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="..." class="rounded me-2" alt="...">
                    <strong class="me-auto">Appointment Reminder {{$id}}</strong>
                    <small>{{$appointmentDateTime}}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
            </div>
        </div>
        <div class="alert alert-info">
            <strong class="me-auto">Appointment Reminder {{$id}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <p><small> {{$appointmentDateTime}}</small></p>
            <button type="button" class="btn btn-primary btn-sm">View Details</button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @elseif(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-7 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Welcome
                    {{ Auth()->user()->name ?? '-' }} !
                </h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" id="monthYearDropdown" onchange="updateAnalytics()">
                        @foreach ($availableMonths as $month)
                        @foreach ($availableYears as $year)
                        @php
                        $optionValue = str_pad($month['number'], 2, '0', STR_PAD_LEFT) . ' ' . $year;
                        @endphp
                        <option value="{{ $optionValue }}" {{ ($currentMonth == $month['number'] && $currentYear == $year) ? 'selected' : '' }}>
                            {{ $month['name'] . ' ' . $year }}
                        </option>
                        @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- *************************************************************** -->
    <!-- Start First Cards -->
    <!-- *************************************************************** -->
    <div class="card-group">
        <div class="card border-right bg-info  ">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-white mb-1 w-100 text-truncate font-weight-medium totalEarnings"><sup class="set-doller">RM</sup>{{ $totalEarnings }}</h2>
                        <h6 class=" text-white font-weight-normal mb-0 w-100 text-truncate">Earnings of Month
                        </h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-white"><i data-feather="dollar-sign"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right bg-success ">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-white mb-1 font-weight-medium completedAppointments">{{ $completedAppointments }}</h2>
                            {{-- <span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">+18.33%</span> --}}
                        </div>
                        <h6 class="text-white font-weight-normal mb-0 w-100 text-truncate">Completed Appointments</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-white"><i data-feather="check-square"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right bg-warning">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-white mb-1 font-weight-medium upcomingAppointments">{{ $upcomingAppointments }}</h2>
                            {{-- <span class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">-18.33%</span> --}}
                        </div>
                        <h6 class="text-white font-weight-normal mb-0 w-100 text-truncate">Upcoming Appointments</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-white"><i data-feather="layers"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body bg-secondary">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-white mb-1 font-weight-medium cancelledAppointments">{{ $cancelledAppointments }}</h2>
                        <h6 class="text-white font-weight-normal mb-0 w-100 text-truncate">Cancelled Appointment</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-white"><i data-feather="x-circle"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- *************************************************************** -->
    <!-- End First Cards -->
    <!-- *************************************************************** -->
    <!-- *************************************************************** -->
    <!-- Start Location and Earnings Charts Section -->
    <!-- *************************************************************** -->
    <div class="row">
        <div class="col-md-6 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <h4 class="card-title mb-0">Earning Statistics</h4>
                        {{-- <div class="ml-auto">
                                <div class="dropdown sub-dropdown">
                                    <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                        <a class="dropdown-item" href="#">Insert</a>
                                        <a class="dropdown-item" href="#">Update</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div> --}}
                    </div>
                </div>
                <div class="pl-4 mb-5">
                    <div id="chart" data-chart-labels="{{ json_encode($chartLabels) }}" data-chart-series="{{ json_encode($chartSeries) }}" class="stats ct-charts position-relative" style="height: 315px;"></div>
                </div>
                <ul class="list-inline text-center mt-4 mb-0">
                    <li class="list-inline-item text-muted font-italic">Earnings for this month</li>
                </ul>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recent Activity</h4>
                        <div class="mt-4 activity">
                            <div class="d-flex align-items-start border-left-line pb-3">
                                <div>
                                    <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">
                                        <i data-feather="shopping-cart"></i>
                                    </a>
                                </div>
                                <div class="ml-3 mt-2">
                                    <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>
                                    <p class="font-14 mb-2 text-muted">John Musa just purchased <br> Cannon 5M
                                        Camera.
                                    </p>
                                    <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-start border-left-line pb-3">
                                <div>
                                    <a href="javascript:void(0)" class="btn btn-danger btn-circle mb-2 btn-item">
                                        <i data-feather="message-square"></i>
                                    </a>
                                </div>
                                <div class="ml-3 mt-2">
                                    <h5 class="text-dark font-weight-medium mb-2">New Support Ticket</h5>
                                    <p class="font-14 mb-2 text-muted">Richardson just create support <br>
                                        ticket</p>
                                    <span class="font-weight-light font-14 text-muted">25 Minutes Ago</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-start border-left-line">
                                <div>
                                    <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
                                        <i data-feather="bell"></i>
                                    </a>
                                </div>
                                <div class="ml-3 mt-2">
                                    <h5 class="text-dark font-weight-medium mb-2">Notification Pending Order!
                                    </h5>
                                    <p class="font-14 mb-2 text-muted">One Pending order from Ryne <br> Doe</p>
                                    <span class="font-weight-light font-14 mb-1 d-block text-muted">2 Hours
                                        Ago</span>
                                    <a href="javascript:void(0)" class="font-14 border-bottom pb-1 border-info">Load
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
</div>
<!-- *************************************************************** -->
<!-- End Location and Earnings Charts Section -->
<!-- *************************************************************** -->
<!-- *************************************************************** -->
<!-- Start Sales Charts Section -->
<!-- *************************************************************** -->
{{-- <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Total Sales</h4>
                        <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                        <ul class="list-style-none mb-0">
                            <li>
                                <i class="fas fa-circle text-primary font-10 mr-2"></i>
                                <span class="text-muted">Direct Sales</span>
                                <span class="text-dark float-right font-weight-medium">$2346</span>
                            </li>
                            <li class="mt-3">
                                <i class="fas fa-circle text-danger font-10 mr-2"></i>
                                <span class="text-muted">Referral Sales</span>
                                <span class="text-dark float-right font-weight-medium">$2108</span>
                            </li>
                            <li class="mt-3">
                                <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                                <span class="text-muted">Affiliate Sales</span>
                                <span class="text-dark float-right font-weight-medium">$1204</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Net Income</h4>
                        <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                        <ul class="list-inline text-center mt-5 mb-2">
                            <li class="list-inline-item text-muted font-italic">Sales for this month</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Earning by Location</h4>
                        <div class="" style="height:180px">
                            <div id="visitbylocate" style="height:100%"></div>
                        </div>
                        <div class="row mb-3 align-items-center mt-1 mt-5">
                            <div class="col-4 text-right">
                                <span class="text-muted font-14">India</span>
                            </div>
                            <div class="col-5">
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-3 text-right">
                                <span class="mb-0 font-14 text-dark font-weight-medium">28%</span>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-4 text-right">
                                <span class="text-muted font-14">UK</span>
                            </div>
                            <div class="col-5">
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 74%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-3 text-right">
                                <span class="mb-0 font-14 text-dark font-weight-medium">21%</span>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-4 text-right">
                                <span class="text-muted font-14">USA</span>
                            </div>
                            <div class="col-5">
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-cyan" role="progressbar" style="width: 60%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-3 text-right">
                                <span class="mb-0 font-14 text-dark font-weight-medium">18%</span>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-4 text-right">
                                <span class="text-muted font-14">China</span>
                            </div>
                            <div class="col-5">
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="col-3 text-right">
                                <span class="mb-0 font-14 text-dark font-weight-medium">12%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
<!-- *************************************************************** -->
<!-- End Sales Charts Section -->
<!-- *************************************************************** -->
<!-- *************************************************************** -->
<!-- Start Top Leader Table -->
<!-- *************************************************************** -->
{{-- <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h4 class="card-title">Top Leaders</h4>
                            <div class="ml-auto">
                                <div class="dropdown sub-dropdown">
                                    <button class="btn btn-link text-muted dropdown-toggle" type="button" id="dd1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                        <a class="dropdown-item" href="#">Insert</a>
                                        <a class="dropdown-item" href="#">Update</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-wrap v-middle mb-0">
                                <thead>
                                    <tr class="border-0">
                                        <th class="border-0 font-14 font-weight-medium text-muted">Team Lead
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted px-2">Project
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted">Team</th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            Status
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                            Weeks
                                        </th>
                                        <th class="border-0 font-14 font-weight-medium text-muted">Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-top-0 px-2 py-4">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="mr-3"><img
                                                        src="../assets/images/users/widget-table-pic1.jpg" alt="user"
                                                        class="rounded-circle" width="45" height="45" /></div>
                                                <div class="">
                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">Hanna
                                                        Gover</h5>
                                                    <span class="text-muted font-14">hgover@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="border-top-0 text-muted px-2 py-4 font-14">Elite Admin</td>
                                        <td class="border-top-0 px-2 py-4">
                                            <div class="popover-icon">
                                                <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                    href="javascript:void(0)">DS</a>
                                                <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                                    href="javascript:void(0)">SS</a>
                                                <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item"
                                                    href="javascript:void(0)">RP</a>
                                                <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                                    href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td class="border-top-0 text-center px-2 py-4"><i
                                                class="fa fa-circle text-primary font-12" data-toggle="tooltip"
                                                data-placement="top" title="In Testing"></i></td>
                                        <td class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                            35
                                        </td>
                                        <td class="font-weight-medium text-dark border-top-0 px-2 py-4">$96K
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-4">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="mr-3"><img
                                                        src="../assets/images/users/widget-table-pic2.jpg" alt="user"
                                                        class="rounded-circle" width="45" height="45" /></div>
                                                <div class="">
                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">Daniel
                                                        Kristeen
                                                    </h5>
                                                    <span class="text-muted font-14">Kristeen@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted px-2 py-4 font-14">Real Homes WP Theme</td>
                                        <td class="px-2 py-4">
                                            <div class="popover-icon">
                                                <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                    href="javascript:void(0)">DS</a>
                                                <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                                    href="javascript:void(0)">SS</a>
                                                <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                                    href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td class="text-center px-2 py-4"><i class="fa fa-circle text-success font-12"
                                                data-toggle="tooltip" data-placement="top" title="Done"></i>
                                        </td>
                                        <td class="text-center text-muted font-weight-medium px-2 py-4">32</td>
                                        <td class="font-weight-medium text-dark px-2 py-4">$85K</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-4">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="mr-3"><img
                                                        src="../assets/images/users/widget-table-pic3.jpg" alt="user"
                                                        class="rounded-circle" width="45" height="45" /></div>
                                                <div class="">
                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">Julian
                                                        Josephs
                                                    </h5>
                                                    <span class="text-muted font-14">Josephs@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted px-2 py-4 font-14">MedicalPro WP Theme</td>
                                        <td class="px-2 py-4">
                                            <div class="popover-icon">
                                                <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                    href="javascript:void(0)">DS</a>
                                                <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                                    href="javascript:void(0)">SS</a>
                                                <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item"
                                                    href="javascript:void(0)">RP</a>
                                                <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                                    href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td class="text-center px-2 py-4"><i class="fa fa-circle text-primary font-12"
                                                data-toggle="tooltip" data-placement="top" title="Done"></i>
                                        </td>
                                        <td class="text-center text-muted font-weight-medium px-2 py-4">29</td>
                                        <td class="font-weight-medium text-dark px-2 py-4">$81K</td>
                                    </tr>
                                    <tr>
                                        <td class="px-2 py-4">
                                            <div class="d-flex no-block align-items-center">
                                                <div class="mr-3"><img
                                                        src="../assets/images/users/widget-table-pic4.jpg" alt="user"
                                                        class="rounded-circle" width="45" height="45" /></div>
                                                <div class="">
                                                    <h5 class="text-dark mb-0 font-16 font-weight-medium">Jan
                                                        Petrovic
                                                    </h5>
                                                    <span class="text-muted font-14">hgover@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-muted px-2 py-4 font-14">Hosting Press HTML</td>
                                        <td class="px-2 py-4">
                                            <div class="popover-icon">
                                                <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                    href="javascript:void(0)">DS</a>
                                                <a class="btn btn-success text-white font-20 rounded-circle btn-circle"
                                                    href="javascript:void(0)">+</a>
                                            </div>
                                        </td>
                                        <td class="text-center px-2 py-4"><i class="fa fa-circle text-danger font-12"
                                                data-toggle="tooltip" data-placement="top" title="In Progress"></i></td>
                                        <td class="text-center text-muted font-weight-medium px-2 py-4">23</td>
                                        <td class="font-weight-medium text-dark px-2 py-4">$80K</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
<div class="modal fade" id="my-event-details" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointmentModalLabel">Appointment Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="p-2 bg-primary text-white">Customer Details</h4>
                <p><strong>Name:</strong> <span class="customer-name"></span></p>
                <p><strong>HP:</strong> <span class="customer-hp"></span></p>
                <p><strong>Address:</strong> <span class="customer-address"></span></p>

                <h4 class="p-2 bg-primary text-white">Appointment Details</h4>
                <span class="badge badge-warning app-status float-right"></span>
                <p><strong>Date & Time:</strong><span class="app-date"></p>
                <p><strong>Duration:</strong> <span class="app-duration"></span></p>
                <p><strong>Price:</strong> <span class="app-price">RM </span></p>
                <p><strong>Description:</strong> <span class="app-desc"></span></p>
                <div class="staff-list"></div>
            </div>

            <div class="modal-footer">
                <a id="edit-appointment-btn" class="btn btn-info" href="#"> <i class="fas fa-pencil-alt"></i> Edit</a>
                <!-- <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#confirmationModal">
                    <i class="fas fa-trash"></i> Delete
                </a> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- *************************************************************** -->
<!-- End Top Leader Table -->
<!-- *************************************************************** -->
</div>
@endsection
@push('custom-scripts')
<!--This page css -->
<link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
<link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
<link href="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
<!--This page JavaScript -->
<script src="../assets/extra-libs/c3/d3.min.js"></script>
<script src="../assets/extra-libs/c3/c3.min.js"></script>
<script src="../assets/libs/chartist/dist/chartist.min.js"></script>
<script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="../assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<!-- <script src="../assets/js/pages/dashboards/dashboard1.js"></script> -->
<script>
    $(document).ready(function() {
        // Auto-close alerts after 5 seconds (5000 milliseconds)
        $(".alert").delay(50000).slideUp(300);
    });


    function updateChart(labels, series) {
        var chartElement = document.getElementById('chart');

        if (chartLabelsAttr && chartSeriesAttr) {
            var chartLabels = JSON.parse(chartLabelsAttr).map(function(date) {
                // Extract only the day part from the date
                return new Date(date).getDate();
            });
            var chartSeries = JSON.parse(chartSeriesAttr);

            // Create a new chart instance with the updated data
            var chart = new Chartist.Line('#chart', {
                labels: chartLabels,
                series: [chartSeries]
            }, {
                // Your chart options here
            });

            // Other chart customization and event handling...

            // Update the chart on window resize
            $(window).on('resize', function() {
                chart.update();
            });
        } else {
            console.error('Chart element not found.');
        }
    }



    function updateAnalytics() {
        var selectedMonthYear = document.getElementById('monthYearDropdown').value;

        // Extract month and year from the selected option
        var selectedMonth = selectedMonthYear.split(' ')[0];
        var selectedYear = selectedMonthYear.split(' ')[1];

        // Perform AJAX request to update analytics based on the selected month and year
        $.ajax({
            type: 'GET',
            url: '/updateAnalytics/' + selectedYear + '/' + selectedMonth,
            dataType: 'json',

            success: function(data) {
                // Update the chart or other parts of your UI with the new data
                $('.totalEarnings').text('RM' + data.totalEarnings);
                $('.completedAppointments').text(data.completedAppointments);
                $('.upcomingAppointments').text(data.upcomingAppointments);
                $('.cancelledAppointments').text(data.cancelledAppointments);

                // Update the chart with the new data
                //updateChart(data.chartLabels, data.chartSeries);

                // Update the data attributes of the chart element
                var chartElement = document.getElementById('chart');
                if (chartElement) {
                    chartElement.setAttribute('data-chart-labels', JSON.stringify(data.chartLabels));
                    chartElement.setAttribute('data-chart-series', JSON.stringify(data.chartSeries));
                }
                var chartLabelsAttr = chartElement.getAttribute('data-chart-labels');
                var chartSeriesAttr = chartElement.getAttribute('data-chart-series');

                if (chartLabelsAttr && chartSeriesAttr) {
                    var chartLabels = JSON.parse(chartLabelsAttr).map(function(date) {
                        // Extract only the day part from the date
                        return new Date(date).getDate();
                    });
                    var chartSeries = JSON.parse(chartSeriesAttr);

                    // Create a new chart instance with the updated data
                    var chart = new Chartist.Line('#chart', {
                        labels: chartLabels,
                        series: [chartSeries]
                    }, {
                        // Your chart options here
                    });

                    // Other chart customization and event handling...

                    // Update the chart on window resize
                    $(window).on('resize', function() {
                        chart.update();
                    });
                } else {
                    console.error('Chart element not found.');
                }
            },
            error: function(error) {
                console.error('Error updating analytics:', error);
            }
        });
    }

    //line chart
    document.addEventListener('DOMContentLoaded', function() {
        var chartElement = document.getElementById('chart');

        if (chartElement) {
            var chartLabelsAttr = chartElement.getAttribute('data-chart-labels');
            var chartSeriesAttr = chartElement.getAttribute('data-chart-series');

            // Check if the data attributes exist and are not empty
            if (chartLabelsAttr && chartSeriesAttr) {
                var chartLabels = JSON.parse(chartLabelsAttr).map(function(date) {
                    // Extract only the day part from the date
                    return new Date(date).getDate();
                });
                var chartSeries = JSON.parse(chartSeriesAttr);

                // Now you can use chartLabels and chartSeries to create your Chartist.js chart
                var chart = new Chartist.Line('#chart', {
                    labels: chartLabels,
                    series: [chartSeries]
                }, {
                    // Your chart options here
                });

                // Other chart customization and event handling...

                $(window).on('resize', function() {
                    chart.update();
                });
            } else {
                console.error('Data attributes not found or empty.');
            }
        } else {
            console.error('Chart element not found.');
        }
    });
</script>
@endpush