<html>

<head>
    <title>Prescription</title>
</head>

<body>
    <table>
        <tr>
            <td>
                <table width="70%">
                    <tr>
                        <td>
                            <h1>{{$appointment->doctor->doctorDetail->prefix}}. {{$appointment->doctor->name}}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($appointment->doctor && $appointment->doctor->doctorSpecialities)
                            <h4>
                                @foreach ($appointment->doctor->doctorSpecialities as $key => $speciality)
                                {{$speciality->speciality->name}}{{count($appointment->doctor->doctorSpecialities) -1 != $key? "," : ''}}
                                @endforeach
                            </h4>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            @if($appointment->doctor_clinic_id)
                            {{$appointment->doctorClinic->clinic->name}} | {{$appointment->doctorClinic->clinic->address}}
                            <br>
                            {{$appointment->doctorClinic->clinic->phone}} {{$appointment->doctorClinic->clinic->email}}
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
            <td width="100px">
                <img width="100px" src="{{asset('admin/img/closed-menu.png')}}" />
            </td>
        </tr>
        <tr>
            <td height="0.5px" colspan="2" style="background-color: blue">

            </td>
        </tr>
        <tr>
            <td align="center" style="padding-top: 40px">
                <table width="80%" cellspacing="5" cellpadding="5">
                    <tbody>
                        <thead>
                            <tr>
                                <th>&nbsp;Medicine</th>
                                <th>Dosage</th>
                                <th>Duration</th>
                                <th>Instruction</th>
                            </tr>
                        </thead>

                        @if($appointment->getPrescription && $appointment->getPrescription->prescribedMedicine && count($appointment->getPrescription->prescribedMedicine) > 0)
                        @foreach ($appointment->getPrescription->prescribedMedicine as $key => $medicine)
                        <tr>
                            <td>{{$medicine->prescriptionElement->name}}</td>
                            <td>{{$medicine->per_day}}</td>
                            <td>{{$medicine->number_of_days}} Day(s)</td>
                            <td>{{$medicine->is_after_meal ?'After':'Before' }} Meal</td>
                        </tr>
             
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td height="0.5px" colspan="2" style="background-color: blue">
            </td>
        </tr>
        @if($appointment->getPrescription->patient_consultation_note)
        <tr>
            <td>
              <p><strong>Consultation Notes : </strong>{{$appointment->getPrescription->patient_consultation_note}}</p>
            </td>
        </tr>
        @endif
    </table>

</body>

</html>
