<table>
    <thead>
        <tr>
            <th>Existing Identifier</th>
            <th>First Name</th>
            <th>Middle Initial</th>
            <th>Surname</th>
            <th>Street</th>
            <th>City</th>
            <th>State</th>
            <th>Zip Code</th>
            <th>SSN</th>
            <th>Score</th>
            <th>Age</th>
            <th>No of OC</th>
            <th>No of AC</th>
            <th>TD</th>
            <th>TA</th>
            <th>D to IR</th>
            <th>Phone</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            @php
                $customer_phones = $customer->phones->pluck('phone_number')->toArray();
                $allPhoneNumbers = array_merge([$customer->phone], $customer_phones);
                $commaSeparatedPhoneNumbers = implode(', ', $allPhoneNumbers);

                $deleted = App\Models\Customer::where('id', $customer->id)->delete();
            @endphp
            @if ($deleted)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->first_name }}</td>
                    <td>{{ $customer->middle_initial }}</td>
                    <td>{{ $customer->last_name }}</td>
                    <td>
                        @php
                            $houseNo = $customer->house_number ?? ''; // Retrieve house number
                            $streetType = $customer->street_type ?? ''; // Retrieve street type
                            $streetName = $customer->street_name ?? ''; // Retrieve street name

                            // Remove house number and street type if they already exist in street name
                            $formattedStreetName = $streetName;

                            if ($houseNo && strpos($formattedStreetName, $houseNo) === false) {
                                $formattedStreetName = $houseNo . ' ' . $formattedStreetName;
                            }

                            if ($streetType && strpos($formattedStreetName, $streetType) === false) {
                                $formattedStreetName .= ' ' . $streetType;
                            }
                        @endphp

                        {{ $formattedStreetName }}
                    </td>
                    <td>{{ $customer->city }}</td>
                    <td>{{ $customer->state }}</td>
                    <td>{{ $customer->zip }}</td>
                    <td>{{ $customer->ssn }}</td>
                    <td>{{ $customer->score }}</td>
                    <td>{{ $customer->age }}</td>
                    <td>{{ $customer->no_of_ac }}</td>
                    <td>{{ $customer->no_of_ac }}</td>
                    <td>{{ $customer->td }}</td>
                    <td>{{ $customer->ta }}</td>
                    <td>{{ $customer->d_to_ir }}</td>
                    <td>{{ $commaSeparatedPhoneNumbers }}</td>
                    <td>{{ $customer->email }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
