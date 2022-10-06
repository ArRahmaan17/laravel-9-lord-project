@extends('layouts.app', ['title' => 'Add Menus SideBar']);

@section('content')
    <div class="card">
        <form action="/insert-menu" method="POST" autocomplete="off">
            @csrf
            <div class="card-header">
                <h4>Server-side Validation</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Your Menu Name</label>
                    <input type="text" name="menu-name" class="form-control">
                    <div class="valid-feedback">
                        Good job!
                    </div>
                    <div class="invalid-feedback">
                        Oh no! Email is invalid.
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Your Menu Route</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-route"></i>
                                    </div>
                                </div>
                                <input type="text" name="menu-route" class="form-control">
                                <div class="valid-feedback">
                                    Good job!
                                </div>
                                <div class="invalid-feedback">
                                    Oh no! Email is invalid.
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label>Your Parent Menu</label>
                            <select name="parent-menu" class="form-control select2">
                                <option value="0" selected='true'>0</option>
                                @foreach ($navbar as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->id }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <label>Your Menu Describtion</label>
                    <textarea class="form-control" name="desc-menu"></textarea>
                    <div class="invalid-feedback">
                        Oh no! You entered an inappropriate word.
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
    {{-- <script>
        $("#add-menu").click(function() {
            alert("coba");
            let uri = `/insert-menu`;
            let addMenu = requestAjax(uri, "POST", "")
        })
    </script> --}}
@endsection
