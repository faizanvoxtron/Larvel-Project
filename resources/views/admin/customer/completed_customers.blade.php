@extends('layouts.admin.app')
@section('page_header')
    All Complete Customers
@endsection
@push('css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}
    <style>
        .sale_status-charged {
            background-color: #6AA84F80 !important;
            /* #6AA84F */
        }

        .sale_status-approved {
            background-color: #00FF0080 !important;
            /* #00FF00 */
        }

        .sale_status-dead {
            background-color: #FF000080 !important;
            /* #FF0000 */
        }

        .sale_status-pending {
            background-color: #F1C23280 !important;
            /* #FFFF00 */
        }

        .sale_status-callback {
            background-color: #FFFF0080 !important;
            /* #FFFF00 */
        }

        .sale_status-decline {
            background-color: #FF990080 !important;
            /* #FFFF00 */
        }

        .sale_status-chargebacks {
            background-color: #0000FF80 !important;
            /* #0000FF */
        }

        .sale_status-refund {
            background-color: #98000080 !important;
            /* #980000 */
        }

        .sale_status-rem_charge {
            background-color: #00FFFF80 !important;
            /* #00FFFF */
        }
    </style>
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

                            @can('assign-customers-to-specialists')
                                <div class="dropdown">
                                    <button class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer  dropdown-toggle"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Assign To Specialist
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item show_specialists" data-specialist_type="rna" href="#">RNA
                                            Specialist</a>
                                        <a class="dropdown-item show_specialists" data-specialist_type="cb" href="#">Chg
                                            Bck
                                            Specialist</a>
                                        <a class="dropdown-item show_specialists" data-specialist_type="decline"
                                            href="#">Decline Specialist</a>
                                    </div>
                                </div>
                            @endcan

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

                    <div class="box-header with-border">
                        <div class="d-flex justify-content-start">


                        </div>
                    </div>
                    <form method="post" action="{{ route($folder_name . '-view') }} ">
                        @csrf
                        <table id="yajra" class="table table-bordered table-hover " style="width:100%;">
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
                                    <th class="">M Id</th>
                                    <th class="">Specialist</th>
                                    <th width="150px">Action</th>
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
                                        <td> {{ $result->MId ? $result->MId->name : '-' }}</td>

                                        <td>
                                            @can('view-customer')
                                                <a class="btn-info btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                                    data-placement="top" title="View"
                                                    href="{{ route($folder_name . '-profile', ['customer_id' => $result->e_id]) }}">
                                                    <i class="icon-eye"></i> </a>
                                            @endcan
                                            @can('download-single-customer-in-txt')
                                                <a class="btn-success btn-sm btn cursor-pointer"
                                                    href="{{ route($folder_name . '-download', ['customer_id' => $result->id]) }}">
                                                    <i class="icon-download"></i> </a>
                                            @endcan
                                            @can('edit-customer')
                                                <a class="btn-primary btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                                    data-placement="top" title="Edit"
                                                    href="{{ route($folder_name . '-edit', ['id' => $result->e_id]) }}">
                                                    <i class="icon-edit"></i>
                                                </a>
                                            @endcan
                                            @if (!$is_agent)
                                                <a class="btn-danger btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                                    data-placement="top" title="Mark As Incomplete"
                                                    href="{{ route('customer-in_complete', ['customer_id' => $result->id]) }}">
                                                    <i class="icon-remove"></i> </a>
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


    <div class="modal fade" id="show_specialists_modal" tabindex="-1" role="dialog"
        aria-labelledby="show_specialists_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Select <span
                            class="text-uppercase specialist_type">ra</span> Specialist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="specialist" class="form-control mb-3" style="height:auto;">
                    </div>
                    {{-- <select name="specialist" id="specialist" data-specialist_type="" class="form-control mb-3">
                    </select> --}}

                    <button type="button" class="btn btn-info assign_specialist">Assign</button>
                </div>
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

                    {{-- @if (!$is_agent)
                        <div class="mb-2">
                            <label for="agent">Agent</label>
                            <select name="agent" id="agent" class="form-control">
                                <option value="">All</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif --}}

                    <div class="mb-2">
                        <label for="office">Office</label>
                        <select name="office" id="office" class="form-control">
                            <option value="">All</option>
                            @foreach ($offices as $office)
                                <option value="{{ $office->id }}">{{ $office->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="mb-2">
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
                    </div> --}}


                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> --}}
    <script>
        $(".select_all").click(function() {
            $('input:checkbox:enabled').not(this).prop('checked', this.checked);
        });


        search_start();

        // $('#first_name,#last_name,#house_number,#phone').keyup(function() {
        //     search_start();
        // })

        $('#office').change(function() {
            search_start();
        })


        function search_start() {
            if ($.fn.DataTable.isDataTable("#yajra")) $("#yajra").DataTable().destroy();
            //Start getting filters

            let office = $('#office').val();
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
                    url: "{{ route('customer-fetch_completed') }}",
                    type: "GET",
                    data: {
                        filter: "{{ app('request')->input('q') }}",
                        office,
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
                    var sale_statusClass = getClassNameBySaleStatus(data.sale_status);

                    $(row).addClass(sale_statusClass);
                },
                columnDefs: [{
                    targets: "noSort",
                    orderable: false
                }, ],
                columns: [{
                        render: function(data, type, row, index) {
                            return `<input type="checkbox" ${row.sale_status == 'Approved' || row.sale_status == 'Charged' ? "disabled" : ""} class="selected_customers"
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
                        render: function(data, type, row) {
                            return row.m_id ? row.m_id.name : '';
                        }
                    },
                    {
                        render: function(data, type, row) {
                            if (row.sale_status == 'RNA') {
                                if (row.rna_specialist) {
                                    return `<span class="badge p-2 badge-success">${row.rna_specialist.name}</span>`;
                                } else {
                                    return '<span class="badge p-2 badge-danger">No</span>';
                                }
                            } else if (row.sale_status == 'Chargebacks') {

                                if (row.cb_specialist) {
                                    return `<span class="badge p-2 badge-success">${row.cb_specialist.name}</span>`;
                                } else {
                                    return '<span class="badge p-2 badge-danger">No</span>';
                                }

                            } else if (row.sale_status == 'Decline') {

                                if (row.decline_specialist) {
                                    return `<span class="badge p-2 badge-success">${row.decline_specialist.name}</span>`;
                                } else {
                                    return '<span class="badge p-2 badge-danger">No</span>';
                                }
                            } else {
                                return '<span class="badge p-2 badge-danger">No</span>';
                            }
                            return row.m_id ? row.m_id.name : '';
                        }
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

                            let download_url = (
                                    "{{ route('customer-download', ['customer_id' => '-id-']) }}")
                                .replace(
                                    '-id-', id);

                            let incomplete_url = (
                                    "{{ route('customer-in_complete', ['customer_id' => '-id-']) }}")
                                .replace(
                                    '-id-', id);


                            let buttons = ``;

                            @can('view-customer')
                                buttons += `<a class="btn-info btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                    data-placement="top" title="View"
                                    href="${view_url}">
                                    <i class="icon-eye"></i> </a>`
                            @endcan

                            @can('edit-customer')
                                buttons += `<a class="btn-primary btn-sm btn m-1 cursor-pointer " style="${row.sale_status == "Approved" || row.sale_status == "Charged" ? "opacity: 50%;" : ""}"
                                        data-toggle="tooltip" data-placement="top" title="${row.sale_status == "Approved" || row.sale_status == "Charged" ? "Cannot Edit approved or charged customer" : "Edit"}" href="${edit_url}"
                                        ${row.sale_status == "Approved" || row.sale_status == "Charged" ? "onclick='return false;'" : ""}>
                                        <i class="icon-edit"></i>
                                    </a>`
                            @endcan
                            @can('download-single-customer-in-txt')
                                buttons += `<a class="btn-success btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                    data-placement="top" title="Download"
                                    href="${download_url}">
                                    <i class="icon-download"></i> </a>`
                            @endcan
                            buttons += `<a class="btn-success btn-sm btn m-1 cursor-pointer customer_notes"
                                            data-toggle="tooltip" data-placement="top" title="Notes"
                                            data-customer_id="${id}" href="#">
                                            <i class="icon-note"></i>
                                        </a>`

                            @if (!$is_agent)
                                buttons += `<a class="btn-danger btn-sm btn m-1 cursor-pointer mark_as_incomplete" data-toggle="tooltip"
                                    data-placement="top" title="Mark As Incomplete"
                                    href="${incomplete_url}">
                                    <i class="icon-remove"></i> </a>`;
                            @endif ;

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
                    $(function() {
                        $('[data-toggle="tooltip"]').tooltip();
                    });
                    //   $('#search-result-div').show();
                    //   $('#search-overlay').hide();
                    //   initShowDetailsMethod();
                } //end drawcallback
            });
        }


        $('#yajra_filter').children().children().val("{{ app('request')->input('search') }}")
        $('#yajra_filter').children().children().trigger("keyup");




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



        $(document).on('click', '.show_specialists', async function(e) {
            let specialist_type = $(this).data("specialist_type");

            $(".specialist_type").text(specialist_type)
            $("#specialist").data("specialist_type", specialist_type)

            let url = "{{ route('approved_customer-get_specialist', ['type' => '-specialist_type-']) }}"
                .replace("-specialist_type-", specialist_type)

            let specialists = await $.get(url)

            let specialists_selector = $('#specialist');

            if (specialists.status == true) {
                // console.log(reports)
                $("#show_specialists_modal").modal('show');
                specialists_selector.html('')

                let selected = "";
                // agents_selector.append('<option value="">Select Agent</option>')
                $(specialists.data).each(function(i, specialist) {
                    let optgroup = `
                <div class="office-group">
                    <label class="font-weight-bold">
                        ${specialist.name}
                    </label>
                    <div class="agent-options">`;
                    $(specialist.agents).each(function(j, agent) {
                        optgroup += `
                            <label>
                                <input type="radio" class="agent-radio" data-specialist_type="${specialist_type}" name="specialist" data-office_id="${specialist.id}" value="${agent.id}">
                                ${agent.name}
                            </label>
                            <br>`;
                    });
                    optgroup += `</div></div>`;

                    specialists_selector.append(optgroup);


                    // specialists_selector.append(
                    //     `<option value="${specialist.id}">${specialist.name}</option>`
                    // );
                });

            } else {
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong'
                })
            }
        })


        $(document).on('click', '.assign_specialist', async function(e) {
            let customers = getSelectedCustomers();

            let data = {
                customers,
                specialist: $("input[name='specialist']:checked").val(),
                specialist_type: $("input[name='specialist']:checked").data('specialist_type'),
                office_id: $("input[name='specialist']:checked").data('office_id'),
            }

            // console.log(data);
            // return;
            if (customers.length > 0) {
                let response = await $.post('{{ route('approved_customer-assign_specialist') }}',
                    data
                )
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
                    title: 'Select Customers '
                })
            }
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

        $(document).on('click', '.mark_as_incomplete', function(event) {
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

        $('.apply_filters').click(function() {
            $("#filters_modal").modal('show');
        })

        function getClassNameBySaleStatus(sale_status) {
            let sale_statusClass = '';
            switch (sale_status) {
                case 'Charged':
                    sale_statusClass = 'sale_status-charged';
                    break;
                case 'Approved':
                    sale_statusClass = 'sale_status-approved';
                    break;
                case 'Dead':
                    sale_statusClass = 'sale_status-dead';
                    break;
                case 'RNA':
                    sale_statusClass = 'sale_status-rna';
                    break;
                case 'Pending':
                    sale_statusClass = 'sale_status-pending';
                    break;
                case 'CallBack':
                    sale_statusClass = 'sale_status-callback';
                    break;
                case 'Decline':
                    sale_statusClass = 'sale_status-decline';
                    break;
                case 'Chargebacks':
                    sale_statusClass = 'sale_status-chargebacks';
                    break;
                case 'Refund':
                    sale_statusClass = 'sale_status-refund';
                    break;
                case 'On Hold':
                    sale_statusClass = 'sale_status-on_hold';
                    break;
                case 'REM Charge':
                    sale_statusClass = 'sale_status-rem_charge';
                    break;
                default:
                    sale_statusClass = '';
            }

            return sale_statusClass;
        }
    </script>
@endpush
