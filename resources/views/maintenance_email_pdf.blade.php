<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Maintenance email</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
        <br/>
		<h5>Laporan Maintenance email</h4>
        <br/>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>name</th>
                <th>email</th>
                <th>status</th>
                <th>description</th>
                <th>approval</th>
			</tr>
		</thead>
		<tbody>
            {{-- @php dd($maintenances_cctv); @endphp --}}
			@foreach($maintenances_email as $maintenance_email)
                <tr>
                    <td>{{ $maintenance_email->name }}</td>
                    <td>{{ $maintenance_email->email }}</td>
                    <td>{{ $maintenance_email->status }}</td>
                    <td>{{ $maintenance_email->description }}</td>
                    <td>
                        @if($maintenance_email->signed == 1)
                        <img src="data:image/png;base64, {!! $qrcode !!}">
                        {{-- <span class="text">Signed</span> --}}
                        @else
                        <span class="text">Unsigned</span>
                        @endif
                    </td>
                </tr>
            @endforeach
		</tbody>
	</table>
</body>
</html>