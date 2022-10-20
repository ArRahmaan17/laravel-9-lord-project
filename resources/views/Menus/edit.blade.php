@extends('layouts.app', ['title' => 'Add Menus SideBar']);

@section('content')
    <div class="card">
        <form action="{{ route('menus.update', $menu->id) }}" method="POST" autocomplete="off">
            @method('put')
            @csrf
            <div class="card-header">
                <h4 class="col-11">{{ $title }} - {{ $menu->name }}</h4>
                <a class="btn btn-info form-control" href="{{ route('menus.index') }}">Back</a>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label>Your Menu Name</label>
                            <input type="text" value="{{ $menu->name }}" name="menu-name" class="form-control">
                            <div class="valid-feedback">
                                Good job!
                            </div>
                            <div class="invalid-feedback">
                                Oh no! Email is invalid.
                            </div>
                        </div>
                        <div class="col-6">
                            <label>Your Menu Name</label>
                            <input type="text" name="menu-order" value="{{ $lastMenuOrdered }}" readonly
                                class="form-control">
                            <div class="valid-feedback">
                                Good job!
                            </div>
                            <div class="invalid-feedback">
                                Oh no! Email is invalid.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label>Your Menu Route</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-route"></i>
                                        </div>
                                    </div>
                                    <input type="text" value="{{ $menu->route }}" name="menu-route"
                                        class="form-control">
                                    <div class="valid-feedback">
                                        Good job!
                                    </div>
                                    <div class="invalid-feedback">
                                        Oh no! Email is invalid.
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label>Your Parent Menu</label>
                                <select name="parent-menu" {{ $menu->isParent ? 'disabled' : '' }}
                                    class="form-control select2">
                                    <option value="0">0</option>
                                    @foreach ($navbar as $item)
                                        @if ($menu->parentId == $item['menuId'])
                                            <option value="{{ $item['menuId'] }}" selected='true'>{{ $item['menuName'] }}
                                            </option>
                                        @else
                                            <option value="{{ $item['menuId'] }}">{{ $item['menuName'] }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Your Icon Menu</label>
                                <select name="icon-menu" class="form-control select2">
                                    <option value="0">0</option>
                                    @foreach (json_decode($icons) as $icon)
                                        <option value="{{ $icon->id }}"
                                            {{ $menu->icon == 'fas ' . $icon->name ? "selected = 'true'" : '' }}>
                                            {{ $icon->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <label>Your Menu Describtion</label>
                        <textarea class="form-control" name="desc-menu">{{ $menu->description }}</textarea>
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
@endsection
