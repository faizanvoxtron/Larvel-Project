@extends('layouts.admin.app')
@section('page_header')
    {{ $page_header }}
@endsection
@section('content')
    <form method="post" class="needs-validation" id="customer_form" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="container-fluid animatedParent animateOnce my-3">
            <div class="animated fadeInUpShort">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box_border">
                            {{-- <div class="row"> --}}

                            <div class="mb-2">
                                <label for="progress">Progress</label>
                                <small>(Press ctrl to select multiple)</small>
                                <select name="progress[]" id="progress" class="select2" multiple>
                                    <option value="">All</option>
                                    @foreach ($progress as $progress)
                                        <option>{{ $progress }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="start_date">Start Date</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" value="">
                            </div>
                            <div class="mb-2">
                                <label for="end_date">End Date</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" value="">
                            </div>


                            <div class="bg-transparent w-100">
                                <button type="submit" class="btn btn-danger m-2 w-100">
                                    <span class="icon-export"></span>
                                    Export and Delete
                                </button>
                            </div>

                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
