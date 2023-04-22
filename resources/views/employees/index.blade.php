@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h1 class="mb-3">Employees</h1>
            <a class="btn btn-sm btn-primary d-flex align-items-center"
                href="{{ route('employees.projects.index') }}">employee projects</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>company</th>
                    <th>first name</th>
                    <th>last name</th>
                    <th>email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through all companies from the database -->
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->company->name }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            <!-- Buttons to edit and delete the company -->
                            @if ($employee->id != Auth::user()->id)
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <button type="submit" id="delete" data-id="{{ $employee->id }}"
                                    class="btn btn-sm btn-danger">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Button to create a new company -->
        <a href="{{ route('employees.create') }}" class="btn btn-primary">Create Company</a>
    </div>
    <script>
        $('[id=delete]').click(function(e) {
            e.preventDefault();
            id = $(this).attr("data-id");

            axios({
                method: "POST",
                url: "{{ route('api.employees.delete') }}",
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
