@extends('layouts.register_doctor.app')
@section('form')
    <!-- MultiStep Form -->
    <div class="row">
        <div class="col-md-12">
            <form id="msform" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="text-center">
                    <img src="{{ asset('admin/img/logo_src.svg') }}" alt="" class="logo">
                </div>
                @csrf
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active">About You</li>
                    <li>Education & Experience</li>
                    <li>Consultation details</li>
                </ul>
                <!-- fieldsets -->
                <fieldset>
                    <h2 class="fs-title">About You</h2>
                    <h3 class="fs-subtitle">Tell us something more about you</h3>

                    <label>Prefix</label>
                    <select name="prefix" class="form-control mb-2" required>
                        <option value="Dr" {{ $result ? ($result->doctorDetail->prefix == 'Dr' ? 'selected' : '') : '' }}> Dr </option>
                        <option value="Prof" {{ $result ? ($result->doctorDetail->prefix == 'Prof' ? 'selected' : '') : '' }}> Prof </option>
                        <option value="Mr" {{ $result ? ($result->doctorDetail->prefix == 'Mr' ? 'selected' : '') : '' }}> Mr </option>
                        <option value="Mrs" {{ $result ? ($result->doctorDetail->prefix == 'Mrs' ? 'selected' : '') : '' }}> Mrs </option>
                    </select>

                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ $result ? $result->name : '' }}" required
                        class="form-control" placeholder="Full Name" />

                    <label>Mobile Number</label>
                    <input type="text" id="phone" name="phone" value="{{ $result ? $result->phone : '' }}" required
                        class="form-control phone" placeholder="Mobile Number"/>

                    <label>Email address</label>
                    <input type="email" name="email" pattern=".*@\w{2,}\.\w{2,}" value="{{ $result ? $result->email : '' }}" required
                        class="form-control" placeholder="Email address" />

                    <label>Date of birth</label>
                    <input type="text" required class="form-control datepicker" name="birth_date"
                        placeholder="Date of birth" required value="{{ $result ? $result->birth_date : '' }}" />

                    {{-- <select name="birth_date" class="form-control mb-2" required>
                            @for ($i = 20; $i < 73; $i++)
                                <option>{{ date('Y') - $i }}</option>
                            @endfor
                        </select> --}}
                    <label>PMC Number</label>
                    <input type="text" name="pmc_no" class="form-control" required placeholder="PMC Number"
                        value="{{ $result ? $result->doctorDetail->pmc_no : '' }}" />

                    <label>Gender</label>
                    <select name="gender" class="form-control mb-2" required>
                        <option value="male" {{ $result ? ($result->gender == 'male' ? 'selected' : '') : '' }}>Male
                        </option>
                        <option value="female" {{ $result ? ($result->gender == 'female' ? 'selected' : '') : '' }}>Female
                        </option>
                    </select>

                    <label>City</label>
                    <select name="city_id" class="form-control mb-2" required>
                        <option value="" > Select City </option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}" {{ $result ? ($result->city->name == $city->name ? 'selected' : '') : '' }}> {{$city->name}} </option>
                        @endforeach
                    </select>

                    <label>Total experience in years</label>
                        <select class=" form-control w-100 mb-2" name="expeirence_years">
                            @for($i = 1; $i < 50; $i++)
                            <option value="{{ $i }}"
                                {{ $result ? ($result->doctorDetail->experience_year == $i ? 'selected' : '') : '' }}>
                                {{ $i }}</option>
                            @endfor 
                        </select>

                    <label>Average waiting time in mins</label>
                        <select class=" form-control w-100 mb-2" name="waiting_time">
                            @for($i = 5; $i < 65; $i += 5)
                            <option value="{{ $i }}"
                                {{ $result ? ($result->doctorDetail->waiting_time == $i ? 'selected' : '') : '' }}>
                                {{ $i }}</option>
                            @endfor 
                        </select>

                    <label>Doctor Badge</label>
                    <select name="badge" class="form-control mb-2" required>
                        <option value="silver" {{ $result ? ($result->doctorDetail->badge == 'silver' ? 'selected' : '') : '' }}> Silver </option>
                        <option value="gold" {{ $result ? ($result->doctorDetail->badge == 'gold' ? 'selected' : '') : '' }}> Gold </option>
                        <option value="platinum" {{ $result ? ($result->doctorDetail->badge == 'platinum' ? 'selected' : '') : '' }}> Platinum </option>
                    </select>

                    <label>Introduction about My Self</label>
                    <textarea name="about" rows="4" class="form-control" cols="50"
                        placeholder="Introduction about My Self">{{ $result ? $result->doctorDetail->about : '' }}</textarea>

                    <label>Profile image</label>
                    <input type="file" data-max-file-size="2M" name="image" class="form-control dropify"
                        data-default-file="{{ $result ? asset('storage/' . $result->image) : '' }}"/>



                    <h2 class="fs-title mt-3">Specialties and Services</h2>
                    <h3 class="fs-subtitle">Please select your Specialties and their respective services</h3>

                    <label>Select your specialities</label>
                    @php
                        $doctor_specialities = [];
                        if ($result) {
                            $doctor_specialities = $result->doctorSpecialities->pluck('speciality_id')->toArray();
                        }
                    @endphp
                    <select class="multi_select form-control w-100 specialities" name="specialities[]" multiple="multiple">
                        @foreach ($specialities as $speciality)
                            <option value="{{ $speciality->id }}"
                                {{ $result ? (in_array($speciality->id, $doctor_specialities) ? 'selected' : '') : '' }}>
                                {{ $speciality->name }}</option>
                        @endforeach
                    </select>


                    <label>Select your services</label>
                    <select class="multi_select form-control w-100 services" name="services[]" multiple="multiple">
                        @if ($result)
                            @foreach ($result->doctorServices as $doctor_service)
                                <option value="{{ $doctor_service->service->id }}" selected>
                                    {{ $doctor_service->service->name }}</option>
                            @endforeach
                        @endif
                    </select>


                    <input type="submit" name="next" class="text-center action-button-green form-control" value="Next" />
                </fieldset>

            </form>
        </div>
    </div>
    <!-- /.MultiStep Form -->
@endsection
@push('scripts')
    <script>
        $('.specialities').change(function() {
            var specialities = $(this).val();
            $('.services').html('');
            console.log(specialities)
            $.ajax({
                url: "{{ route('register_doctor_get_services') }}",
                type: 'GET',
                data: {
                    specialities,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        $("#loader").fadeOut();

                        $('.services').html(response.html);

                    } else {
                        $("#loader").fadeOut();
                        swal({
                            title: response.message,
                            icon: "error"
                        })
                    }
                },
            })
        })
    </script>
@endpush
