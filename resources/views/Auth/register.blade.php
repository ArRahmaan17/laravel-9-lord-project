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
                        <h4>Register</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/create-user" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="name">Username</label>
                                <input id="name" type="text" value="{{ \Session::get('name') ?? '' }}"
                                    class="form-control {{ \Session::get('name') ? 'is-invalid' : '' }}" name="name"
                                    tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                    Please Check your username
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="text"
                                    class="form-control {{ \Session::get('email') ? 'is-invalid' : '' }}"
                                    value="{{ \Session::get('email') ?? '' }}" name="email" tabindex="1" required
                                    autofocus>
                                <div class="invalid-feedback">
                                    Please Check your email
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password" tabindex="1"
                                    required autofocus>
                                <div class="invalid-feedback">
                                    Please Check your password
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger btn-lg btn-block" tabindex="4">
                                    Register
                                </button>
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
