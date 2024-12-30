<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    public function index()
    {
        // Retrieve all staff data from the database
        $staffList = Staff::all();

        // Pass the staff data to a view for display
        //return view('Backend.staff-view', ['staffList' => $staffList]);
        //return view('Backend.staff-view');
        //$staffList = Staff::select('Staff_Id', 'Staff_Name', 'Staff_HP', 'Staff_Address')->get();

        // Render the staff view page with staff data
        return view('Backend.staff-view', ['staffList' => $staffList]);
    }
    public function staffdetail()
    {
        $staffList = Staff::select('Staff_Id', 'Staff_Name', 'Staff_HP', 'Staff_Address')->get();
        return response()->json(['data' => $staffList]);
    }
    public function create()
    {
        return view('Backend.staff-add');
    }
    public function checkStaffName(Request $request)
    {
        $staffName = $request->input('Staff_Name');
        $exists = Staff::where('Staff_Name', $staffName)->exists();

        return response()->json(['exists' => $exists]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Staff_Name' => 'required|unique:staff|string|max:255',
            'Staff_HP' => 'required|string|max:20',
            'Staff_Address' => 'required|string|max:255',
        ], [
            'Staff_Name.required' => 'Name cannot be Empty!',
            'Staff_Name.unique' => 'Name has already been used!',
            'Staff_HP.required' => 'HP cannot be Empty!',
            'Staff_Address.required' => 'Address cannot be Empty!',
        ]);

        $staff = Staff::create($validatedData);

        if ($staff) {
            return redirect()->route('staffview')->with('success', 'Staff details added successfully!');
        }else{
            return back()->withInput()->with('error', 'Failed to add staff details.');
        }
    }

    public function show($id)
    {
        // Retrieve and display details of a specific staff member
        $staff = Staff::findOrFail($id);
        return view('Backend.staff-edit', ['staff' => $staff]);
    }

    public function update(Request $request, $id)
    {
        // Logic to update staff details (similar to store method)
        $validatedData = $request->validate([
            'Staff_Name' => 'required|string|max:255',
            'Staff_HP' => 'required|string|max:20',
            'Staff_Address' => 'required|string|max:255',
        ], [
            'Staff_Name.required' => 'Name cannot be Empty!',
            'Staff_HP.required' => 'HP cannot be Empty!',
            'Staff_Address.required' => 'Address cannot be Empty!',
        ]);

        $staff = Staff::findOrFail($id); // Find the staff member by ID

        // Attempt to update the staff member
        $staffUpdated = $staff->update($validatedData);

        if ($staffUpdated) {
            return redirect()->route('staffview')->with('success', 'Staff details updated successfully!');
        } else {
            return back()->withInput()->with('error', 'Failed to update staff details.');
        }
    }

    public function destroy($id)
    {
        // Logic to delete a staff member
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staffview')->with('success', 'Staff member deleted successfully!');
    }
}
