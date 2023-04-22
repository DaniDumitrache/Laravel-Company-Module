@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-3">Employee projects</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>employee</th>
                    <th>project</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($EmployeeProjects as $EmployeeProject)
                    <tr>
                        <td>{{ $EmployeeProject->id }}</td>
                        <td>{{ $EmployeeProject->employee->first_name }} {{ $EmployeeProject->employee->last_name }}</td>
                        <td>{{ $EmployeeProject->project->name }}</td>
                        <td>
                            <!-- Buttons to edit and delete the company -->
                            <a href="{{ route('employees.projects.edit', $EmployeeProject->id) }}"
                                class="btn btn-sm btn-primary">Edit</a>
                            <button type="submit" id="delete" data-id="{{ $EmployeeProject->id }}"
                                class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Button to create a new company -->
        <a href="{{ route('employees.projects.create') }}" class="btn btn-primary">Create Company</a>
    </div>
    <script>
        $('[id=delete]').click(function(e) {
            e.preventDefault();
            id = $(this).attr("data-id");

            axios({
                method: "POST",
                url: "{{ route('api.employees.projects.delete') }}",
                params: {
                    'id': id
                },
            }).then((res) => {
                Alert(res.data, 'success')
                if (res.statusText == 'OK') {
                    this.parentElement.parentElement.remove()
                }
            }).catch((err) => {
                Alert(err.response.data.message, 'danger')
            });
        });
    </script>
@endsection
