@extends('layouts.admin.app')
@section('page_header')
    All Customers Docs
@endsection
@push('css')
    <style>
        .dataTables_filter {
            margin-bottom: 10px;
        }

        .child-row {
            background-color: #f9f9f9;
        }

        .child-table {
            width: 100%;
        }

        .child-table th,
        .child-table td {
            padding: 5px;
            text-align: left;
        }

        .editable {
            display: block;
            /* Ensure it behaves like a block element */
            width: 100%;
            min-height: 30px;
            /* Minimum height to make it more clickable */
            border: 1px solid transparent;
            padding: 5px;
            border-radius: 4px;
            transition: border-color 0.3s, background-color 0.3s;
            box-sizing: border-box;
            /* Include padding and border in the element's total width and height */
        }

        .editable:focus {
            border-color: #007bff;
            background-color: #f8f9fa;
            outline: none;
        }

        textarea.editable {
            width: 100%;
            min-height: 60px;
            min-width: 220px;
            resize: both;
            /* Allow both horizontal and vertical resizing */
            box-sizing: border-box;
            /* Include padding and border in the element's total width and height */
        }

        .sale_status-dropdown {
            min-width: 140px;
        }

        .editableAccount {
            display: block;
            /* Ensure it behaves like a block element */
            width: 100%;
            min-height: 30px;
            /* Minimum height to make it more clickable */
            border: 1px solid transparent;
            padding: 5px;
            border-radius: 4px;
            transition: border-color 0.3s, background-color 0.3s;
            box-sizing: border-box;
            /* Include padding and border in the element's total width and height */
        }

        .editableAccount:focus {
            border-color: #007bff;
            background-color: #f8f9fa;
            outline: none;
        }

        .sale_status-dropdown {
            width: 100%;
        }



        #customers-table td {
            white-space: nowrap;
            /* Ensures text does not wrap */
            overflow: hidden;
            /* Prevents overflow */
            text-overflow: ellipsis;
            /* Shows ellipsis (...) for overflowed content */
        }

        /* .sale_status-rna {
                                                                                                                                                            background-color: #cce5ff !important;
                                                                                                                                                        } */

        /* .sale_status-on_hold {
                                                                                                                                                            background-color: #f5c6cb !important;
                                                                                                                                                        } */

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
    <div class="my-3">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="row my-3">
                        <div class="col-12">

                            <div class="dropdown">
                                <button class="btn-success btn-sm btn mb-2 mr-2 cursor-pointer  dropdown-toggle"
                                    type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Change Bulk Status Of Selected
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item sale_status-charged change_bulk_status"
                                        href="#">Charged</a>
                                    <a class="dropdown-item sale_status-approved change_bulk_status"
                                        href="#">Approved</a>
                                    <a class="dropdown-item sale_status-dead change_bulk_status" href="#">Dead</a>
                                    <a class="dropdown-item sale_status-rna change_bulk_status" href="#">RNA</a>
                                    <a class="dropdown-item sale_status-pending change_bulk_status"
                                        href="#">Pending</a>
                                    <a class="dropdown-item sale_status-callback change_bulk_status"
                                        href="#">CallBack</a>
                                    <a class="dropdown-item sale_status-decline change_bulk_status"
                                        href="#">Decline</a>
                                    <a class="dropdown-item sale_status-chargebacks change_bulk_status"
                                        href="#">Chargebacks</a>
                                    <a class="dropdown-item sale_status-refund change_bulk_status" href="#">Refund</a>
                                    <a class="dropdown-item sale_status-on_hold change_bulk_status" href="#">On
                                        Hold</a>
                                    <a class="dropdown-item sale_status-rem_charge change_bulk_status" href="#">REM
                                        Charge</a>
                                </div>
                            </div>

                            <div class="row my-3">
                                <div class="col-12 d-flex justify-content-end">

                                    <button type="button" class="btn btn-sm btn-info apply_filters"><i
                                            class="icon icon-filter"></i> Apply FIlters</button>
                                </div>
                            </div>




                        </div>
                    </div>
                    <table id="customers-table" class="table table-bordered table-responsive w-100">
                        <thead>
                            <tr>
                                <th class="noSort" width=" 10px">
                                    <input type="checkbox" class="select_all" style="width: 20px; height: 20px;"> </td>
                                </th>
                                <th>Comments</th>
                                <th>Completed On</th>
                                <th>First Name</th>
                                <th>Middle Initial</th>
                                <th>Last Name</th>
                                <th>Phone Number (Primary)</th>
                                <th>Address</th>
                                <th>DOB</th>
                                <th>SSN</th>
                                <th>MMN</th>
                                <th>Charge</th>
                                <th>No. of Cards</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                                <th>Sale Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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

                    <div class="col-md-12 p-0">
                        <label for="sale_status_filter">Sale Status</label>
                        <select name="sale_status_filter" id="sale_status_filter" class="form-control">
                            <option>Select</option>
                            <option class="sale_status-charged">Charged</option>
                            <option class="sale_status-approved">Approved</option>
                            <option class="sale_status-dead">Dead</option>
                            <option class="sale_status-rna">RNA</option>
                            <option class="sale_status-pending">Pending</option>
                            <option class="sale_status-callback">CallBack</option>
                            <option class="sale_status-decline">Decline</option>
                            <option class="sale_status-chargebacks">Chargebacks</option>
                            <option class="sale_status-refund">Refund</option>
                            <option class="sale_status-on_hold">On Hold</option>
                            <option class="sale_status-rem_charge">REM Charge</option>
                        </select>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"
        integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.apply_filters').click(function() {
                $("#filters_modal").modal('show');
            })

            $(".select_all").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            var table = $('#customers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('approved_customer-fetch') }}',
                    data: function(d) {
                        d.sale_status = $('#sale_status_filter').val();
                    }
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
                        data: 'comments',
                        name: 'comments',
                        render: editableColumn
                    },
                    {
                        data: 'completed_on',
                        name: 'completed_on',
                        render: editableColumn
                    },
                    {
                        data: 'first_name',
                        name: 'first_name',
                        render: editableColumn
                    },
                    {
                        data: 'middle_initial',
                        name: 'middle_initial',
                        render: editableColumn
                    },
                    {
                        data: 'last_name',
                        name: 'last_name',
                        render: editableColumn
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        render: editableColumn
                    },
                    {
                        data: 'address',
                        name: 'address',
                        render: editableColumn
                    },
                    {
                        data: 'dob',
                        name: 'dob',
                        render: editableColumn
                    },
                    {
                        data: 'ssn',
                        name: 'ssn',
                        render: editableColumn
                    },
                    {
                        data: 'mmn',
                        name: 'mmn',
                        render: editableColumn
                    },
                    {
                        data: 'charge',
                        name: 'charge',
                        render: editableColumn
                    },
                    {
                        data: 'no_of_ac',
                        name: 'no_of_ac',
                        render: editableColumn
                    },
                    {
                        data: 'city',
                        name: 'city',
                        render: editableColumn
                    },
                    {
                        data: 'state',
                        name: 'state',
                        render: editableColumn
                    },
                    {
                        data: 'zip',
                        name: 'zip',
                        render: editableColumn
                    },
                    {
                        data: 'sale_status',
                        name: 'sale_status',
                        render: sale_statusDropdown,
                        width: 'auto'
                    }
                ],
                rowCallback: function(row, data, index) {
                    var accounts = JSON.parse(data.accounts);
                    var sale_statusClass = getClassNameBySaleStatus(data.sale_status);

                    $(row).addClass(sale_statusClass);

                    if (data.accounts) {
                        var accountsHtml =
                            '</tr><tr class="child-row"><td colspan="16"><table class="table table-sm table-bordered child-table">';
                        accountsHtml +=
                            '<thead><tr><th>NOC</th><th>Card Number</th><th>Expiry</th><th>CVC</th><th>Charge Card</th><th>Charge On This Card</th></tr></thead>';
                        accountsHtml += '<tbody>';

                        accounts.forEach(function(account) {
                            console.log(account);
                            accountsHtml += '<tr>' +
                                '<td><span class="editableAccount" contenteditable="true" data-account-id="' +
                                account.id + '" data-column="noc">' + account.noc +
                                '</span></td>' +
                                '<td><span class="editableAccount" contenteditable="true" data-account-id="' +
                                account.id + '" data-column="account_number">' + account
                                .account_number +
                                '</span></td>' +
                                '<td><span class="editableAccount" contenteditable="true" data-account-id="' +
                                account.id + '" data-column="exp">' + account.exp +
                                '</span></td>' +
                                '<td><span class="editableAccount" contenteditable="true" data-account-id="' +
                                account.id + '" data-column="cvv1">' + account.cvv1 +
                                '</span></td>' +
                                '<td><select class="editableAccount" data-account-id="' +
                                account.id + '" data-column="charge_card">' +
                                '<option value="1"' + (account.charge_card === true ?
                                    ' selected' : '') + '>Yes</option>' +
                                '<option value="0"' + (account.charge_card === false ?
                                    ' selected' :
                                    '') + '>No</option>' +
                                '</select></td>' +
                                '<td><span class="editableAccount" contenteditable="true" data-account-id="' +
                                account.id + '" data-column="charge">' + account.charge +
                                '</span></td>' +
                                '</tr>';
                        });

                        accountsHtml += '</tbody></table></td></tr>';


                        $(row).append(accountsHtml);
                        $(row).after(accountsHtml);
                    }
                },
                drawCallback: function() {
                    applyInputMasks();
                }
            });


            $('#sale_status_filter').change(function() {
                table.draw();
            });

            function editableColumn(data, type, row, meta) {
                if (meta.settings.aoColumns[meta.col].data === 'comments') {
                    return '<textarea class=" editable w-10" data-id="' + row.id + '" data-column="' + meta.settings
                        .aoColumns[meta.col].data + '">' + data + '</textarea>';
                }
                if (meta.settings.aoColumns[meta.col].data == 'completed_on') {
                    return data ? moment(data).format('LLL') : "-";
                }
                return '<span class=" editable" contenteditable="true" data-id="' + row.id + '" data-column="' +
                    meta
                    .settings.aoColumns[meta.col].data + '">' + data + '</span>';
            }

            function sale_statusDropdown(data, type, row, meta) {
                var sale_statuses = [
                    'Select', 'Charged', 'Approved', 'Dead', 'RNA', 'Pending', 'CallBack', 'Decline',
                    'Chargebacks', 'Refund', 'On Hold', 'REM Charge',
                ];
                var select = '<select class="form-control sale_status-dropdown" data-id="' + row.id + '">';
                for (var i = 0; i < sale_statuses.length; i++) {
                    var selected = (data === sale_statuses[i]) ? 'selected' : '';
                    select += '<option value="' + sale_statuses[i] + '" ' + selected + '>' + sale_statuses[i] +
                        '</option>';
                }
                select += '</select>';
                return select;
            }

            function applyInputMasks() {
                $(".editable[data-column='phone']").inputmask("9999999999");
                $(".editable[data-column='dob']").inputmask("99/99/9999");
                $(".editable[data-column='ssn']").inputmask("999999999");
                $(".editableAccount[data-column='account_number']").inputmask("9999999999999999");
                $(".editableAccount[data-column='exp']").inputmask("99/99");
            }

            $('#customers-table').on('change', '.sale_status-dropdown', function() {
                var id = $(this).data('id');
                var column = 'sale_status';
                var value = $(this).val();
                let sale_statusClass = getClassNameBySaleStatus(value);
                updateCustomer(id, column, value);

                // Get the row corresponding to the changed dropdown
                var row = $(this).closest('tr');

                // Remove old sale status class
                row.removeClass(function(index, className) {
                    return (className.match(/(^|\s)sale_status-\S+/g) || []).join(' ');
                });

                // Add new sale status class
                row.addClass(sale_statusClass);
            });

            $('#customers-table').on('focusout', '.editable', function() {
                var id = $(this).data('id');
                var column = $(this).data('column');
                if (column == 'comments') {
                    var value = $(this).val();
                } else {
                    var value = $(this).text();
                }
                if (isValidCustomerField(column, value)) {
                    updateCustomer(id, column, value);
                }
            });

            $('#customers-table').on('change', 'select.editableAccount', function() {
                var accountId = $(this).data('account-id');
                var column = $(this).data('column');
                var value = $(this).val();
                console.log(value)
                updateAccount(accountId, column, value);
            });

            $(document).on('focusout', '.editableAccount', function() {
                var accountId = $(this).data('account-id');
                var column = $(this).data('column');
                var value = $(this).text();
                if (isValidAccountField(column, value)) {
                    updateAccount(accountId, column, value);
                }
            });



            function isValidCustomerField(column, value) {
                var requiredFields = ['last_name', 'phone', 'ssn', 'city', 'state', 'zip'];
                if (requiredFields.includes(column) && !value.trim()) {
                    Swal.fire({
                        title: 'Error!',
                        text: formatColumnName(column) + ' is required.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return false;
                }
                return true;
            }

            function isValidAccountField(column, value) {
                var requiredFields = ['noc', 'account_number', 'exp', 'cvv1'];
                if (requiredFields.includes(column) && !value.trim()) {
                    Swal.fire({
                        title: 'Error!',
                        text: formatColumnName(column) + ' is required.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    return false;
                }
                return true;
            }

            function updateCustomer(id, column, value) {
                $.ajax({
                    url: ("{{ route('approved_customer-edit', ['id' => '-id-']) }}").replace('-id-', id),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        [column]: value
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error updating the data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }

            function updateAccount(accountId, column, value) {
                $.ajax({
                    url: ("{{ route('approved_customer-edit_account', ['id' => '-id-']) }}").replace('-id-',
                        accountId),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        [column]: value
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'There was an error updating the data.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }


            function formatColumnName(column) {
                return column.split('_')
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                    .join(' ');
            }

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

            // 
            $(document).on('click', '.change_bulk_status', async function(e) {
                let customers = getSelectedCustomers();
                let status = $(this).text();

                if (customers.length > 0) {

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
                            // Proceed with the redirection if confirmed
                            let url = '{{ route('approved_customer-change_bulk_status') }}';

                            // $(customers).each(function(index, customer) {
                            //     url = url + "customers%5B%5D=" + customer + '&';
                            // })
                            // window.location = url;

                            $.ajax({
                                url: url,
                                type: 'POST',
                                dataType: 'json',
                                data: {
                                    customers,
                                    status,
                                },
                                success: function(response) {
                                    if (response.status == true) {
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
        });
    </script>
@endpush
