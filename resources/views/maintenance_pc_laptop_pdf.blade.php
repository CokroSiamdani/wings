<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Maintenance PC dan Laptop</title>
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
		<h5>Laporan Maintenance PC dan Laptop</h4>
        <br/>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>category</th>
                <th>item_name</th>
                <th>brand</th>
                <th>serial_number</th>
                <th>user_name</th>
                <th>status</th>
                <th>password_8_chars</th>
                <th>password_combination</th>
                <th>description</th>
                <th>approval</th>
			</tr>
		</thead>
		<tbody>
            {{-- @php dd($maintenances_pc_laptop); @endphp --}}
			@foreach($maintenances_pc_laptop as $maintenance_pc_laptop)
                <tr>
                    <td>{{ $maintenance_pc_laptop->category }}</td>
                    <td>{{ $maintenance_pc_laptop->item_name }}</td>
                    <td>{{ $maintenance_pc_laptop->brand }}</td>
                    <td>{{ $maintenance_pc_laptop->serial_number }}</td>
                    <td>{{ $maintenance_pc_laptop->user_name }}</td>
                    <td>{{ $maintenance_pc_laptop->status }}</td>
                    <td>{{ $maintenance_pc_laptop->password_8_chars }}</td>
                    <td>{{ $maintenance_pc_laptop->password_combination }}</td>
                    <td>{{ $maintenance_pc_laptop->description }}</td>
                    <td>
                        @if($maintenance_pc_laptop->signed == 1)
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