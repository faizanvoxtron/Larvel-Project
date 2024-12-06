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


                    {{-- <div class="row my-3">

                        <div class="col-4">
                            <label for="response">Response</label>
                            <select name="response" id="response" class="form-control">
                                <option value="">All</option>
                                <option>Allowed</option>
                                <option>Not Allowed</option>
                                <option>Invalid Number</option>
                            </select>
                        </div>

                    </div> --}}

                    <form method="post" action="{{ route($folder_name . '-view') }} ">
                        @csrf
                        {{-- <table id="" class="table table-bordered table-hover datatable" style="width:100%;"> --}}
                        <table id="yajra" class="table table-bordered table-hover " style="width:100%;">
                            <thead>
                                <tr>
                                    <th width="10px">#</th>
                                    <th class="">Customer</th>
                                    <th class="">User</th>
                                    <th class="">Timestamp</th>
                                    <th class="">Action</th>
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

    <!-- Modal -->
    <div class="modal fade" id="changesModal" tabindex="-1" role="dialog" aria-labelledby="changesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changesModalLabel">Modifications</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><strong>Before:</strong></h6>
                                <ul id="beforeList" class="list-group list-group-flush"></ul>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>After:</strong></h6>
                                <ul id="afterList" class="list-group list-group-flush"></ul>
                            </div>
                        </div>
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
                    [10, 20, 30, 40, 50, 100, 500],
                    [10, 20, 30, 40, 50, 100, 500]
                ],
                "scrollX": true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('customer_phone_modification_logs-fetch') }}",
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
                        render: function(data, type, row, index) {
                            var customerLink = (
                                    "{{ route('customer-profile', ['customer_id' => '-id-']) }}"
                                )
                                .replace(
                                    '-id-', row.customer.e_id);
                            return '<a href="' + customerLink + '">' + row.customer
                                .first_name + ' ' + row.customer.last_name + '</a>';
                        },
                    },
                    {
                        render: function(data, type, row, index) {
                            return row.user ? row.user.name : "-";
                        },
                    },
                    {
                        render: function(data, type, row, index) {
                            return moment(row.created_at).format("lll");
                        },
                    },
                    {
                        render: function(data, type, row, index) {
                            return `<a class="btn-success btn-sm btn cursor-pointer view_changes" href="#" data-toggle="tooltip"
                                data-placement="top" title="View Changes"
                                data-before='${row.before}'
                                data-after='${row.after}'>
                                <i class="icon-eye"></i>
                            </a>`;
                        },
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


        // Attach click event handler for view_changes buttons
        $(document).on('click', '.view_changes', function(e) {
            e.preventDefault();

            // Get data-before and data-after attributes
            const before = $(this).data('before');
            const after = $(this).data('after');
            // Clear existing list items
            $('#beforeList').empty();
            $('#afterList').empty();

            // Populate the lists with the changes
            before.forEach(function(item) {
                $('#beforeList').append('<li>' + item + '</li>');
            });

            after.forEach(function(item) {
                $('#afterList').append('<li>' + item + '</li>');
            });

            // Show the modal
            $('#changesModal').modal('show');
        });


        window.Pusher = Pusher;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: '{{ env('PUSHER_APP_KEY') }}',
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
            wsPort: 6001,
            wssPort: 6001,
            forceTLS: true,
            disableStats: true,
            enabledTransports: ['ws', 'wss'],
        });
        window.Echo.channel('phone-modifications')
            .listen('PhoneModified', (e) => {
                search_start();
            });
    </script>
@endpush
