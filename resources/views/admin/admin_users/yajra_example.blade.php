@extends('layouts.admin.app')
@section('page_header')
    All Users
@endsection
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
                        </div>
                    </div>
                    <table id="yajra" class="table table-bordered table-hover  " style="width:100%;">
                        <thead>
                            <tr>
                                <th width=" 10px">#</th>
                                <th width="200px">Image</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    <script>
        search_start();

        $('#search_verified').change(function() {
            search_start();
        })

        $('#search_status').change(function() {
            search_start();
        })


        function search_start() {
            if ($.fn.DataTable.isDataTable("#yajra")) $("#yajra").DataTable().destroy();
            //Start getting filters

            let verified = $('#search_verified').val();
            let status = $('#search_status').val();

            $('#yajra').DataTable({
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin_users-fetch') }}",
                    type: "GET",
                    data: {
                        filter: "{{ app('request')->input('q') }}",
                        verified: verified,
                        status: status,
                    }
                },
                createdRow: function(row, data, dataIndex) {
                    // $(row).attr('class', 'data-row click_detail');
                    // $(row).attr('data-id', data.id);
                    // console.log(row,data);
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row, index) {
                            return index.row + 1;
                        }
                    },
                    {
                        render: function(data, type, row, index) {
                            return " <img style='width:50px; height:40px;' src='" + row.image_url + "' >";
                        }
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'role.name'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'email'
                    },

                    {
                        data: 'status',
                        render: function(data, type, row) {
                            if (row.status == 1) {
                                return '<span class="badge p-2 badge-success">Enable</span>';
                            } else {
                                return '<span class="badge p-2 badge-danger">Disabled</span>';
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            let e_url = ("{{ route('admin_users-edit', ['id' => '-id-']) }}").replace(
                                '-id-', row.e_id);
                            let d_url = ("").replace('-id-', row.e_id);
                            return `<a class="cst_btn-outline btn-sm cursor-pointer" href="${e_url}"> <i class="icon-edit"></i> </a>`;
                        }
                    },

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
