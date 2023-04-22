<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Project;
use App\Models\Employee;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        $projectCount = Project::count();
        $employeeCount = Employee::count();

        return view('companies.index', ['companies' => $companies, 'projectCount' => $projectCount, 'employeeCount' => $employeeCount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        $company = Company::where('name', $request->name)->first();

        if (!$company) {
            $compan = Company::create([
                'name' => $request->name,
                'address' => $request->address
            ]);

            if ($compan->wasRecentlyCreated) {
                return 'The Company was added successfully';
            }
        } else {
            return abort(503, 'This Company Aleready exist');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        if ($company) {
            return view('companies.edit')->with(['company' => $company, 'id' => $id]);
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        $company = Company::where('id', $id)->first();
        $comp = Company::where('name', $request->name)->first();

        if (!$comp or $comp->name == $request->name) {
            if ($company) {
                $res = $company->update([
                    'name' => $request->name,
                    'address' => $request->address
                ]);

                if ($res) {
                    return 'The Company was added successfully';
                }
            } else {
                return abort(503, 'This Company Not exist');
            }
        } else {
            return abort(503, 'This Name Aleready exist');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $company = Company::where('id', $request->id)->first();

        if ($company) {
            Employee::where('company_id', $request->id)->delete();
            Project::where('company_id', $request->id)->delete();
            
            $company = $company->delete();
            if ($company) {
                return 'The Company was deleted successfully';
            }
        } else {
            return abort(503, 'This Company Not Exist');
        }
    }
}
