@extends('layouts.admin.app')
@section('page_header')
    {{ $page_header }}
@endsection
@push('css')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        textarea:focus,
        input:focus {
            color: #000000 !important;
            font-weight: 300 !important;
        }

        input,
        textarea {
            color: #000000 !important;
            font-weight: 300 !important;
        }

        .countdown-container {
            display: flex;
            align-items: center;
        }

        .countdown-timer {
            margin-left: 10px;
            font-size: 16px;
        }

        .error {
            font-weight: bold;
            color: red
        }

        .custom-control.custom-switch {
            padding-left: 2.25rem;
        }

        .custom-control.custom-switch .custom-control-label::before {
            left: -2.25rem;
            width: 2rem;
            pointer-events: all;
            border-radius: 0.5rem;
        }

        .custom-control.custom-switch .custom-control-label::after {
            top: 0.25rem;
            left: -2.25rem;
            width: 1rem;
            height: 1rem;
            border-radius: 0.5rem;
            background-color: #adb5bd;
            transition: background-color 0.15s ease-in-out, transform 0.15s ease-in-out;
        }

        .custom-control.custom-switch .custom-control-input:checked~.custom-control-label::before {
            background-color: #1dcf3a;
        }

        .custom-control.custom-switch .custom-control-input:checked~.custom-control-label::after {
            background-color: #fff;
            transform: translateX(1rem);
        }

        /* .custom-switch .custom-control-label::before {
                                                                                                                                                                                                            background-color: #adb5bd;
                                                                                                                                                                                                        }
                                                                                                                                                                                                        .custom-switch .custom-control-input:checked ~ .custom-control-label::before {
                                                                                                                                                                                                            background-color: #1dcf3a;
                                                                                                                                                                                                        }
                                                                                                                                                                                                        .custom-switch .custom-control-input:checked ~ .custom-control-label::after {
                                                                                                                                                                                                            background-color: #fff;
                                                                                                                                                                                                            transform: translateX(1rem);
                                                                                                                                                                                                        } */
    </style>
@endpush

@section('content')
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script> --}}
    <form method="post" class="needs-validation" id="customer_form" enctype="multipart/form-data" novalidate>
        @csrf
        <input type="hidden" name="previous_url" value="{{ session('previous_url', url()->previous()) }}">

        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box_border">
                            <div class="row justify-content-between align-items-center">

                                @if (!$result)
                                    <button type="button"
                                        class="btn btn-info d-flex align-items-center import_from_leadcenter mx-1">
                                        <span class="icon-download mr-1"></span>
                                        Import From Leadcenter

                                        <div class="countdown-container ml-4 d-none">
                                            <i class="fas fa-clock"></i>
                                            <div id="countdown" class="countdown-timer">5:00</div>
                                        </div>
                                    </button>
                                @else
                                    <div class="state-timer-container d-flex align-items-center h2 ml-4">
                                        <span class="mr-2">Customer's Time</span>
                                        <i class="fas fa-clock"></i>
                                        <div id="timer" class="ml-2 timer">00:00:00 AM</div>
                                    </div>
                                @endif
                            </div>
                            <br>
                            <div class="row">
                                @if (Auth::user()->role_id == App\Models\User::SUPERADMIN_ROLE)
                                    <div class="col-md-4 mb-3">
                                        <label for="agent_id">Agent</label>
                                        <select id="agent_id" name="agent_id" class="form-control">
                                            <option value="">Select Agent</option>
                                            @foreach ($agents as $key => $agent)
                                                <option value="{{ $agent->id }}"
                                                    @if ($result) @if ($result->agent_id == $agent->id) selected @endif
                                                    @endif>{{ $agent->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('agent_id')
                                            <div class="validation-error"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                                <input type="hidden" name="lead_id" id="lead_id">


                                <div class="col-md-4 mb-3">
                                    <label for="closer_id">Closer Name</label>
                                    <select id="closer_id" name="closer_id" class="form-control">
                                        <option value="">Select Closer</option>
                                        @foreach ($closers as $key => $closer)
                                            <option value="{{ $closer->id }}"
                                                @if ($result) @if ($result->closer_id == $closer->id) selected @endif
                                                @endif>{{ $closer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('closer_id')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="to_person_id">T.O Person</label>
                                    <select id="to_person_id" name="to_person_id" class="form-control">
                                        <option value="">Select T.O Person</option>
                                        @foreach ($t_o_persons as $key => $t_o_person)
                                            <option value="{{ $t_o_person->id }}"
                                                @if ($result) @if ($result->to_person_id == $t_o_person->id) selected @endif
                                                @endif
                                                >{{ $t_o_person->role->name . ' - ' . $t_o_person->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('to_person_id')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" id="first_name"
                                        value="{{ $result ? $result->first_name : old('first_name') }}"
                                        class="form-control" placeholder="Enter First Name">
                                    @error('first_name')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="middle_initial">Middle Initial</label>
                                    <input type="text" name="middle_initial" id="middle_initial"
                                        value="{{ $result ? $result->middle_initial : old('middle_initial') }}"
                                        class="form-control" placeholder="Enter Middle Initial">
                                    @error('middle_initial')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" id="last_name"
                                        value="{{ $result ? $result->last_name : old('last_name') }}" class="form-control"
                                        placeholder="Enter Last Name" required>
                                    @error('last_name')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" required
                                        value="{{ $result ? $result->phone : old('phone') }}" class="form-control mask"
                                        placeholder="Enter Phone">
                                    @error('phone')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ $result ? $result->email : old('email') }}" class="form-control"
                                        placeholder="Enter Email">
                                    @error('email')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="ssn">Social Security Number</label>
                                    <input type="text" name="ssn" id="ssn"
                                        value="{{ $result ? $result->ssn : old('ssn') }}" class="form-control"
                                        placeholder="Enter Social Security Number" required>
                                    @error('ssn')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>




                                <div class="col-md-4">
                                    <label for="dob">Date Of Birth</label>
                                    <input type="date" name="dob" id="dob"
                                        value="{{ $result ? ($result->dob ? \Carbon\Carbon::parse($result->dob)->format('Y-m-d') : old('dob')) : null }}"
                                        class="form-control" placeholder="MM-DD-YYYY"
                                        max="{{ \Carbon\Carbon::today()->subYears(18)->format('Y-m-d') }}">
                                    @error('dob')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="age">Age</label>
                                    <input type="text" name="age" id="age"
                                        value="{{ $result ? $result->age : old('age') }}" class="form-control"
                                        placeholder="Enter Age">
                                    @error('age')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label for="mmn">MMN</label>
                                    <input type="text" name="mmn" id="mmn"
                                        value="{{ $result ? $result->mmn : old('mmn') }}" class="form-control"
                                        placeholder="Enter MMN">
                                    @error('mmn')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>



                                {{-- <div class="col-md-4">
                                    <label for="house_number">House Number</label>
                                    <input type="text" name="house_number" id="house_number"
                                        value="{{ $result ? $result->house_number : old('house_number') }}"
                                        class="form-control" placeholder="Enter House Number" required>
                                    @error('house_number')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div> --}}

                                {{-- <div class="col-md-4">
                                    <label for="quadrant">Quadrant</label>
                                    <input type="text" name="quadrant" id="quadrant"
                                        value="{{ $result ? $result->quadrant : old('quadrant') }}" class="form-control"
                                        placeholder="NW">
                                    @error('quadrant')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <div class="col-md-4">
                                    <label for="street_name">Street Name</label>
                                    <input type="text" name="street_name" id="street_name"
                                        value="{{ $result ? $result->house_number . ' ' . $result->street_name . ' ' . $result->street_type : old('street_name') }}"
                                        class="form-control" placeholder="Enter Street Name" required>
                                    @error('street_name')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city"
                                        value="{{ $result ? $result->city : old('city') }}" class="form-control"
                                        placeholder="Enter City" required>
                                    @error('city')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="state">State</label>
                                    <input type="text" name="state" id="state"
                                        value="{{ $result ? $result->state : old('state') }}" class="form-control"
                                        placeholder="NC" required>
                                    @error('state')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="zip">Zip</label>
                                    <input type="text" name="zip" id="zip"
                                        value="{{ $result ? $result->zip : old('zip') }}" class="form-control"
                                        placeholder="Enter Zip" required>
                                    @error('zip')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- <div class="col-md-12">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" class="form-control w-100" rows="5">{{ $result ? $result->address : old('address') }}</textarea>
                                    @error('address')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div> --}}


                                <div class="col-md-12 ml-0 pl-0">
                                    <button type="button"
                                        class="btn cst_btn-outline btn-danger d-flex align-items-center add_address mt-3 ml-3 px-5">
                                        <span class="icon-add mr-1"></span>
                                        Add Address
                                    </button>
                                </div>


                                <div class="secondary_addresses_div w-100"
                                    data-current_index="{{ isset($result) ? $result->addresses->count() : 0 }}">
                                    @if (isset($result))
                                        @foreach ($result->addresses as $key => $address)
                                            <div class="row m-3 p-3 border border-dark rounded secondary_address_div">
                                                <div class="col-12 d-flex justify-content-between align-items-center p-0">
                                                    <label><strong>Secondary Address</strong></label>
                                                    <button type="button" class="btn btn-sm btn-danger delete_address"><i
                                                            class="fa fa-trash"></i> </button>
                                                </div>

                                                <div class="row">
                                                    {{-- <div class="col-md-4">
                                                        <label for="house_number">House Number</label>
                                                        <input type="text"
                                                            name="addresses[{{ $key }}][house_number]"
                                                            value="{{ $address->house_number }}" id="house_number"
                                                            required class="form-control"
                                                            placeholder="Enter House Number">
                                                        @error('house_number')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div> --}}

                                                    {{-- <div class="col-md-4">
                                                        <label for="quadrant">Quadrant</label>
                                                        <input type="text"
                                                            name="addresses[{{ $key }}][quadrant]"
                                                            value="{{ $address->quadrant }}" id="quadrant"
                                                            class="form-control" placeholder="NW">
                                                        @error('quadrant')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div> --}}

                                                    <div class="col-md-3">
                                                        <label for="street_name">Street Name</label>
                                                        <input type="text"
                                                            name="addresses[{{ $key }}][street_name]"
                                                            value="{{ $address->street_name }}" id="street_name" required
                                                            class="form-control" placeholder="Enter Street Name">
                                                        @error('street_name')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    {{-- <div class="col-md-3"> --}}
                                                    {{-- <label for="street_type">Street Type</label>
                                                        <input type="text"
                                                            name="addresses[{{ $key }}][street_type]"
                                                            value="{{ $address->street_type }}" id="street_type"
                                                            class="form-control" placeholder="DR">
                                                        @error('street_type')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div> --}}

                                                    <div class="col-md-3">
                                                        <label for="city">City</label>
                                                        <input type="text" name="addresses[{{ $key }}][city]"
                                                            id="city" class="form-control" placeholder="Enter City"
                                                            value="{{ $address->city }}" required>
                                                        @error('city')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label for="state">State</label>
                                                        <input type="text"
                                                            name="addresses[{{ $key }}][state]" id="state"
                                                            class="form-control" placeholder="NC"
                                                            value="{{ $address->state }}" required>
                                                        @error('state')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label for="zip">Zip</label>
                                                        <input type="text" name="addresses[{{ $key }}][zip]"
                                                            id="zip" class="form-control" placeholder="Enter Zip"
                                                            value="{{ $address->zip }}" required>
                                                        @error('zip')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    {{-- <div class="col-md-12">
                                                        <label for="address">Address</label>
                                                        <textarea name="addresses[{{ $key }}][address]" id="address" class="form-control w-100" rows="5">{{ $address->address }}</textarea>
                                                        @error('address')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div> --}}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>




                                <div class="col-md-12">
                                    <div class="row d-flex justify-content-between align-items-center mx-2 my-2">
                                        <label for="secondary_phones">Secondry Phones</label>
                                        <button type="button" class="btn btn-xs btn-danger add_phone_div">+ Add
                                            Phone</button>
                                    </div>
                                    <textarea name="secondary_phones" id="secondary_phones" disabled class="form-control w-100" rows="5">{{ $result ? $result->secondary_phones : old('secondary_phones') }}</textarea>
                                    @error('secondary_phones')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                    <div class="phone_numbers_div row">
                                        @if ($result)
                                            @foreach ($result->phones as $secondary_phone)
                                                <div class="col-3 p-1">
                                                    <div class="d-flex align-items-center justify-content-between mx-2">

                                                        <a href="#" data-phone_id="{{ $secondary_phone->id }}"
                                                            data-is_primary="{{ $secondary_phone->is_primary }}"
                                                            title="Toggle Primary Action"
                                                            class="mr-1 {{ $secondary_phone->is_primary ? 'text-warning' : 'text-muted' }} mark_phone_as_primary">
                                                            <i class="fa fa-star"></i></a>
                                                        <input type="text" name="secondary_phone_numbers[]"
                                                            maxlength="10" pattern="[1-9]{1}[0-9]{9}"
                                                            value="{{ $secondary_phone->phone_number }}"
                                                            class="form-control my-2 secondary_phones"
                                                            placeholder="Enter Secondary Phone Number">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>


                                <button type="button"
                                    class="btn cst_btn-outline btn-danger d-flex align-items-center add_account mt-3 ml-3 px-5">
                                    <span class="icon-add mr-1"></span>
                                    Add Card
                                </button>



                                <div class="accounts_div w-100"
                                    data-current_index="{{ isset($result) ? $result->accounts->count() : 0 }}">

                                    @if (isset($result))
                                        @foreach ($result->accounts as $key => $account)
                                            <div class="row m-3 p-3 border border-dark rounded account_div">
                                                <div class="col-12 d-flex justify-content-between align-items-center p-0">
                                                    <label><strong>Card Information</strong></label>
                                                    <button type="button" class="btn btn-sm btn-danger delete_account"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="noc-{{ $key }}">NOC</label>
                                                        <input type="text" name="accounts[{{ $key }}][noc]"
                                                            value="{{ $account->noc }}" id="noc-{{ $key }}"
                                                            required class="form-control" placeholder="Enter NOC"
                                                            {{-- pattern="[A-Za-z\s]*" --}}
                                                            title="Only letters and spaces are allowed">
                                                        @error('noc')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="account_name-{{ $key }}">Bank Name</label>
                                                        <input type="text"
                                                            name="accounts[{{ $key }}][account_name]"
                                                            value="{{ $account->account_name }}"
                                                            id="account_name-{{ $key }}" required
                                                            class="form-control" placeholder="Enter Bank Name">
                                                        @error('account_name')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="toll_free-{{ $key }}">Toll Free</label>
                                                        <input type="text"
                                                            name="accounts[{{ $key }}][toll_free]"
                                                            value="{{ $account->toll_free }}"
                                                            id="toll_free-{{ $key }}" class="form-control"
                                                            placeholder="Enter Toll Free Number">
                                                        @error('toll_free')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="exp-{{ $key }}">Exp</label>
                                                        <input type="text" name="accounts[{{ $key }}][exp]"
                                                            value="{{ $account->exp }}" id="exp-{{ $key }}"
                                                            placeholder="MM/YY" {{-- pattern="^(0[1-9]|1[0-2])\\/\\d{2}$" --}} required
                                                            class="form-control mask exp" placeholder="Enter Exp">
                                                        @error('exp')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="account_number-{{ $key }}">Card #</label>
                                                        <input type="text"
                                                            name="accounts[{{ $key }}][account_number]"
                                                            value="{{ $account->account_number }}"
                                                            id="account_number-{{ $key }}" required
                                                            class="form-control" {{-- pattern="\d{14,16}" --}}
                                                            placeholder="Enter Card Number" minlength="14"
                                                            maxlength="16">
                                                        @error('account_number')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="cvv1-{{ $key }}">CVV/CVV (First CVV)</label>
                                                        <input type="text" name="accounts[{{ $key }}][cvv1]"
                                                            value="{{ $account->cvv1 }}" id="cvv1-{{ $key }}"
                                                            required class="form-control" {{-- pattern="\d{3,4}" --}}
                                                            placeholder="Enter CVV for Card" minlength="3"
                                                            maxlength="4">
                                                        @error('cvv1')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="cvv2-{{ $key }}">CVV/CVV (Second
                                                            CVV)</label>
                                                        <input type="text" name="accounts[{{ $key }}][cvv2]"
                                                            value="{{ $account->cvv2 }}" id="cvv2-{{ $key }}"
                                                            class="form-control" {{-- pattern="\d{3,4}" --}}
                                                            placeholder="Enter Second CVV for Card" minlength="3"
                                                            maxlength="4">
                                                        @error('cvv2')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="balance-{{ $key }}">Balance</label>
                                                        <input type="text"
                                                            name="accounts[{{ $key }}][balance]"
                                                            value="{{ $account->balance }}"
                                                            id="balance-{{ $key }}" class="form-control"
                                                            placeholder="Enter Balance">
                                                        @error('balance')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="available-{{ $key }}">Available</label>
                                                        <input type="text"
                                                            name="accounts[{{ $key }}][available]"
                                                            value="{{ $account->available }}"
                                                            id="available-{{ $key }}" class="form-control"
                                                            placeholder="Enter Available">
                                                        @error('available')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="lp-{{ $key }}">LP</label>
                                                        <input type="text" name="accounts[{{ $key }}][lp]"
                                                            value="{{ $account->lp }}" id="lp-{{ $key }}"
                                                            class="form-control" placeholder="Enter LP">
                                                        @error('lp')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="dp-{{ $key }}">DP</label>
                                                        <input type="text" name="accounts[{{ $key }}][dp]"
                                                            value="{{ $account->dp }}" id="dp-{{ $key }}"
                                                            class="form-control" placeholder="Enter DP">
                                                        @error('dp')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="apr-{{ $key }}">APR%</label>
                                                        <input type="text" name="accounts[{{ $key }}][apr]"
                                                            value="{{ $account->apr }}" id="apr-{{ $key }}"
                                                            class="form-control" placeholder="Enter APR%">
                                                        @error('apr')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label for="poa-{{ $key }}">POA</label>
                                                        <select name="accounts[{{ $key }}][poa]"
                                                            id="poa-{{ $key }}" class="form-control">
                                                            <option value="yes"
                                                                {{ $account->poa == 'yes' ? 'selected' : '' }}>Yes
                                                            </option>
                                                            <option value="no"
                                                                {{ $account->poa == 'no' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                        @error('poa')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>







                                                    <div class="col-md-4">
                                                        <label for="charge-{{ $key }}">Charge on this
                                                            card</label>
                                                        <input type="text"
                                                            name="accounts[{{ $key }}][charge]"
                                                            value="{{ $account->charge }}"
                                                            id="charge-{{ $key }}" class="form-control"
                                                            placeholder="Enter Charge on this card">
                                                        @error('charge')
                                                            <div class="validation-error"> {{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                    <div class="col-md-4">
                                                        <label for="charge_card-{{ $key }}">Charge Card</label>
                                                        <div class="custom-control custom-switch ml-3 mt-3 pt-1">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="charge_card-{{ $key }}"
                                                                name="accounts[{{ $key }}][charge_card]"
                                                                value="1"
                                                                {{ $account->charge_card == true ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                                for="charge_card-{{ $key }}"></label>
                                                        </div>
                                                    </div>












                                                    {{-- @if ($account->poa == 'yes') --}}
                                                    <div class="row p-2 m-2">
                                                        <div class="col-md-4">
                                                            <label for="full_name-{{ $key }}">Full Name</label>
                                                            <input type="text"
                                                                name="accounts[{{ $key }}][full_name]"
                                                                value="{{ $account->full_name }}"
                                                                id="full_name-{{ $key }}" class="form-control"
                                                                placeholder="Enter Full Name">
                                                            @error('full_name')
                                                                <div class="validation-error"> {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        {{-- <div class="col-md-4">
                                                            <label for="address-{{ $key }}">Address</label>
                                                            <input type="text"
                                                                name="accounts[{{ $key }}][address]"
                                                                value="{{ $account->address }}"
                                                                id="address-{{ $key }}" class="form-control"
                                                                placeholder="Enter Address">
                                                            @error('address')
                                                                <div class="validation-error"> {{ $message }}</div>
                                                            @enderror
                                                        </div> --}}
                                                        <div class="col-md-4">
                                                            <label for="ssn-{{ $key }}">SSN</label>
                                                            <input type="text"
                                                                name="accounts[{{ $key }}][ssn]"
                                                                value="{{ $account->ssn }}"
                                                                id="ssn-{{ $key }}" class="form-control"
                                                                placeholder="Enter SSN">
                                                            @error('ssn')
                                                                <div class="validation-error"> {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="mmm-{{ $key }}">Mmm</label>
                                                            <input type="text"
                                                                name="accounts[{{ $key }}][mmm]"
                                                                value="{{ $account->mmm }}"
                                                                id="mmm-{{ $key }}" class="form-control"
                                                                placeholder="Enter Mmm">
                                                            @error('mmm')
                                                                <div class="validation-error"> {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="dob-{{ $key }}">DOB</label>
                                                            <input type="text"
                                                                name="accounts[{{ $key }}][dob]"
                                                                value="{{ $account->dob }}"
                                                                id="dob-{{ $key }}" class="form-control"
                                                                placeholder="Enter DOB">
                                                            @error('dob')
                                                                <div class="validation-error"> {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="relation-{{ $key }}">Relation</label>
                                                            <input type="text"
                                                                name="accounts[{{ $key }}][relation]"
                                                                value="{{ $account->relation }}"
                                                                id="relation-{{ $key }}" class="form-control"
                                                                placeholder="Enter Relation">
                                                            @error('relation')
                                                                <div class="validation-error"> {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- @endif --}}
                                                </div>
                                            </div>
                                        @endforeach


                                    @endif
                                </div>





                                <div class="col-md-12">
                                    <label for="meta">Metadata</label>
                                    {{-- maxlength="300" --}}
                                    <textarea name="meta" id="meta" class="form-control w-100" rows="3">{{ $result ? $result->meta : old('meta') }}</textarea>
                                    @error('meta')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="score">Score</label>
                                    <input type="number" name="score" id="score"
                                        value="{{ $result ? $result->score : old('score') }}" class="form-control"
                                        placeholder="Enter Score" required>
                                    @error('score')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="no_of_oc">No. of Open Cards</label>
                                    <input type="number" name="no_of_oc" id="no_of_oc"
                                        value="{{ $result ? $result->no_of_oc : old('no_of_oc') }}" class="form-control"
                                        placeholder="Enter No. of Open Cards" required>
                                    @error('no_of_oc')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="no_of_ac">No. of Accounts</label>
                                    <input type="number" name="no_of_ac" id="no_of_ac"
                                        value="{{ $result ? $result->no_of_ac : old('no_of_ac') }}" class="form-control"
                                        placeholder="Enter No. of Accounts" required>
                                    @error('no_of_ac')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="td">Total Debt</label>
                                    <input type="number" name="td" id="td"
                                        value="{{ $result ? $result->td : old('td') }}" class="form-control"
                                        placeholder="Enter Total Debt" required>
                                    @error('td')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="ta">Total Available</label>
                                    <input type="number" name="ta" id="ta"
                                        value="{{ $result ? $result->ta : old('ta') }}" class="form-control"
                                        placeholder="Enter Total Available" required>
                                    @error('ta')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="d_to_ir">Debt to Income Ratio %</label>
                                    <input type="number" name="d_to_ir" id="d_to_ir"
                                        value="{{ $result ? $result->d_to_ir : old('d_to_ir') }}" class="form-control"
                                        placeholder="Enter Debt to Income Ratio %" required>
                                    @error('d_to_ir')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-3">
                                    <label for="charge">Total Charge</label>
                                    <input type="number" name="charge" id="charge"
                                        value="{{ $result ? $result->charge : old('charge') }}" class="form-control"
                                        placeholder="Enter Total Charge" required>
                                    @error('charge')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row m-1">
                                    <div class="col-md-12 mb-3">
                                        <label for="progress" class="form-label">Progress</label>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($progress as $index => $value)
                                                <label class="cst_btn-outline btn-sm mb-2 m-1" for="{{ $value }}"
                                                    data-target="#{{ $value }}">
                                                    <input type="radio" name="progress" id="{{ $value }}"
                                                        value="{{ $value }}" required
                                                        @if (($result && $result->progress == $value) || (!$result && $index == 0)) checked @endif>
                                                    {{ $value }}
                                                </label>
                                            @endforeach
                                        </div>
                                        @error('progress')
                                            <div class="validation-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                {{-- <select id="progress" name="progress" class="form-control">
                                        @foreach ($progress as $progress)
                                            <option value="{{ $progress }}"
                                                @if ($result) @if ($result->progress == $progress) selected @endif
                                                @endif>{{ $progress }}
                                            </option>
                                        @endforeach
                                    </select> --}}

                                {{-- <div class="col-md-4 mb-3">

                                    <label for="status" class="d-block">Status</label>
                                    @error('status')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                    <div class="custom__radio mb-3">
                                        <div class="d-flex box p-0 justify-content-between form-check">
                                            <div class="w-100">
                                                <input class="form-check-input" name="status" type="radio"
                                                    @if ($result) @if ($result->status) checked @endif
                                                @else checked @endif
                                                value="1" id="enable">
                                                <label class="form-check-label" for="enable">
                                                    Enable
                                                </label>
                                            </div>
                                            <div class="w-100">
                                                <input class="form-check-input" type="radio" name="status"
                                                    value="0"
                                                    @if ($result) @if (!$result->status) checked @endif
                                                    @endif id="disable">
                                                <label class="form-check-label" for="disable">
                                                    Disable
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}





                                <div class="bg-transparent w-100">
                                    <button type="submit" class="btn btn-success m-2 w-100 fetch_report">
                                        <span class="icon-save"></span>
                                        Save
                                    </button>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>

            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.20.1/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"
        integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            // $(".mask").inputmask();
            $("#phone").inputmask("9999999999");
            $(".secondary_phones").inputmask("9999999999");
            $("#ssn").inputmask("999999999");
            $(".exp").inputmask("99/99");


            // Trigger change event for initial POA fields
            $('[name^="accounts["][name$="[poa]"]').trigger('change');


            @can('hold-after-leadcenter-import')
                const last_lead_used_at = "{{ Auth::user()->last_lead_used_at }}";
                var seconds = checkTimeDifference(last_lead_used_at);
                startCountdown(seconds);
            @endcan
        })


        $(".import_from_leadcenter").click(async function() {
            $("#loader").show();
            let lead = await $.get('{{ route('customer-get_lead') }}')

            if (lead.status == true) {
                $('#lead_id').val(lead.data.id)
                $('#first_name').val(lead.data.first_name);
                $('#city').val(lead.data.city);
                $('#middle_initial').val(lead.data.middle_name);
                $('#last_name').val(lead.data.surname);
                $('#ssn').val(lead.data.ssn);
                $('#email').val(lead.data.email);
                $('#street_name').val(lead.data.street);
                $('#zip').val(lead.data.zip);
                $('#state').val(lead.data.state_abbr);
                $('#age').val(lead.data.age);
                $('#score').val(lead.data.score);
                $('#no_of_oc').val(lead.data.no_of_oc);
                $('#no_of_ac').val(lead.data.no_of_ac);
                $('#td').val(lead.data.td);
                $('#ta').val(lead.data.ta);
                $('#d_to_ir').val(lead.data.d_to_ir);

                if (lead.data.phone != null) {
                    if (lead.data.phone.length > 1) {
                        $('#secondary_phones').val(lead.data.phone)
                    } else {
                        $('#phone').val(lead.data.phone[0]);
                    }
                }


                Toast.fire({
                    icon: 'success',
                    title: "Lead Imported Successfully."
                })
                @can('hold-after-leadcenter-import')
                    startCountdown(360);
                @endcan
            } else {
                Toast.fire({
                    icon: 'error',
                    title: lead.message
                })
            }
            $("#loader").hide();

        })

        function checkTimeDifference(dateTimeString) {
            var givenTime = new Date(dateTimeString);
            var currentTime = new Date();
            var differenceInMillis = currentTime - givenTime;
            var differenceInSeconds = Math.floor(differenceInMillis / 1000);
            if (differenceInSeconds < 360 && differenceInSeconds >= 0) {
                return 360 - differenceInSeconds;
            } else {
                return 0;
            }
        }


        function startCountdown(duration) {
            $('.countdown-container').removeClass('d-none');
            $('.import_from_leadcenter').attr('disabled', 'disabled');
            var countdown = duration;
            var timer = setInterval(function() {
                var minutes = Math.floor(countdown / 60);
                var seconds = countdown % 60;
                seconds = seconds < 10 ? '0' + seconds : seconds;
                $('#countdown').text(minutes + ':' + seconds);
                if (countdown <= 0) {
                    $('.countdown-container').addClass('d-none');
                    $('.import_from_leadcenter').removeAttr('disabled');
                    clearInterval(timer);
                }
                countdown--;
            }, 1000);

        }

        $(document).on('click', '.add_address', function(e) {
            let index = $(".secondary_addresses_div").data('current_index');
            let secondary_address_div_html = ` <div class="row m-3 p-3 border border-dark rounded secondary_address_div">
                                                <div class="col-12 d-flex justify-content-between align-items-center p-0">
                                                    <label><strong>Secondary Address</strong></label>
                                                    <button type="button" class="btn btn-sm btn-danger delete_address"><i
                                                            class="fa fa-trash"></i> </button>
                                                </div>

                                        <div class="row">


                                            <div class="col-md-3">
                                                <label for="street_name">Street Name</label>
                                                <input type="text" name="addresses[${index}][street_name]" id="street_name"
                                                    required class="form-control" placeholder="Enter Street Name">
                                                @error('street_name')
                                                    <div class="validation-error"> {{ $message }}</div>
                                                @enderror
                                            </div>

              
                                            <div class="col-md-3">
                                                <label for="city">City</label>
                                                <input type="text" name="addresses[${index}][city]" id="city"
                                                    class="form-control" placeholder="Enter City" required>
                                                @error('city')
                                                    <div class="validation-error"> {{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-3">
                                                <label for="state">State</label>
                                                <input type="text" name="addresses[${index}][state]" id="state"
                                                    class="form-control" placeholder="NC" required>
                                                @error('state')
                                                    <div class="validation-error"> {{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-3">
                                                <label for="zip">Zip</label>
                                                <input type="text" name="addresses[${index}][zip]" id="zip"
                                                    class="form-control" placeholder="Enter Zip" required>
                                                @error('zip')
                                                    <div class="validation-error"> {{ $message }}</div>
                                                @enderror
                                            </div>

                                           
                                        </div>
                                    </div>`;


            // <div class="col-md-4">
            //             <label for="quadrant">Quadrant</label>
            //             <input type="text" name="addresses[${index}][quadrant]" id="quadrant"
            //                 class="form-control" placeholder="NW">
            //             @error('quadrant')
            //                 <div class="validation-error"> {{ $message }}</div>
            //             @enderror
            //         </div>

            // <div class="col-md-12">
            //             <label for="address">Address</label>
            //             <textarea name="addresses[${index}][address]" id="address" class="form-control w-100" rows="5"></textarea>
            //             @error('address')
            //                 <div class="validation-error"> {{ $message }}</div>
            //             @enderror
            //         </div>
            $(".secondary_addresses_div").append(secondary_address_div_html);
            $(".secondary_addresses_div").data('current_index', (index + 1));
        })

        $(document).on('click', '.delete_address', function(e) {
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
                    let index = $(".secondary_addresses_div").data('current_index');
                    $(this).parent().parent().remove();
                    $(".secondary_addresses_div").data('current_index', (index - 1));
                }
            });
        })



        $(document).on('click', '.add_account', function(e) {
            let index = $(".accounts_div").data('current_index');

            let accounts_div_html = `
        
            <div class="row m-3 p-3 border border-dark rounded account_div">
            <div class="col-12 d-flex justify-content-between align-items-center p-0">
                <label><strong>Card Information</strong></label>
                <button type="button" class="btn btn-sm btn-danger delete_account"><i
                        class="fa fa-trash"></i></button>
            </div>  
                <div class="row">
                    <div class="col-md-4">
                        <label for="noc-${index}">NOC</label>
                        <input type="text" name="accounts[${index}][noc]" id="noc-${index}" required class="form-control" placeholder="Enter NOC" title="Only letters and spaces are allowed">
                        <div class="validation-error" style="display:none">Invalid NOC</div>
                    </div>
                    <div class="col-md-4">
                        <label for="account_name-${index}">Bank Name</label>
                        <input type="text" name="accounts[${index}][account_name]" id="account_name-${index}" required class="form-control" placeholder="Enter Bank Name">
                        <div class="validation-error" style="display:none">Invalid Bank Name</div>
                    </div>
                    <div class="col-md-4">
                        <label for="toll_free-${index}">Toll Free</label>
                        <input type="text" name="accounts[${index}][toll_free]" id="toll_free-${index}" class="form-control" placeholder="Enter Toll Free Number">
                        <div class="validation-error" style="display:none">Invalid Toll Free Number</div>
                    </div>
                    <div class="col-md-4">
                        <label for="exp-${index}">Exp</label>
                        <input type="text" name="accounts[${index}][exp]" id="exp-${index}" required placeholder="MM/YY" class="form-control mask exp" placeholder="Enter Exp">
                        <div class="validation-error" style="display:none">Invalid Exp</div>
                    </div>
                    <div class="col-md-4">
                        <label for="account_number-${index}">Card #</label>
                        <input type="text" name="accounts[${index}][account_number]" id="account_number-${index}" required class="form-control"  placeholder="Enter Card Number" minlength="14" maxlength="16">
                        <div class="validation-error" style="display:none">Invalid Card Number</div>
                    </div>
                    <div class="col-md-4">
                        <label for="cvv1-${index}">CVV/CVV (First CVV)</label>
                        <input type="text" name="accounts[${index}][cvv1]" id="cvv1-${index}" required class="form-control"  placeholder="Enter CVV for Card" minlength="3" maxlength="4">
                        <div class="validation-error" style="display:none">Invalid CVV (First)</div>
                    </div>
                    <div class="col-md-4">
                        <label for="cvv2-${index}">CVV/CVV (Second CVV)</label>
                        <input type="text" name="accounts[${index}][cvv2]" id="cvv2-${index}" class="form-control"  placeholder="Enter Second CVV for Card" minlength="3" maxlength="4">
                        <div class="validation-error" style="display:none">Invalid CVV (Second)</div>
                    </div>
                    <div class="col-md-4">
                        <label for="balance-${index}">Balance</label>
                        <input type="text" name="accounts[${index}][balance]" id="balance-${index}" class="form-control" placeholder="Enter Balance">
                        <div class="validation-error" style="display:none">Invalid Balance</div>
                    </div>
                    <div class="col-md-4">
                        <label for="available-${index}">Available</label>
                        <input type="text" name="accounts[${index}][available]" id="available-${index}" class="form-control" placeholder="Enter Available">
                        <div class="validation-error" style="display:none">Invalid Available</div>
                    </div>
                    <div class="col-md-4">
                        <label for="lp-${index}">LP</label>
                        <input type="text" name="accounts[${index}][lp]" id="lp-${index}" class="form-control" placeholder="Enter LP">
                        <div class="validation-error" style="display:none">Invalid LP</div>
                    </div>
                    <div class="col-md-4">
                        <label for="dp-${index}">DP</label>
                        <input type="text" name="accounts[${index}][dp]" id="dp-${index}" class="form-control" placeholder="Enter DP">
                        <div class="validation-error" style="display:none">Invalid DP</div>
                    </div>
                    <div class="col-md-4">
                        <label for="apr-${index}">APR%</label>
                        <input type="text" name="accounts[${index}][apr]" id="apr-${index}" class="form-control" placeholder="Enter APR%">
                        <div class="validation-error" style="display:none">Invalid APR%</div>
                    </div>

                    <div class="col-md-4">
                        <label for="poa-${index}">POA</label>
                        <select name="accounts[${index}][poa]" id="poa-${index}" class="form-control">
                            <option value="yes">Yes</option>
                            <option value="no" selected >No</option>
                        </select>
                        <div class="validation-error" style="display:none">Invalid POA</div>
                    </div>

                    
                    <div class="col-md-4">
                        <label for="charge-${index}">Charge on this card</label>
                        <input type="text" name="accounts[${index}][charge]" id="charge-${index}" class="form-control" placeholder="Enter Charge on this card">
                        <div class="validation-error" style="display:none">Invalid Charge on this card</div>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="charge_card-${index}">Charge Card</label>
                        <div class="custom-control custom-switch ml-3 mt-3 pt-1">
                            <input type="checkbox" class="custom-control-input"
                                id="charge_card-${index}"
                                name="accounts[${index}][charge_card]"
                                value="1">
                            <label class="custom-control-label"
                                for="charge_card-${index}"></label>
                        </div>
                    </div>

                    
                    
                    <div class="row p-2 m-2">
                    <div class="col-md-4">
                        <label for="full_name-${index}">Full Name</label>
                        <input type="text" name="accounts[${index}][full_name]" id="full_name-${index}" class="form-control" placeholder="Enter Full Name">
                        <div class="validation-error" style="display:none">Invalid Full Name</div>
                    </div>
                    <div class="col-md-4">
                        <label for="address-${index}">Address</label>
                        <input type="text" name="accounts[${index}][address]" id="address-${index}" class="form-control" placeholder="Enter Address">
                        <div class="validation-error" style="display:none">Invalid Address</div>
                    </div>
                    <div class="col-md-4">
                        <label for="ssn-${index}">SSN</label>
                        <input type="text" name="accounts[${index}][ssn]" id="ssn-${index}" class="form-control" placeholder="Enter SSN">
                        <div class="validation-error" style="display:none">Invalid SSN</div>
                    </div>
                    <div class="col-md-4">
                        <label for="mmm-${index}">Mmn</label>
                        <input type="text" name="accounts[${index}][mmm]" id="mmm-${index}" class="form-control" placeholder="Enter Mmm">
                        <div class="validation-error" style="display:none">Invalid Mmm</div>
                    </div>
                    <div class="col-md-4">
                        <label for="dob-${index}">DOB</label>
                        <input type="text" name="accounts[${index}][dob]" id="dob-${index}" class="form-control" placeholder="Enter DOB">
                        <div class="validation-error" style="display:none">Invalid DOB</div>
                    </div>
                    <div class="col-md-4">
                        <label for="relation-${index}">Relation</label>
                        <input type="text" name="accounts[${index}][relation]" id="relation-${index}" class="form-control" placeholder="Enter Relation">
                        <div class="validation-error" style="display:none">Invalid Relation</div>
                    </div>
                </div>
                </div>
            </div>`;
            $(".accounts_div").append(accounts_div_html);
            $(".accounts_div").data('current_index', (index + 1));
            $(".exp").inputmask("99/99");
            $('[name^="accounts["][name$="[poa]"]').change()
        })


        $(document).on('change', '[name^="accounts["][name$="[poa]"]', function() {
            let index = $(this).attr('name').match(/\[(\d+)\]/)[1]; // Extract index from name
            let poaValue = $(this).val();
            console.log("poaValue", poaValue);
            if (poaValue === 'yes') {
                $(`#full_name-${index}, #address-${index}, #ssn-${index}, #mmm-${index}, #dob-${index}, #relation-${index}`)
                    .closest('.col-md-4').slideDown();
            } else {
                $(`#full_name-${index}, #address-${index}, #ssn-${index}, #mmm-${index}, #dob-${index}, #relation-${index}`)
                    .closest('.col-md-4').slideUp();
            }
        });

        $(document).on('click', '.delete_account', function(e) {
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

                    let index = $(".accounts_div").data('current_index');
                    $(this).parent().parent().remove();
                    $(".accounts_div").data('current_index', (index - 1));

                }
            });
        })










        $(document).on('click', '.add_phone_div', async function(e) {
            let html = `
                <div class="col-3 p-1">
                    <div class="d-flex align-items-center justify-content-between mx-2">
                                <button type="button" class="btn btn-xs btn-danger remove_phone_div">X</button>
                                <input type="text" name="secondary_phone_numbers[]" maxlength="10"
                                            pattern="[1-9]{1}[0-9]{9}" class="form-control my-2 secondary_phones" required
                                            placeholder="Enter Secondary Phone Number">
                            </div>
                    </div>
            `;
            $('.phone_numbers_div').append(html)
            $(".secondary_phones").inputmask("9999999999");
        })


        $(document).on('click', '.remove_phone_div', async function(e) {
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
                    $(this).parent().parent().remove();
                }
            });
        })




        $(document).on('click', '.mark_phone_as_primary', async function(e) {
            Swal.fire({
                title: "Are you sure?",
                // text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1E3A5F",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let phone_id = $(this).data('phone_id');
                    let is_primary = $(this).data('is_primary');
                    let response = await $.post('{{ route('customer-mark_phone_as_primary') }}', {
                        phone_id,
                        is_primary
                    })
                    if (response.status == true) {
                        $(this).toggleClass('text-muted text-warning')
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: response.message
                        })
                    }
                }
            });
        })





        // document.getElementById('customer_form').addEventListener('submit', function(event) {
        //     event.preventDefault(); // Prevent the form from submitting immediately
        //     if (confirm('Are you sure you want to submit this form?')) {
        //         this.submit(); // If the user confirms, submit the form
        //     }
        // });
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[type="radio"][name="progress"]');

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    radios.forEach(r => {
                        const label = r.parentElement;
                        if (r.checked) {
                            label.classList.add('checked');
                        } else {
                            label.classList.remove('checked');
                        }
                    });
                });

                // Initially check if any radio is already checked
                if (radio.checked) {
                    radio.parentElement.classList.add('checked');
                }
            });
        });








        $("#customer_form_").validate({
            rules: {
                name: "required",
                email: {
                    required: true,
                    email: true
                },
                "exp[]": {
                    required: true,
                    regex: "^(0[1-9]|1[0-2])\/\d{2}$"
                }
            },
            submitHandler: function(form) {
                // do other things for a valid form
                form.submit();
            }
        });
    </script>


    @if ($result)
        <script>
            // Use the time passed from the controller as the initial time
            const serverTime = "{{ $formattedTime }}"; // Example: "03:30:00 PM"
            const [time, meridiem] = serverTime.split(' '); // Split into time and AM/PM
            const [hours, minutes, seconds] = time.split(':').map(Number);

            let timerDate = new Date();
            timerDate.setHours(hours + (meridiem === 'PM' && hours !== 12 ? 12 : 0) - (meridiem === 'AM' && hours === 12 ? 12 :
                0));
            timerDate.setMinutes(minutes);
            timerDate.setSeconds(seconds);

            function updateTimer() {
                timerDate.setSeconds(timerDate.getSeconds() + 1);

                let hh = timerDate.getHours();
                const mm = String(timerDate.getMinutes()).padStart(2, '0');
                const ss = String(timerDate.getSeconds()).padStart(2, '0');
                const ampm = hh >= 12 ? 'PM' : 'AM';
                hh = hh % 12 || 12; // Convert to 12-hour format

                document.getElementById('timer').textContent = `${String(hh).padStart(2, '0')}:${mm}:${ss} ${ampm}`;
            }

            setInterval(updateTimer, 1000);
        </script>
    @endif
@endpush
