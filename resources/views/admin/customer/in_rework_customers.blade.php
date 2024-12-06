@extends('layouts.admin.app')
@section('page_header')
    All Re-work Customers
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

                            @can('download-customer')
                                <div class="dropdown">
                                    <button class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer  dropdown-toggle"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Download Selected As
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item download_selected_as_csv" href="#">.CSV</a>
                                        <a class="dropdown-item download_selected_as_txt_zip" href="#">.txt</a>
                                    </div>
                                </div>
                            @endcan

                        </div>
                    </div>
                    <form method="post" action="{{ route($folder_name . '-view') }} ">
                        @csrf
                        <table id="yajra" class="table table-bordered table-hover datatables" style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="noSort" width=" 10px">
                                        <input type="checkbox" class="select_all" style="width: 20px; height: 20px;"> </td>
                                    </th>
                                    <th class="noSort" width=" 10px">#</th>
                                    <th class="">First Name</th>
                                    <th class="">Last Name</th>
                                    <th class="">Agent</th>
                                    <th class="">Street Name</th>
                                    <th class="">Progress</th>
                                    <th width="">Action</th>
                                </tr>
                            </thead>
                            <tbody class="">

                                {{-- @foreach ($result as $key => $result)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="selected_customers"
                                                style="width: 20px; height: 20px;" name="selected_customers"
                                                value=" {{ $result->id }}">
                                        </td>
                                        <td> {{ $result->first_name }}</td>
                                        <td> {{ $result->last_name }}</td>
                                        <td> {{ $result->agent->name ?? '-' }}</td>
                                        <td> {{ $result->house_number }}</td>
                                        <td> {{ $result->street_name }}</td>
                                        <td> {{ $result->progress }}</td>

                                        <td>
                                            @can('edit-customer')
                                                <a class="btn-success btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                                    data-placement="top" title="Edit"
                                                    href="{{ route($folder_name . '-edit', ['id' => $result->e_id]) }}">
                                                    <i class="icon-edit"></i>
                                                </a>
                                            @endcan
                                            @can('view-customer')
                                                <a class="btn-primary btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                                    data-placement="top" title="View"
                                                    href="{{ route('customer-profile', ['customer_id' => $result->e_id]) }}">
                                                    <i class="icon-eye"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach --}}
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
    <script>
        search_start();

        // $('#first_name,#last_name,#house_number,#phone').keyup(function() {
        //     search_start();
        // })

        // $('#progress,#status,#agent').change(function() {
        //     search_start();
        // })


        function search_start() {
            if ($.fn.DataTable.isDataTable("#yajra")) $("#yajra").DataTable().destroy();
            //Start getting filters

            // let progress = $('#progress').val();
            // let status = $('#status').val();
            // let agent = $('#agent').val();
            // let first_name = $('#first_name').val();
            // let last_name = $('#last_name').val();
            // let house_number = $('#house_number').val();
            // let phone = $('#phone').val();

            $('#yajra').DataTable({
                lengthMenu: [
                    [10, 20, 30, 40, 50, 100, 1000, 5000, -1],
                    [10, 20, 30, 40, 50, 100, 1000, 5000, 'All']
                ],
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('customer-fetch_in_rework') }}",
                    type: "GET",
                    data: {
                        filter: "{{ app('request')->input('q') }}",
                        // progress,
                        // status,
                        // agent,
                        // first_name,
                        // last_name,
                        // house_number,
                        // phone,
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
                            return `<input type="checkbox" class="selected_customers"
                    style="width: 20px; height: 20px;" name="selected_customers"
                    value="${row.id}">`;
                        }
                    },
                    {
                        render: function(data, type, row, index) {
                            return index.row + 1;
                        }
                    },
                    {
                        data: 'first_name'
                    },
                    {
                        data: 'last_name'
                    },
                    {
                        data: 'agent.name'
                    },
                    {
                        data: 'street_name'
                    },
                    {
                        data: 'progress'
                    },
                    // {
                    //     data: 'status',
                    //     render: function(data, type, row) {
                    //         if (row.status == 1) {
                    //             return '<span class="badge p-2 badge-success">Enable</span>';
                    //         } else {
                    //             return '<span class="badge p-2 badge-danger">Disabled</span>';
                    //         }
                    //     }
                    // },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            const id = row.id;
                            const e_id = row.e_id;

                            let edit_url = ("{{ route('customer-edit', ['id' => '-id-']) }}").replace(
                                '-id-', e_id);

                            let view_url = ("{{ route('customer-profile', ['customer_id' => '-id-']) }}")
                                .replace(
                                    '-id-', e_id);

                            let buttons = ``;

                            @can('edit-customer')
                                buttons += `<a class="btn-success btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                            data-placement="top" title="Edit"
                            href="${edit_url}">
                            <i class="icon-edit"></i>
                        </a>`
                            @endcan

                            @can('view-customer')
                                buttons += `<a class="btn-info btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                            data-placement="top" title="View"
                            href="${view_url}">
                            <i class="icon-eye"></i> </a>`
                            @endcan




                            return buttons;
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










        $(".select_all").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        function getSelectedCustomers() {
            var array = [];
            $("input:checkbox[name=selected_customers]:checked").each(function() {
                array.push($(this).val());
            });
            return array;
        }

        $(document).on('click', '.download_selected_as_csv', async function(e) {
            let customers = getSelectedCustomers();

            if (customers.length > 0) {
                let url = '{{ route('customer-download_in_csv') }}';

                // $(customers).each(function(index, customer) {
                //     url = url + "customers%5B%5D=" + customer + '&';
                // })
                // window.location = url;

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        customers
                    },
                    success: function(response) {
                        if (response.status) {
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                        }
                    }
                })

            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Select Customers '
                })
            }
        })

        $(document).on('click', '.download_selected_as_txt_zip', async function(e) {
            let customers = getSelectedCustomers();

            if (customers.length > 0) {
                let url = '{{ route('customer-download_in_txt_zip') }}';

                // $(customers).each(function(index, customer) {
                //     url = url + "customers%5B%5D=" + customer + '&';
                // })
                // window.location = url;


                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        customers
                    },
                    success: function(response) {
                        if (response.status) {
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                        }
                    }
                })

            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Select Customers '
                })
            }
        })
    </script>
@endpush
