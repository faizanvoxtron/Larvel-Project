@extends('layouts.admin.app')
@section('page_header')
    All {{ Str::plural($module_name) }}
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="my-3">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-12">


                    <div class="row my-3">

                        <div class="col-4">
                            <label for="response">Response</label>
                            <select name="response" id="response" class="form-control">
                                <option value="">All</option>
                                <option>Allowed</option>
                                <option>Not Allowed</option>
                                <option>Invalid Number</option>
                            </select>
                        </div>

                    </div>

                    <form method="post" action="{{ route($folder_name . '-view') }} ">
                        @csrf
                        {{-- <table id="" class="table table-bordered table-hover datatable" style="width:100%;"> --}}
                        <table id="yajra" class="table table-bordered table-hover " style="width:100%;">
                            <thead>
                                <tr>
                                    <th width=" 10px">#</th>
                                    <th class="">Source IP</th>
                                    <th class="">Number Used</th>
                                    <th class="">Response</th>
                                    <th class="">Requested On</th>
                                </tr>
                            </thead>
                            <tbody class="">

                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
        moment().format();


        search_start();

        // $('#response').keyup(function() {
        //     search_start();
        // })

        $('#response').change(function() {
            search_start();
        })


        function search_start() {
            if ($.fn.DataTable.isDataTable("#yajra")) $("#yajra").DataTable().destroy();
            //Start getting filters

            let response = $('#response').val();

            $('#yajra').DataTable({
                lengthMenu: [
                    [10, 20, 30, 40, 50, 100, 1000, 5000, -1],
                    [10, 20, 30, 40, 50, 100, 1000, 5000, 'All']
                ],
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('phone_validation_logs-fetch') }}",
                    type: "GET",
                    data: {
                        filter: "{{ app('request')->input('q') }}",
                        response,
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    // $(row).attr('class', 'data-row click_detail');
                    // $(row).attr('data-id', data.id);
                    // console.log(row,data);
                },
                columnDefs: [{
                    targets: "noSort",
                    orderable: false
                }, ],
                columns: [{
                        render: function(data, type, row, index) {
                            return index.row + 1;
                        },
                    },
                    {
                        data: 'source_ip'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'response',
                        render: function(data, type, row) {
                            if (data == 'Allowed') {
                                return '<span class="badge p-2 badge-success">Allowed</span>';
                            } else if(data == 'Not Allowed') {
                                return '<span class="badge p-2 badge-danger">Not Allowed</span>';
                            }else{
                                return '<span class="badge p-2 badge-warning">Invalid Number</span>';
                            }
                        }
                    },

                    {
                        data: "created_at",
                        render: function(data, type, row, index) {
                            return moment(data).format('llll');
                        }
                    }

                ],
                "drawCallback": function(settings) {
                    //   $('#search-result-div').show();
                    //   $('#search-overlay').hide();
                    //   initShowDetailsMethod();
                } //end drawcallback
            });
        }


        $('#yajra_filter').children().children().val("{{ app('request')->input('search') }}")
        $('#yajra_filter').children().children().trigger("keyup");
    </script>
@endpush
