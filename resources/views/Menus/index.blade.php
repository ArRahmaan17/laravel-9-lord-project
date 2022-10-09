@extends('layouts.app', ['title' => 'Add Menus SideBar']);

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header col-12">
                <h4 class="col-10">{{ $title }}</h4>
                <a class="btn btn-success form-control" href="/add-menus">Tambah Menu</a>
            </div>
            <div class="card-body p-0">
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
                                    <a href="/edit-menu/{{ $item['menuId'] }}" class="btn btn-warning">Update</a>
                                    <form action="/delete-menu/{{ $item['menuId'] }}" method="post" class="d-inline-block">
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
                                            <a href="/edit-menu/{{ $child->id }}" class="btn btn-warning">Update</a>
                                            <form action="/delete-menu/{{ $child->id }}" method="post"
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
    {{-- <script>
        $("#add-menu").click(function() {
            alert("coba");
            let uri = `/insert-menu`;
            let addMenu = requestAjax(uri, "POST", "")
        })
    </script> --}}
@endsection
