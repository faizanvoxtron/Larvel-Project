@extends('layouts.widget.app')
@section('page_header')
{{ Str::singular($page_header) }}
@endsection
@section('content')
<div class="container-fluid animatedParent animateOnce my-3">
    <div class="animated fadeInUpShort">
        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            <div class="row">


                <div class="col-md-12">

                    @if (isset($include_translation_section) && $include_translation_section)
                    <div class="card no-b  no-r">
                        <div class="row card-body">
                            <div class="col-md-12">
                                <h5 class="box_heading">Language And Translation</h5>
                            </div>
                            @include('general_crud.languages_dropdown')
                            @include('general_crud.english_records_dropdown')
                        </div>
                    </div>
                    <br>
                    @endif
                    <div class="card no-b  no-r">
                        <div class="card-body">
                            @if (isset($reference))
                            @include('general_crud.general_widget_content', $reference)
                            @endif
                            @if ($input_elements)
                            @foreach ($input_elements as $key => $input_field)
                            @if ($input_field['element_type'] == 'input')
                            @include('general_crud.input', $input_field)
                            @elseif ($input_field['element_type'] == 'textarea')
                            @include('general_crud.textarea', $input_field)
                            @elseif ($input_field['element_type'] == 'dropdown')
                            @include('general_crud.dropdown', $input_field)
                            @elseif ($input_field['element_type'] == 'radio')
                            @include('general_crud.radio', $input_field)
                            @endif
                            @if ($input_field['element_type'] == 'image')
                            @include('general_crud.image', $input_field)
                            @endif
                            @endforeach
                            @endif
                            @if ($include_status_radio)
                            @include('general_crud.status_radio')
                            @endif
                        </div>

                    </div>


                </div>

                <div class="form-group col-12 d-flex justify-content-start mt-4 text-left">
                    <button type="submit" class="btn btn-success mt-2"><i class="icon-save"></i>
                        {{ $result ? 'Update' : 'Save' }}
                    </button>
                </div>

                {{-- <div class="col-md-8 card">
                        <div class="row">

                            @foreach ($input_elements as $key => $input_field)
                                @if ($input_field['element_type'] == 'input')
                                    @include('general_crud.input',$input_field)
                                @elseif ($input_field['element_type'] == 'textarea')
                                    @include('general_crud.textarea',$input_field)
                                @elseif ($input_field['element_type'] == 'dropdown')
                                    @include('general_crud.dropdown',$input_field)
                                @elseif ($input_field['element_type'] == 'radio')
                                    @include('general_crud.radio',$input_field)
                                @endif
                            @endforeach
                            @if ($include_status_radio)
                                @include('general_crud.status_radio',$input_field)
                            @endif


                        </div>

                    </div>

                    <div class="col-md-4 card">
                        <div class="row">

                            @foreach ($input_elements as $key => $input_field)
                                @if ($input_field['element_type'] == 'image')
                                    @include('general_crud.image',$input_field)
                                @endif
                            @endforeach

                        </div>
                    </div>

                </div>
                <div class="bg-transparent">
                    <button type="submit" class="btn btn-primary"><i class="icon-save"></i>
                        {{ $result ? 'Update' : 'Save' }}
                </button>
            </div> --}}
        </form>
    </div>
</div>
@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        $('.lang_id').change(function() {
            var lang_id = $(this).val();
            if (lang_id == '1') {
                $('.translation_of').attr('required', '');
                $('.translation_of_div').slideUp();

            } else {
                $('.translation_of').attr('required', 'required');
                $('.translation_of_div').slideDown();
            }
        })
    })

</script>
@endpush
