@extends('layouts.admin.app')
@section('page_header')
    All {{ Str::plural($module_name) }}
@endsection
@section('content')
    <div class="container my-3">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-header with-border">
                        <div class="d-flex justify-content-start">
                            <a href="{{ route($folder_name . '-add') }}" class="btn-success btn-sm btn mb-2 cursor-pointer">
                                <i class=" icon-add"></i>
                                Add New
                            </a>
                        </div>
                    </div>
                    <form method="post" action="{{ route($folder_name . '-view') }} ">
                        @csrf
                        <table id="" class="table table-bordered table-hover datatable" style="width:100%;">
                            <thead>
                                <tr>
                                    <th width=" 10px">#</th>
                                    <th class="">Identifier</th>
                                    <th class="">Ip Address</th>
                                    <th width="150px">Primary</th>
                                    <th width="150px">Status</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="">

                                @foreach ($result as $key => $result)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="sequence[]" value="{{ $result->id }}">
                                            {{ $key + 1 }}
                                        </td>
                                        <td> {{ $result->identifier }}</td>
                                        <td> {{ $result->ip }}</td>
                                        <td>
                                            @if ($result->is_primary)
                                                <span class="badge p-2 badge-success">Yes</span>
                                            @else
                                                <span class="badge p-2 badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($result->status)
                                                <span class="badge p-2 badge-success">Enable</span>
                                            @else
                                                <span class="badge p-2 badge-danger">Disable</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn-primary btn-sm btn cursor-pointer"
                                                href="{{ route($folder_name . '-edit', ['id' => $result->e_id]) }}"> <i
                                                    class="icon-edit"></i> </a>

                                            <a class="btn-danger btn-sm btn cursor-pointer deleteIp"
                                                href="{{ route($folder_name . '-delete', ['id' => $result->e_id]) }}"> <i
                                                    class="icon-trash"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- <button type="submit" class="btn btn-sm mb-2 btn-success">
                            Update sequence
                        </button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.deleteIp').on('click', function(event) {
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
