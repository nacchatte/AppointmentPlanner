@extends('Backend.Layout.app')
@section('main-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">View Customer Details</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Customer</a>
                            </li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">View Customer Details
                            </li>
                        </ol>
                    </nav>
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
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customer Details</h4>
                        <form action="{{ route('customer.update', ['id' => $customer->Customer_Id]) }}" method="POST">
                            @csrf
                            @method('PUT')
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

                            <div class="form-body">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" id="Customer_Name" name="Customer_Name"
                                                        class="form-control @error('Customer_Name') is-invalid @enderror"
                                                        required placeholder="Full Name" value="{{ $customer->Customer_Name }}">
                                                    <div id="customerNameError" class="text-danger"></div>
                                                    @error('Customer_Name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Hp Number</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" id="Customer_HP" name="Customer_HP"
                                                        class="form-control @error('Customer_HP') is-invalid @enderror"
                                                        required placeholder="Phone Number" value="{{ $customer->Customer_HP }}">
                                                    @error('Customer_HP')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" id="Customer_Address" name="Customer_Address"
                                                        class="form-control @error('Customer_Address') is-invalid @enderror"
                                                        placeholder="Address" value="{{ $customer->Customer_Address }}">
                                                    @error('Customer_Address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 col-form-label">Date</label>
                                                                        <div class="col-sm-3">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <input type="date" id="date" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <label class="col-sm-1 col-form-label">Time</label>
                                                                        <div class="col-sm-3">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <input type="time" id="time" class="form-control" value="">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                <!-- <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 col-form-label">Duration</label>
                                                                        <div class="col-sm-3">
                                                                            <div class="row">
                                                                                <div class="col-md-12 input-group">
                                                                                    <select class="custom-select " id="duration">
                                                                                        <option value="1">1</option>
                                                                                        <option value="2">2</option>
                                                                                        <option value="3">3</option>
                                                                                        <option value="3">4</option>
                                                                                        <option value="3">5</option>
                                                                                        <option value="3">6</option>
                                                                                        <option value="3">7</option>
                                                                                        <option value="3">8</option>
                                                                                        <option value="3">9</option>
                                                                                        <option value="3">10</option>
                                                                                        <option value="3">11</option>
                                                                                        <option value="3">12</option>
                                                                                        <option value="3">13</option>
                                                                                        <option value="3">14</option>
                                                                                        <option value="3">15</option>
                                                                                        <option value="3">16</option>
                                                                                        <option value="3">17</option>
                                                                                        <option value="3">18</option>
                                                                                        <option value="3">19</option>
                                                                                        <option value="3">20</option>
                                                                                        <option value="3">21</option>
                                                                                        <option value="3">22</option>
                                                                                        <option value="3">23</option>
                                                                                    </select>
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"
                                                                                            id="inputGroup-sizing">Hour(s)</span>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <label class="col-sm-1 col-form-label">Price</label>
                                                                        <div class="col-sm-3">
                                                                            <div class="row">
                                                                                <div class="col-md-12 input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"
                                                                                            id="inputGroup-sizing">RM</span>
                                                                                    </div>
                                                                                    <input type="number" id="price" class="form-control"
                                                                                        value="">
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                <!-- <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 col-form-label">Description</label>
                                                                        <div class="col-lg-10">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <textarea class="form-control" rows="3" id="desc" placeholder="Description Here..."></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                <!-- <div class="form-group">
                                                                    <div class="row">
                                                                        <label class="col-sm-2 col-form-label">Staff In Charge</label>
                                                                        <div class="col-lg-4">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="input-group">
                                                                                        <select class="custom-select" id="pic">
                                                                                            <option value="1">Erica</option>
                                                                                            <option value="2">Sonia</option>
                                                                                            <option value="3">Amely</option>
                                                                                        </select>
                                                                                        <div class="input-group-append">
                                                                                            <button class="btn btn-outline-secondary"
                                                                                                type="button">Add More</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> -->
                                <div class="form-actions">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-info">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" onclick="goBack()">Back</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
@push('custom-scripts')
    <script>
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {
        // Auto-close alerts after 5 seconds (5000 milliseconds)
            $(".alert").delay(5000).slideUp(300);
        });

        //     $('#Staff_Name').on('keyup', function() {
        //     let staffName = $(this).val();

        //     $.ajax({
        //         url: '/check-staff-name', // Route for checking uniqueness
        //         method: 'POST',
        //         data: {
        //             '_token': '{{ csrf_token() }}',
        //             'Staff_Name': staffName
        //         },
        //         success: function(response) {
        //             if (response.exists) {
        //                 // Display an error message or indication that the name is not unique
        //                 $('#staffNameError').text('Staff name already exists');
        //             } else {
        //                 // Clear error message or indication
        //                 $('#staffNameError').text('');
        //             }
        //         }
        //     });
        // });
    </script>
@endpush