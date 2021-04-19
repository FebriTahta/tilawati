
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	
	<style>
		.page-break {
			page-break-after: always;
			page-break-inside: avoid;
		}
		.td {
			font-family: 'arial';
			font-size: 16px;
		}
		.small {
			font-size: 13px;
			font-weight: 150;
		}
	</style>
		@foreach ($peserta as $item)
		<div class="print">
			<table class="dalam" style="margin-left: 290px; margin-top: 342px">
				<tr>
					<td>{{ $item->name }}</td>
				</tr>
				<tr>
					<td>{{ $item->alamat }}</td>
				</tr>
				<tr>
					<?php $tgl_lahir = ($item->tgllahir - 25569) * 86400?>
					<td>{{ $item->kota }} {{ gmdate('d-m-Y',$tgl_lahir) }}</td>
				</tr>
				<tr>
					<td>{{ $item->kriteria }}</td>
				</tr>
			</table>
			<div class="row">
				<div class="ke1 col-xl-6">
					<p style="margin-left: 110px; margin-top: 140px" class="small">No. Syahadah : {{ $item->pelatihan->id }}/2021/{{ $item->id }}</p>
				</div>
				<div class="ke2 col-xl-6" style="margin-left: 540px">
					<p style="margin-top: 92px"> Surabaya, &nbsp; 11 Oktober 2020</p>
					<p style="margin-top: 55px">
						<span>Dr. H Umar Jaeni, M.Pd </span><br>
						<span>Direktur Eksekutif</span>
					</p>
				</div>
			</div>
		</div>
		@endforeach
</body>
</html>	

