<div class="modal fade" data-backdrop tabindex="-1" role="dialog" id="modal-create-new-menu">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">Add Menu Modal</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="bg-dark p-0 m-0" data-action="{{ route('menus.store') }}" method="POST" autocomplete="off">
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
                    <button type="button" onclick="saveMenus()" class="btn btn-primary text-dark">Save
                        Menus</button>
            </form>
        </div>
    </div>
</div>
