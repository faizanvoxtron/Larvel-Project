@php
    $CustomerLogs = new App\Models\CustomerLogs();
    $User = new App\Models\User();
@endphp


@foreach ($logs as $key => $log)
    @php
        $formatted_timestamp = Carbon\Carbon::parse($log->created_at)->isoFormat('lll');
        $support_id_user = $User::find($log->supporting_id);
        $payload = json_decode($log->payload, true);
        // $payload = $log->payload;
    @endphp
    {{-- LOG HEADER --}}
    <span class="d-flex justify-content-between align-items-center"> {{ $key + 1 }}
        @if ($log->actionBy)
            {{ $log->actionBy->name }} ({{ $log->actionBy->role->name }})
        @elseif (isset($support_id_user))
            {{ $support_id_user->name }} (Agent)
        @else
            Someone
        @endif
        <small>
            {{ $formatted_timestamp }}
        </small>
    </span>

    @switch($log->type)
        @case($CustomerLogs::CUSTOMER_CREATED)
            <h6 class="text-center">Created Customer</h6>
        @break

        @case($CustomerLogs::REPORT_REQUESTED)
            <h6 class="text-center">Requested Report</h6>
        @break

        @case($CustomerLogs::REPORT_FETCHED)
            <h6 class="text-center">Fetched Report</h6>
        @break

        @case($CustomerLogs::REPORT_ATTACHED)
            <h6 class="text-center">Attached Report</h6>
        @break

        {{-- **************************** --}}
        @case($CustomerLogs::CUSTOMER_INFO_UPDATED)
            <h6 class="text-center">Updated Customer's Personal Info</h6>
            @if ($payload && count($payload))
                @foreach ($payload as $key => $value)
                    <div class="d-flex">
                        <div class="flex-shrink-0 d-flex align-items-center" style="width: 20%;">
                            <strong class="text-center w-100">{{ Str::title(str_replace('_', ' ', $key)) }} </strong>
                        </div>
                        <div class="d-flex flex-grow-1">
                            <div class="w-50 text-danger d-flex align-items-center justify-content-center">
                                {{ $value['old'] }}
                            </div>
                            <div class="w-50 text-success d-flex align-items-center justify-content-center">
                                {{ $value['new'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @break

        {{-- **************************** --}}
        @case($CustomerLogs::CUSTOMER_CARDS_UPDATED)
            <h6 class="text-center">Updated Customer's Cards</h6>
            @if ($payload && count($payload))
                @foreach ($payload as $entry)
                    {{-- Handle Updated Cards --}}
                    @foreach ($entry as $field => $values)
                        @if (is_array($values) && isset($values['old']) && isset($values['new']))
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0 d-flex align-items-center" style="width: 20%;">
                                    <strong class="text-center w-100">{{ Str::title(str_replace('_', ' ', $field)) }}</strong>
                                </div>
                                <div class="d-flex flex-grow-1">
                                    <div class="w-50 text-danger d-flex align-items-center justify-content-center">
                                        {{ $values['old'] }}
                                    </div>
                                    <div class="w-50 text-success d-flex align-items-center justify-content-center">
                                        {{ $values['new'] }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    {{-- Handle Added Cards --}}
                    @if (isset($entry['added']))
                        <h6 class="text-center">Added Card Details</h6>
                        @foreach ($entry['added'] as $field => $value)
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0 d-flex align-items-center" style="width: 20%;">
                                    <strong class="text-center w-100">{{ Str::title(str_replace('_', ' ', $field)) }}</strong>
                                </div>
                                <div class="d-flex flex-grow-1">
                                    <div class="w-100 text-success d-flex align-items-center justify-content-center">
                                        {{ $value }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    {{-- Handle Removed Cards --}}
                    @if (isset($entry['removed']))
                        <h6 class="text-center">Removed Card Details</h6>
                        @foreach ($entry['removed'] as $field => $value)
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0 d-flex align-items-center" style="width: 20%;">
                                    <strong class="text-center w-100">{{ Str::title(str_replace('_', ' ', $field)) }}</strong>
                                </div>
                                <div class="d-flex flex-grow-1">
                                    <div class="w-100 text-danger d-flex align-items-center justify-content-center">
                                        {{ $value }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
        @break

        @case($CustomerLogs::CUSTOMER_PHONES_UPDATED)
            <h6 class="text-center">Updated Customer's Phones</h6>
        @break

        @case($CustomerLogs::CUSTOMER_ADDRESSES_UPDATED)
            <h6 class="text-center">Updated Customer's Addresses</h6>
            @if ($payload && count($payload))
                @foreach ($payload as $entry)
                    {{-- Handle Updated Cards --}}
                    @foreach ($entry as $field => $values)
                        @if (is_array($values) && isset($values['old']) && isset($values['new']))
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0 d-flex align-items-center" style="width: 20%;">
                                    <strong class="text-center w-100">{{ Str::title(str_replace('_', ' ', $field)) }}</strong>
                                </div>
                                <div class="d-flex flex-grow-1">
                                    <div class="w-50 text-danger d-flex align-items-center justify-content-center">
                                        {{ $values['old'] }}
                                    </div>
                                    <div class="w-50 text-success d-flex align-items-center justify-content-center">
                                        {{ $values['new'] }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    {{-- Handle Added Cards --}}
                    @if (isset($entry['added']))
                        <h6 class="text-center">Added Address Details</h6>
                        @foreach ($entry['added'] as $field => $value)
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0 d-flex align-items-center" style="width: 20%;">
                                    <strong class="text-center w-100">{{ Str::title(str_replace('_', ' ', $field)) }}</strong>
                                </div>
                                <div class="d-flex flex-grow-1">
                                    <div class="w-100 text-success d-flex align-items-center justify-content-center">
                                        {{ $value }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    {{-- Handle Removed Cards --}}
                    @if (isset($entry['removed']))
                        <h6 class="text-center">Removed Address Details</h6>
                        @foreach ($entry['removed'] as $field => $value)
                            <div class="d-flex mb-2">
                                <div class="flex-shrink-0 d-flex align-items-center" style="width: 20%;">
                                    <strong class="text-center w-100">{{ Str::title(str_replace('_', ' ', $field)) }}</strong>
                                </div>
                                <div class="d-flex flex-grow-1">
                                    <div class="w-100 text-danger d-flex align-items-center justify-content-center">
                                        {{ $value }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
        @break

        @case($CustomerLogs::SUBMITTED)
            <h6 class="text-center">Marked as submitted</h6>
        @break

        @case($CustomerLogs::MARKED_INCOMPLETE)
            <h6 class="text-center">Marked as incomplete</h6>
        @break

        @case($CustomerLogs::CUSTOMER_COMMENT_UPDATED)
            <h6 class="text-center">Updated Customer's Comment</h6>
            <p class="text-center">{{ $log->supporting_text }}</p>
        @break

        @case($CustomerLogs::SALE_STATUS_UPDATED)
            <h6 class="text-center">Updated Customer's Sale Status</h6>
            <h6 class="text-center">{{ $log->supporting_text }}</h6>
        @break

        @case($CustomerLogs::SPECIALIST_ASSIGNED)
            <h6 class="text-center">Assigned To Specialist</h6>
            <h6 class="text-center">{{ $support_id_user->name . '( ' . $support_id_user->role->name . ' )' }}</h6>
        @break

        @case($CustomerLogs::DOWNLOADED)
            <h6 class="text-center">Downloaded In TXT</h6>
        @break

        @case($CustomerLogs::PROGRESS_UPDATED)
            <h6 class="text-center">Progress Updated</h6>
            <h6 class="text-center">{{ $log->supporting_text }}</h6>
        @break

        @case($CustomerLogs::REPORT_VIEWED)
            <h6 class="text-center">Report Viewed</h6>
        @break

        @case($CustomerLogs::PROFILE_VIEWED)
            <h6 class="text-center">Profile Viewed</h6>
        @break

        @case($CustomerLogs::EDIT_INITIATED)
            <h6 class="text-center">Edit Initiated</h6>
        @break

        @case($CustomerLogs::CARD_VIEWED)
            <h6 class="text-center">Card Information Viewed</h6>
        @break

        @case($CustomerLogs::META_VIEWED)
            <h6 class="text-center">MetaData Viewed</h6>
        @break

        @case($CustomerLogs::RECORDING_PLAYED)
            <h6 class="text-center">Played Recording</h6>
        @break

        @default
            <h6 class="text-center">{{ $log->type }}</h6>
    @endswitch

    {{-- LOG FOOTER --}}
    <hr>
@endforeach
