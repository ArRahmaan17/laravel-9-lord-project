@extends('Auth/index')
@section('contentAuth')
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
                        <form method="POST" action="/authentication" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="login-username">Username</label>
                                <input id="login-username" type="text" class="form-control" name="login-username"
                                    tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Please fill in your email
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="login-password" class="control-label">Password</label>
                                    <div class="float-right">
                                        <a href="/" class="text-small text-danger">
                                            Forgot Password?
                                        </a>
                                    </div>
                                </div>
                                <input id="login-password" type="password" class="form-control" name="login-password"
                                    tabindex="2" required>
                                <div class="invalid-feedback">
                                    please fill in your password
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-lg btn-block" tabindex="4">
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
