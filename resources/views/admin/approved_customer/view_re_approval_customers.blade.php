@extends('layouts.admin.app')
@section('page_header')
    All Re-Approval Customers
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
            background-color: #FFFF0080 !important;
            /* #FFFF00 */
        }

        .sale_status-callback {
            background-color: #FFFF0080 !important;
            /* #FFFF00 */
        }

        .sale_status-decline {
            background-color: #FFFF0080 !important;
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


                        </div>
                    </div>
                    <div class="box-header with-border">
                        <div class="d-flex justify-content-start">


                        </div>
                    </div>
                    <form>
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
                    <select name="specialist" id="specialist" data-specialist_type="" class="form-control mb-3">
                    </select>

                    <button type="button" class="btn btn-info assign_specialist">Assign</button>
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
                    url: "{{ route('re_approval_customer-fetch') }}",
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
                createdRow: function(row, data, dataIndex) {},
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

                            let approval_url = (
                                    "{{ route('re_approval_customer-proceed_for_approval', ['customer_id' => '-id-']) }}"
                                    )
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
                                buttons += `<a class="btn-primary btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                    data-placement="top" title="Edit"
                                    href="${edit_url}">
                                    <i class="icon-edit"></i>
                                </a>`
                            @endcan
                            @can('download-single-customer-in-txt')
                                buttons += `<a class="btn-success btn-sm btn m-1 cursor-pointer" data-toggle="tooltip"
                                    data-placement="top" title="Download"
                                    href="${download_url}">
                                    <i class="icon-download"></i> </a>`
                            @endcan

                            buttons += `<a class="btn-success btn-sm btn m-1 cursor-pointer proceed_for_Approval" data-toggle="tooltip"
                                    data-placement="top" title="Procedd for approval"
                                    href="${approval_url}">
                                    <i class="icon-check"></i> </a>`

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


        $(document).on('click', '.proceed_for_Approval', function(event) {
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
