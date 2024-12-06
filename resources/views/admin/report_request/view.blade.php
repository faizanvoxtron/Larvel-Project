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
                            @can('add-report-request')
                                <a href="{{ route($folder_name . '-add') }}" class="btn-success btn-sm btn mb-2 cursor-pointer">
                                    <i class=" icon-add"></i>
                                    Add New
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12 d-flex justify-content-end">

                            <button type="button" class="btn btn-sm btn-info apply_filters"><i
                                    class="icon icon-filter"></i> Apply FIlters</button>
                        </div>
                    </div>
                    <form method="post" action="{{ route($folder_name . '-view') }} ">
                        @csrf
                        <table id="yajra" class="table table-bordered table-hover table-responsive" style="width:100%;">
                            <thead>
                                <tr>
                                    <th width=" 10px">#</th>
                                    <th class="">Type</th>
                                    <th class="">Customer</th>
                                    <th class="">Requested From</th>
                                    <th class="">Requested By</th>
                                    <th class="">Priority</th>
                                    <th class="">Requested On</th>
                                    {{-- <th class="">Approval Status</th> --}}
                                    <th width="150px">Progress</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="">

                                {{-- @foreach ($result as $key => $result)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="sequence[]" value="{{ $result->id }}">
                                            {{ $key + 1 }}
                                        </td>
                                        <td> {{ $result->type }}</td>
                                        <td> {{ $result->customer->first_name ." ". $result->customer->last_name}}</td>
                                        <td> {{ $result->manager ? $result->manager->name : 'Anyone' }}</td>
                                        <td> {{ $result->agent ? $result->agent->name : '-' }}</td>
                                        <td>
                                            @if ($result->priority == 'default')
                                                <span class="badge p-2 badge-info">Default</span>
                                            @else
                                                <span class="badge p-2 badge-danger">High</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($result->progress == 'pending')
                                                <span class="badge p-2 badge-danger">Pending</span>
                                            @else
                                                <span class="badge p-2 badge-success">Fulfilled</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($result->progress == 'pending')
                                                @can('edit-report-request')
                                                    <a class="btn-primary btn-sm btn cursor-pointer"
                                                        href="{{ route($folder_name . '-edit', ['id' => $result->e_id]) }}"> <i
                                                            class="icon-edit"></i>
                                                    </a>
                                                @endcan
                                            @endif

                                            @can('attach-report-to-report-request')
                                                <a class="btn-warning btn-sm btn cursor-pointer fetch_reports" href="#"
                                                    data-customer_id="{{ $result->customer_id }}"
                                                    data-report_id="{{ $result->report_id }}"
                                                    data-request_id="{{ $result->id }}">
                                                    <i class="icon-report"></i>
                                                </a>
                                            @endcan

                                            @if ($result->report_id)
                                                <a class="btn-success btn-sm btn cursor-pointer"
                                                    href="{{ route('report-detail', ['id' => encrypt($result->report_id)]) }}"> <i
                                                        class="icon-eye"></i>
                                                </a>
                                            @endif
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
    <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Select Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="report" id="report" class="form-control mb-3">
                    </select>

                    <button type="button" class="btn btn-info attach">Attach</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="filters_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Available Filters</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <a href="" class="btn btn-sm btn-info mb-2 apply_filters">
                        <i class="icon-remove"></i>
                        Clear FIlters
                    </a>



                    <div class="mb-2">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="">
                    </div>

                    <div class="mb-2">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="">
                    </div>

                    <div class="mb-2">
                        <label for="requested_on">Requested On</label>
                        <input type="date" id="requested_on" name="requested_on" class="form-control" value="">
                    </div>






                </div>

            </div>
        </div>
    </div>
@endsection



@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
        $(document).ready(function(e) {

            search_start();


            $('#first_name,#last_name').keyup(function() {
                search_start();
            })

            $('#requested_on').change(function() {
                search_start();
            })

            moment().format();

            function search_start() {
                if ($.fn.DataTable.isDataTable("#yajra")) $("#yajra").DataTable().destroy();
                //Start getting filters

                let first_name = $('#first_name').val();
                let last_name = $('#last_name').val();
                let requested_on = $('#requested_on').val();

                $('#yajra').DataTable({
                    lengthMenu: [
                        [10, 20, 30, 40, 50, 100, 1000, 5000],
                        [10, 20, 30, 40, 50, 100, 1000, 5000]
                    ],
                    "scrollX": true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('report_request-fetch') }}",
                        type: "GET",
                        data: {
                            filter: "{{ app('request')->input('q') }}",
                            first_name,
                            last_name,
                            requested_on,
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
                            data: 'type'
                        },
                        {
                            data: "customer.first_name",
                            render: function(data, type, row, index) {
                                if (row.customer) {
                                    var customerLink = (
                                            "{{ route('customer-profile', ['customer_id' => '-id-']) }}"
                                        )
                                        .replace(
                                            '-id-', row.customer.e_id);
                                    return '<a href="' + customerLink + '">' + row.customer
                                        .first_name + ' ' + row.customer.last_name + '</a>';
                                } else {
                                    return row.customer_id ?? "-";
                                    return "-";
                                }
                            },
                        },
                        {
                            render: function(data, type, row, index) {
                                return row.manager ? row.manager.name : "Anyone";
                            },
                        },
                        {
                            render: function(data, type, row, index) {
                                return row.agent ? row.agent.name : '-';
                            },
                        },
                        {
                            render: function(data, type, row) {
                                if (row.priority == 'default') {
                                    return '<span class="badge p-2 badge-info">Default</span>';
                                } else {
                                    return '<span class="badge p-2 badge-danger">High</span>';
                                }
                            }
                        },
                        // {
                        //     render: function(data, type, row) {
                        //         if (row.approval_status == 'pending') {
                        //             return '<span class="badge p-2 badge-warning">Pending</span>';
                        //         } else {
                        //             return '<span class="badge p-2 badge-success">Approved</span>';
                        //         }
                        //     }
                        // },
                        {
                            render: function(data, type, row) {
                                return moment(row.created_at).format(
                                    'lll'); // Example format
                            }
                        },
                        {
                            render: function(data, type, row) {
                                if (row.progress == 'pending') {
                                    return '<span class="badge p-2 badge-danger">Pending</span>';
                                } else {
                                    return '<span class="badge p-2 badge-success">Fulfilled</span>';
                                }
                            }
                        },
                        {
                            render: function(data, type, row) {
                                const id = row.id;
                                const e_id = row.e_id;

                                let edit_url = (
                                        "{{ route('report_request-edit', ['id' => '-id-']) }}"
                                    )
                                    .replace(
                                        '-id-', e_id);

                                let detail_url = (
                                        "{{ route('report-detail', ['id' => '-id-']) }}")
                                    .replace(
                                        '-id-', row.e_report_id);

                                let buttons = ``;
                                @can('edit-report-request')
                                    if (row.progress == 'pending') {
                                        buttons += `<a class="btn-primary btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                data-placement="top" title="Edit"
                                href="${edit_url}">
                                <i class="icon-edit"></i> </a>`
                                    }
                                @endcan
                                @can('attach-report-to-report-request')
                                    if (row.approval_status == 'pending') {
                                        @if (!$is_agent)
                                            buttons += `<a class="btn-success btn-sm btn cursor-pointer change_approval_status" href="#" data-toggle="tooltip"
                                                            data-placement="top" title="Approve Request"
                                                            data-action="approved"
                                                            data-request_id="${row.id }">
                                                            <i class="icon-check"></i>
                                                        </a>`
                                            buttons += `<a class="btn-danger btn-sm btn cursor-pointer mx-1 change_approval_status" href="#" data-toggle="tooltip"
                                                            data-placement="top" title="Decline Request"
                                                            data-action="declined"
                                                            data-request_id="${row.id }">
                                                            <i class="icon-close"></i>
                                                        </a>`
                                        @endif
                                    } else {
                                        buttons += `<a class="btn-warning btn-sm btn cursor-pointer fetch_reports" href="#" data-toggle="tooltip"
                                        data-placement="top" title="Attach Report"
                                        data-customer_id="${row.customer_id }"
                                        data-report_id="${row.report_id }"
                                        data-request_id="${row.id }">
                                        <i class="icon-report"></i>
                                    </a>`
                                    }
                                @endcan
                                if (row.report_id != null) {
                                    buttons += `<a class="btn-success btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                data-placement="top" title="View Report" target="_blank"
                                href="${detail_url}">
                                <i class="icon-eye"></i> </a>`
                                }
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



            $(document).on('click', '.fetch_reports', async function(e) {
                e.preventDefault();
                let customer_id = $(this).data('customer_id');
                let report_id = $(this).data('report_id');
                let request_id = $(this).data('request_id');
                let report_selector = $('#report');

                $('.attach').attr('data-request_id', request_id)
                let url = '{{ route('report-get', ['customer_id' => '-customer_id-']) }}'.replace(
                    '-customer_id-', customer_id)
                let reports = await $.get(url)

                if (reports.status == true) {
                    // console.log(reports)
                    $("#reportModal").modal('show');
                    report_selector.html('')

                    let selected = "";
                    report_selector.append('<option value="">Select Report</option>')
                    $(reports.data).each(function(i, report) {
                        if (report_id != '' && report_id == report.id) {
                            selected = "selected";
                        }
                        report_selector.append(
                            ` <option value="${report.id}" ${selected} >${report.report_type} ${moment(report.created_at).format('MMMM DD,YYYY')} ${report.report_pdf ? "(Has PDF)" : ""}</option> `
                        )
                    })

                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong'
                    })
                }

            });

            $(document).on('click', '.attach', async function(e) {
                let report = $("#report").val();
                let request_id = $(".attach").data('request_id');
                if (report && request_id) {

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
                            $.ajax({
                                url: "{{ route('report_request-attach') }}",
                                type: "post",
                                data: {
                                    request_id,
                                    report_id: report,
                                },
                                success: function(response) {
                                    if (response.status) {
                                        window.location.reload();
                                    } else {

                                        $("#reportModal").modal('hide');
                                        Toast.fire({
                                            icon: 'error',
                                            title: 'Something went wrong'
                                        })
                                    }
                                }
                            })
                        }
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please select report.'
                    })
                }
            })

        });

        $(document).on("click", ".change_approval_status", function(e) {
            e.preventDefault();

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
                    let approval_status = $(this).data("action")
                    let request_id = $(this).data("request_id")

                    $.ajax({
                        url: "{{ route('report_request-approval_status') }}",
                        type: "post",
                        data: {
                            request_id,
                            approval_status,
                        },
                        success: function(response) {
                            if (response.status) {
                                window.location.reload();
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Something went wrong'
                                })
                            }
                        }
                    })
                }
            });
        })


        $('.apply_filters').click(function() {
            $("#filters_modal").modal('show');
        })
    </script>
@endpush
