@extends('layouts.admin.app')
@section('page_header')
    Customer Profile
@endsection
@push('css')
    <style>
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row my-3 mx-1">
            {{-- <div class=""> --}}
            <div class="card m-0 p-0 col-4">
                <div class="card-header">Personal Information </div>
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between align-items-center">
                        {{ $customer->first_name . ' ' . $customer->last_name }}
                    </h5>
                    <p class="card-text">
                        <span class="icon icon-phone"> {{ $customer->phone ?? '-' }}</span>
                        <br>
                        <span class="icon icon-envelope"> {{ $customer->email ?? '-' }}</span>
                        <br>
                        <span class="icon icon-lock"> {{ $customer->ssn ?? '-' }}</span>
                        <br>
                        <span class="icon icon-calendar">
                            {{ $customer->dob ? Carbon\Carbon::parse($customer->dob)->isoFormat('ll') : '-' }}</span>
                    </p>
                    <br>
                    <button type="button" class="btn btn btn-sm btn-info" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        View More
                    </button>
                </div>
            </div>

            <div class="card mx-2 p-0 col-4" style="max-width: 18rem;">
                <div class="card-header">Marked As Complete</div>
                <div class="card-body text-center align-items-center">

                    <span class="">
                        @if ($customer->is_complete)
                            <h4 class="">Completed</h4><lord-icon src="https://cdn.lordicon.com/oqdmuxru.json"
                                trigger="hover" colors="primary:#27a744" style="width:120px;height:120px">
                            </lord-icon>
                        @else
                            <h4 class="">Incomplete</h4>
                            <lord-icon src="https://cdn.lordicon.com/zxvuvcnc.json" trigger="hover" colors="primary:#dc3545"
                                style="width:120px;height:120px">
                            </lord-icon>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        @can('view-reports')
            <div class="card p-3 m-2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-header with-border">
                            <div class="d-flex justify-content-between">
                                <h4>Reports</h4>
                                @can('fetch-report')
                                    <a href="{{ route('report-fetch', ['customer_id' => $customer->e_id]) }}"
                                        class="btn-success btn-sm btn mb-2 cursor-pointer">
                                        <i class=" icon-add"></i>
                                        Fetch Report
                                    </a>
                                @endcan
                            </div>
                        </div>
                        @csrf
                        <table id="" class="table table-bordered table-hover" style="width:100%;">
                            <thead>
                                <tr>
                                    <th width=" 10px">#</th>
                                    <th class="">Type</th>
                                    <th width="250px">Attached</th>
                                    <th width="250px">Fetched On</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="">

                                @foreach ($customer->reports as $key => $report)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="sequence[]" value="{{ $report->id }}">
                                            {{ $key + 1 }}
                                        </td>
                                        <td> {{ $report->report_type }}</td>
                                        <td>
                                            @if ($report->reportRequest)
                                                <span class="badge p-2 badge-success">Yes</span>
                                            @else
                                                <span class="badge p-2 badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $report->created_at ? Carbon\Carbon::parse($report->created_at)->isoFormat('llll') : '-' }}
                                        </td>
                                        <td>
                                            <a class="btn-info btn-sm btn cursor-pointer" target="_blank"
                                                href="{{ route('report-detail', ['id' => $report->e_id]) }}">
                                                <i class="icon-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- <button type="submit" class="btn btn-sm mb-2 btn-success">
                            Update sequence
                        </button> --}}
                    </div>
                </div>
            </div>
        @endcan


        <div class="card p-3 m-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-header with-border">
                        <div class="d-flex justify-content-between">
                            <h4>All cards</h4>
                        </div>
                    </div>
                    @csrf
                    <table id="" class="table table-bordered table-hover" style="width:100%;">
                        <thead>
                            <tr>
                                <th width=" 10px">#</th>
                                <th class="">NOC</th>
                                <th width="">Card #</th>
                                <th width="">Bank Name</th>
                                <th width="">EXP</th>
                                <th width="">CVV</th>
                                <th width="">POA</th>
                                <th width="">charge Card</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">

                            @foreach ($customer->accounts as $key => $account)
                                <tr>
                                    <td>
                                        <input type="hidden" name="sequence[]" value="{{ $account->id }}">
                                        {{ $key + 1 }}
                                    </td>
                                    <td> {{ $account->noc }}</td>
                                    <td class="account_number">
                                        <span class="visible_account_number">{{ $account->account_number }}</span>
                                        <span class="hidden_account_number" style="display:none;">
                                            {{ str_repeat('*', strlen($account->account_number) - 4) . substr($account->account_number, -4) }}
                                        </span>
                                    </td>
                                    <td> {{ $account->account_name }}</td>
                                    <td> {{ $account->exp }}</td>
                                    <td> {{ $account->cvv1 }}</td>
                                    <td> {{ $account->poa ? 'Yes' : 'No' }}</td>
                                    <td> {{ $account->charge_card ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <button type="button"
                                            class="btn-info btn-sm btn cursor-pointer toggle_visibility_ view_account_details"
                                            data-visible="1" data-account_detail='{{ $account }}'>
                                            <i class="icon_ icon-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- <button type="submit" class="btn btn-sm mb-2 btn-success">
                            Update sequence
                        </button> --}}
                </div>
            </div>
        </div>

        @can('access-customer-recordings')
            <div class="card p-3 m-2">
                <div class="row">
                    @foreach ($customer->recordings as $recording)
                        <div class="col-md-4 mb-3">
                            <div class="mb-2 ml-2">
                                <h6>{{ $recording->date }}</h6>
                            </div>
                            <audio class="audioPlayer" controls>
                                <source src="{{ asset('storage/' . $recording->source) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    @endforeach
                </div>
            </div>
        @endcan

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Personal Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <dl class="row">

                            {{-- <dt class="col-sm-4">Quadrant</dt>
                            <dd class="col-sm-8">{{ $customer->quadrant ?? '-' }}</dd> --}}

                            <dt class="col-sm-4">Street Name</dt>
                            <dd class="col-sm-8">{{ $customer->street_name ?? '-' }}</dd>

                            <dt class="col-sm-4">City</dt>
                            <dd class="col-sm-8">{{ $customer->city ?? '-' }}</dd>

                            <dt class="col-sm-4">Statte</dt>
                            <dd class="col-sm-8">{{ $customer->state ?? '-' }}</dd>

                            <dt class="col-sm-4">Zip</dt>
                            <dd class="col-sm-8">{{ $customer->zip ?? '-' }}</dd>



                        </dl>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="account_details_modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Account Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <dl class="row">

                            <dt class="col-sm-4">NOC</dt>
                            <dd class="col-sm-8 noc"></dd>

                            <dt class="col-sm-4">Bank Name</dt>
                            <dd class="col-sm-8 account_name"></dd>

                            <dt class="col-sm-4">Toll Free</dt>
                            <dd class="col-sm-8 toll_free"></dd>

                            <dt class="col-sm-4">Exp</dt>
                            <dd class="col-sm-8 exp"></dd>

                            <dt class="col-sm-4">Card #</dt>
                            <dd class="col-sm-8 account_number"></dd>

                            <dt class="col-sm-5">CVV/CVV (First CVV)</dt>
                            <dd class="col-sm-4 cvv1"></dd>

                            <dt class="col-sm-6">CVV/CVV (Second CVV)</dt>
                            <dd class="col-sm-4 cvv2"></dd>

                            <dt class="col-sm-4">Balance</dt>
                            <dd class="col-sm-8 balance"></dd>

                            <dt class="col-sm-4">Available</dt>
                            <dd class="col-sm-8 available"></dd>

                            <dt class="col-sm-4">LP</dt>
                            <dd class="col-sm-8 lp"></dd>

                            <dt class="col-sm-4">DP</dt>
                            <dd class="col-sm-8 dp"></dd>


                            <dt class="col-sm-4">Charge Card</dt>
                            <dd class="col-sm-8 charge_card"></dd>


                            <dt class="col-sm-4">Charge</dt>
                            <dd class="col-sm-8 charge"></dd>

                            <dt class="col-sm-4">APR%</dt>
                            <dd class="col-sm-8 apr"></dd>

                            <dt class="col-sm-4">POA</dt>
                            <dd class="col-sm-8 poa"></dd>

                            <dt class="col-sm-4">Full Name</dt>
                            <dd class="col-sm-8 full_name"></dd>

                            <dt class="col-sm-4">Address</dt>
                            <dd class="col-sm-8 address"></dd>

                            <dt class="col-sm-4">SSN</dt>
                            <dd class="col-sm-8 ssn"></dd>

                            <dt class="col-sm-4">Mmn</dt>
                            <dd class="col-sm-8 mmm"></dd>

                            <dt class="col-sm-4">DOB</dt>
                            <dd class="col-sm-8 dob"></dd>

                            <dt class="col-sm-4">Relation</dt>
                            <dd class="col-sm-8 relation"></dd>

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="https://cdn.lordicon.com/lordicon.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.toggle_visibility').forEach(button => {
                    button.addEventListener('click', function() {
                        let visible = this.dataset.visible === '1';
                        let accountNumberCell = this.closest('tr').querySelector('.account_number');
                        let visibleAccountNumber = accountNumberCell.querySelector(
                            '.visible_account_number');
                        let hiddenAccountNumber = accountNumberCell.querySelector(
                            '.hidden_account_number');
                        let icon = this.querySelector('.icon_');

                        if (visible) {
                            visibleAccountNumber.style.display = 'none';
                            hiddenAccountNumber.style.display = 'inline';
                            icon.classList.remove('icon-eye');
                            icon.classList.add('icon-eye-slash');
                            this.dataset.visible = '0';
                        } else {
                            visibleAccountNumber.style.display = 'inline';
                            hiddenAccountNumber.style.display = 'none';
                            icon.classList.remove('icon-eye-slash');
                            icon.classList.add('icon-eye');
                            this.dataset.visible = '1';
                        }
                    });
                });
            });

            $(document).ready(function() {
                $(".view_account_details").click(function() {
                    var accountDetail = $(this).data("account_detail");

                    $("#account_details_modal .noc").text(accountDetail.noc);
                    $("#account_details_modal .account_name").text(accountDetail.account_name);
                    $("#account_details_modal .toll_free").text(accountDetail.toll_free);
                    $("#account_details_modal .exp").text(accountDetail.exp);
                    $("#account_details_modal .account_number").text(accountDetail.account_number);
                    $("#account_details_modal .cvv1").text(accountDetail.cvv1);
                    $("#account_details_modal .cvv2").text(accountDetail.cvv2);
                    $("#account_details_modal .balance").text(accountDetail.balance);
                    $("#account_details_modal .available").text(accountDetail.available);
                    $("#account_details_modal .lp").text(accountDetail.lp);
                    $("#account_details_modal .dp").text(accountDetail.dp);
                    $("#account_details_modal .apr").text(accountDetail.apr);
                    $("#account_details_modal .charge_card").text(accountDetail.charge_card == 1 ? "Yes" :
                        "No");
                    $("#account_details_modal .charge").text(accountDetail.charge);
                    $("#account_details_modal .poa").text(accountDetail.poa);
                    $("#account_details_modal .full_name").text(accountDetail.full_name);
                    $("#account_details_modal .address").text(accountDetail.address);
                    $("#account_details_modal .ssn").text(accountDetail.ssn);
                    $("#account_details_modal .mmm").text(accountDetail.mmm);
                    $("#account_details_modal .dob").text(accountDetail.dob);
                    $("#account_details_modal .relation").text(accountDetail.relation);

                    $("#account_details_modal").modal("show");

                    createLog("{{ $customer->id }}", "{{ $CARD_VIEWED }}");
                });
            });

            $('.audioPlayer').on('play', function() {
                createLog("{{ $customer->id }}", "{{ $RECORDING_PLAYED }}");
            });
        </script>
    @endpush
