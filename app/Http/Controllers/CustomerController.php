<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Fetch all customer
        $customer = Customer::all();
        return view('Backend.cust-view', ['customer' => $customer]);
    }

    public function customerdetail()
    {
        $customerList = Customer::select('Customer_Id', 'Customer_Name', 'Customer_HP', 'Customer_Address')->get();
        return response()->json(['data' => $customerList]);
    }

    public function create()
    {
        return view('Backend.cust-add');
    }

    public function checkCustomerName(Request $request)
    {
        $customerName = $request->input('Customer_Name');
        $exists = Customer::where('Customer_Name', $customerName)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Customer_Name' => 'required|unique:customer|string|max:255',
            'Customer_HP' => 'required|string|max:20',
            'Customer_Address' => 'required|string|max:255',
        ], [
            'Customer_Name.required' => 'Name cannot be Empty!',
            'Customer_Name.unique' => 'Name has already been used!',
            'Customer_HP.required' => 'HP cannot be Empty!',
            'Customer_Address.required' => 'Address cannot be Empty!',
        ]);

        $customer = Customer::create($validatedData);

        if ($customer) {
            return redirect()->route('customer.index')->with('success', 'Customer details added successfully!');
        } else {
            return back()->withInput()->with('error', 'Failed to add customer details.');
        }
    }


    public function show($id)
    {
        // Fetch a specific customer by ID and display details
        $customer = Customer::findOrFail($id);
        return view('Backend.cust-edit', ['customer' => $customer]);
    }

    public function update(Request $request, $id)
    {
        // Validate and update customer details
        $validatedData = $request->validate([
            'Customer_Name' => 'required|unique:customer|string|max:255',
            'Customer_HP' => 'required|string|max:20',
            'Customer_Address' => 'required|string|max:255',
        ], [
            'Customer_Name.required' => 'Name cannot be Empty!',
            'Customer_Name.unique' => 'Name has already been used!',
            'Customer_HP.required' => 'HP cannot be Empty!',
            'Customer_Address.required' => 'Address cannot be Empty!',
        ]);

        $customer = Customer::findOrFail($id); // Find the customer by ID

        $customerUpdated = $customer->update($validatedData);

        if ($customerUpdated) {
            return redirect()->route('customer.index')->with('success', 'Customer details updated successfully!');
        } else {
            return back()->withInput()->with('error', 'Failed to update customer details.');
        }
    }

    public function destroy($id)
    {
        // Delete a specific customer by ID
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully!');
    }
}
