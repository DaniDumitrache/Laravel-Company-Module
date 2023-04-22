@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Company') }}</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <input id="name" type="text" class="form-control" name="name"
                                            value="{{ $company->name }}" required autocomplete="name" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address"
                                            class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                        <input id="address" type="text" class="form-control" name="address"
                                            value="{{ $company->address }}" required autocomplete="address" autofocus>
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
                url: "{{ route('api.companies.edit', $id) }}",
                params: params,
            }).then((res) => {
                Alert(res.data, 'success')
            }).catch((err) => {
                Alert(err.response.data.message, 'danger')
            });
        });
    </script>
@endsection
