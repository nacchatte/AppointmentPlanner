<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Appointment_Staff;
use App\Models\Customer;
use App\Models\Staff;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('Backend.app-view', ['appointments' => $appointments]);
    }

    public function tableview()
    {
        $appointments = Appointment::select(
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
            ->get();

        return view('Backend.app-table', ['appointments' => $appointments]);
    }

    public function getAppointments()
    {
        // Retrieve appointments data from the database
        $appointments = Appointment::select(
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
            ->get();

        // Organize appointments and staff into a more structured format
        $formattedAppointments = [];
        foreach ($appointments as $appointment) {
            $appointmentId = $appointment->App_Id;

            // Get associated staff for the appointment
            $staff = Staff::select('staff.Staff_Name') // specify the table alias
                ->join('appointment_staff', 'staff.Staff_Id', '=', 'appointment_staff.Staff_Id')
                ->where('appointment_staff.App_Id', '=', $appointmentId)
                ->get();

            // Create an entry for the appointment
            $formattedAppointments[$appointmentId] = [
                'appointment' => [
                    'App_Id' => $appointment->App_Id,
                    'App_Date' => $appointment->App_Date,
                    'App_Time' => $appointment->App_Time,
                    'App_Duration' => $appointment->App_Duration,
                    'App_Price' => $appointment->App_Price,
                    'App_Desc' => $appointment->App_Desc,
                    'App_Status' => $appointment->App_Status,
                    'Customer_Id' => $appointment->Customer_Id,
                    'Customer_Name' => $appointment->Customer_Name,
                    'Customer_HP' => $appointment->Customer_HP,
                    'Customer_Address' => $appointment->Customer_Address,
                ],
                'staff' => $staff->toArray()
            ];
        }

        // Convert the associative array to a simple array
        $formattedAppointments = array_values($formattedAppointments);

        // Return appointment data as JSON
        return response()->json($formattedAppointments);
    }

    public function create()
    {
        // Logic for displaying the create form
        $staff = Staff::all();
        return view('Backend.app-add', ['staff' => $staff]);
    }

    public function checkCustomer(Request $request)
    {
        $customer = Customer::where('Customer_Name', $request->Customer_Name)->first();
        if ($customer) {
            return response()->json(['exists' => true, 'customer' => $customer]);
        }
        return response()->json(['exists' => false]);
    }

    public function store(Request $request)
    {

        $customer = Customer::firstOrCreate(['Customer_Name' => $request->Customer_Name], [
            'Customer_HP' => $request->Customer_HP,
            'Customer_Address' => $request->Customer_Address
        ]);

        $appointment = new Appointment();
        $appointment->App_Date = $request->App_Date;
        $appointment->App_Time = $request->App_Time;
        $appointment->App_Duration = $request->App_Duration;
        $appointment->App_Price = $request->App_Price;
        $appointment->App_Desc = $request->App_Desc;
        $appointment->App_Status = 'upcoming';
        $appointment->Customer_Id = $customer->Customer_Id;
        $appointment->save();

        if ($request->has('staff')) {
            foreach ($request->staff as $staffId) {
                $staff = Staff::find($staffId);
                if ($staff) {
                    $appointment->staff()->attach($staffId, [
                        'Staff_Name' => $staff->Staff_Name
                    ]);
                }
            }
        }
        return redirect()->route('appointments.index')->with('success', 'Appointment added successfully!');
    }


    public function show(Appointment $appointment)
    {
        // Retrieve details of a specific appointment, including staff and customer information
        $app = $this->getAppointmentDetails($appointment->App_Id);
        $staff = Staff::all();
        //dd($app, $staff); 
        return view('Backend.app-edit', compact('app', 'staff'));
    }

    private function getAppointmentDetails($appointmentId)
    {
        $appointment = Appointment::select(
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
            ->where('appointments.App_Id', '=', $appointmentId)
            ->first();

        if (!$appointment) {
            return null;
        }

        // Get associated staff for the appointment
        $staff = Staff::select('staff.Staff_Name', 'staff.Staff_Id')
            ->join('appointment_staff', 'staff.Staff_Id', '=', 'appointment_staff.Staff_Id')
            ->where('appointment_staff.App_Id', '=', $appointmentId)
            ->get();

        // Create a formatted response
        $formattedAppointment = [
            'appointment' => [
                'App_Id' => $appointment->App_Id,
                'App_Date' => $appointment->App_Date,
                'App_Time' => $appointment->App_Time,
                'App_Duration' => $appointment->App_Duration,
                'App_Price' => $appointment->App_Price,
                'App_Desc' => $appointment->App_Desc,
                'App_Status' => $appointment->App_Status,
                'Customer_Id' => $appointment->Customer_Id,
                'Customer_Name' => $appointment->Customer_Name,
                'Customer_HP' => $appointment->Customer_HP,
                'Customer_Address' => $appointment->Customer_Address,
            ],
            'staff' => $staff->toArray()
        ];

        return $formattedAppointment;
    }

    public function edit(Appointment $appointment)
    {
        return view('Backend.appointments.edit', ['appointment' => $appointment]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        // Validate the request data as needed

        // Update customer details
        $customer = Customer::find($request->Customer_Id);

        // If the customer doesn't exist, create a new one
        if (!$customer) {
            $customer = Customer::create([
                'Customer_Name' => $request->Customer_Name,
                'Customer_HP' => $request->Customer_HP,
                'Customer_Address' => $request->Customer_Address
            ]);
        } else {
            // If the customer exists, update the details
            $customer->update([
                'Customer_Name' => $request->Customer_Name,
                'Customer_HP' => $request->Customer_HP,
                'Customer_Address' => $request->Customer_Address
            ]);
        }

        // Update appointment details
        $appointment->update([
            'App_Date' => $request->App_Date,
            'App_Time' => $request->App_Time,
            'App_Duration' => $request->App_Duration,
            'App_Price' => $request->App_Price,
            'App_Desc' => $request->App_Desc,
            'App_Status' => $request->App_Status
        ]);

        // Sync staff details
        $newStaffIds = $request->staff;
        $existingStaffIds = $appointment->staff->pluck('Staff_Id')->toArray();

        // Detach staff that are not in the new selection
        $staffToDetach = array_diff($existingStaffIds, $newStaffIds);
        $appointment->staff()->detach($staffToDetach);

        // Attach new staff that are not already associated
        $staffToAttach = array_diff($newStaffIds, $existingStaffIds);
        foreach ($staffToAttach as $staffId) {
            $staff = Staff::find($staffId);
            if ($staff) {
                $appointment->staff()->attach($staffId, [
                    'Staff_Name' => $staff->Staff_Name
                ]);
            }
        }

        return redirect()->route('appointments.table')->with('success', 'Appointment updated successfully!');
    }



    public function destroy(Appointment $appointment)
    {
        // Get the appointment details along with associated staff
        $appointmentDetails = Appointment::select(
            'appointments.App_Id',
            'appointments.Customer_Id'
        )
            ->where('appointments.App_Id', '=', $appointment->App_Id)
            ->first();

        if (!$appointmentDetails) {
            return redirect()->back()->with('error', 'Appointment not found!');
        }

        // Delete appointment_staff records based on App_Id
        Appointment_Staff::where('App_Id', $appointmentDetails->App_Id)->delete();

        // Delete the appointment
        $appointment->delete();

        // You can also delete the associated customer if needed
        // Customer::where('Customer_Id', $appointmentDetails->Customer_Id)->delete();
        return redirect()->back()->with('success', 'Appointment deleted successfully!');
        // return redirect()->route('appointments.table')->with('success', 'Appointment deleted successfully!');
    }
}
