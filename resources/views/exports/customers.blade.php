<table>
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>MMN</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Social security</th>
            <th>Date of birth</th>
            {{-- <th>Quadrant</th> --}}
            <th>Street name</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>


            <th>Secondary Addresses</th>


            <th>Score</th>
            <th>No. of Open Cards</th>
            <th>No. of Accounts</th>
            <th>Total Debt</th>
            <th>Total Available</th>
            <th>Debt to Income Ratio % </th>
            <th>Progress</th>
            <th>Total Charge</th>
            <th>Metadata</th>

            <th>Cards</th>


            <th>Comments</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->first_name }}</td>
                <td>{{ $customer->last_name }}</td>
                <td>{{ $customer->mmm }}</td>
                <td>{{ $customer->email }}</td>
                <td>
                    {{ $customer->phone }}
                    <br>
                    {{ $customer->secondary_phones }}
                    <br>
                    @foreach ($customer->phones as $key => $phone)
                        {{ $phone->phone_number }}
                        <br>
                    @endforeach
                </td>

                <td>{{ $customer->ssn }}</td>
                <td>{{ $customer->dob }}</td>
                {{-- <td>{{ $customer->quadrant }}</td> --}}
                <td>{{ $customer->street_name }}</td>
                <td>{{ $customer->city }}</td>
                <td>{{ $customer->state }}</td>
                <td>{{ $customer->zip }}</td>

                <td>
                    @foreach ($customer->addresses as $key => $address)
                        {{-- Quadrant : {{ $address->quadrant }} --}}
                        <br>
                        Street name : {{ $address->street_name }}
                        <br>
                        City : {{ $address->city }}
                        <br>
                        State : {{ $address->state }}
                        <br>
                        Zip : {{ $address->zip }}
                        <br>


                        <br>
                    @endforeach
                </td>

                <td>{{ $customer->score }}</td>
                <td>{{ $customer->no_of_oc }}</td>
                <td>{{ $customer->no_of_ac }}</td>
                <td>{{ $customer->td }}</td>
                <td>{{ $customer->ta }}</td>
                <td>{{ $customer->d_to_ir }}</td>
                <td>{{ $customer->progress }}</td>
                <td>{{ $customer->charge }}</td>
                <td>{{ $customer->meta }}</td>


                <td>
                    @foreach ($customer->accounts->sortByDesc('charge_card') as $key => $card)
                        NOC : {{ $card->noc }}
                        <br>
                        Bank Name : {{ $card->account_name }}
                        <br>
                        Toll Free : {{ $card->toll_free }}
                        <br>
                        Exp : {{ $card->exp }}
                        <br>
                        Card # : {{ $card->account_number }}
                        <br>
                        CVV/CVV (First CVV) : {{ $card->cvv1 }}
                        <br>
                        CVV/CVV (Second CVV) : {{ $card->cvv2 }}
                        <br>
                        Charge on this card : {{ $card->charge }}
                        <br>
                        Charge Card : {{ $card->charge_card == true ? 'Yes' : 'No' }}
                        <br>
                        Balance : {{ $card->balance }}
                        <br>
                        Available : {{ $card->available }}
                        <br>
                        LP : {{ $card->lp }}
                        <br>
                        DP : {{ $card->dp }}
                        <br>
                        APR% : {{ $card->apr }}
                        <br>
                        POA : {{ $card->poa }}
                        <br>
                        Full Name : {{ $card->full_name }}
                        <br>
                        SSN : {{ $card->ssn }}
                        <br>
                        Mmm : {{ $card->mmm }}
                        <br>
                        DOB : {{ $card->dob }}
                        <br>
                        Relation : {{ $card->relation }}
                        <br>


                        <br>
                    @endforeach
                </td>





                <td>{{ $customer->comments }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
