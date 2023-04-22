@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Project') }}</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company_id">Company</label>

                                        <select class="form-control" id="company_id" name="company_id">
                                            <option value="">Select a company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ $project->company_id == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>


                                        <input id="name" type="text" class="form-control" name="name"
                                            value="{{ $project->name }}" required autocomplete="name" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address"
                                            class="col-md-4 col-form-label text-md-right">{{ __('description') }}</label>


                                        <input id="description" type="text" class="form-control" name="description"
                                            value="{{ $project->description }}" required autocomplete="description"
                                            autofocus>
                                    </div>
                                </div>


                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" id="edit" class="btn btn-primary">
                                        {{ __('Edit') }}
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
        $('#edit').click(function(e) {
            e.preventDefault()
            var params =
                Object.fromEntries(
                    new URLSearchParams(
                        $('form').serialize()
                    )
                )

            axios({
                method: "POST",
                url: "{{ route('api.projects.edit', $id) }}",
                params: params,
            }).then((res) => {
                Alert(res.data, 'success')
            }).catch((err) => {
                Alert(err.response.data.message, 'danger')
            });
        });
    </script>
@endsection
