<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::select(
            'id',
            'first_name',
            'last_name',
            'company_id',
            'email',
            'phone_no'
        )->where('status', 1)->orderBy('id','desc')->with('getCompany')
        // ->paginate(10);
        ->get();

        return view('Admin.Employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::select('id', 'name')->where('status', 1)->get();

        return view('Admin.Employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'companyName' => 'required|not_in:0',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'nullable|email|unique:employees',
                'phone_no' => 'nullable|numeric|unique:employees',
            ],
            [
                'companyName.required' => 'Company name is required',
                'companyName.not_in' => 'Company name is required',
                'first_name.required' => 'First name is required',
                'last_name.required' => 'Last name is required',
                'email.email' => 'Please enter valid email',
                'email.unique' => 'Email must be unique',
                'phone_no.numeric' => 'Please enter valid phone no.',
                'email.unique' => 'Phone must be unique'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $item = new Employee();
            $item->company_id = $request->companyName;
            $item->first_name = $request->first_name;
            $item->last_name = $request->last_name;
            $item->phone_no = $request->phone_no;
            $item->email = $request->email;
            $item->save();

            return Redirect::to('employee')->with('status', 'Successfully Created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies = Company::select('id', 'name')->where('status', 1)->get();

        return view('Admin.Employees.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'companyName' => 'required|not_in:0',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'nullable|email',
                'phone_no' => 'nullable|numeric',
            ],
            [
                'companyName.required' => 'Company name is required',
                'companyName.not_in' => 'Company name is required',
                'first_name.required' => 'First name is required',
                'last_name.required' => 'Last name is required',
                'email.email' => 'Please enter valid email',
                'phone_no.numeric' => 'Please enter valid phone no.'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $item = Employee::find($employee->id);
            $item->company_id = $request->companyName;
            $item->first_name = $request->first_name;
            $item->last_name = $request->last_name;
            $item->phone_no = $request->phone_no;
            $item->email = $request->email;
            $item->save();

            return Redirect::to('employee')->with('status', 'Successfully Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $item = Employee::find($employee->id);
        $item->status = 0;
        $item->save();

        return Redirect::to('employee')->with('status', 'Successfully Deleted');
    }
}
