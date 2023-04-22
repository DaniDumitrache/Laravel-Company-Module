<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\Company;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();

        return view('employees.index')->with(['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('employees.create')->with(['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $employee = Employee::where('email', $request->email)->first();

        if (!$employee) {
            $employee = Employee::create([
                'company_id' => $request->company_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            if ($employee->wasRecentlyCreated) {
                return 'The employee was added successfully';
            }
        } else {
            return abort(503, 'This employee Aleready exist');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $companies = Company::all();

        if ($employee) {
            return view('employees.edit')->with(['employee' => $employee, 'companies' => $companies, 'id' => $id]);
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'company_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $employee = Employee::where('id', $id)->first();
        $employ = Employee::where('email', $request->email)->first();

        if ($employ or $employ->email == $request->email) {
            if ($employee) {
                $res = $employee->update([
                    'company_id' => $request->company_id,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                if ($res) {
                    return 'The employee was added successfully';
                }
            } else {
                return abort(503, 'This employee Not exist');
            }
        } else {
            return abort(503, 'This Email Aleready exist');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $employee = Employee::where('id', $request->id)->first();

        if ($employee) {
            $employee = $employee->delete();
            if ($employee) {
                return 'The employee was deleted successfully';
            }
        } else {
            return abort(503, 'This employee Not Exist');
        }
    }
}
