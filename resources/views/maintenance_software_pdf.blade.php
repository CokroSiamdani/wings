<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Maintenance software</title>
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
		<h5>Laporan Maintenance software</h4>
        <br/>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>client</th>
                <th>cloud</th>
                <th>vm_name</th>
                <th>status</th>
                <th>restarted</th>
                <th>description</th>
                <th>approval</th>
			</tr>
		</thead>
		<tbody>
            {{-- @php dd($maintenances_software); @endphp --}}
			@foreach($maintenances_software as $maintenance_software)
                <tr>
                    <td>{{ $maintenance_software->client }}</td>
                    <td>{{ $maintenance_software->cloud }}</td>
                    <td>{{ $maintenance_software->vm_name }}</td>
                    <td>{{ $maintenance_software->status }}</td>
                    <td>{{ $maintenance_software->restarted }}</td>
                    <td>{{ $maintenance_software->description }}</td>
                    <td>
                        @if($maintenance_software->signed == 1)
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