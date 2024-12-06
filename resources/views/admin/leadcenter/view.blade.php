@extends('layouts.admin.app')
@section('page_header')
    All {{ Str::plural($module_name) }}
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .office-group {
            margin-bottom: 15px;
        }

        .agent-options {
            margin-left: 20px;
            display: block;
        }
    </style>
@endpush
@section('content')
    <div class="my-3">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-header with-border">
                        <div class="">

                            @can('upload-leadcenter-leads')
                                <a href="#" class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer upload_leads">
                                    <i class=" icon-add"></i>
                                    Upload
                                </a>
                            @endcan

                            @can('move-leadcenter-leads-to-rnd')
                                <a href="#" class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer move_to_rnd">
                                    <i class=" icon-add"></i>
                                    Move selected to RnD
                                </a>
                            @endcan

                            @can('assign-leadcenter-leads-to-rnd-agents')
                                <a href="#" class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer assign_to_rnd_Agent">
                                    <i class=" icon-add"></i>
                                    Assign selected to RnD Agent
                                </a>
                            @endcan

                            @can('unassign-leadcenter-leads-to-rnd')
                                <a href="#" class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer unassign_to_rnd">
                                    <i class=" icon-remove"></i>
                                    Unassign selected to RnD
                                </a>
                            @endcan

                            @can('assign-leadcenter-leads-to-agents')
                                <a href="#" class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer assign_to_agent">
                                    <i class=" icon-add"></i>
                                    Assign selected to Agent
                                </a>
                            @endcan

                            @can('assign-leadcenter-leads-to-office')
                                <a href="#" class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer assign_to_office">
                                    <i class=" icon-add"></i>
                                    Assign selected to Office
                                </a>
                            @endcan

                            @can('unassign-leadcenter-leads-to-agents')
                                <a href="#" class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer unassign_to_agent">
                                    <i class=" icon-remove"></i>
                                    Unassign selected to Agent
                                </a>
                            @endcan

                            @can('delete-leadcenter-leads')
                                <a href="#" class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer delete_leads">
                                    <i class=" icon-trash"></i>
                                    Delete selected
                                </a>
                            @endcan

                            @can('download-leadcenter-leads')
                                <span class="dropdown">
                                    <button class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer  dropdown-toggle"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Download Selected As
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item download_selected_as_csv" href="#">.CSV</a>
                                        <a class="dropdown-item download_selected_as_txt_zip" href="#">.txt</a>
                                    </div>
                                </span>
                            @endcan


                            <span class="dropdown">
                                <button class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer  dropdown-toggle"
                                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Mark Selected As
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @can('complete-leadcenter-leads')
                                        <a class="dropdown-item mark_selected_as" data-action="complete"
                                            href="#">Complete</a>
                                    @endcan
                                    @can('incomplete-leadcenter-leads')
                                        <a class="dropdown-item mark_selected_as" data-action="incomplete"
                                            href="#">Incomplete</a>
                                    @endcan
                                </div>
                            </span>

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

                    <form method="post" action="{{ route($folder_name . '-view') }} ">
                        @csrf
                        {{-- <table id="" class="table table-bordered table-hover datatable" style="width:100%;"> --}}
                        <table id="yajra" class="table table-bordered table-hover " style="width:100%;">
                            <thead>
                                <tr>
                                    <th class="noSort" width=" 10px">
                                        <input type="checkbox" class="select_all" style="width: 20px; height: 20px;"> </td>
                                    </th>
                                    <th width=" 10px">#</th>
                                    <th class="">First Name</th>
                                    <th class="">Middle Name</th>
                                    <th class="">Surname</th>
                                    <th class="">Agent</th>
                                    <th class="">RnD Agent</th>
                                    <th class="">City</th>
                                    <th class="">State</th>
                                    <th class="">Zip</th>
                                    <th class="">Phone number</th>
                                    <th class="">Has Phone</th>
                                    <th class="">Completed</th>
                                    <th class="">In RnD</th>
                                    <th class="">Is RC</th>
                                    <th class="">Uploaded On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="">

                                {{-- @foreach ($result as $key => $result)
                                    <tr>
                                        <td> <input type="checkbox" class="selected_leads"
                                                style="width: 20px; height: 20px;" name="selected_leads"
                                                value="{{ $result->id }}"> </td>
                                        <td>
                                            <input type="hidden" name="sequence[]" value="{{ $result->id }}">
                                            {{ $key + 1 }}
                                        </td>
                                        <td> {{ $result->first_name }}</td>
                                        <td> {{ $result->middle_name }}</td>
                                        <td> {{ $result->surname }}</td>
                                        <td> {{ $result->agent ? $result->agent->name : '-' }}</td>
                                        <td> {{ $result->rnd_agent ? $result->rnd_agent->name : '-' }}</td>
                                        <td> {{ $result->city }}</td>
                                        <td> {{ $result->state_abbr }}</td>
                                        <td> {{ $result->zip }}</td>
                                        <td
                                            style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:30px;">
                                            {{ $result->phone }}</td>
                                        <td>
                                            @if ($result->phone)
                                                <span class="badge p-2 badge-success">Yes</span>
                                            @else
                                                <span class="badge p-2 badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($result->is_complete)
                                                <span class="badge p-2 badge-success">Complete</span>
                                            @else
                                                <span class="badge p-2 badge-danger">Incomplete</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($result->in_rnd)
                                                <span class="badge p-2 badge-success">Yes</span>
                                            @else
                                                <span class="badge p-2 badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>

                                            @can('complete-leadcenter-leads')
                                                @if (!$result->is_complete)
                                                    <a class="btn-success btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                                        data-placement="top" title="Mark complete"
                                                        href="{{ route($folder_name . '-complete', ['leadcenter_id' => $result->id]) }}">
                                                        <i class="icon-check"></i> </a>
                                                @endif
                                            @endcan
                                            @can('fill-details-in-leadcenter-leads')
                                                <a class="btn-success btn-sm btn cursor-pointer m-1" data-toggle="tooltip"
                                                    data-placement="top" title="Fill Details"
                                                    href="{{ route($folder_name . '-fill_details', ['id' => $result->e_id]) }}">
                                                    <i class="icon-phone"></i> </a>
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

    <div class="modal fade" id="upload_leads_modal" tabindex="-1" role="dialog" aria-labelledby="upload_leads_modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload File (CSV)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route($folder_name . '-upload') }}" class="needs-validation" novalidate
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="file" name="file" class="dropify" required
                            data-allowed-file-extensions="csv">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="assign_to_agent_modal" tabindex="-1" role="dialog"
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
                    <select name="agent" id="agent" class="form-control mb-3">
                    </select>

                    <button type="button" class="btn btn-info assign">Assign</button>
                </div>
            </div>
        </div>
    </div> --}}




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
                    <button type="button" class="btn btn-info assign">Assign</button>
                </div>
            </div>
        </div>
    </div>







    <div class="modal fade" id="assign_to_office_modal" tabindex="-1" role="dialog"
        aria-labelledby="assign_to_office_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Select Office</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="office" id="office" class="form-control mb-3">
                    </select>

                    <button type="button" class="btn btn-info assign_office">Assign</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="fill_details_modal" tabindex="-1" role="dialog"
        aria-labelledby="assign_to_agent_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Fill Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="lead_id" class="lead_id">
                        <div class="phone_numbers_div">
                            <div class="d-flex align-items-center justify-content-between">
                                <button type="button" class="btn btn-xs btn-info add_phone_div">+</button>
                                <input type="number" name="phone_numbers[]" class="form-control my-2" required
                                    placeholder="Enter Phone Number">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="assign_to_rnd_agent_modal" tabindex="-1" role="dialog"
        aria-labelledby="assign_to_rnd_agent_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Select Agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="rnd_agent" id="rnd_agent" class="form-control mb-3">
                    </select>

                    <button type="button" class="btn btn-info assign_rnd">Assign</button>
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
                        <label for="has_rnd_agent_filter">Has RnD Agent</label>
                        <select name="has_rnd_agent_filter" id="has_rnd_agent_filter" class="form-control">
                            <option value="">All</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="rnd_agent_filter">RND Agent</label>
                        <select name="rnd_agent_filter" id="rnd_agent_filter" class="form-control">
                            <option value="">All</option>
                            @foreach ($rnd_agents as $rnd_agent)
                                <option value="{{ $rnd_agent->id }}">{{ $rnd_agent->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="has_agent_filter">Has Agent</label>
                        <select name="has_agent_filter" id="has_agent_filter" class="form-control">
                            <option value="">All</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="agent_filter">Agent</label>
                        <select name="agent_filter" id="agent_filter" class="form-control">
                            <option value="">All</option>
                            @foreach ($agents as $agent)
                                <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="is_completed_filter">Completed</label>
                        <select name="is_completed_filter" id="is_completed_filter" class="form-control">
                            <option value="">All</option>
                            <option value="1">Completed</option>
                            <option value="0">In Complete</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="has_phone_filter">Has Phone</label>
                        <select name="has_phone_filter" id="has_phone_filter" class="form-control">
                            <option value="">All</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label for="is_rc_lead_filter">RC Lead</label>
                        <select name="is_rc_lead_filter" id="is_rc_lead_filter" class="form-control">
                            <option value="">All</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>







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
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

        search_start();

        $('#first_name,#last_name,#house_number,#phone').keyup(function() {
            search_start();
        })

        $('#progress,#status,#agent_filter,#rnd_agent_filter,#is_completed_filter,#has_phone_filter,#has_agent_filter,#has_rnd_agent_filter,#is_rc_lead_filter')
            .change(function() {
                search_start();
            })


        function search_start() {
            if ($.fn.DataTable.isDataTable("#yajra")) $("#yajra").DataTable().destroy();
            //Start getting filters

            let progress = $('#progress').val();
            let has_agent_filter = $('#has_agent_filter').val();
            let agent_filter = $('#agent_filter').val();
            let has_rnd_agent_filter = $('#has_rnd_agent_filter').val();
            let rnd_agent_filter = $('#rnd_agent_filter').val();
            let is_completed_filter = $('#is_completed_filter').val();
            let has_phone_filter = $('#has_phone_filter').val();
            let is_rc_lead_filter = $('#is_rc_lead_filter').val();


            $('#yajra').DataTable({
                lengthMenu: [
                    [10, 15, 20, 30, 40, 50, 100, 1000, 5000, 10000],
                    [10, 15, 20, 30, 40, 50, 100, 1000, 5000, 10000]
                ],
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('leadcenter-fetch') }}",
                    type: "GET",
                    data: {
                        filter: "{{ app('request')->input('q') }}",
                        progress,
                        agent_filter,
                        is_completed_filter,
                        has_phone_filter,
                        rnd_agent_filter,
                        has_rnd_agent_filter,
                        has_agent_filter,
                        is_rc_lead_filter,
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
                            return `<input type="checkbox" class="selected_leads"
                            style="width: 20px; height: 20px;" name="selected_leads"
                            value="${row.id}">`;
                        }
                    },

                    {
                        render: function(data, type, row, index) {
                            return index.row + 1;
                        },
                    },
                    {
                        data: 'first_name'
                    },
                    {
                        data: 'middle_name'
                    },
                    {
                        data: 'surname'
                    },
                    {
                        render: function(data, type, row, index) {
                            if (row.agent) {
                                return `<span class="badge p-2 badge-success">${row.agent.name}</span>`;
                            } else {
                                return '<span class="badge p-2 badge-danger">No</span>';
                            }

                            return row.agent ? row.agent.name : '-';
                        },
                    },
                    {
                        render: function(data, type, row, index) {

                            if (row.rnd_agent) {
                                return `<span class="badge p-2 badge-success">${row.rnd_agent.name}</span>`;
                            } else {
                                return '<span class="badge p-2 badge-danger">No</span>';
                            }
                            return row.rnd_agent ? row.rnd_agent.name : '-';
                        },
                    },

                    {
                        data: 'city'
                    },
                    {
                        data: 'state_abbr'
                    },
                    {
                        data: 'zip'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        render: function(data, type, row) {
                            if (row.phone) {
                                return '<span class="badge p-2 badge-success">Yes</span>';
                            } else {
                                return '<span class="badge p-2 badge-danger">No</span>';
                            }
                        }
                    },
                    {
                        render: function(data, type, row) {
                            if (row.is_complete == 1) {
                                return '<span class="badge p-2 badge-success">Complete</span>';
                            } else {
                                return '<span class="badge p-2 badge-danger">Incomplete</span>';
                            }
                        }
                    },
                    {
                        render: function(data, type, row) {
                            if (row.in_rnd == 1) {
                                return '<span class="badge p-2 badge-success">Yes</span>';
                            } else {
                                return '<span class="badge p-2 badge-danger">No</span>';
                            }
                        }
                    },
                    {
                        render: function(data, type, row) {
                            if (row.is_rc == 1) {
                                return '<span class="badge p-2 badge-success">Yes</span>';
                            } else {
                                return '<span class="badge p-2 badge-danger">No</span>';
                            }
                        }
                    },
                    {
                        render: function(data, type, row) {
                            return moment(row.created_at).format(
                                'lll'); // Example format
                        }
                    },
                    {
                        render: function(data, type, row) {
                            const id = row.id;
                            const e_id = row.e_id;

                            let complete_url = (
                                    "{{ route('leadcenter-complete', ['leadcenter_id' => '-id-']) }}")
                                .replace(
                                    '-id-', id);

                            let incomplete_url = (
                                    "{{ route('leadcenter-incomplete', ['leadcenter_id' => '-id-']) }}")
                                .replace(
                                    '-id-', id);

                            let fill_details_url = (
                                    "{{ route('leadcenter-fill_details', ['id' => '-id-']) }}")
                                .replace(
                                    '-id-', e_id);

                            let buttons = ``;
                            @can('complete-leadcenter-leads')
                                if (row.is_complete == 0) {
                                    buttons += `<a class="btn-success btn-sm btn m-1 cursor-pointer complete_lead" data-toggle="tooltip"
                                data-placement="top" title="Mark Complete"
                                href="${complete_url}">
                                <i class="icon-check"></i> </a>`
                                }
                            @endcan


                            @can('incomplete-leadcenter-leads')
                                if (row.is_complete == 1) {
                                    buttons += `<a class="btn-danger btn-sm btn m-1 cursor-pointer complete_lead" data-toggle="tooltip"
                                data-placement="top" title="Mark Incomplete"
                                href="${incomplete_url}">
                                <i class="icon-remove"></i> </a>`
                                }
                            @endcan


                            @can('fill-details-in-leadcenter-leads')
                                buttons += `<a class="btn-success btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                    data-placement="top" title="Fill Details"
                                    href="${fill_details_url}">
                                    <i class="icon-phone"></i> </a>`
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
        $(document).on('click', '.upload_leads', function(e) {
            e.preventDefault();
            $("#upload_leads_modal").modal('show');

        })

        // $(document).on('click', '.assign_to_agent', async function(e) {
        //     let agents = await $.get('{{ route('leadcenter-get_agents') }}')
        //     let agents_selector = $('#agent');

        //     if (agents.status == true) {
        //         // console.log(reports)
        //         $("#assign_to_agent_modal").modal('show');
        //         agents_selector.html('')

        //         let selected = "";
        //         // agents_selector.append('<option value="">Select Agent</option>')
        //         $(agents.data).each(function(i, office) {
        //             let optgroup = `<optgroup label="${office.name}">`;
        //             $(office.agents).each(function(j, agent) {
        //                 optgroup += `<option value="${agent.id}">${agent.name}</option>`;
        //             });
        //             optgroup += `</optgroup>`;
        //             agents_selector.append(optgroup);
        //         });

        //     } else {
        //         Toast.fire({
        //             icon: 'error',
        //             title: 'Something went wrong'
        //         })
        //     }
        // });



        $(document).on('click', '.assign_to_agent', async function(e) {
            let agents = await $.get('{{ route('leadcenter-get_agents') }}')
            let agentSelection = $('#agent-selection');

            if (agents.status === true) {
                $("#assign_to_agent_modal").modal('show');
                agentSelection.html('')

                $(agents.data).each(function(i, office) {
                    let optgroup = `
                <div class="office-group">
                    <label class="font-weight-bold">
                        <input type="checkbox" class="office-checkbox" data-office-id="${office.id}">
                        ${office.name}
                    </label>
                    <div class="agent-options">
            `;
                    $(office.agents).each(function(j, agent) {
                        optgroup += `
                    <label>
                        <input type="checkbox" class="agent-checkbox" data-office-id="${office.id}" value="${agent.id}">
                        ${agent.name}
                    </label>
                    <br>
                `;
                    });
                    optgroup += `</div></div>`;
                    agentSelection.append(optgroup);
                });

                $('.office-checkbox').on('change', function() {
                    let officeId = $(this).data('office-id');
                    let isChecked = $(this).is(':checked');
                    $(`.agent-checkbox[data-office-id=${officeId}]`).prop('checked', isChecked);
                });

                $('.agent-checkbox').on('change', function() {
                    let officeId = $(this).data('office-id');
                    let allChecked = $(`.agent-checkbox[data-office-id=${officeId}]`).length === $(
                        `.agent-checkbox[data-office-id=${officeId}]:checked`).length;
                    $(`.office-checkbox[data-office-id=${officeId}]`).prop('checked', allChecked);
                });

            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong'
                })
            }
        });




        $(document).on('click', '.assign', async function(e) {
            // let agent = $("#agent").val();

            let agents = [];
            $('.agent-checkbox:checked').each(function() {
                agents.push($(this).val());
            });

            let leads = getSelectedLeads();
            if (agents.length > 0 && leads.length > 0) {

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
                            url: "{{ route('leadcenter-assign_agent') }}",
                            type: "post",
                            data: {
                                agents,
                                // agent,
                                leads,
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
                    title: 'Select Leads and agent'
                })
            }
        })

        $(document).on('click', '.assign_to_office', async function(e) {
            let offices = await $.get('{{ route('leadcenter-get_offices') }}')
            let office_selector = $('#office');

            if (offices.status == true) {
                // console.log(reports)
                $("#assign_to_office_modal").modal('show');
                office_selector.html('')

                let selected = "";
                // agents_selector.append('<option value="">Select Agent</option>')
                $(offices.data).each(function(i, office) {
                    office_selector.append(
                        `<option value="${office.id}">${office.name} (${office.agents_count} Agents)</option>`
                    );
                });

            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong'
                })
            }
        });

        $(document).on('click', '.assign_office', async function(e) {
            let office = $("#office").val();
            let leads = getSelectedLeads();
            if (office != undefined && leads.length > 0) {
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
                            url: "{{ route('leadcenter-assign_office') }}",
                            type: "post",
                            data: {
                                office,
                                leads,
                            },
                            success: function(response) {
                                if (response.status) {
                                    window.location.reload();
                                } else {
                                    $("#assign_to_office_modal").modal('hide');
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.message,
                                    })
                                }
                            }
                        })
                    }
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Select Leads and office'
                })
            }
        })

        $(document).on('click', '.move_to_rnd', async function(e) {
            let leads = getSelectedLeads();

            if (leads != undefined && leads.length > 0) {
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
                        let response = await $.post('{{ route('leadcenter-move_to_rnd') }}', {
                            leads
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
                    title: 'Select Leads '
                })
            }
        })


        $(document).on('click', '.unassign_to_rnd', function(e) {
            let leads = getSelectedLeads();

            if (leads != undefined && leads.length > 0) {
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
                        let response = await $.post('{{ route('leadcenter-unassign_to_rnd') }}', {
                            leads
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
                    title: 'Select Leads '
                })
            }
        })

        $(document).on('click', '.unassign_to_agent', async function(e) {
            let leads = getSelectedLeads();

            if (leads != undefined && leads.length > 0) {

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
                        let response = await $.post('{{ route('leadcenter-unassign_agent') }}', {
                            leads
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
                    title: 'Select Leads '
                })
            }
        })


        $(document).on('click', '.delete_leads', async function(e) {
            let leads = getSelectedLeads();

            if (leads != undefined && leads.length > 0) {

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
                        let response = await $.post('{{ route('leadcenter-delete') }}', {
                            leads
                        })
                        if (response.status == true) {
                            Toast.fire({
                                icon: 'success',
                                title: 'Successfully deleted'
                            })
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
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
                    title: 'Select Leads '
                })
            }
        })



        $(document).on('click', '.assign_to_rnd_Agent', async function(e) {
            let rnd_agents = await $.get('{{ route('leadcenter-get_rnd_agents') }}')
            let rnd_agents_selector = $('#rnd_agent');

            if (rnd_agents.status == true) {
                // console.log(reports)
                $("#assign_to_rnd_agent_modal").modal('show');
                rnd_agents_selector.html('')

                let selected = "";
                rnd_agents_selector.append('<option value="">Select RnD Agent</option>')
                $(rnd_agents.data).each(function(i, rnd_agent) {

                    rnd_agents_selector.append(
                        ` <option value="${rnd_agent.id}" >${rnd_agent.name}</option> `
                    )
                })

            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong'
                })
            }
        });

        $(document).on('click', '.assign_rnd', async function(e) {
            let rnd_agent = $("#rnd_agent").val();
            let leads = getSelectedLeads();
            if (rnd_agent != undefined && leads.length > 0) {

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
                            url: "{{ route('leadcenter-assign_to_rnd_Agent') }}",
                            type: "post",
                            data: {
                                rnd_agent,
                                leads,
                            },
                            success: function(response) {
                                if (response.status) {
                                    window.location.reload();
                                } else {

                                    $("#assign_to_rnd_agent_modal").modal('hide');
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
                    title: 'Select Leads and agent'
                })
            }
        })


        // $(document).on('click', '.fill_details', async function(e) {
        //     let lead_id = $(this).data('lead_id');
        //     $('.lead_id').val(lead_id);
        //     $('#fill_details_modal').modal('show');
        // })


        // $(document).on('click', '.add_phone_div', async function(e) {
        //     let html = `   <div class="d-flex align-items-center justify-content-between">
    //                         <button type="button" class="btn btn-xs btn-danger remove_phone_div">X</button>
    //                         <input type="number" name="phone_numbers[]" class="form-control my-2" required
    //                             placeholder="Enter Phone Number">
    //                     </div>`;
        //     $('.phone_numbers_div').append(html)
        // })


        // $(document).on('click', '.remove_phone_div', async function(e) {
        //     $(this).parent().remove();
        // })

        $(document).on('click', '.download_selected_as_csv', async function(e) {
            let leads = getSelectedLeads();

            if (leads.length > 0) {

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
                        let url = '{{ route('leadcenter-download_in_csv') }}';

                        // $(customers).each(function(index, customer) {
                        //     url = url + "customers%5B%5D=" + customer + '&';
                        // })
                        // window.location = url;

                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                leads
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
                    }
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Select Leads'
                })
            }
        })

        $(document).on('click', '.download_selected_as_txt_zip', async function(e) {
            let leads = getSelectedLeads();

            if (leads.length > 0) {

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
                        let url = '{{ route('leadcenter-download_in_txt_zip') }}';

                        // $(customers).each(function(index, customer) {
                        //     url = url + "customers%5B%5D=" + customer + '&';
                        // })
                        // window.location = url;


                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                leads
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
                    }
                });
            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Select Leads'
                })
            }
        })


        $(document).on('click', '.mark_selected_as', function(e) {
            let leads = getSelectedLeads();
            let action = $(this).data('action');

            if (leads.length > 0) {

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
                        let url = '{{ route('leadcenter-bulk_complete') }}';

                        $.ajax({
                            url: url,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                leads,
                                action
                            },
                            success: function(response) {
                                if (response.status) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Successfully marked as ' + action
                                    })
                                    window.location.reload();
                                } else {
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
                    title: 'Select Leads'
                })
            }
        });




        $('.apply_filters').click(function() {
            $("#filters_modal").modal('show');
        })




        function getSelectedLeads() {
            var array = [];
            $("input:checkbox[name=selected_leads]:checked").each(function() {
                array.push($(this).val());
            });
            return array;
        }
    </script>
@endpush
