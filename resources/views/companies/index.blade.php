@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-3">companies</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Number of Employees</th>
                    <th>Number of Projects</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through all companies from the database -->
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $projectCount }}</td>
                        <td>{{ $employeeCount }}</td>                        <td>
                            <!-- Buttons to edit and delete the company -->
                            @if (Auth::user()->company_id != $company->id)
                                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <button type="submit" id="delete" data-id="{{ $company->id }}"
                                    class="btn btn-sm btn-danger">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Button to create a new company -->
        <a href="{{ route('companies.create') }}" class="btn btn-primary">Create Company</a>
    </div>
    <script>
        $('[id=delete]').click(function(e) {
            e.preventDefault();
            id = $(this).attr("data-id");

            axios({
                method: "POST",
                url: "{{ route('api.companies.delete') }}",
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
