<table class="table table-responsive table-bordered">
    <tr>
        <th>Notary Availability</th>
        <th>Notary Name</th>
        <th>Notary Phone Number</th>
        <th>Notary City</th>
        <th>Notary Distance</th>
        <th>Notary Fee</th>
        <th>Select Notary</th>
    </tr>
    <tbody>
        @foreach($notary_list as $notary)
        <tr>
            <td style="text-align: center;"><i class="fal fa-inbox-out fa-2x"></i></td>
            <td>{{ $notary->name }}</td>
            <td>{{ $notary->companyName }}</td>
            <td>{{ $notary->paymentAddress }}</td>
            <td>432 km</td>
            <td>40</td>
            <td><button type="button" class="btn btn-primary">SELECT</button></td>
        </tr>
        @endforeach
    </tbody>       
</table>