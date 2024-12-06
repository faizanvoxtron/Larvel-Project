@extends('layouts.admin.app')
@section('page_header')
    Dashboard
@endsection
@push('css')
    <link rel="stylesheet" type="text/css"
        href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row my-3">
            @can('access-dashboard')
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-user primary font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{ number_format($total_managers) }}</h3>
                                        <span>Total Managers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-user primary font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{ number_format($total_agents) }}</h3>
                                        <span>Total Agents</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-minus-circle primary font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{ number_format($pending_requests) }}</h3>
                                        <span>Pending Requests</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-user primary font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{ number_format($total_customers) }}</h3>
                                        <span>Total Customers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-check primary font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{ number_format($complete_customers) }}</h3>
                                        <span>Complete Customers</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-hourglass primary font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{ number_format($total_leads) }}</h3>
                                        <span>Total Leads</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        <i class="fa fa-hourglass-half primary font-large-2 float-left"></i>
                                    </div>
                                    <div class="media-body text-right">
                                        <h3>{{ number_format($incomplete_leads) }}</h3>
                                        <span>Incomplete Leads</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <h5><span class="text-success"><i class="fa fa-circle"></i></span> Online Users </h5>
                                <div class="ml-1 d-flex justify-content-between">
                                    <b>Agents</b>
                                    <b>{{ number_format($online_agents) }}/{{ number_format($total_agents) }}</b>
                                </div>


                                <div class="mx-3 mt-1 mb-2 ">
                                    @foreach ($offices as $office)
                                        <div class="d-flex justify-content-between">
                                            <h6>{{ $office->name }}</h6>
                                            <h6>{{ number_format(count($office->agents->where('is_online', 1))) }}/{{ number_format(count($office->agents)) }}
                                            </h6>
                                        </div>
                                    @endforeach
                                </div>


                                <div class="ml-1 d-flex justify-content-between">
                                    <h6>Mangers</h6>
                                    <h6>{{ number_format($online_managers) }}/{{ number_format($total_managers) }}</h6>
                                </div>
                                <div class="ml-1 d-flex justify-content-between">
                                    <h6>RND Agents</h6>
                                    <h6>{{ number_format($online_rnd_agents) }}/{{ number_format($total_rnd_agents) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    @endsection

    @push('scripts')
        <script>
            // $(document).ready(function() {})
        </script>
    @endpush
