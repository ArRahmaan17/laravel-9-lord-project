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
                        <h4>Login</h4>
                    </div>
                    <div class="card-body">
                        <div id="login-errors-alert" class="container-fluid p-0 m-0 collapse">
                            <div class="alert alert-danger alert-has-icon">
                                <div class="alert-icon "><i style="font-size: 25px" class="fa fa-warning"></i>
                                </div>
                                <div class="alert-body">
                                    <div class="alert-title text-capitalize"></div>
                                    <span class="list-errors"></span>
                                </div>
                            </div>
                        </div>
                        <form url="{{ url('/authentication') }}" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input type="text" class="form-control" id="name" tabindex="1" autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                    <div class="float-right">
                                        <a href="/" class="text-small text-danger">
                                            Forgot Password?
                                        </a>
                                    </div>
                                </div>
                                <input type="password" class="form-control" id="password" tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-lg btn-block" id="login-button"
                                    tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-5 text-muted text-center">
                    Don't have an account? <a href="/register">Create One</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptAuthentication')
    <script>
        $(document).ready(function() {
            let _token = $(document).find('meta[name="csrf-token"]').attr('content');
            $("form").submit(function(e) {
                e.preventDefault();
                let url = $("form").attr('url');
                let payload = {};
                payload['_token'] = _token;
                requiredLoginInput = $('form').find('.form-control');
                requiredLoginInput.each(function() {
                    payload[$(this).attr('id')] = $(this).val();
                });
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        ...payload
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response)
                        // if () {}
                    },
                    error: function(error) {
                        $("#login-errors-alert").removeClass('collapse')
                        $(".alert-title").append(error.responseJSON.message);
                        Object.values(error.responseJSON.errors).map((value) => {
                            $('span.list-errors').append(value[0] + '<br>');
                        });
                    }
                });
            });
        });
    </script>
@endsection
