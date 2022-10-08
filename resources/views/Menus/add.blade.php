@extends('layouts.app', ['title' => 'Add Menus SideBar']);

@section('content')
    <div class="card">
        <form action="/insert-menu" method="POST" autocomplete="off">
            @csrf
            <div class="card-header">
                <h4 class="col-11">{{ $title }}</h4>
                <a class="btn btn-info form-control" href="/all-menus">Back</a>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Name Of Your Menu </label>
                            <input type="text" name="menu-name" class="form-control">
                            <div class="valid-feedback">
                                Good job!
                            </div>
                            <div class="invalid-feedback">
                                Oh no! Email is invalid.
                            </div>
                        </div>
                        <div class="col-6">
                            <label>Order Of Your Menu</label>
                            <input type="text" name="menu-order" value="{{ $lastMenuOrdered }}" readonly
                                class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label>Route Of Your Menu</label>
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
                        <div class="col-4">
                            <label>Parent Of Your Menu</label>
                            <select name="parent-menu" class="form-control select2">
                                <option value="0" selected='true'></option>
                                @foreach ($navbar as $menu)
                                    <option value="{{ $menu['menuId'] }}">{{ $menu['menuName'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label>Icon Of Your Menu</label>
                            <select name="parent-menu" class="form-control select2">
                                <option value="0" selected='true'>select your icon</option>
                                @foreach (json_decode($icons) as $icon)
                                    <option value="{{ $icon->id }}">
                                        {{ $icon->name }}
                                    </option>
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
