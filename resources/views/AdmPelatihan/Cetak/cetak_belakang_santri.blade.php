
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
	{{-- <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title> --}}
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
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
		th, td {
			padding: 5px;
			text-align: left;    
		}
		.nobottom tr{
			border-bottom: none;
			border: none;
		}
	</style>
	<style type="text/css">
		
		
	</style>		

	
	@foreach($peserta as $key=> $p)
<div class="container page-break">
	<center>
		<p>No> Syahadah : {{ $p->pelatihan->id }}/2021/{{ $p->id }}</p>
	</center>
	<br/>
	<table style="width:500px">
		<tr>
			<th></th>
			<th></th>
			<td colspan="4" class="nobottom">Penilaian</td>
		  </tr>
		  <tr>
			<td>No.</td>
			<td>Bidang Penilaian</td>
			<td>Max</td>
			<td>Min</td>
			<td>Nilai</td>
			<td>Jumlah</td>
		  </tr>
		<tr>
			<th>1.</th>
			<th>AL QURAN</th>
			<th></th>
			<th></th>
			<td></td>
			<th>75</th>
		</tr>
		<tr>
			<th></th>
			<td>a. Fashohah</td>
			<td>28</td>
			<td>23</td>
			<td>25</td>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td>b. Tajwid</td>
			<td>28</td>
			<td>23</td>
			<td>25</td>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td>a. Gharib Musykilat</td>
			<td>28</td>
			<td>23</td>
			<td>25</td>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td>a. Suara dan Lagu</td>
			<td>28</td>
			<td>23</td>
			<td>25</td>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td>PRESTASI</td>
			<td></td>
			<td></td>
			<td></td>
			<td>CUKUP</td>
		</tr>
	</table>
</div>
	@endforeach
</body>
</html>	

