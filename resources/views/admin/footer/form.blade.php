@extends('layouts.admin.app')
@php
$lang_id = request()->route()->parameters['lang_id'];
($language = App\Models\Language::find(decrypt($lang_id)));
@endphp
@section('page_header')
    {{ $page_header . " (".$language->name.")"}}
@endsection
@section('content')
    <form method="post" class="needs-validation" id="disable_enter_submit" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="box_border">
                            <div class="row">
                                <div class="col-md-12">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ $result ? $result->name : old('name') }}" class="form-control"
                                        placeholder="Enter Name" required>
                                    @error('name')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3 link_div">
                                    <label for="link">Link</label>
                                    <input type="text" name="link" id="link"
                                        value="{{ $result ? $result->link : old('link') }}" class="form-control link"
                                        placeholder="Enter Link" required>
                                    @error('link')
                                        <div class="validation-error"> {{ $message }}</div>
                                    @enderror
                                </div>

                                @include('general_crud.status_radio')

                            </div>
                        </div>






                        <div class="bg-transparent">
                            <button type="submit" class="cst_btn px-5 btn-sm">
                                {{-- <i class="icon-save"></i> --}}
                                {{ $result ? 'Update' : 'Save' }}
                            </button>
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
        $(document).ready(function() {
            let type = "{{$result->type ?? 'nav-link'}}"
            ShowHideFieldsByType(type);
            $('.type').change(function() {
                let type = $(this).val();
                ShowHideFieldsByType(type);
            })

            function ShowHideFieldsByType(type){
                if (type == 'nav-link') {
                    showLink();
                    hideParent();
                    hideColumnWidth();
                } else if (type == 'nav-link-with-dropdown') {
                    hideLink();
                    hideParent();
                    hideColumnWidth();
                } else if (type == 'dropdown-header') {
                    showLink();
                    getParents(type);
                    showParent();
                    showColumnWidth();
                } else if (type == 'dropdown-link') {
                    showLink();
                    getParents(type);
                    showParent();
                    hideColumnWidth();
                }

            }

            function showLink() {
                $('.link_div').slideDown();
                $('.link').attr('required', 'required');
            }

            function hideLink() {
                $('.link_div').slideUp();
                $('.link').removeAttr('required');
            }

            function hideParent() {
                $('.parent_div').slideUp();
            }

            function showParent() {
                $('.parent_div').slideDown();
            }


            function hideColumnWidth() {
                $('.col_width_div').slideUp();
            }

            function showColumnWidth() {
                $('.col_width_div').slideDown();
            }

            function getParents(type) {
                $('#loader').show();
                $.ajax({
                    url: "{{ route('menu-get-parent-by-type') }}",
                    type: 'GET',
                    data: {
                        type,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            $("#loader").fadeOut();

                            $('.parents').html(response.html);

                        } else {
                            $("#loader").fadeOut();
                            swal({
                                title: response.message,
                                icon: "error"
                            })
                        }
                    },
                })
            }


        })
    </script>
@endpush
