@extends('layouts.admin.app')
@section('page_header')
    All {{ Str::plural($module_name) }}
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .modal-dialog {
            max-width: 600px;
        }

        .modal-content {
            height: 400px;
        }

        .modal-body {
            height: calc(100% - 56px - 56px);
            overflow-y: auto;
        }

        .office-group {
            margin-bottom: 15px;
        }
    </style>
@endpush
@section('content')
    <div class=" my-3">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-header with-border">
                        <div class="d-flex justify-content-start">

                            @can('add-customer')
                                <a href="{{ route($folder_name . '-add') }}"
                                    class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer">
                                    <i class=" icon-add"></i>
                                    Add New
                                </a>
                            @endcan

                            @can('bulk-add-customer')
                                <a href="#" class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer upload_customers">
                                    <i class=" icon-add"></i>
                                    Add Via File
                                </a>
                                <a href="{{ asset('samples/leads_template.csv') }}"
                                    class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer">
                                    <i class=" icon-download"></i>
                                    Download Sample File
                                </a>
                            @endcan

                            @can('bulk-assign-customer-to-agent')
                                <a href="#" class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer assign_to_agent">
                                    <i class=" icon-add"></i>
                                    Assign selected to Agent
                                </a>
                            @endcan

                            @can('move-customers-to-re-work')
                                <a href="#" class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer move_to_rework">
                                    <i class="icon-minus"></i>
                                    Move to Re-work
                                </a>
                            @endcan

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


                            {{-- @can('export-customers-as-rcl')
                                <a href="#" class="btn-danger btn-sm btn mb-2 mr-2 cursor-pointer export_as_rcl">
                                    <i class="icon-upload"></i>
                                    Export Selected as RCL
                                </a>
                            @endcan --}}

                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12 d-flex justify-content-end">

                            <button type="button" class="btn btn-sm btn-info apply_filters"><i
                                    class="icon icon-filter"></i> Apply FIlters</button>


                            {{-- <label for="progress">Progress</label>
                            <select name="progress" id="progress" class="form-control">
                                <option value="">All</option>
                                @foreach ($progress as $progress)
                                    <option>{{ $progress }}</option>
                                @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <table id="yajra" class="table table-bordered table-hover " style="width:100%;">
                        <thead>
                            <tr>
                                <th class="noSort" width=" 10px">
                                    <input type="checkbox" class="select_all" style="width: 20px; height: 20px;"> </td>
                                </th>
                                <th class="">First Name</th>
                                <th class="">Last Name</th>
                                <th class="">State</th>
                                <th class="">Agent</th>
                                <th class="">Phone</th>
                                <th class="" width="150px">Marked As Complete</th>
                                <th width="150px">Progress</th>
                                {{-- <th width="150px">Status</th> --}}
                                <th width="250px">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">

                            {{-- @foreach ($result as $key => $result)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="sequence[]" value="{{ $result->id }}">
                                            {{ $key + 1 }}
                                        </td>
                                        <td> {{ $result->first_name }}</td>
                                        <td> {{ $result->last_name }}</td>
                                        <td> {{ $result->agent->name ?? '-' }}</td>
                                        <td> {{ $result->house_number }}</td>
                                        <td> {{ $result->street_name }}</td>
                                        <td>
                                            @if ($result->is_complete)
                                                <span class="badge p-2 badge-success">Complete</span>
                                            @else
                                                <span class="badge p-2 badge-danger">Incomplete</span>
                                            @endif
                                        </td>

                                        <td> {{ $result->progress }}</td>
                                        <td>
                                            @if ($result->status)
                                                <span class="badge p-2 badge-success">Enable</span>
                                            @else
                                                <span class="badge p-2 badge-danger">Disable</span>
                                            @endif
                                        </td>
                                        <td>
                                            @can('edit-customer')
                                                <a class="btn-primary btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                                    data-placement="top" title="Edit"
                                                    href="{{ route($folder_name . '-edit', ['id' => $result->e_id]) }}">
                                                    <i class="icon-edit"></i>
                                                </a>

                                                <a class="btn-warning btn-sm btn m-1 cursor-pointer update_meta"
                                                    data-toggle="tooltip" data-placement="top" title="Metadata"
                                                    data-metadata="{{ $result->meta }}" data-customer_id="{{ $result->id }}"
                                                    href="#">
                                                    <i class="icon-info"></i>
                                                </a>
                                            @endcan
                                            @can('view-customer')
                                                <a class="btn-info btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                                    data-placement="top" title="View"
                                                    href="{{ route($folder_name . '-profile', ['customer_id' => $result->e_id]) }}">
                                                    <i class="icon-eye"></i> </a>
                                            @endcan
                                            <a class="btn-success btn-sm btn m-1 cursor-pointer customer_notes"
                                                data-toggle="tooltip" data-placement="top" title="Notes"
                                                data-customer_id="{{ $result->id }}" href="#">
                                                <i class="icon-note"></i>
                                            </a>

                                            @if (!$result->is_complete)
                                                <a class="btn-success btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                                    data-placement="top" title="Mark Submitted"
                                                    href="{{ route($folder_name . '-complete', ['customer_id' => $result->id]) }}">
                                                    <i class="icon-check"></i> </a>
                                            @endif

                                            @if ($result->is_complete)
                                                <a class="btn-danger btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                                    data-placement="top" title="Mark As Incomplete"
                                                    href="{{ route($folder_name . '-in_complete', ['customer_id' => $result->id]) }}">
                                                    <i class="icon-remove"></i> </a>
                                            @endif --}}

                            {{-- @if ($result->attached_report())
                                                <a class="btn-success btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                                    data-placement="top" title="View Report" target="_blank"
                                                    href="{{ route('report-detail', ['id' => $result->attached_report()->e_id]) }}">
                                                    <i class="icon-eye"></i>
                                                </a>
                                            @endif --}}

                            {{-- @can('view-customer-logs')
                                                <a href="#" class="btn-info btn-sm btn m-1 cursor-pointer view_logs"
                                                    data-toggle="tooltip" data-placement="top" title="View Logs"
                                                    data-customer_id="{{ $result->id }}">
                                                    <i class="icon-book"></i> </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach  --}}
                        </tbody>
                    </table>

                    {{-- <button type="submit" class="btn btn-sm mb-2 btn-success">
                            Update sequence
                        </button> --}}
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="upload_customers_modal" tabindex="-1" role="dialog"
        aria-labelledby="upload_customers_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload File (CSV)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route($folder_name . '-upload') }}" enctype="multipart/form-data">
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

    <div class="modal fade" id="update_meta_modal" tabindex="-1" role="dialog" aria-labelledby="update_meta_modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Customer's Metadata</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route($folder_name . '-metadata') }}">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" class="customer_id" name="customer_id">
                        <textarea name="meta" id="metadata" rows="15" class="w-100"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="customer_notes_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Customer Notes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea name="note" id="note" rows="5" class="w-100"></textarea>
                    <button class="btn btn-primary add_note">Add Note</button>
                    <hr>
                    <h5 class="modal-title">Previous Notes</h5>
                    <br>
                    <div class="previous_notes_div"> </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view_logs_modal" tabindex="-1" role="dialog" aria-labelledby="view_logs_modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Customer Logs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="logs_div">
                    </div>
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

                    @if (!$is_agent)
                        <div class="mb-2">
                            <label for="agent">Agent</label>
                            <select name="agent" id="agent" class="form-control">
                                <option value="">All</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="mb-2">
                        <label for="progress">Progress</label>
                        <small>(Press ctrl to select multiple)</small>
                        <select name="progress[]" id="progress" class="select2" multiple>
                            <option value="">All</option>
                            @foreach ($progress as $progress)
                                <option>{{ $progress }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">All</option>
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="">
                    </div>

                    <div class="mb-2">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="">
                    </div>


                    <div class="mb-2">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="">
                    </div>


                    <div class="mb-2">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" class="form-control" value="">
                    </div>

                    <div class="mb-2">
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="">
                    </div>

                    <div class="mb-2">
                        <label for="end_date">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="">
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="mark_as_submitted_modal" tabindex="-1" role="dialog"
        aria-labelledby="view_logs_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Select M ID</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer-complete') }}" class="needs-validation" novalidate method="post">
                        @csrf
                        <input type="hidden" name="customer_id" class="customer_id">
                        <select name="m_id" id="m_ids" class="form-control mb-3" required>
                        </select>
                        <div class="criteria"> </div>
                        <button type="submit" class="btn btn-info ">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="assign_to_agent_modal" tabindex="-1" role="dialog"
        aria-labelledby="assign_to_agent_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Select Agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="agent-selection" class="form-control mb-3" style="height:auto;">
                    </div>
                </div>
                <div class="modal-header">
                    <button type="button" class="btn btn-info assign">Assign</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script>
        $('.summernote').summernote();
        moment().format();

        $(".select_all").click(function() {
            $('input:checkbox:enabled').not(this).prop('checked', this.checked);
        });

        search_start();

        $('#first_name,#last_name,#phone,#state').keyup(function() {
            search_start();
        })

        $('#progress,#status,#agent,#start_date,#end_date').change(function() {
            search_start();
        })


        function search_start() {
            if ($.fn.DataTable.isDataTable("#yajra")) $("#yajra").DataTable().destroy();
            //Start getting filters

            let progress = $('#progress').val();
            let status = $('#status').val();
            let agent = $('#agent').val();
            let first_name = $('#first_name').val();
            let last_name = $('#last_name').val();
            let phone = $('#phone').val();
            let state = $('#state').val();
            let start_date = $('#start_date').val();
            let end_date = $('#end_date').val();

            $('#yajra').DataTable({
                lengthMenu: [
                    [10, 20, 30, 40, 50, 100, 1000, 5000, -1],
                    [10, 20, 30, 40, 50, 100, 1000, 5000, 'All']
                ],
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('customer-fetch') }}",
                    type: "GET",
                    data: {
                        filter: "{{ app('request')->input('q') }}",
                        progress,
                        status,
                        agent,
                        first_name,
                        last_name,
                        phone,
                        state,
                        start_date,
                        end_date,
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
                        data: 'first_name'
                    },
                    {
                        data: 'last_name'
                    },
                    {
                        data: 'state'
                    },
                    {
                        data: 'agent.name'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'is_complete',
                        render: function(data, type, row) {
                            if (row.is_complete == 1) {
                                return '<span class="badge p-2 badge-success">Yes</span>';
                            } else {
                                return '<span class="badge p-2 badge-danger">No</span>';
                            }
                        }
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

                            let incomplete_url = (
                                    "{{ route('customer-in_complete', ['customer_id' => '-id-']) }}")
                                .replace(
                                    '-id-', id);


                            let buttons = ``;
                            @can('edit-customer')
                                buttons += `<a class="btn-primary btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                    data-placement="top" title="Edit"
                                    href="${edit_url}">
                                    <i class="icon-edit"></i>
                                </a>

                                <a class="btn-warning btn-sm btn m-1 cursor-pointer update_meta"
                                    data-toggle="tooltip" data-placement="top" title="Metadata"
                                    data-metadata="${row.meta}" data-customer_id="${id}"
                                    href="#">
                                    <i class="icon-info"></i>
                                </a>`
                            @endcan
                            @can('view-customer')
                                buttons += `<a class="btn-info btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                    data-placement="top" title="View" style="background-color:#${row.reports.length > 0 ? "2FE42D" : "DC3545"}; border-color:#${row.reports.length > 0 ? "2FE42D" : "DC3545"}"
                                    href="${view_url}">
                                    <i class="icon-eye"></i> </a>`
                            @endcan

                            @can('access-customer-recordings')
                                if (row.recordings.length > 0) {
                                    buttons += `<a class="btn-danger btn-sm btn m-1 cursor-pointer"
                                        data-toggle="tooltip" data-placement="top" title="This Customer Has Recordings" href="${view_url}">
                                        <i class="icon-microphone"></i>
                                    </a>`;
                                }
                            @endcan

                            buttons += `<a class="btn-success btn-sm btn m-1 cursor-pointer customer_notes"
                                            data-toggle="tooltip" data-placement="top" title="Notes"
                                            data-customer_id="${id}" href="#">
                                            <i class="icon-note"></i>
                                        </a>`;



                            if (!row.is_complete == 1) {
                                buttons += `<a class="btn-success btn-sm btn m-1 cursor-pointer mark_as_submitted" data-toggle="tooltip"
                                    data-placement="top" title="Mark Submitted"
                                    href="#" data-customer_id="${id}">
                                    <i class="icon-check"></i> </a>`;
                            } else {
                                @if (!$is_agent)
                                    buttons += `<a class="btn-danger btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                    data-placement="top" title="Mark As Incomplete"
                                    href="${incomplete_url}">
                                    <i class="icon-remove"></i> </a>`;
                                @endif ;
                            }

                            @can('view-customer-logs')
                                buttons += `<a href="#" class="btn-info btn-sm btn m-1 cursor-pointer view_logs"
                                    data-toggle="tooltip" data-placement="top" title="View Logs"
                                    data-customer_id="${id}">
                                    <i class="icon-book"></i> </a>`;
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


        // {{ route($folder_name . '-upload') }}
        $(document).on('click', '.mark_as_submitted', async function(e) {
            e.preventDefault();
            let customer_id = $(this).data('customer_id');
            let m_ids = await $.get('{{ route('m_ids-get') }}')
            let m_ids_selector = $('#m_ids');

            if (m_ids.status == true) {
                $('.customer_id').val(customer_id);
                m_ids_selector.html('')
                $(m_ids.data).each(function(i, m_id) {

                    m_ids_selector.append(
                        ` <option value="${m_id.id}" data-criteria='${m_id.criteria}'>${m_id.name}</option> `
                    )
                })
                $("#mark_as_submitted_modal").modal('show');

            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong'
                })
            }
        })

        $(document).on('change', '#m_ids', function(e) {
            e.preventDefault();
            let criteria = $('#m_ids :selected').data('criteria');
            $('.criteria').html('');
            $('.criteria').html(criteria);
        })

        $(document).on('click', '.upload_customers', function(e) {
            e.preventDefault();
            $("#upload_customers_modal").modal('show');
        })

        $(document).on('click', '.update_meta', function(e) {
            e.preventDefault();
            let metadata = $(this).data('metadata');
            let customer_id = $(this).data('customer_id');

            $(".customer_id").val(customer_id);
            $("#metadata").val(metadata);
            $("#update_meta_modal").modal('show');

            createLog(customer_id, "{{ $META_VIEWED }}");
        })

        $(document).on('click', '.view_logs', async function(e) {
            e.preventDefault();
            let customer_id = $(this).data('customer_id');
            let url = '{{ route('customer_logs-get_logs', ['customer_id' => '-customer_id-']) }}'.replace(
                '-customer_id-', customer_id)
            $("#loader").show();
            let response = await $.get(url)
            if (response.status == true) {
                $('.logs_div').html('')
                $('.logs_div').html(response.data)
                // $(response.data).each(function(i, log) {
                //     $('.logs_div').append(
                //         ` <h6> ${ i + 1}  ${log} </h6>`
                //     )
                // })
                $("#view_logs_modal").modal('show');
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong'
                })
            }

            $("#loader").hide();
        })


        $(document).on('click', '.customer_notes', async function(e) {
            e.preventDefault();
            $('#loader').show();
            let customer_id = $(this).data('customer_id');

            let url = '{{ route('customer_notes-get', ['customer_id' => '-customer_id-']) }}'.replace(
                '-customer_id-', customer_id)
            let post_url = '{{ route('customer_notes-add', ['customer_id' => '-customer_id-']) }}'.replace(
                '-customer_id-', customer_id)

            let notes = await $.get(url)

            if (notes.status == true) {
                $("#customer_notes_modal").modal('show');
                $('.previous_notes_div').html('');
                $(notes.data).each(function(i, note) {
                    let html = ` 
                        <span><b>${note.author.name}</b> ${moment(note.created_at).format("MMM-DD-YYYY")}</span>
                            <br>
                            <span>${note.note}</span>
                            <br> <br>`;
                    $('.previous_notes_div').append(html);

                })

            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong'
                })
            }
            $('#loader').hide();

            $(document).on('click', '.add_note', async function(e) {
                let note = $("#note").val();
                if (note != "" && note != null) {
                    let response = await $.post(post_url, {
                        note
                    })
                    if (response.status == true) {
                        window.location.reload();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong'
                        })
                    }
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Please enter a note'
                    })
                }
            });
        });

        $(document).on('click', '.move_to_rework', async function(e) {
            let customers = getSelectedCustomers();

            if (customers.length > 0) {

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#1E3A5F",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes!"
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        let response = await $.post('{{ route('customer-move_to_rework') }}', {
                            customers
                        })

                        if (response.status == true) {
                            window.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Something went wrong'
                            })
                        }
                    }
                });

            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Select Customers '
                })
            }
        })

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

        $('.apply_filters').click(function() {
            $("#filters_modal").modal('show');
        })



        $(document).on('click', '.assign_to_agent', async function(e) {
            let agents = await $.get('{{ route('leadcenter-get_agents') }}');
            let agentSelection = $('#agent-selection');

            if (agents.status === true) {
                $("#assign_to_agent_modal").modal('show');
                agentSelection.html('');

                $(agents.data).each(function(i, office) {
                    let optgroup = `
                <div class="office-group">
                    <label class="font-weight-bold">
                        ${office.name}
                    </label>
                    <div class="agent-options">`;
                    $(office.agents).each(function(j, agent) {
                        optgroup += `
                    <label>
                        <input type="radio" class="agent-radio" id="assign_to_customers_select_Agent" name="agent" data-office-id="${office.id}" value="${agent.id}">
                        ${agent.name}
                    </label>
                    <br>
                `;
                    });
                    optgroup += `</div></div>`;
                    agentSelection.append(optgroup);
                });

            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong'
                });
            }
        });


        $(document).on('click', '.assign', async function(e) {

            let customers = getSelectedCustomers();
            let agent = $("input[name='agent']:checked").val();

            if (agent && customers.length > 0) {

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
                            url: "{{ route('customer-assign_customer_to_agent') }}",
                            type: "post",
                            data: {
                                // agents,
                                agent,
                                customers,
                            },
                            success: function(response) {
                                if (response.status) {
                                    window.location.reload();
                                } else {

                                    $("#assign_to_agent_modal").modal('hide');
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.message
                                    })
                                }
                            }
                        })
                    }
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Select Customers and agent'
                })
            }
        })




        $(document).on('click', '.export_as_rcl', async function(e) {
            let customers = getSelectedCustomers();

            if (customers.length > 0) {

                Swal.fire({
                    title: "Are you sure?",
                    text: "This will DELETE selected customers and cannot be reversed!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#1E3A5F",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes!"
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        let response = await $.post('{{ route('customer-export_as_rcl') }}', {
                            customers
                        })
                        if (response.status) {
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            })
                            window.location.reload();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                        }
                    }
                });

            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Select Customers '
                })
            }
        })




        function getSelectedCustomers() {
            var array = [];
            $("input:checkbox[name=selected_customers]:checked").each(function() {
                array.push($(this).val());
            });
            return array;
        }
    </script>
@endpush
