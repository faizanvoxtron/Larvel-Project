@extends('layouts.admin.app')
@section('page_header')
    {{ $page_header }}
@endsection
@section('content')
    <form method="post" class="needs-validation" id="disable_enter_submit" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box_border">

                            <div class="d-flex align-items-center">
                                <h5>Name : </h5>
                                <h6 class="ml-1 mb-1">
                                    {{ $lead->first_name . ' ' . $lead->middle_name . ' ' . $lead->surname }}
                                </h6>
                            </div>


                            <div class="d-flex align-items-center">
                                <h5>Street : </h5>
                                <h6 class="ml-1 mb-1"> {{ $lead->street }}
                                </h6>
                            </div>

                            <div class="d-flex align-items-center">
                                <h5>State : </h5>
                                <h6 class="ml-1 mb-1"> {{ $lead->state_abbr }}
                                </h6>
                            </div>

                            <div class="d-flex align-items-center">
                                <h5>City : </h5>
                                <h6 class="ml-1 mb-1"> {{ $lead->city }}
                                </h6>
                            </div>

                            <div class="d-flex align-items-center">
                                <h5>Zip : </h5>
                                <h6 class="ml-1 mb-1"> {{ $lead->zip }}
                                </h6>
                            </div>

                            {{-- <div class="d-flex align-items-center my-2">
                                <button type="button" class="btn btn-info phone_lookup"><i
                                        class="icon icon-phone"></i>Phone Lookup</button>
                            </div> --}}


                            <form action="" method="POST">
                                @csrf
                                <div class="phone_numbers_div">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button type="button" class="btn btn-xs btn-info add_phone_div">+</button>
                                        <input type="text" name="phone_numbers[]" maxlength="10"
                                            pattern="[1-9]{1}[0-9]{9}" class="form-control my-2 default_phone" required
                                            placeholder="Enter Phone Number">
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-info">Save</button>
                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.add_phone_div', async function(e) {
            let html = `   <div class="d-flex align-items-center justify-content-between">
                                <button type="button" class="btn btn-xs btn-danger remove_phone_div">X</button>
                                <input type="text" name="phone_numbers[]" maxlength="10"
                                            pattern="[1-9]{1}[0-9]{9}" class="form-control my-2" required
                                            placeholder="Enter Phone Number">
                            </div>`;
            $('.phone_numbers_div').append(html)
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
                    $(this).parent().remove();
                }
            })
        })

        $(document).on('click', '.phone_lookup', async function(e) {
            $("#loader").show();
            $('.phone_lookup').attr('disabled', "disabled");
            $.ajax({
                url: "{{ route('leadcenter-find_person') }}",
                type: 'GET',
                data: {
                    first_name: " {{ $lead->first_name }}",
                    last_name: " {{ $lead->surname }}",
                    middle_name: " {{ $lead->middle_name }}",
                    street_line_1: " {{ $lead->street }}",
                    city: " {{ $lead->city }}",
                    zip: " {{ $lead->zip }}",
                    state: " {{ $lead->state_abbr }}",
                },
                success: function(response) {
                    if (response.status == true && response.data.length > 0) {

                        $('.phone_numbers_div').each(function() {
                            // Within each "phone_numbers_div", find and remove all elements with the class "add_on_phone"
                            $(this).find('.add_on_phone').remove();
                        });
                        response.data.forEach((phone, i) => {
                            if (i == 0) {
                                $(".default_phone").val(phone);
                            } else {
                                let html = `   <div class="d-flex align-items-center justify-content-between add_on_phone">
                                <button type="button" class="btn btn-xs btn-danger remove_phone_div">X</button>
                                <input type="text" name="phone_numbers[]" maxlength="10"
                                    value="${phone}"
                                            pattern="[1-9]{1}[0-9]{9}" class="form-control my-2" required
                                            placeholder="Enter Phone Number">
                                     </div>`;
                                $('.phone_numbers_div').append(html)
                            }
                        })
                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: "No data found"
                        })
                    }

                    $("#loader").hide();
                },
                error: function(xhr, status, error) {
                    $("#loader").hide();
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        })
    </script>
@endpush
