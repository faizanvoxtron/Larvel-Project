@extends('layouts.admin.app')
@section('page_header')
    All {{ Str::plural($module_name) }}
@endsection
@push('css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}
@endpush
@section('content')
    <div class="container my-3">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-header with-border">
                        <div class="d-flex justify-content-start">
                            <a href="{{ route($folder_name . '-add') }}"
                                class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer">
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
                                    <th class="">Name</th>
                                    <th class="">Email Domain</th>
                                    <th class="">Agents</th>
                                    <th class="">Can Login</th>
                                    <th class="">Status</th>
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
                                        <td> {{ $result->name }}</td>
                                        <td> {{ $result->email_domain }}</td>
                                        <td> {{ $result->agents->count() }}</td>
                                        <td>
                                            @if ($result->can_login)
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

                                            <a class="btn-success btn-sm btn cursor-pointer"
                                                href="{{ route($folder_name . '-edit', ['id' => $result->e_id]) }}">
                                                <i class="icon-edit"></i> </a>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
    <script></script>
@endpush
