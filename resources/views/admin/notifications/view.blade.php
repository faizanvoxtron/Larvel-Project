@extends('layouts.admin.app')
@section('page_header')
    All Notifications
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="my-3">
        <div class="card p-3">
            <div class="row">
                <div class="col-md-12">



                    <div class="">
                        <div class="list-group">
                            @foreach ($notifications as $notification)
                                <a href="{{ route('redirect_notification', ['module' => $notification->module, 'supporting_id' => $notification->supporting_id]) }}"
                                    class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $notification->title }}</h5>
                                        <small>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ $notification->text }}</p>
                                </a>
                            @endforeach

                        </div>

                        <div class="d-flex justify-content-center">
                            @if ($more_notifications == true)
                                <a href="{{ route('admin.notifications', ['limit' => $limit + 1]) }}" class="mt-2">Load
                                    More</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script></script>
@endpush
