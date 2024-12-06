@extends('layouts.admin.app')
@section('page_header')
    All Customer Export Batches
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



                        </div>
                    </div>
                    <div class="box-header with-border">
                        <div class="d-flex justify-content-start">


                        </div>
                    </div>
                    <form method="post">
                        <table id="" class="table table-bordered table-hover datatable" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="">Filename</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="">

                                @foreach ($result as $key => $result)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td> {{ $result->filename }}</td>

                                        <td>
                                            @can('export-customer')
                                                <a class="btn-success btn-sm btn cursor-pointer" {{-- href="{{ route('customer_exports-download', ['export_id' => $result->e_id]) }}" --}}
                                                    href="{{ asset('storage/' . $result->path) }}" download>
                                                    <i class="icon-download"></i> </a>
                                            @endcan
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
