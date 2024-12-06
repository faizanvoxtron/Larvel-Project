<table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Surame</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Social security</th>
            <th>Street Abbr</th>
            <th>City</th>
            <th>Street</th>
            <th>Zip</th>
            <th>Score</th>
            <th>No of OC</th>
            <th>No of AC</th>
            <th>TD</th>
            <th>TA</th>
            <th>D to IR</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($leads as $lead)
            <tr>
                <td>{{ $lead->first_name }}</td>
                <td>{{ $lead->surname }}</td>
                <td>{{ $lead->phone }}</td>
                <td>{{ $lead->email }}</td>
                <td>{{ $lead->ssn }}</td>
                <td>{{ $lead->state_abbr }}</td>
                <td>{{ $lead->city }}</td>
                <td>{{ $lead->street }}</td>
                <td>{{ $lead->zip }}</td>
                <td>{{ $lead->score }}</td>
                <td>{{ $lead->no_of_ac }}</td>
                <td>{{ $lead->no_of_ac }}</td>
                <td>{{ $lead->td }}</td>
                <td>{{ $lead->ta }}</td>
                <td>{{ $lead->d_to_ir }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
