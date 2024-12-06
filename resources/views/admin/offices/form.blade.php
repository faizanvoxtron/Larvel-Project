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
                                {{-- <div class="col-md-12">
                                    <h5 class="box_heading">Administrator Information</h5>
                                </div> --}}
                                <div class="col-md-12 mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ $result ? $result->name : old('name') }}" class="form-control"
                                        placeholder="Enter Name" required>
                                    @error('name')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-12 mb-3">
                                    <label for="email_domain">Email Domain</label>
                                    <input type="email_domain" name="email_domain" id="email_domain"
                                        value="{{ $result ? $result->email_domain : old('email_domain') }}"
                                        class="form-control" placeholder="Enter Email Domain" required>
                                    @error('email_domain')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="ips">Allowed IPs</label>
                                    <select name="ips[]" id="ips" class="form-control select2" multiple required>
                                        {{-- Loop through email domains if available --}}
                                        @foreach ($ips as $ip)
                                            <option value="{{ $ip->id }}"
                                                @if ($result) @if (in_array($ip->id, $office_ips)) selected @endif
                                                @endif>
                                                {{ $ip->identifier }} - {{ $ip->ip }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ips')
                                        <div class="validation-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="mids">MIDs</label>
                                    <select name="mids[]" id="mids" class="form-control select2" multiple required>
                                        {{-- Loop through email domains if available --}}
                                        @foreach ($mids as $mid)
                                            <option value="{{ $mid->id }}"
                                                @if ($result) @if (in_array($mid->id, $office_mids)) selected @endif
                                                @endif>
                                                {{ $mid->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('mids')
                                        <div class="validation-error">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-12 mb-3">
                                    <div class="col-md-6 px-0 mb-3">

                                        <label for="can_login" class="d-block">Can login</label>
                                        @error('capacity')
                                            <div class="validation-error"> {{ $message }}</div>
                                        @enderror
                                        <div class="custom__radio mb-3">
                                            <div class="d-flex box p-0 justify-content-between form-check">
                                                <div class="w-100">
                                                    <input class="form-check-input" name="can_login" type="radio"
                                                        @if ($result) @if ($result->can_login) checked @endif
                                                    @else checked @endif value="1"
                                                    id="yes">
                                                    <label class="form-check-label" for="yes">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="w-100">
                                                    <input class="form-check-input" type="radio" name="can_login"
                                                        value="0" id="no"
                                                        @if ($result) @if (!$result->can_login) checked @endif
                                                        @endif >
                                                    <label class="form-check-label" for="no">
                                                        No
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    @include('general_crud.status_radio')
                                </div>

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
@endpush
