@extends('layouts.admin.app')
@section('page_header')
    All Users
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .accordion-toggle {
            cursor: pointer;
        }

        .hiddenRow {
            padding: 0 !important;
        }
    </style>
@endpush
@section('content')
    <div class="container my-3">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-header with-border">
                        <div class="row pr-4 justify-content-end ">
                            <a href="{{ route('admin_users-add') }}" class="cst_btn-outline btn-sm mb-2">
                                <i class=" icon-add"></i>
                                Add New
                            </a>
                            {{-- <a href="#" class="cst_btn-outline btn-sm mb-2 ml-2 upload_users">
                                <i class=" icon-upload"></i>
                                Upload
                            </a> --}}

                            <a href="{{ route('admin_users-force_logout') }}"
                                class="cst_btn-outline btn-danger btn-sm mb-2 ml-2" id="logoutAll">
                                <i class=" icon-power-off"></i>
                                Logout agents
                            </a>
                        </div>

                    </div>
                    {{-- <table id="" class="table table-bordered table-hover" style="width:100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Online</th>
                                <th>Multi Device Login</th>
                                <th>Status</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">

                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td></td>
                                    <td></td>
                                    <td><b>{{ $role->name }}</b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    @foreach ($role->users as $user_key => $user)
                                <tr>
                                    <td>{{ $user_key + 1 }}</td>
                                    </td>
                                    <td> {{ $user->name }}</td>
                                    <td> {{ $user->phone }}</td>
                                    <td> {{ $user->email }}</td>
                                    <td>
                                        @if ($user->is_online)
                                            <b class="text p-2 text-success">Online</b>
                                        @else
                                            <b class="text p-2 text-danger">Offline</b>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->multi_device_login)
                                            <span class="badge p-2 badge-success">Yes</span>
                                        @else
                                            <span class="badge p-2 badge-danger">No</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($user->status)
                                            <span class="badge p-2 badge-success">Enable</span>
                                        @else
                                            <span class="badge p-2 badge-danger">Disable</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn-success btn-sm btn cursor-pointer" data-toggle="tooltip"
                                            data-placement="top" title="Edit"
                                            href="{{ route('admin_users-edit', ['id' => $user->e_id]) }}">
                                            <i class="icon-edit"></i> </a>

                                        @can('view-user-reports')
                                            <a class="btn-warning btn-sm btn cursor-pointer" data-toggle="tooltip"
                                                data-placement="top" title="Reports"
                                                href="{{ route('admin_users-reports', ['id' => $user->e_id]) }}">
                                                <i class="icon-report"></i> </a>
                                        @endcan

                                        <a class="btn-danger btn-sm btn cursor-pointer" data-toggle="tooltip"
                                            data-placement="top" title="Logout"
                                            href="{{ route('admin_users-force_logout', ['id' => $user->id]) }}">
                                            <i class="icon-power-off"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table> --}}

                    {{-- 
                    <table id="" class="table table-bordered table-hover" style="width:100%;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Online</th>
                                <th>Multi Device Login</th>
                                <th>Status</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach ($roles as $roleKey => $role)
                                <tr data-toggle="collapse" data-target="#role-{{ $roleKey }}" class="accordion-toggle">
                                    <td>{{ $roleKey + 1 }}</td>
                                    <td colspan="7"><b>{{ $role->name }}</b></td>
                                </tr>
                                <tr>
                                    <td colspan="8" class="hiddenRow">
                                        <div class="accordian-body collapse p-3" id="role-{{ $roleKey }}">
                                            <table class="table table-bordered table-hover">
                                                @if ($role->id == \App\Models\User::AGENT_ROLE)
                                                    <!-- Replace 'Agent' with User::AGENT_ROLE if it's a constant -->
                                                    @foreach ($role->users->groupBy('office_id') as $officeId => $users)
                                                        <thead data-toggle="collapse"
                                                            data-target="#office-{{ $roleKey }}-{{ $officeId }}"
                                                            class="accordion-toggle">
                                                            <tr>
                                                                <td colspan="8" class="p-3"><b>
                                                                        {{ $users->first()->office->name ?? 'Primary' }}
                                                                    </b></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="office-{{ $roleKey }}-{{ $officeId }}"
                                                            class="collapse">
                                                            @foreach ($users as $userKey => $user)
                                                                <tr>
                                                                    <td>{{ $userKey + 1 }}</td>
                                                                    <td>{{ $user->name }}</td>
                                                                    <td>{{ $user->phone }}</td>
                                                                    <td>{{ $user->email }}</td>
                                                                    <td>
                                                                        @if ($user->is_online)
                                                                            <b class="text p-2 text-success">Online</b>
                                                                        @else
                                                                            <b class="text p-2 text-danger">Offline</b>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($user->multi_device_login)
                                                                            <span class="badge p-2 badge-success">Yes</span>
                                                                        @else
                                                                            <span class="badge p-2 badge-danger">No</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($user->status)
                                                                            <span
                                                                                class="badge p-2 badge-success">Enable</span>
                                                                        @else
                                                                            <span
                                                                                class="badge p-2 badge-danger">Disable</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn-success btn-sm btn cursor-pointer"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Edit"
                                                                            href="{{ route('admin_users-edit', ['id' => $user->e_id]) }}">
                                                                            <i class="icon-edit"></i> </a>

                                                                        @can('view-user-reports')
                                                                            <a class="btn-warning btn-sm btn cursor-pointer"
                                                                                data-toggle="tooltip" data-placement="top"
                                                                                title="Reports"
                                                                                href="{{ route('admin_users-reports', ['id' => $user->e_id]) }}">
                                                                                <i class="icon-report"></i> </a>
                                                                        @endcan

                                                                        <a class="btn-danger btn-sm btn cursor-pointer"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Logout"
                                                                            href="{{ route('admin_users-force_logout', ['id' => $user->id]) }}">
                                                                            <i class="icon-power-off"></i> </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    @endforeach
                                                @else
                                                    @foreach ($role->users as $userKey => $user)
                                                        <tr>
                                                            <td>{{ $userKey + 1 }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                @if ($user->is_online)
                                                                    <b class="text p-2 text-success">Online</b>
                                                                @else
                                                                    <b class="text p-2 text-danger">Offline</b>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($user->multi_device_login)
                                                                    <span class="badge p-2 badge-success">Yes</span>
                                                                @else
                                                                    <span class="badge p-2 badge-danger">No</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($user->status)
                                                                    <span class="badge p-2 badge-success">Enable</span>
                                                                @else
                                                                    <span class="badge p-2 badge-danger">Disable</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a class="btn-success btn-sm btn cursor-pointer"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Edit"
                                                                    href="{{ route('admin_users-edit', ['id' => $user->e_id]) }}">
                                                                    <i class="icon-edit"></i> </a>

                                                                @can('view-user-reports')
                                                                    <a class="btn-warning btn-sm btn cursor-pointer"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Reports"
                                                                        href="{{ route('admin_users-reports', ['id' => $user->e_id]) }}">
                                                                        <i class="icon-report"></i> </a>
                                                                @endcan

                                                                <a class="btn-danger btn-sm btn cursor-pointer"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Logout"
                                                                    href="{{ route('admin_users-force_logout', ['id' => $user->id]) }}">
                                                                    <i class="icon-power-off"></i> </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}


                    @foreach ($roles as $roleKey => $role)
                        <table class="table table-bordered table-hover " style="width:100%;">
                            <thead>
                                <tr data-toggle="collapse" data-target="#role-{{ $roleKey }}" class="accordion-toggle">
                                    <th colspan="8">
                                        <b>{{ $role->name }}</b>
                                        <i class="fas fa-chevron-down float-right"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="hiddenRow collapse" id="role-{{ $roleKey }}">
                                @if ($role->id == \App\Models\User::AGENT_ROLE)
                                    @foreach ($role->users->groupBy('office_id') as $officeId => $users)
                                        <tr data-toggle="collapse"
                                            data-target="#office-{{ $roleKey }}-{{ $officeId }}"
                                            class="accordion-toggle">
                                            <td colspan="8" class="p-3">
                                                <b>{{ $users->first()->office->name ?? 'Primary' }}</b> <i
                                                    class="fas fa-chevron-down float-right"></i>
                                            </td>
                                        </tr>
                                        <tr class="hiddenRow collapse" id="office-{{ $roleKey }}-{{ $officeId }}">
                                            <td colspan="8">
                                                <table class="table table-bordered table-hover datatable">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Phone</th>
                                                            <th>Email</th>
                                                            <th>Online</th>
                                                            <th>Multi Device Login</th>
                                                            <th>Status</th>
                                                            <th width="15%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($users as $userKey => $user)
                                                            <tr>
                                                                <td>{{ $userKey + 1 }}</td>
                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->phone }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>
                                                                    @if ($user->is_online)
                                                                        <b class="text p-2 text-success">Online</b>
                                                                    @else
                                                                        <b class="text p-2 text-danger">Offline</b>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($user->multi_device_login)
                                                                        <span class="badge p-2 badge-success">Yes</span>
                                                                    @else
                                                                        <span class="badge p-2 badge-danger">No</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($user->status)
                                                                        <span class="badge p-2 badge-success">Enable</span>
                                                                    @else
                                                                        <span class="badge p-2 badge-danger">Disable</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a class="btn-success btn-sm btn cursor-pointer"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Edit"
                                                                        href="{{ route('admin_users-edit', ['id' => $user->e_id]) }}">
                                                                        <i class="icon-edit"></i>
                                                                    </a>
                                                                    {{-- @can('view-user-reports')
                                                                        <a class="btn-warning btn-sm btn cursor-pointer"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Reports"
                                                                            href="{{ route('admin_users-reports', ['id' => $user->e_id]) }}">
                                                                            <i class="icon-report"></i>
                                                                        </a>
                                                                    @endcan --}}
                                                                    <a class="btn-danger btn-sm btn cursor-pointer logoutOne"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Logout"
                                                                        href="{{ route('admin_users-force_logout', ['id' => $user->id]) }}">
                                                                        <i class="icon-power-off"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">
                                            <table class="table table-bordered table-hover datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Email</th>
                                                        <th>Online</th>
                                                        <th>Multi Device Login</th>
                                                        <th>Status</th>
                                                        <th width="15%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($role->users as $userKey => $user)
                                                        <tr>
                                                            <td>{{ $userKey + 1 }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->phone }}</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td>
                                                                @if ($user->is_online)
                                                                    <b class="text p-2 text-success">Online</b>
                                                                @else
                                                                    <b class="text p-2 text-danger">Offline</b>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($user->multi_device_login)
                                                                    <span class="badge p-2 badge-success">Yes</span>
                                                                @else
                                                                    <span class="badge p-2 badge-danger">No</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($user->status)
                                                                    <span class="badge p-2 badge-success">Enable</span>
                                                                @else
                                                                    <span class="badge p-2 badge-danger">Disable</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a class="btn-success btn-sm btn cursor-pointer"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Edit"
                                                                    href="{{ route('admin_users-edit', ['id' => $user->e_id]) }}">
                                                                    <i class="icon-edit"></i>
                                                                </a>
                                                                {{-- @can('view-user-reports')
                                                                    <a class="btn-warning btn-sm btn cursor-pointer"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Reports"
                                                                        href="{{ route('admin_users-reports', ['id' => $user->e_id]) }}">
                                                                        <i class="icon-report"></i>
                                                                    </a>
                                                                @endcan --}}
                                                                <a class="btn-danger btn-sm btn cursor-pointer logoutOne"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Logout"
                                                                    href="{{ route('admin_users-force_logout', ['id' => $user->id]) }}">
                                                                    <i class="icon-power-off"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    @endforeach



                    {{-- <button type="submit" class="btn btn-sm mb-2 btn-success">
                            Update sequence
                        </button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="upload_users_modal" tabindex="-1" role="dialog" aria-labelledby="upload_users_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload File (CSV)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('admin_users-upload') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="file" name="file" class="dropify" required data-allowed-file-extensions="csv">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script>
        $(document).on('click', '.upload_users', function(e) {
            e.preventDefault();
            $("#upload_users_modal").modal('show');
        })


        $(document).on('click', '.accordion-toggle', function() {
            var $this = $(this);
            $this.find('i.fas').toggleClass('fa-chevron-down fa-chevron-up');
        });

        $('#logoutAll').on('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1E3A5F",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = this.href; // Proceed with the redirection if confirmed
                }
            });
        });

        // Attach event listener to all elements with class 'logoutOne'
        $('.logoutOne').on('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1E3A5F",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = this.href; // Proceed with the redirection if confirmed
                }
            });
        });
    </script>
@endpush
