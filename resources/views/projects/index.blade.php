@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <h1 class="mb-3">projects</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>company</th>
                    <th>name</th>
                    <th>description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through all companies from the database -->
                @foreach ($projects as $project)
                
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->company->name }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ $project->description }}</td>
                        <td>
                            <!-- Buttons to edit and delete the company -->
                            <a href="{{ route('companies.edit', $project->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <button type="submit" id="delete" data-id="{{ $project->id }}"
                                class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Button to create a new company -->
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Create Company</a>
    </div>
    <script>
        $('[id=delete]').click(function(e) {
            e.preventDefault();
            id = $(this).attr("data-id");

            axios({
                method: "POST",
                url: "{{ route('api.projects.delete') }}",
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
