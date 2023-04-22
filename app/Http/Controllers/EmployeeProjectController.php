<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\EmployeeProject;
use App\Models\Project;

class EmployeeProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $EmployeeProjects = EmployeeProject::all();

        return view('EmployeeProjects.index')->with(['EmployeeProjects' => $EmployeeProjects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $projects = Project::all();

        return view('EmployeeProjects.create')->with(['employees' => $employees, 'projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'project_id' => 'required'
        ]);

        $employeeProject = EmployeeProject::where('employee_id', $request->employee_id)
            ->where('project_id', $request->project_id)
            ->first();


        if (!$employeeProject) {
            $projec = EmployeeProject::create([
                'employee_id' => $request->employee_id,
                'project_id' => $request->project_id
            ]);

            if ($projec->wasRecentlyCreated) {
                return 'The project was added successfully';
            }
        } else {
            return abort(503, 'the employee already exists with this project');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = EmployeeProject::findOrFail($id);
        $employees = Employee::all();
        $projects = Project::all();

        if ($project) {
            return view('EmployeeProjects.edit')->with(['project' => $project, 'projects' => $projects, 'employees' => $employees, 'id' => $id]);
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
            'employee_id' => 'required',
            'project_id' => 'required'
        ]);

        $employeeProject = EmployeeProject::where('employee_id', $request->employee_id)
            ->where('project_id', $request->project_id)
            ->first();
        $project = EmployeeProject::find($id);

        if (!$employeeProject && $project->project_id != $request->project_id) {
            if ($project) {
                $res = $project->update([
                    'employee_id' => $request->employee_id,
                    'project_id' => $request->project_id
                ]);

                if ($res) {
                    return 'The Project was edited successfully';
                }
            } else {
                return abort(503, 'This Project Not exist');
            }
        } else {
            return abort(503, 'the employee already exists with this project');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $project = EmployeeProject::findOrFail($request->id);

        if ($project) {
            $project = $project->delete();

            if ($project) {
                return 'The project was deleted successfully';
            }
        } else {
            return abort(503, 'This project Not Exist');
        }
    }
}
