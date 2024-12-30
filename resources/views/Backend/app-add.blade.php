@extends('Backend.Layout.app')
@section('main-content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Add Appointment</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="#" class="text-muted">App</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Add Appointment
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- <div class="col-5 align-self-center">
                                                    <div class="customize-input float-right">
                                                        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                                            <option selected>Aug 19</option>
                                                            <option value="1">July 19</option>
                                                            <option value="2">Jun 19</option>
                                                        </select>
                                                    </div>
                                                </div> -->
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
                        <h4 class="card-title">New Appointment</h4>
                        <form action="{{ route('appointments.store') }}" method="POST">
                            @csrf
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
                                                    <input type="text" name="Customer_Name" id="Customer_Name"
                                                        class="form-control" required placeholder="Full Name">
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
                                                    <input type="text" name="Customer_HP" id="Customer_HP"
                                                        class="form-control" required placeholder="Phone Number">
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
                                                    <input type="text" name="Customer_Address" id="Customer_Address"
                                                        class="form-control" required placeholder="Address">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-3">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="date" id="App_Date" name="App_Date" required
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <label class="col-sm-1 col-form-label">Time</label>
                                        <div class="col-sm-3">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="time" id="App_Time" name="App_Time" required
                                                        class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Duration</label>
                                        <div class="col-sm-3">
                                            <div class="row">
                                                <div class="col-md-12 input-group">
                                                    <select class="custom-select" name="App_Duration" required
                                                        id="App_Duration">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
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
                                                        <span class="input-group-text" id="inputGroup-sizing">RM</span>
                                                    </div>
                                                    <input type="number" id="App_Price" name="App_Price" required
                                                        class="form-control" value="">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea class="form-control" rows="3" id="App_Desc" name="App_Desc" placeholder="Description Here..."></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Staff In Charge</label>
                                        <div class="col-lg-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div id="staffContainer">
                                                        <div class="form-group">
                                                            <select class="custom-select" name="staff[]">
                                                                @foreach ($staff as $individualStaff)
                                                                    <option value="{{ $individualStaff->Staff_Id }}">
                                                                        {{ $individualStaff->Staff_Name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button type="button" id="addStaff" class="btn btn-secondary">Add
                                                        More</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                        <button type="reset" class="btn btn-dark">Reset</button>
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

</div>


@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            // Auto-close alerts after 5 seconds (5000 milliseconds)
            $(".alert").delay(5000).slideUp(300);
        });

        $(document).ready(function() {
            $('#Customer_Name').on('change', function() {
                var name = $(this).val();
                $.ajax({
                    url: '/check-customer', // Endpoint to check customer details
                    method: 'GET',
                    data: {
                        Customer_Name: name // Use the 'name' variable here
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#Customer_HP').val(response.customer.Customer_HP); // Autofill HP
                            $('#Customer_Address').val(response.customer
                                .Customer_Address); // Autofill Address
                        }
                    }
                });
            });
        });


        $(document).ready(function() {
            var staffCount = 0; // Counter to track staff dropdowns

            $('#addStaff').on('click', function() {
                staffCount++;
                var newStaff = `<div class="form-group">
                    <select class="custom-select staff-dropdown" name="staff[]" id="staff_${staffCount}">
                        @foreach ($staff as $individualStaff)
                            <option value="{{ $individualStaff->Staff_Id }}">{{ $individualStaff->Staff_Name }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger deleteStaff">Delete</button>
                </div>`;
                $('#staffContainer').append(newStaff);
                removeSelectedStaff();
            });

            function removeSelectedStaff() {
                $('.staff-dropdown').change(function() {
                    var selectedStaff = $(this).val();
                    $('.staff-dropdown').not(this).find('option').prop('disabled', false);
                    $('.staff-dropdown').not(this).find(`option[value="${selectedStaff}"]`).prop('disabled',
                        true);
                });
            }

            $(document).on('click', '.delete-staff', function() {
                $(this).closest('.form-group').remove();
                removeSelectedStaff();
            });
        });

    </script>
@endpush
