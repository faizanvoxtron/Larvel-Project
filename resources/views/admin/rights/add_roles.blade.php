@extends('layouts.admin.app')

@push('css')
@endpush
@section('page_header')
    @if ($role)
        Update Role
    @else
        Add Role
    @endif
@endsection
@section('content')
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-12">
                    <form method="POST" class="needs-validation" enctype="multipart/form-data" novalidate
                        @if ($role) action="{{ route('role.update', ['role' => $role]) }}" @else action="{{ route('role.create') }}" @endif>
                        @csrf
                        <div class="box_border">
                            <div class="">
                                <div class="">
                                    <div class="form-row">
                                        <div class="form-group col-md-12 m-0">
                                            <h5 class="box_heading">Role Information</h5>
                                            <label for="name" class="col-form-label s-12">
                                                Name
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="name" required
                                                class="form-control r-0 light s-12 " id="name"
                                                placeholder="Enter Role name"
                                                @if ($role && $role->is_system_default) readonly @endif
                                                @if ($role) value="{{ $role->name }}" @endif>
                                            @error('name')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-12 m-0">
                                            <label for="role_select" class="col-form-label s-12">Select Role to Auto-Select
                                                Permissions</label>
                                            <select id="role_select" class="form-control">
                                                <option value="">Select a Role</option>
                                                @foreach ($all_roles_with_permissions as $r)
                                                    <option value="{{ $r['id'] }}">{{ $r['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12 m-0">
                                            <label for="name" class="col-form-label mt-3 s-12">
                                                Select Permissions
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="form-group">
                                                <div class="form-check">


                                                    {{-- @if ($role)
                                                @foreach ($role->permissions as $key => $item)

                                                <label class="form-check-label" for="permission{{ $key }}">
                                                <input class="form-check-input" name="permissions[]" id="permission{{ $key }}" type="checkbox" value="{{ $item->id }}" checked> {{ $item->name }}
                                                </label><br>
                                                @endforeach
                                                @endif
                                                @foreach ($permissions as $key => $permission)

                                                <label class="form-check-label" for="permission{{ $key }}">
                                                    <input class="form-check-input" name="permissions[]" id="permission{{ $key }}" type="checkbox" value="{{ $permission->id }}"> {{ $permission->name }}
                                                </label><br>

                                                @endforeach --}}
                                                    {{-- @if (count($selected_permission)) --}}
                                                    @foreach ($permissions as $key => $permission)
                                                        <div class="parent">
                                                            <input type="checkbox" name="permissions[]"
                                                                @if (in_array($permission->id, $selected_permission)) checked @endif
                                                                value="{{ $permission->id }}" id="{{ $permission->id }}" />
                                                            <label for="{{ $permission->id }}"
                                                                class="text-strong font-weight-bold">
                                                                {{ $permission->name }}
                                                                {{-- ({{ $permission->slug }}) --}}
                                                                @if (!empty($permission->description))
                                                                    <img src="{{ asset('admin/img/info-icon.png') }}"
                                                                        data-toggle="tooltip" data-placement="right"
                                                                        title="{{ $permission->description }}"
                                                                        class="cursor-pointer" style="width: 18px;">
                                                                @endif
                                                            </label>
                                                        </div>
                                                        <div>
                                                            <ul class="child">
                                                                @foreach ($permission->child as $key => $child)
                                                                    <li class="ml-2"> <input type="checkbox"
                                                                            @if (in_array($child->id, $selected_permission)) checked @endif
                                                                            name="permissions[]"
                                                                            value="{{ $child->id }}"
                                                                            id="{{ $child->id }}" /><label
                                                                            for="{{ $child->id }}">{{ $child->name }}
                                                                            {{-- ({{ $child->slug }}) --}}
                                                                        </label>
                                                                        @if (!empty($child->description))
                                                                            <img src="{{ asset('admin/img/info-icon.png') }}"
                                                                                data-toggle="tooltip" data-placement="right"
                                                                                title="{{ $child->description }}"
                                                                                class="cursor-pointer" style="width: 18px;">
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endforeach
                                                    {{-- @endif --}}
                                                </div>
                                            </div>
                                            @error('name')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="px-0">
                            <button type="submit" class="cst_btn px-5 btn-sm">
                                {{-- <i class="icon-save mr-2"></i> --}}
                                @if ($role)
                                    Update Role
                                @else
                                    Add Role
                                @endif
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    @endsection


    {{-- @push('scripts')
        <script>
            $(".parent input").on('click', function() {
                var _parent = $(this);
                var nextli = $(this).parent().next().children().children();

                if (_parent.prop('checked')) {
                    console.log('parent checked');
                    nextli.each(function() {
                        $(this).children().prop('checked', true);
                    });

                } else {
                    console.log('parent un checked');
                    nextli.each(function() {
                        $(this).children().prop('checked', false);
                    });

                }
            });

            $(".child input").on('click', function() {

                var ths = $(this);
                var parentinput = ths.closest('div').prev().children();
                var sibblingsli = ths.closest('ul').find('li');

                if (ths.prop('checked')) {
                    console.log('child checked');
                    parentinput.prop('checked', true);
                } else {
                    console.log('child unchecked');
                    var status = true;
                    sibblingsli.each(function() {
                        console.log('sibb');
                        if ($(this).children().prop('checked')) status = false;
                    });
                    // if (status) parentinput.prop('checked', false);
                }
            });
        </script>
    @endpush --}}


    @push('scripts')
    <script>
        const allRolesWithPermissions = @json($all_roles_with_permissions);

        $("#role_select").on('change', function() {
            const selectedRoleId = $(this).val();
            const selectedRole = allRolesWithPermissions.find(role => role.id == selectedRoleId);

            $("input[name='permissions[]']").prop('checked', false); // Uncheck all checkboxes

            if (selectedRole) {
                selectedRole.permissions.forEach(permissionId => {
                    $("input[name='permissions[]'][value='" + permissionId + "']").prop('checked', true);
                });
            }
        });

        $(".parent input").on('click', function() {
            var _parent = $(this);
            var nextli = $(this).parent().next().children().children();

            if (_parent.prop('checked')) {
                console.log('parent checked');
                nextli.each(function() {
                    $(this).children().prop('checked', true);
                });
            } else {
                console.log('parent un checked');
                nextli.each(function() {
                    $(this).children().prop('checked', false);
                });
            }
        });

        $(".child input").on('click', function() {
            var ths = $(this);
            var parentinput = ths.closest('div').prev().children();
            var sibblingsli = ths.closest('ul').find('li');

            if (ths.prop('checked')) {
                console.log('child checked');
                parentinput.prop('checked', true);
            } else {
                console.log('child unchecked');
                var status = true;
                sibblingsli.each(function() {
                    console.log('sibb');
                    if ($(this).children().prop('checked')) status = false;
                });
                if (status) parentinput.prop('checked', false);
            }
        });
    </script>
@endpush
