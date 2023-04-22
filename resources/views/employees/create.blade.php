@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Employee') }}</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-right">{{ __('company') }}</label>

                                        <select class="form-control" id="company_id" name="company_id">
                                            <option value="">Select a company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name"
                                            class="col-md-4 col-form-label text-md-right">{{ __('first name') }}</label>


                                        <input id="first_name" type="text" class="form-control" name="first_name"
                                            value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name"
                                            class="col-md-4 col-form-label text-md-right">{{ __('last name') }}</label>


                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                            value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-right">{{ __('email') }}</label>


                                        <input id="email" type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right">{{ __('password') }}</label>


                                        <input id="password" type="password" class="form-control" name="password"
                                            value="{{ old('password') }}" required autocomplete="password" autofocus>
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
                url: "{{ route('api.employees.create') }}",
                params: params,
            }).then((res) => {
                Alert(res.data, 'success')
            }).catch((err) => {
                Alert(err.response.data.message, 'danger')
            });
        });
    </script>
@endsection
