@extends('layouts.admin.app')
@section('page_header')
    Fetch Report
@endsection
@section('content')
    <form method="post" class="needs-validation" id="disable_enter_submit" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box_border">
                            <div class="row">

                                <div class="col-md-4">
                                    <label for="firstName">First Name</label>
                                    <input type="text" name="firstName" id="firstName"
                                        value="{{ $customer ? $customer->first_name : old('firstName') }}"
                                        class="form-control" placeholder="Enter First Name" required>
                                    @error('firstName')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" name="lastName" id="lastName"
                                        value="{{ $customer ? $customer->last_name : old('lastName') }}"
                                        class="form-control" placeholder="Enter Last Name" required>
                                    @error('lastName')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone"
                                        value="{{ $customer ? $customer->phone : old('phone') }}" class="form-control"
                                        placeholder="Enter Phonee">
                                    @error('phone')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="ssn">Social Security Number</label>
                                    <input type="text" name="ssn" id="ssn"
                                        value="{{ $customer ? $customer->ssn : old('ssn') }}" class="form-control"
                                        placeholder="Enter Social Security Number" required>
                                    @error('ssn')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="dob">Date Of Birth</label>
                                    <input type="text" name="dob" id="dob"
                                        value="{{ $customer ? $customer->dob : old('dob') }}" class="form-control"
                                        placeholder="YYYY-MM-DD">
                                    @error('dob')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Report Type</label>
                                        <div class="radio-btn">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="report_type"
                                                    id="vantage4" value="vantage4" checked>
                                                <label class="form-check-label" for="vantage4">
                                                    Prequal Vantage 4
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="report_type"
                                                    id="fico9" value="fico9">
                                                <label class="form-check-label" for="fico9">
                                                    FICO 9
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @error('report_type')
                                    <div class="validation-error"> {{ $message }}</div>
                                @enderror

                                {{-- <div class="col-md-4">
                                    <label for="houseNumber">House Number</label>
                                    <input type="text" name="houseNumber" id="houseNumber"
                                        value="{{ $customer ? $customer->house_number : old('houseNumber') }}"
                                        class="form-control" placeholder="Enter House Number" required>
                                    @error('houseNumber')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div> --}}

                                {{-- <div class="col-md-4">
                                    <label for="quadrant">Quadrant</label>
                                    <input type="text" name="quadrant" id="quadrant"
                                        value="{{ $customer ? $customer->quadrant : old('quadrant') }}"
                                        class="form-control" placeholder="NW">
                                    @error('quadrant')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div> --}}

                                <div class="col-md-4">
                                    <label for="streetName">Street Name</label>
                                    <input type="text" name="streetName" id="streetName"
                                        value="{{ $customer ? $customer->street_name : old('streetName') }}"
                                        class="form-control" placeholder="Enter Street Name" required>
                                    @error('streetName')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city"
                                        value="{{ $customer ? $customer->city : old('city') }}" class="form-control"
                                        placeholder="Enter City" required>
                                    @error('city')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="state">State</label>
                                    <input type="text" name="state" id="state"
                                        value="{{ $customer ? $customer->state : old('state') }}" class="form-control"
                                        placeholder="NC" required>
                                    @error('state')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="zip">Zip</label>
                                    <input type="text" name="zip" id="zip"
                                        value="{{ $customer ? $customer->zip : old('zip') }}" class="form-control"
                                        placeholder="Enter Zip" required>
                                    @error('zip')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="bg-transparent w-100">
                                    <button type="submit" class="btn btn-success m-2 w-100 fetch_report">
                                        <span class="icon-download"></span>
                                        Fetch
                                    </button>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                    <div class="row">


                                        <div class="col-md-12 mb-3">
                                            <label for="houseNumber">House Number</label>
                                            <input type="text" name="houseNumber" id="houseNumber"
                                                value="{{ $customer ? $customer->house_number : old('houseNumber') }}"
                                                class="form-control" placeholder="Enter House Number" required>
                                            @error('houseNumber')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <label for="quadrant">Quadrant</label>
                                            <input type="text" name="quadrant" id="quadrant"
                                                value="{{ $customer ? $customer->quadrant : old('quadrant') }}"
                                                class="form-control" placeholder="NW">
                                            @error('quadrant')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <label for="streetName">Street Name</label>
                                            <input type="text" name="streetName" id="streetName"
                                                value="{{ $customer ? $customer->street_name : old('streetName') }}"
                                                class="form-control" placeholder="Enter Street Name" required>
                                            @error('streetName')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <label for="streetType">Street Type</label>
                                            <input type="text" name="streetType" id="streetType"
                                                value="{{ $customer ? $customer->street_type : old('streetType') }}"
                                                class="form-control" placeholder="DR">
                                            @error('streetType')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <label for="city">City</label>
                                            <input type="text" name="city" id="city"
                                                value="{{ $customer ? $customer->city : old('city') }}" class="form-control"
                                                placeholder="Enter City" required>
                                            @error('city')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <label for="state">State</label>
                                            <input type="text" name="state" id="state"
                                                value="{{ $customer ? $customer->state : old('state') }}"
                                                class="form-control" placeholder="NC" required>
                                            @error('state')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <label for="zip">Zip</label>
                                            <input type="text" name="zip" id="zip"
                                                value="{{ $customer ? $customer->zip : old('zip') }}" class="form-control"
                                                placeholder="Enter Zip" required>
                                            @error('zip')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>


                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row">


                                        <div class="col-md-12 mb-3">
                                            <label for="firstName">First Name</label>
                                            <input type="text" name="firstName" id="firstName"
                                                value="{{ $customer ? $customer->first_name : old('firstName') }}"
                                                class="form-control" placeholder="Enter First Name" required>
                                            @error('firstName')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label for="lastName">Last Name</label>
                                            <input type="text" name="lastName" id="lastName"
                                                value="{{ $customer ? $customer->last_name : old('lastName') }}"
                                                class="form-control" placeholder="Enter Last Name" required>
                                            @error('lastName')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>



                                        <div class="col-md-12 mb-3">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" id="phone"
                                                value="{{ $customer ? $customer->phone : old('phone') }}"
                                                class="form-control" placeholder="Enter Phonee">
                                            @error('phone')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-12 mb-3">
                                            <label for="ssn">Social Security Number</label>
                                            <input type="text" name="ssn" id="ssn"
                                                value="{{ $customer ? $customer->ssn : old('ssn') }}"
                                                class="form-control" placeholder="Enter Social Security Number" required>
                                            @error('ssn')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>



                                        <div class="col-md-12 mb-3">
                                            <label for="dob">Date Of Birth</label>
                                            <input type="text" name="dob" id="dob"
                                                value="{{ $customer ? $customer->dob : old('dob') }}"
                                                class="form-control" placeholder="YYYY-MM-DD">
                                            @error('dob')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>



                                        <div class="col-md-12 mb-1">
                                            <div class="form-group">
                                                <label>Report Type</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="report_type"
                                                        id="vantage4" value="vantage4" checked>
                                                    <label class="form-check-label" for="vantage4">
                                                        Prequal Vantage 4
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="report_type"
                                                        id="fico9" value="fico9">
                                                    <label class="form-check-label" for="fico9">
                                                        FICO 9
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @error('report_type')
                                            <div class="validation-error"> {{ $message }}</div>
                                        @enderror



                                    </div>
                                </div> --}}



                        </div>




                    </div>







                </div>

                {{-- <div class="col-md-4">
                    <div class="box_border">
                        <div class="row">


                        </div>
                    </div>

                </div> --}}



            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // $(".fetch_report").click(function() {
        //     $("#loader").show();
        // })
    </script>
@endpush
