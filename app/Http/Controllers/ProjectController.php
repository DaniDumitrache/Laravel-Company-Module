<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Company;
use App\Models\EmployeeProject;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index')->with(['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('projects.create')->with(['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);

        $company = Project::where('name', $request->name)->first();

        if (!$company) {
            $projec = Project::create([
                'company_id' => $request->company_id,
                'name' => $request->name,
                'description' => $request->description
            ]);

            if ($projec->wasRecentlyCreated) {
                return 'The project was added successfully';
            }
        } else {
            return abort(503, 'This project Aleready exist');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $companies = Company::all();

        if ($project) {
            return view('projects.edit')->with(['project' => $project, 'companies' => $companies, 'id' => $id]);
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
            'name' => 'required',
            'description' => 'required'
        ]);

        $project = Project::where('id', $id)->first();
        $proj = Project::where('name', $request->name)->first();

        if (!$proj or $proj->name == $request->name) {
            if ($project) {
                $res = $project->update([
                    'company_id' => $request->company_id,
                    'name' => $request->name,
                    'description' => $request->description
                ]);

                if ($res) {
                    return 'The Project was added successfully';
                }
            } else {
                return abort(503, 'This Project Not exist');
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
        $project = Project::findOrFail($request->id);

        if ($project) {
            $EmployeeProject = EmployeeProject::where('project_id', $request->id)->first()->delete();

            $project = $project->delete();
            if ($project) {
                return 'The project was deleted successfully';
            }
        } else {
            return abort(503, 'This project Not Exist');
        }
    }
}
