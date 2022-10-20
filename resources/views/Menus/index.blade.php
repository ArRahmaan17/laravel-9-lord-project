@extends('layouts.app', ['title' => 'Add Menus SideBar']);

@section('content')
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-create-new-menu">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="bg-dark p-0 m-0" action="{{ route('menus.store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label class="text-light">Name Of Your Menu </label>
                                    <input type="text" name="menu-name" class="form-control">
                                    <div class="valid-feedback">
                                        Good job!
                                    </div>
                                    <div class="invalid-feedback">
                                        Oh no! Email is invalid.
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="text-light">Order Of Your Menu</label>
                                    <input type="text" name="menu-order" value="{{ $lastMenuOrdered }}" readonly
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <label class="text-light">Route Of Your Menu</label>
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
                                    <label class="text-light">Parent Of Your Menu</label>
                                    <select name="parent-menu" class="select2" style="width: 100%">
                                        <option value="0" selected='true'></option>
                                        @foreach ($navbar as $menu)
                                            <option value="{{ $menu['menuId'] }}">{{ $menu['menuName'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="text-light">Icon Of Your Menu</label><br>
                                    <select name="icon-menu" class="select2" style="width: 100%">
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
                            <label class="text-light">Your Menu Describtion</label>
                            <textarea class="form-control" name="desc-menu"></textarea>
                            <div class="invalid-feedback">
                                Oh no! You entered an inappropriate word.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer br bg-dark">
                        <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">Close</button>
                        <button type="button" onclick="saveMenus()" class="btn btn-primary text-dark">Save Menus</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header col-12">
                <h4 class="col-10">{{ $title }}</h4>
                {{-- <a class="btn btn-success form-control" href="{{ route('menus.create') }}">Tambah Menu</a> --}}
                <a class="btn btn-success form-control" onclick="addNewMenu()">Tambah Menu</a>
            </div>
            <div class="card-body p-0">
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ Session::get('message') }}
                        </div>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <tr>
                            <th class="col-1">#</th>
                            <th class="col-2">Nama</th>
                            <th class="col-2">Icon</th>
                            <th class="col-3">Keterangan</th>
                            <th class="col-2">Status</th>
                            <th class="col-2">Action</th>
                        </tr>
                        @foreach ($navbar as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['menuName'] }}</td>
                                <td><i class="{{ $item['menuIcon'] }}"></i></td>
                                <td>{{ $item['menuDesc'] ?? "don't have a caption yet" }}</td>
                                <td>
                                    @if ($item['menuStatus'] == 1)
                                        <div class="badge badge-success">Active</div>
                                    @else
                                        <div class="badge badge-danger">Not Active</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('menus.show', $item['menuId']) }}" class="btn btn-warning">Update</a>
                                    <form action="{{ route('menus.destroy', $item['menuId']) }}" method="post"
                                        class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @if (!empty(json_decode($item['menuChild'])))
                                @foreach (json_decode($item['menuChild']) as $child)
                                    <tr>
                                        <td></td>
                                        <td>{{ $child->name }}</td>
                                        <td><i class="{{ $child->icon }}"></i></td>
                                        <td>{{ $child->description != '' ? $child->description : "don't have a caption yet" }}
                                        </td>
                                        <td>
                                            @if ($child->currentStatus == 1)
                                                <div class="badge badge-success">Active</div>
                                            @else
                                                <div class="badge badge-danger">Not Active</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('menus.update', $child->id) }}"
                                                class="btn btn-warning">Update</a>
                                            <form action="{{ route('menus.destroy', $child->id) }}" method="post"
                                                class="d-inline-block">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1 <span
                                    class="sr-only">(current)</span></a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function addNewMenu() {
            $("#modal-create-new-menu").modal('show');
        }

        function saveMenus() {
            let requiredInput = $("#modal-create-new-menu").find('input.form-control');
            let requiredSelect = $("#modal-create-new-menu").find('select.select2');
            let valid = 1
            let payload = {}
            let requiredInput = [
                'menu-order',
                'parent-menu',
            ]
            requiredInput.each(function() {
                if ($(this).val() == "") {
                    toastError($(this).attr('name').split('-').join(" ") + " must be not null");
                    valid = 0
                } else {
                    payload[$(this).attr('name')] = $(this).val();
                }
            });
            requiredSelect.each(function() {
                if ($(this).val() == 0) {
                    toastError($(this).attr('name').split('-').join(" ") + " must be not null");
                    valid = 0
                } else {
                    payload[$(this).attr('name')] = $(this).val();
                }
            });
            // if (valid == 0) {
            //     $.ajax({
            //         url: {{ route('menus.store') }},
            //         type: "POST",
            //         data: {
            //             ...payload
            //         }
            //     })
            // }
        }
    </script>
@endsection
