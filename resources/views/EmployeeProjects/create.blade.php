@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Employee Project') }}</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="employee_id"
                                            class="col-md-4 col-form-label text-md-right">{{ __('employee') }}</label>

                                        <select class="form-control" id="employee_id" name="employee_id">
                                            <option value="">Select a employee</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="project_id"
                                            class="col-md-4 col-form-label text-md-right">{{ __('project') }}</label>

                                        <select class="form-control" id="project_id" name="project_id">
                                            <option value="">Select a project</option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}"
                                                    {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                                    {{ $project->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="create" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#create').click(function(e) {
            e.preventDefault()
            var params =
                Object.fromEntries(
                    new URLSearchParams(
                        $('form').serialize()
                    )
                )

            axios({
                method: "POST",
                url: "{{ route('api.employees.projects.create') }}",
                params: params,
            }).then((res) => {
                Alert(res.data, 'success')
            }).catch((err) => {
                Alert(err.response.data.message, 'danger')
            });
        });
    </script>
@endsection
