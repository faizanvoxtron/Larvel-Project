<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('/admin/img/VA_icon.png') }}" type="image/x-icon">
    <title>VoxAccess - @yield('page_header')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <link href="{{ asset('admin/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('admin/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('admin/css/qrcode-reader.min.css') }}">
    <!-- include summernote css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <!-- Moyasar Styles -->
    {{-- <link rel="stylesheet" href="https://cdn.moyasar.com/mpf/1.5.0/moyasar.css"> --}}

    <link rel="stylesheet" href="{{ asset('admin/switch/tailwind-switch.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    @stack('css')
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }

        .validation-error {
            width: 100%;
            margin-top: .25rem;
            font-size: 80%;
            color: #ed5564;
        }

        .modal-backdrop.show {
            opacity: 0;
            z-index: -2000;
        }

        .has-sidebar-left.page {
            height: 100vh;
            overflow-y: auto;
        }

        .btn-success {
            background-color: #1E3A5F !important;
            border-color: #1E3A5F !important;
        }

        button.swal2-confirm.btn.btn-success {
            margin-left: 10px;
        }

        /* Ensure the dropdown menu is 500px wide */
        .dropdown-menu {
            width: 500px !important;
            /* Use !important to override any existing styles */
        }

        /* Ensure text wraps within the defined width */
        .dropdown-menu .menu a {
            white-space: normal;
            /* Allow text to wrap */
            word-wrap: break-word;
            /* Break words that are too long */
            display: block;
            /* Make anchor tags block elements to contain child elements correctly */
        }

        /* Ensure the span expands vertically */
        .dropdown-menu .menu .h6 {
            white-space: normal;
            /* Allow text to wrap */
            word-wrap: break-word;
            /* Break words that are too long */
            display: block;
            /* Make the span a block element to allow height expansion */
        }
    </style>
    <!-- Js -->
    <!--
    --- Head Part - Use Jquery anywhere at page.
    --- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
    -->
    <script>
        (function(w, d, u) {
            w.readyQ = [];
            w.bindReadyQ = [];

            function p(x, y) {
                if (x == "ready") {
                    w.bindReadyQ.push(y);
                } else {
                    w.readyQ.push(x);
                }
            };
            var a = {
                ready: p,
                bind: p
            };
            w.$ = w.jQuery = function(f) {
                if (f === d || f === u) {
                    return a
                } else {
                    p(f)
                }
            }
        })(window, document)
    </script>
</head>
@php
    $languages = App\Models\Language::all();
    $user = new App\Models\User();

    $avatar;
    if (Auth::user()->image) {
        $avatar = asset('storage/' . Auth::user()->image);
    } else {
        if (Auth::user()->gender == 'female') {
            if (Auth::user()->role_id == $user::AGENT_ROLE) {
                $avatar = asset('admin/img/female_agent_avatar.png');
            } elseif (Auth::user()->role_id == $user::MANAGER_ROLE) {
                $avatar = asset('admin/img/female_manager_avatar.png');
            } else {
                $avatar = asset('admin/img/female_admin_avatar.webp');
            }
        } else {
            if (Auth::user()->role_id == $user::AGENT_ROLE) {
                $avatar = asset('admin/img/agent_avatar.png');
            } elseif (Auth::user()->role_id == $user::MANAGER_ROLE) {
                $avatar = asset('admin/img/manager_avatar.jfif');
            } else {
                $avatar = asset('admin/img/admin_avatar.jfif');
            }
        }
    }

@endphp

<body class="light">
    <!-- Pre loader -->
    @include('layouts.admin.loader')
    <div id="app">
        {{-- //////////////////////////// SIDENAV ////////////////////////////// --}}

        @include('layouts.admin.sidenav')

        {{-- //////////////////////////// END SIDENAV ////////////////////////////// --}}
        <div class="page has-sidebar-left">
            <div class="pos-f-t">
                <div class="collapse" id="navbarToggleExternalContent">
                    <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
                        <div class="search-bar">
                            <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50"
                                type="text" placeholder="start typing...">
                        </div>
                        <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent"
                            aria-expanded="false" aria-label="Toggle navigation"
                            class="paper-nav-toggle paper-nav-white active "><i></i></a>
                    </div>
                </div>
            </div>
            <div
                class="navbar navbar-expand d-flex navbar-dark justify-content-between bd-navbar blue accent-3 shadow d-print-none">
                <div class="relative">
                    <div class="d-flex">
                        <div>
                            <a href="#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                                <i style="background-color: white;"></i>
                            </a>
                        </div>
                        <div class="d-none d-md-block">
                            <h1 class="nav-title text-white ">@yield('page_header')</h1>
                        </div>
                    </div>
                </div>
                <!--Top Menu Start -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Notifications -->

                        <li>
                            <div class="mt-1">
                                <div class="float-left image pr-2">
                                    <img class="user_avatar" src="{{ $avatar }}" alt="User Image">
                                </div>
                                <div class="float-left info mt-1">
                                    <h6 class="font-weight-light mt-2 mb-1 pr-4" style="color: white">
                                        {{ Auth::user()->name }}</h6>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown custom-dropdown notifications-menu read_notifications">
                            <a href="#" class="nav-link read_notifications" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="icon-notifications read_notifications m-0" style="color: white"></i>
                                {{-- <span class="badge badge-danger badge-mini rounded-circle">4</span> --}}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="header">
                                    {{-- You have
                                    {{ auth()->user()->notifications()->count() }}
                                    Unread Notifications --}}
                                </li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="notifications_tray menu">
                                        @foreach (auth()->user()->notifications() as $notification)
                                            <li class="notification_count">
                                                <a
                                                    href="{{ route('redirect_notification', ['module' => $notification->module, 'supporting_id' => $notification->supporting_id]) }}">
                                                    {{-- <i class="icon icon-data_usage text-success"></i> --}}
                                                    <h6 class="h6">{{ $notification->title }}</h6>
                                                    <p class="mb-2">{{ $notification->text }}</p>
                                                    <small>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                                </a>
                                            </li>
                                        @endforeach
                                        {{-- <div class="d-flex justify-content-center">
                                            <h6>
                                                <a href="#" data->View More</a>
                                            </h6>
                                        </div> --}}
                                    </ul>
                                </li>
                                <li class="footer p-2 text-center">
                                    <h6>
                                        <a href="#" class="view_more" data-current_index="1">View More</a>
                                    </h6>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-link">
                            <a href="/chatify" target="_blank" title="Chats">
                                <i class="text-white fa fa-comments"></i>
                            </a>
                        </li>

                        {{-- <li class="nav-link">
                            <form id="chatForm" action="https://stagging.devtestlink.com/"
                                target="_blank" method="GET" enctype="multipart/form-data">
                                <input type="hidden" name="fullName" value="{{ auth()->user()->name }}">
                                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                                <input type="hidden" name="role_id" value="{{ auth()->user()->role_id }}">
                                <input type="hidden" name="role" value="{{ auth()->user()->role->name }}">
                                <input type="hidden" name="handshakeToken"
                                    value="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.">

                                <button type="submit" title="Chats"
                                    style="background:none; border:none; cursor:pointer;">
                                    <i class="text-white fa fa-comments"></i>
                                </button>
                            </form>
                        </li> --}}


                        {{-- <div class="nav-link"> --}}
                        <li class="nav-link">
                            <a href="#" title="View Timezones" class=" view_timezones ">
                                <i class="text-white fas fa-clock"></i>
                            </a>
                        </li>

                        {{-- <li class="dropdown custom-dropdown user user-menu nav-link">
                            <a href="#" title="View Scripts" data-toggle="dropdown">
                                <i class="text-white fas fa-file-code"></i>
                            </a>

                            <div class="dropdown-menu p-0 m-0 dropdown-menu-right">
                                <div class="list-group mt-3 shadow">

                                    <a href="{{ asset('admin/pdfs/bank_tfns.pdf') }}" target="_blank"
                                        class="list-group-item list-group-item-action ">
                                        <i class="icon icon-credit-card s-18"></i>
                                        Bank TFNs
                                    </a>
                                    @foreach (App\Models\Scripts::where('status', 1)->get() as $key => $script)
                                        <a href="{{ asset('storage/' . $script->source) }}" target="_blank"
                                            class="list-group-item list-group-item-action ">
                                            <i class="mr-2 icon icon-circle text-blue"></i>
                                            {{ $script->title }}
                                        </a>
                                    @endforeach
                                </div>

                            </div>
                        </li> --}}
                        {{-- </div> --}}
                        {{-- <li>
                            <a class="nav-link " data-toggle="collapse" data-target="#navbarToggleExternalContent"
                                aria-controls="navbarToggleExternalContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <i class=" icon-search3 "></i>
                            </a>
                        </li> --}}
                        <!-- Right Sidebar Toggle Button -->
                        {{-- <li>
                            <a class="nav-link ml-2" data-toggle="control-sidebar">
                                <i class="icon-tasks "></i>
                            </a>
                        </li> --}}
                        <!-- User Account-->
                        <li class="dropdown custom-dropdown user user-menu ">
                            <a href="#" class="nav-link" data-toggle="dropdown">
                                {{-- <img src="{{ asset('storage/'.Auth::user()->image) }}" width="25" height="25" class="user-image" alt="User Image"> --}}
                                <i class="icon-more_vert " style="color:white; z-index:9999;"></i>
                            </a>
                            <div class="dropdown-menu p-0 m-0 dropdown-menu-right">
                                <div class="list-group mt-3 shadow">
                                    {{-- <a href="{{ route('updateProfile') }}" --}}
                                    <a href="{{ route('updateProfile') }}"
                                        class="list-group-item list-group-item-action ">
                                        <i class="mr-2 icon-cogs text-blue"></i>
                                        Update Profile
                                    </a>
                                    {{-- <a href="{{ route('change_password') }}" --}}
                                    <a href="{{ route('manage-password') }}"
                                        class="list-group-item list-group-item-action ">
                                        <i class="mr-2 icon-cogs text-blue"></i>
                                        Change Password
                                    </a>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="list-group-item list-group-item-action">
                                        <i class="mr-2 icon-sign-out text-purple"></i>
                                        Logout
                                    </a>
                                </div>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- CONTENT START --}}
            @yield('content')
            {{-- CONTENT END --}}

            <div class="control-sidebar-bg shadow white fixed"></div>

            <div class="modal fade" id="fill_questionaire_form_modal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content"></div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="timezones_modal" tabindex="-1" role="dialog"
                aria-labelledby="timezones_modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">USA Timezones</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <span class="d-flex justify-content-between align-items-center">
                                    <span class="h4">Pacific Time</span> <span
                                        class="h6">{{ \Carbon\Carbon::now('America/Los_Angeles')->format('h:i A') }}</span></span>
                                <span class="d-flex justify-content-between align-items-center">
                                    <span class="h4">Mountain Time</span> <span
                                        class="h6">{{ \Carbon\Carbon::now('America/Denver')->format('h:i A') }}</span></span>
                                <span class="d-flex justify-content-between align-items-center">
                                    <span class="h4">Central Time</span> <span
                                        class="h6">{{ \Carbon\Carbon::now('America/Chicago')->format('h:i A') }}</span></span>
                                <span class="d-flex justify-content-between align-items-center">
                                    <span class="h4">Eastern Time</span> <span
                                        class="h6">{{ \Carbon\Carbon::now('America/New_York')->format('h:i A') }}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade bd-example-modal-lg" id="scripts_modal" tabindex="-1" role="dialog"
                aria-labelledby="ScriptsModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content script_iframe">

                    </div>
                </div>
            </div>
        </div>
        <!--/#app -->
        <script src="{{ asset('admin/js/app.js') }}"></script>
        <script src="{{ asset('admin/js/qrcode-reader.min.js') }}"></script>

        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
        {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

        <script src="{{ asset('admin/toastr/toastr.min.js') }}"></script>
        {{-- <script
                src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap&amp;sensor=false&amp;libraries=places">
    </script> --}}
        <script src="{{ asset('admin/js/locationpicker.js') }}"></script>
        {{-- <script src="{{ asset('admin/js/summernote-cleaner.js') }}"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
        {{-- <button class="btn btn-primary btn-lg toast-action" data-title="Hey, Bro!"
            data-message="Paper Panel has toast as well." data-type="error" data-position-class="toast-bottom-left">
            Error Toast</button> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
        <!-- include summernote js -->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        {{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=fetch"></script> --}}
        {{-- <script src="https://cdn.moyasar.com/mpf/1.5.0/moyasar.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>

        <script src="{{ asset('admin/switch/jquery-tailwind-toggle.js') }}"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/laravel-echo@latest/dist/echo.iife.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/pusher-js@latest/dist/pusher.min.js"></script>
        {{-- <script src="{{ mix('js/app.js') }}"></script> --}}

        {{-- FCM --}}
        <script type="module">
            import {
                initializeApp
            } from 'https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js'
            import {
                getMessaging,
                getToken
            } from 'https://www.gstatic.com/firebasejs/10.11.0/firebase-messaging.js'

            const firebaseConfig = {
                apiKey: "AIzaSyAWS7eGwpXBtvDx4-ousKTJVCqoA7YTmGQ",
                authDomain: "voxaccess-34c85.firebaseapp.com",
                projectId: "voxaccess-34c85",
                storageBucket: "voxaccess-34c85.appspot.com",
                messagingSenderId: "338984004662",
                appId: "1:338984004662:web:52415a460bece2e434fc97",
                measurementId: "G-DW373G41Y8"
            };

            // Initialize Firebase
            const app = initializeApp(firebaseConfig);
            const messaging = getMessaging(app);
            const fcm_sw_path = "{{ asset('admin/js/firebase-messaging-sw.js') }}"
            const fcm_key = "{{ env('FCM_NOTIFICATION_KEY') }}"
            // console.log(fcm_sw_path);
            navigator.serviceWorker.register(fcm_sw_path).then(registration => {
                getToken(messaging, {
                    serviceWorkerRegistration: registration,
                    vapidKey: fcm_key
                }).then((currentToken) => {
                    if (currentToken) {
                        // console.log("currentToken", currentToken)
                        $.post("{{ route('save_fcm_token') }}", {
                            "token": currentToken
                        })
                        // Send the token to your server and update the UI if necessary
                        // ...
                    } else {
                        // Show permission request UI
                        console.log('No registration token available. Request permission to generate one.');
                        // ...
                    }
                }).catch((err) => {
                    console.log('An error occurred while retrieving token. ', err);
                    // ...
                });

            })
        </script>

        <script>
            $(document).on('click', '.read_notifications ', function() {
                let notifications = {{ auth()->user()->notifications()->pluck('id') }}
                $.post("{{ route('admin.read_notifications') }}", {
                    notification_ids: notifications
                })
            });
        </script>
        {{-- FCM END --}}

        @include('layouts.admin.widgets_modals')
        @stack('widget_modals')
        <script>
            @if (Session::has('message'))
                toastr["{{ Session::get('type') }}"]("{{ Session::get('message') }}", "{{ Session::get('title') }}")
            @endif
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            $('[data-toggle="tooltip"]').tooltip()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // $.ajaxSetup({
            //     beforeSend: function(xhr, settings) {
            //         if (settings.url.indexOf("trestleiq") !== -1) {

            //             //     headers: {
            //             //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             //     }
            //             xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
            //             console.log(settings);
            //         } else {
            //             console.log("ALL AJAX EXCEPT TRESTLE");
            //         }
            //         // if (settings.type != "OPTIONS") {
            //         //     xhr.setRequestHeader("X-CSRFToken", $('meta[name="csrf-token"]').attr('content'));
            //         // }
            //     }
            // });

            $(".treeview-menu").each(function() {
                if ($(this).children().length == 0) {
                    $(this).parent().remove();
                }
            });

            $('#disable_enter_submit').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });

            (function() {
                'use strict';
                window.addEventListener('load', function() {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            // Prevent the default form submission
                            event.preventDefault();
                            event.stopPropagation();

                            if (form.checkValidity() === false) {
                                form.classList.add('was-validated');
                            } else {
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
                                        form
                                            .submit(); // Submit the form if the confirmation is successful
                                    }
                                });
                            }
                        }, false);
                    });
                }, false);
            })();


            $(document).ready(function() {
                $('#loader').fadeOut()
                $('.dropify').dropify();
                $('.select2-single').select2({
                    maximumSelectionLength: 1,
                });
                $('.datatable').DataTable({
                    lengthMenu: [
                        [10, 20, 30, 40, 50, 100, 1000, 5000, -1],
                        [10, 20, 30, 40, 50, 100, 1000, 5000, 'All']
                    ]
                });
                $(".dropify-clear").css("display", "none");
                // $('.summernote').summernote();
                $('.summernote').summernote({
                    onPaste: function(e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                            .getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    },
                    toolbar: [
                        ['styleTags', []],
                        ['cleaner', ['cleaner']], // The Button
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['hr']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });

                $('[data-toggle="tooltip"]').tooltip()

                $(document).on('click', '.fill_questionaire', function() {
                    let id = $(this).data('id');
                    let url = ("{{ route('appointment-get_questionaire_form', ['-id-']) }}").replace('-id-',
                        id)
                    var height = screen.height * 0.8;
                    var html = '<iframe id="frame" height=' + height + ' src="' + url + '"> </iframe>'
                    var selector = '#fill_questionaire_form_modal';
                    $(selector).children().children().html(html);
                    $(selector).modal('show');
                })

                $.qrCodeReader.jsQRpath = "{{ asset('admin/dist/js/jsQR/jsQR.min.js') }}";
                $.qrCodeReader.beepPath = "{{ asset('admin/dist/audio/beep.mp3') }}";
                var element = "#openreader-btn-0";
                var target = "#target-input-0";
                $(element).qrCodeReader({
                    target: target,
                    audioFeedback: true,
                    multiple: false,
                    skipDuplicates: true,
                });

                $(".token_tags").select2({
                    placeholder: "Tags", //placeholder
                    tags: true,
                    tokenSeparators: ['/', ',', ';', " "],
                });

                $('[data-toggle="tooltip"]').tooltip()
                $(".sortable").sortable({
                    revert: true
                });

                $(".token_article").select2({
                    placeholder: "Articles", //placeholder
                    tags: true,
                    tokenSeparators: ['/', ',', ';', " "],
                });

                function checkIframeLoaded() {
                    // Get a handle to the iframe element
                    var iframe = document.getElementById('iView');
                    // console.log(iframe)
                    if (iframe != null) {
                        var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
                        // Check if loading is complete
                        if (iframeDoc.readyState == 'complete') {
                            // The loading is complete, call the function we want executed once the iframe is loaded
                            afterLoading();
                            return;
                        }
                        // If we are here, it is not loaded. Set things up so we check   the status again in 100 milliseconds
                        window.setTimeout(checkIframeLoaded, 100);
                    }
                }

                checkIframeLoaded();
                $('#iView').on("load", function() {
                    renderControls();
                });

                window.afterLoading = function() {
                    window.setTimeout(renderControls, 1000);
                    window.setTimeout(renderControls, 2000);
                }

                $(document).on("load", "#iView", function() {
                    renderControls()
                });

                function setActions(callBack, moveUpCallback, moveDownCallback, addCallback, deleteCallback) {
                    let arrowImgAsset = "{{ asset('admin/img/slider-left-arrow.svg') }}";
                    let addImgAsset = "{{ asset('admin/img/add-icon.png') }}";
                    var template = '<div class="infosec"><button><img class="dragUp" src="' + arrowImgAsset +
                        '" alt="dragUp" onclick="parent.' + moveUpCallback + '" /></button><div><a onclick="parent.' +
                        callBack +
                        '">Edit</a><a onclick="parent.' +
                        deleteCallback + '">Delete</a></div><img class="dragDown" src="' + arrowImgAsset +
                        '" alt="dragDown" onclick="parent.' + moveDownCallback +
                        '" /></button><div class="addWidget"><button onclick="parent.' + addCallback + '"><img src="' +
                        addImgAsset + '" alt="addIcon" /></button></div></div>'
                    return template;
                }



                window.renderControls = function() {
                    $('#iView').contents().find('.dynamic-widget').each(function(event) {
                        if ($(this).find('.infosec').length == 0) {
                            let reference_widget_id = $(this).data('reference_widget_id');
                            let widget_id = $(this).data('widget_id');
                            let callback = 'open_module_modal_' + widget_id + '(' +
                                reference_widget_id +
                                ')';
                            let moveDownCallback = 'repositionWidget(' + reference_widget_id +
                                ', \'down\')';
                            let moveUpCallback = 'repositionWidget(' + reference_widget_id +
                                ', \'up\')';
                            let addCallback = 'openWidgetsModal(' + reference_widget_id + ')';
                            let deleteCallback = 'deleteWidget(' + reference_widget_id + ')';
                            $(this).prepend(setActions(callback, moveUpCallback, moveDownCallback,
                                addCallback, deleteCallback));
                        }
                    });
                }

                window.openWidgetsModal = function(reference_widget_id) {
                    $('#insertWidget').attr('data-reference_widget_id', reference_widget_id);
                    $('#myModal').modal('show');
                }
                window.repositionWidget = function(reference_widget_id, position) {
                    // function repositionWidget(reference_widget_id, position) {
                    $.ajax({
                        url: "{{ route('repositionWidget') }}",
                        type: 'POST',
                        data: {
                            position,
                            reference_widget_id,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            refreshIframe();
                            // afterLoading();
                            // renderControls();
                        },
                    })
                }

                window.deleteWidget = function(reference_widget_id) {
                    // function repositionWidget(reference_widget_id, position) {
                    $.ajax({
                        url: "{{ route('deleteWidget') }}",
                        type: 'POST',
                        data: {
                            reference_widget_id,
                            '_token': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            refreshIframe();
                            // afterLoading();
                            // renderControls();
                        },
                    })
                }

                window.refreshIframe = function() {
                    let selector = '#iView'
                    $(selector).attr('src', $(selector).attr('src'));
                    afterLoading();
                    renderControls();

                }
                $('[data-toggle="tooltip"]').tooltip()
                $(".sortable").sortable({
                    revert: true
                });
            });


            function createLog(customer_id, type, supporting_text = null, supporting_id = null, payload = null) {
                $.post("{{ route('customer_logs-create_log') }}", {
                    _token: "{{ csrf_token() }}", // Add the CSRF token
                    customer_id: customer_id,
                    type: type,
                    supporting_text: supporting_text,
                    supporting_id: supporting_id,
                    payload: payload,
                })
            }
        </script>
        @stack('scripts')
        @stack('widget_scripts')

        <script>
            jQuery('#datetimepicker7').datetimepicker({
                timepicker: false,
                formatDate: 'Y-m-d',
                maxDate: new Date() //tomorrow is maximum date calendar
            });
        </script>

        <script>
            $(".numberInput").attr("maxlength", 6);
            $(".numberInput").keyup(function() {
                var number = $('.numberInput').val();
                if (number.length > 11) number = number.substring(0, 11);
                $('.numberInput').val(number);
            });

            function ucwords(str) {
                return (str + '').replace(/^([a-z])|\s+([a-z])/g, function($1) {
                    return $1.toUpperCase();
                });
            }


            $(document).on('click', '.view_timezones', function() {
                $("#timezones_modal").modal('show');
            });

            $(document).on('click', '.view_more', async function(e) {
                e.preventDefault();
                e.stopPropagation();
                let offset = $('.notification_count').length;
                let url = "{{ route('admin.notifications_ajax', ['offset' => '-offset-']) }}".replace('-offset-',
                    offset)
                let notification = await $.get(url);
                if (notification.status == true && notification.data.length > 0) {
                    $(notification.data).each(function(i, notification) {
                        let redirection_url =
                            "{{ route('redirect_notification', ['module' => '-module-', 'supporting_id' => '-supporting_id-']) }}"
                            .replace('-module-', notification.module).replace(
                                '-supporting_id-', notification.supporting_id)

                        let createdAt = moment(notification.created_at).fromNow();
                        let html = `<li class="notification_count">
                                                <a
                                                    href="${redirection_url}">
                                                    {{-- <i class="icon icon-data_usage text-success"></i> --}}
                                                    <h6 class="h6">${notification.title}</h6>
                                                    <p class="mb-2">${notification.text}</p>
                                                    <small>${createdAt}</small>
                                                </a>
                                            </li>`;
                        $('.notifications_tray').append(html)
                    })
                }
            });
        </script>
</body>

</html>
