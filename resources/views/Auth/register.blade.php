@extends('Auth/index')
@section('contentAuthentication')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="https://cdn3.iconfinder.com/data/icons/race-1-color-with-outline/300/Racing_circuit-512.png"
                        alt="logo" width="100" class="shadow-light rounded-circle">
                </div>
                <div class="card card-danger">
                    <div class="card-header">
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <div id="register-errors-alert" class="container-fluid p-0 m-0 collapse">
                            <div class="alert alert-danger alert-has-icon collapse">
                                <div class="alert-icon "><i style="font-size: 30px" class="fa fa-warning"></i>
                                </div>
                                <div class="alert-body">
                                    <div class="alert-title text-capitalize"></div>
                                    <span class="list-errors"></span>
                                </div>
                            </div>
                        </div>
                        <form method="POST" id="register-form" url="{{ url('/create-user') }}" class="needs-validation"
                            novalidate="">
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input id="name" type="text" class="form-control" id="register-name">
                                <div class="invalid-feedback">
                                    Please fill in your username and try again.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="text" class="form-control" id="register-email">
                                <div class="invalid-feedback">
                                    Please fill in your email and try again.
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" id="register-password">
                                <div class="invalid-feedback">
                                    Please fill in your password and try again.
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-danger btn-lg btn-block" id="register-button">Register
                                    Your Account</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-5 text-muted text-center">
                    Get <a href="/">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptAuthentication')
    <script>
        $(document).ready(function() {
            let isInvalidRequiredRegistrationsInputs = $('form').find('.form-control');
            isInvalidRequiredRegistrationsInputs.each(function() {
                $(this).keyup(function(e) {
                    if ($(this).val() != '') {
                        $(this).removeClass('is-invalid')
                    }
                });
            });
        })
        let _token = $(document).find('meta[name="csrf-token"').attr('content');
        $("#register-button").click(() => {
            let url = $("#register-form").attr('url');
            let payload = {};
            let valid = true;
            payload['_token'] = _token;
            let requiredRegistrationsInputs = $('form').find('.form-control');
            requiredRegistrationsInputs.each(function() {
                if ($(this).val() != '') {
                    payload[$(this).attr('id')] = $(this).val();
                } else {
                    $(this).addClass('is-invalid')
                    valid = false;
                }
            });
            if (valid) {
                $.ajax({
                    url: url,
                    async: false,
                    method: 'POST',
                    data: {
                        ...payload
                    },
                    dataType: 'JSON',
                    success: (data) => {},
                    error: data => {
                        $("#register-errors-alert").removeClass('collapse')
                        $(".alert-title").append(data.responseJSON.message);
                        Object.values(data.responseJSON.errors).map((value, index) => {
                            $('.list-errors').append(value[0] +
                                '<br>');
                        });
                    }
                });
            }
        });
    </script>
@endsection
