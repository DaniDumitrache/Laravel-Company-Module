@extends('layouts.app')

@section('content')
    <div class="container mt-2">
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="w-100">
                    <div class="border rounded p-1 d-flex justify-content-center w-100">
                        <a href="{{ route('companies.index') }}" class="btn btn-dark me-2">comapnies</a>
                        <a href="{{ route('employees.index') }}" class="btn btn-dark me-2">employees</a>
                        <a href="{{ route('projects.index') }}" class="btn btn-dark">projects</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
