<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::select(
            'id',
            'name',
            'email',
            'logo'
        )->where('status', 1)->orderBy('id','desc')
        // ->paginate(10);
        ->get();

        return view('Admin.Companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Companies.create');
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
                'companyName' => 'required',
                'email' => 'nullable|email|unique:companies',
            ],
            [
                'companyName.required' => 'Company name is required',
                'email.email' => 'Please enter valid email',
                'email.unique' => 'Email must be unique'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->logo) {
                $file = $request->logo;
                $name =  time() . '_' . $file->getClientOriginalName();
                $logo = $name;
            }
            $item = new Company();
            $item->name = $request->companyName;
            $item->email = $request->email;
            if ($request->logo) {
                $item->logo = $logo;
            }
            $item->save();

            if ($request->logo) {
                $request->logo->move('storage/' . $item->id, $logo);
            }

            return Redirect::to('company')->with('status', 'Successfully Created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('Admin.Companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'companyName' => 'required',
                'email' => 'nullable|email',
            ],
            [
                'companyName.required' => 'Company name is required',
                'email.email' => 'Please enter valid email',
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->logo) {
                $file = $request->logo;
                $name =  time() . '_' . $file->getClientOriginalName();
                $logo = $name;
            }
            $item = Company::find($company->id);
            $item->name = $request->companyName;
            $item->email = $request->email;
            if ($request->logo) {
                $item->logo = $logo;
            }
            $item->save();

            if ($request->logo) {
                $request->logo->move('storage/' . $company->id, $logo);
            }

            return Redirect::to('company')->with('status', 'Successfully Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $item = Company::find($company->id);
        $item->status = 0;
        $item->save();

        return Redirect::to('company')->with('status', 'Successfully Deleted');
    }
}
