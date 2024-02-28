<?php

namespace App\Http\Controllers;

use App\Exports\CustomerExport;
use App\Models\Customer;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('userName')->get();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required|min:3|max:50',
            'age' =>'required|numeric|min:1',
            'mobile_number' =>'required|unique:customers|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->input();
        unset($input['_token']);
        unset($input['_method']);
        $input['user_id'] = Auth::user()->id;
        Customer::create($input);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.create_edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required|min:3|max:50',
            'age' =>'required|numeric|min:1',
            'mobile_number' =>'required|unique:customers|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->input();
        unset($input['_token']);
        unset($input['_method']);
        $input['user_id'] = Auth::user()->id;
        $customer->update($input);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /** 
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }

    public function Export()
    {
        return Excel::download(new CustomerExport, 'customers.xlsx');
    }
}
