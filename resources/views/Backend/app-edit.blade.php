@extends('Backend.Layout.app')
@section('main-content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">View Appointment Details</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">App</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">View Appointment Details
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
                    <h4 class="card-title">Appointment Details</h4>
                    <form action="{{ route('appointments.update', ['appointment' => $app['appointment']['App_Id'] ?? null]) }}" method="POST">
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
                                            <input type="text" hidden name="Customer_Id" id="Customer_Id" class="form-control" value="{{ $app['appointment']['Customer_Id'] }}">
                                                <input type="text" name="Customer_Name" id="Customer_Name" class="form-control" required placeholder="Full Name" value="{{ $app['appointment']['Customer_Name'] }}">
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
                                                <input type="text" name="Customer_HP" id="Customer_HP" class="form-control" required placeholder="Phone Number" value="{{ $app['appointment']['Customer_HP'] }}">
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
                                                <input type="text" name="Customer_Address" id="Customer_Address" class="form-control" required placeholder="Address" value="{{ $app['appointment']['Customer_Address'] }}">
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
                                                <input type="date" id="App_Date" name="App_Date" required class="form-control" value="{{ $app['appointment']['App_Date'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-1 col-form-label">Time</label>
                                    <div class="col-sm-3">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="time" id="App_Time" name="App_Time" required class="form-control" value="{{ $app['appointment']['App_Time'] }}">
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
                                                <select class="custom-select" name="App_Duration" required id="App_Duration">
                                                    <option value="1" @if($app['appointment']['App_Duration']==1) selected @endif>1</option>
                                                    <option value="2" @if($app['appointment']['App_Duration']==2) selected @endif>2</option>
                                                    <option value="3" @if($app['appointment']['App_Duration']==3) selected @endif>3</option>
                                                    <option value="4" @if($app['appointment']['App_Duration']==4) selected @endif>4</option>
                                                    <option value="5" @if($app['appointment']['App_Duration']==5) selected @endif>5</option>
                                                    <option value="6" @if($app['appointment']['App_Duration']==6) selected @endif>6</option>
                                                    <option value="7" @if($app['appointment']['App_Duration']==7) selected @endif>7</option>
                                                    <option value="8" @if($app['appointment']['App_Duration']==8) selected @endif>8</option>
                                                    <option value="9" @if($app['appointment']['App_Duration']==9) selected @endif>9</option>
                                                    <option value="10" @if($app['appointment']['App_Duration']==10) selected @endif>10</option>
                                                    <option value="11" @if($app['appointment']['App_Duration']==11) selected @endif>11</option>
                                                    <option value="12" @if($app['appointment']['App_Duration']==12) selected @endif>12</option>
                                                    <option value="13" @if($app['appointment']['App_Duration']==13) selected @endif>13</option>
                                                    <option value="14" @if($app['appointment']['App_Duration']==14) selected @endif>14</option>
                                                    <option value="15" @if($app['appointment']['App_Duration']==15) selected @endif>15</option>
                                                    <option value="16" @if($app['appointment']['App_Duration']==16) selected @endif>16</option>
                                                    <option value="17" @if($app['appointment']['App_Duration']==17) selected @endif>17</option>
                                                    <option value="18" @if($app['appointment']['App_Duration']==18) selected @endif>18</option>
                                                    <option value="19" @if($app['appointment']['App_Duration']==19) selected @endif>19</option>
                                                    <option value="20" @if($app['appointment']['App_Duration']==20) selected @endif>20</option>
                                                    <option value="21" @if($app['appointment']['App_Duration']==21) selected @endif>21</option>
                                                    <option value="22" @if($app['appointment']['App_Duration']==22) selected @endif>22</option>
                                                    <option value="23" @if($app['appointment']['App_Duration']==23) selected @endif>23</option>
                                                </select>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing">Hour(s)</span>
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
                                                <input type="number" id="App_Price" name="App_Price" required class="form-control" value="{{ $app['appointment']['App_Price'] }}">
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
                                                <textarea class="form-control" rows="3" id="App_Desc" name="App_Desc" placeholder="Description Here...">{{ $app['appointment']['App_Desc'] }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-3">
                                        <div class="row">
                                            <div class="col-md-12 input-group">
                                                <select class="custom-select" name="App_Status" required id="App_Status">
                                                    <option value="upcoming" @if($app['appointment']['App_Status']=="upcoming") selected @endif>upcoming</option>
                                                    <option value="completed" @if($app['appointment']['App_Status']=="completed") selected @endif>completed</option>
                                                    <option value="cancelled" @if($app['appointment']['App_Status']=="cancelled") selected @endif>cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Staff In Charge</label>
                                    <div class="col-lg-4">
                                        <div id="staffContainer">
                                            @foreach ($app['staff'] as $key => $individualStaff)
                                            <div class="form-group">
                                                <select class="custom-select" name="staff[]">
                                                    @foreach ($staff as $staffOption)
                                                    <option value="{{ $staffOption->Staff_Id }}" {{ (isset($individualStaff['Staff_Id']) && $individualStaff['Staff_Id'] == $staffOption->Staff_Id) ? 'selected' : '' }}>
                                                        {{ $staffOption->Staff_Name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @if ($key > 0)
                                                <button type="button" class="btn btn-danger deleteStaff">Delete</button>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                        <button type="button" id="addStaff" class="btn btn-secondary">Add More</button>
                                    </div>
                                </div>
                            </div>
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

</div>


@endsection
@push('custom-scripts')
<script>
    $(document).ready(function() {
        // Auto-close alerts after 5 seconds (5000 milliseconds)
        $(".alert").delay(5000).slideUp(300);
    });

    function goBack() {
        window.history.back();
    }

    // JavaScript to handle adding and deleting staff dropdowns
    // document.getElementById('addStaff').addEventListener('click', function () {
    //     var staffContainer = document.getElementById('staffContainer');
    //     var newStaffGroup = staffContainer.children[0].cloneNode(true);

    //     // Clear selected option in the cloned dropdown
    //     newStaffGroup.querySelector('select').selectedIndex = -1;

    //     // Append the new staff dropdown and delete button
    //     staffContainer.appendChild(newStaffGroup);
    // });

    document.getElementById('staffContainer').addEventListener('click', function(event) {
        if (event.target.classList.contains('deleteStaff')) {
            event.target.parentNode.remove();
        }
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