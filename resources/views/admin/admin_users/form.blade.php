@extends('layouts.admin.app')
@section('page_header')
    {{ $page_header }}
@endsection
@section('content')
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
            <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="box_border">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="box_heading">Administrator Information</h5>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ $result ? $result->name : old('name') }}" class="form-control"
                                        placeholder="Administrator Name" required>
                                    @error('name')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" name="phone" id="phone" maxlength="15"
                                        value="{{ $result ? $result->phone : old('phone') }}" class="form-control"
                                        placeholder="Administrator Phone">
                                    @error('phone')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div
                                    class="col-md-6 mb-3 email_div   @if ($result) @if ($result->office_id) d-none @endif
                                    @endif">

                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ $result ? $result->email : old('email') }}" class="form-control"
                                        placeholder="Administrator Email Address" required>
                                    @error('email')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror

                                </div>

                                <div
                                    class="col-md-6 mb-3 username_div  @if ($result) @if (!$result->office_id) d-none @endif
@else
d-none
                                    @endif">
                                    <div class="row">
                                        <div class="col-6 pr-0">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username"
                                                value="{{ $result ? explode('@', $result->email)[0] : old('username') }}"
                                                class="form-control" placeholder="Agent Username">
                                            @error('username')
                                                <div class="validation-error"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6 pl-0">
                                            <label for="suffix">Suffix</label>
                                            <input type="text" name="suffix" id="suffix" class="form-control"
                                                readonly
                                                value="{{ $result ? $result->office->email_domain ?? '' : old('username') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="role">Role</label>
                                    <select id="role" name="role" required class="form-control role">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $key => $role)
                                            <option value="{{ $role->id }}"
                                                @if ($result) @if ($result->role_id == $role->id) selected @endif
                                                @endif>{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>






                                <div class="col-md-6 mb-3">
                                    <label for="password">Set Password</label>
                                    <small class="text-info">(Enter Password if you want to update current password)</small>
                                    <br>
                                    <small class="text-primary">Password Format : Atleast 8 characters with atleast one
                                        uppercase letter and
                                        one special character</small>
                                    <div class="password_box">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Administrator Password" {{ $result ?: 'required' }}>
                                        <span class="show_password p-2" style="cursor:pointer"><i
                                                class="icon-eye"></i></span>
                                        <span class="hide_password p-2" style="cursor:pointer; display: none;"><i
                                                class="icon icon-eye-hidden2"></i></span>
                                        @error('password')
                                            <div class="validation-error"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div
                                    class="col-md-6 mb-3 office 
                             @if ($result) @if (
                                 $result->role_id != App\Models\User::AGENT_ROLE &&
                                     $result->role_id != App\Models\User::CLOSER_ROLE &&
                                     $result->role_id != App\Models\User::TEAM_LEAD_ROLE &&
                                     $result->role_id != App\Models\User::RNA_SPECIALIST_ROLE &&
                                     $result->role_id != App\Models\User::CB_SPECIALIST_ROLE &&
                                     $result->role_id != App\Models\User::DECLINE_SPECIALIST_ROLE) d-none @endif
@else
d-none @endif ">
                                    <label for="office">Office</label>
                                    <select id="office" name="office" class="form-control office_dropdown">
                                        <option value="">Primary</option>
                                        @foreach ($offices as $key => $office)
                                            <option value="{{ $office->id }}"
                                                data-email_domain="{{ $office->email_domain }}"
                                                @if ($result) @if ($result->office_id == $office->id) selected @endif
                                                @endif>{{ $office->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('office')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div
                                    class="col-md-6 mb-3 m_id
                                        @if ($result) @if ($result->role_id != App\Models\User::FE_ROLE) d-none @endif
@else
d-none @endif ">
                                    <label for="m_id">M ID</label>
                                    <select id="m_id" name="m_id" class="form-control">
                                        @foreach ($m_ids as $key => $m_id)
                                            <option value="{{ $m_id->id }}"
                                                @if ($result) @if ($result->m_id == $m_id->id) selected @endif
                                                @endif>{{ $m_id->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('m_id')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="gender">Gender</label>
                                    <select id="gender" name="gender" required class="form-control role">
                                        <option value="male"
                                            @if ($result) @if ($result->gender == 'male') selected @endif
                                            @endif>Male
                                        </option>

                                        <option value="female"
                                            @if ($result) @if ($result->gender == 'female') selected @endif
                                            @endif>Female
                                        </option>
                                    </select>
                                    @error('gender')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="col-md-6 mb-3">
                                    <label for="multi_device_login">Can Login On Multiple Devices </label>
                                    <select id="multi_device_login" name="multi_device_login" required
                                        class="form-control role">

                                        <option value="0"
                                            @if ($result) @if (!$result->multi_device_login) selected @endif
                                            @endif>No
                                        </option>

                                        <option value="1"
                                            @if ($result) @if ($result->multi_device_login) selected @endif
                                            @endif>Yes
                                        </option>
                                    </select>
                                    @error('multi_device_login')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>


                                {{--  <div class="col-md-6 mb-3 city  @if ($result)  @if ($result->role_id != App\User::PICKUP_DISPATCHER_ROLE) d-none @endif @else d-none @endif ">
                                <label for="city">City</label>
                                <select id="city" name="city" class="form-control city_dropdown">
                                    <option value="">Select City</option>
                                    @foreach ($cities as $key => $city)
                                        <option value="{{ $city->id }}" @if ($result)  @if ($result->city_id == $city->id) selected @endif @endif>{{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('city')<div class="validation-error"> {{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3 region  @if ($result)  @if ($result->role_id != App\User::DELIVERY_TRANSPORTER_ROLE) d-none @endif @else d-none
                                               @endif
                                ">
                                <label for="region">Region</label>
                                <select id="region" name="region" class="form-control region_dropdown">
                                    <option value="">Select Region</option>
                                    @foreach ($regions as $key => $region)
                                        <option value="{{ $region->id }}" @if ($result)  @if ($result->region_id == $region->id) selected @endif @endif>{{ $region->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('outlet')<div class="validation-error"> {{ $message }}</div> @enderror
                            </div> --}}



                                <div class="col-md-6 mb-3">

                                    <label for="status" class="d-block">Administrator Status</label>
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
                                </div>
                            </div>


                        </div>

                    </div>

                    <div class="col-md-4 ">
                        <div class="box_border pb-1 px-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="box_heading px-2">Administrator Photo</h5>
                                    <hr>
                                </div>
                                <div class="col-md-12 px-4 mb-3">
                                    <input type="file" data-max-file-size="2M" name="image" id="image"
                                        value="{{ $result ? $result->image : null }}"
                                        data-allowed-file-extensions="jpg png jpeg" data-max-file-size="5M"
                                        data-default-file="{{ $result ? asset('storage/' . $result->image) : '' }}"
                                        class="dropify">
                                    @error('image')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
                <div class="bg-transparent">
                    <button type="submit" class="cst_btn btn-sm px-5"><i class="icon-save"></i>
                        {{ $result ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.show_password').click(function() {
            $(this).hide();
            $('#password').attr('type', 'text');
            $('.hide_password').show();
        })
        $('.hide_password').click(function() {
            $(this).hide();
            $('#password').attr('type', 'password');
            $('.show_password').show();
        })
        $('.role').change(function() {
            var role_id = $(this).val();
            if (
                role_id == "{{ App\Models\User::AGENT_ROLE }}" ||
                role_id == "{{ App\Models\User::CLOSER_ROLE }}" ||
                role_id == "{{ App\Models\User::TEAM_LEAD_ROLE }}" ||
                role_id == "{{ App\Models\User::RNA_SPECIALIST_ROLE }}" ||
                role_id == "{{ App\Models\User::CB_SPECIALIST_ROLE }}" ||
                role_id == "{{ App\Models\User::DECLINE_SPECIALIST_ROLE }}"
            ) {
                $('.office').removeClass('d-none')

            } else if (role_id == "{{ App\Models\User::FE_ROLE }}") {
                $('.m_id').removeClass('d-none')

                $('.email_div').removeClass('d-none')
                $('.username_div').addClass('d-none')
                $('.office_dropdown').val('');
                $('.office').addClass('d-none')
            } else {
                $('.email_div').removeClass('d-none')
                $('.username_div').addClass('d-none')
                $('.office_dropdown').val('');
                $('.office').addClass('d-none')
                $('.m_id').addClass('d-none')
            }
        })

        $('.office_dropdown').change(function() {
            var office_id = $(this).val();
            var email_domain = $(this).find(":selected").data('email_domain');

            if (office_id != '') {
                $('#suffix').val(email_domain)
                $('.email_div').addClass('d-none')
                $('.username_div').removeClass('d-none')

                $('#username').attr('required', 'required');
                $('#email').attr('required', null);
            } else {
                $('.email_div').removeClass('d-none')
                $('.username_div').addClass('d-none')


                $('#username').attr('required', null);
                $('#email').attr('required', 'required');
            }

            $('.office_dropdown').change();
        })
    </script>
@endpush
