<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	@if ($pelatihan->keterangan == 'instruktur')
	<style>
		body{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12px;
			text-transform: capitalize;
		}
		.syahadah{
			font-size: 14px;
		}
		.page-break {
			page-break-after: always;
			page-break-inside: avoid;
		}
		.center {
			margin-left: auto;
			margin-right: auto;
		}
		table.table1{   
	    	border: 1px solid black;
    		border-collapse: collapse;
    
		}

		table th,td{
			border: 1px solid black;
			padding: 8px;
		}

		th.penilaian{
			border:0px;
		}

		th.pe{
			border: 0;
		}
		.jum{
			text-align: right;
		}
		th.pe3{
			border-right: 0;
		}

		th.pe2{
			border-left: 0;    
		}


		td.nilai{
			border-right: 0;
			border-bottom: 0;
			border-top:0;
		}

		td.nilai2{
			border-right: 0;
			border-left: 0;
			border-bottom: 0;
			border-top: 0;
		}

		td.nilai3{
			border-right: 0;
			border-left: 0;
			border-bottom: 0;
			border-top: 0;
		}

		td.nilai4{
			border-left: 0;
			border-bottom: 0;
			border-top: 0;
		}

		th.nilai5{
			border-right: 0;
		}

		th.nilai6{
			border-right:0 ;
		}

		th.nilai7{
			border-left: 0;
		}
		td.pop{
			border-top: 0;
			border-bottom: 0;
		}

		td.pop2{
			border-top: 0;
			border-bottom: 0;
		}
		.alignleft {
			float: left;
		}
		.alignright {
			float: right;
		}.paksatengah{
			margin-right: 19px;
		}
	</style>
	@else
	<style>
		body{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
			text-transform: capitalize;
		}
		.syahadah{
			font-size: 14px;
		}
		.page-break {
			page-break-after: always;
			page-break-inside: avoid;
		}
		.center {
			margin-left: auto;
			margin-right: auto;
		}
		table.table1{   
	    	border: 1px solid black;
    		border-collapse: collapse;
    
		}

		table th,td{
			border: 1px solid black;
			padding: 8px;
		}

		th.penilaian{
			border:0px;
		}

		th.pe{
			border: 0;
		}
		.jum{
			text-align: right;
		}
		th.pe3{
			border-right: 0;
		}

		th.pe2{
			border-left: 0;    
		}


		td.nilai{
			border-right: 0;
			border-bottom: 0;
			border-top:0;
		}

		td.nilai2{
			border-right: 0;
			border-left: 0;
			border-bottom: 0;
			border-top: 0;
		}

		td.nilai3{
			border-right: 0;
			border-left: 0;
			border-bottom: 0;
			border-top: 0;
		}

		td.nilai4{
			border-left: 0;
			border-bottom: 0;
			border-top: 0;
		}

		th.nilai5{
			border-right: 0;
		}

		th.nilai6{
			border-right:0 ;
		}

		th.nilai7{
			border-left: 0;
		}
		td.pop{
			border-top: 0;
			border-bottom: 0;
		}

		td.pop2{
			border-top: 0;
			border-bottom: 0;
		}
		.alignleft {
			float: left;
		}
		.alignright {
			float: right;
		}.paksatengah{
			margin-right: 19px;
		}
	</style>
	@endif
	@foreach($peserta as $key=> $p)
	<div style="page-break-inside: avoid">
	{{-- <center>
		<p @if ($pelatihan->keterangan == 'instruktur') style="margin-top: 147px" @else style="margin-top: 147px" @endif class="syahadah">No. Syahadah : {{ $p->pelatihan->id }} / 2021 / {{ $p->id }}</p>
	</center> --}}
	<div>
		<p @if ($pelatihan->keterangan == 'instruktur') style="margin-top: 160px;margin-left: 358px" @else style="margin-top: 160px;margin-left: 358px" @endif class="syahadah">No. Syahadah : {{ $p->pelatihan->id }}/2021/{{ $p->id }}</p>
	</div>
		<table 
		@if ($pelatihan->keterangan == 'instruktur')
		style="width: 700px"
		@else
		style="width: 782px; margin-left:154px"
		@endif  class="table1">
			<tr>
					<th rowspan="2">No.</th>
					<th rowspan="2">Bidang Penilaian</th>
					<th colspan="3" class="penilaian">Penilaian</th>
					<th rowspan="2" style="text-align: center">Jumlah</th>
			</tr>
			<tr>     
				<th class="pe">Max</th>
				<th class="pe">Min</th>
				<th class="pe">Nilai</th>
				
			</tr>
			<tr>
				<th>1</th>
				<td>&nbsp; &nbsp;<b> Al-Qur'an</b></td>
				<th colspan="3" class="pe3"></th>
				<th >{{ $jumlah = $p->nilai->where("kategori","al-qur'an")->sum('nominal') }}</th>
			</tr>
			<?php $i = 2?>
			@foreach ($p->nilai as $key=> $item)
				
				@if ($item->kategori !== 'skill')
					<tr>
						<td class="pop"></td>
						<td class="pop2" >&nbsp; &nbsp;&nbsp;<span style="text-transform: capitalize">{{ $item->penilaian->name }}</span></td>
						<td class="nilai" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
						<td class="nilai2" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
						<td class="nilai3" style="text-align: center">&nbsp; &nbsp;{{ $item->nominal }}</td>
						<td style="border-top: 0;border-bottom: 0;"></td>
					</tr>
				@else
				<tr>
					<th>{{ $i++ }}</th>
					<td class="nilai6" style="text-transform: uppercase">&nbsp; &nbsp;<b> {{ $item->penilaian->name }}</b></th>
					<th colspan="3" class="nilai5"></th>
					<th >{{ $item->nominal }}</th>
				</tr>
				@endif
			@endforeach
			<tr>
				<th></th>
				<td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
				<th colspan="3" class="nilai5"></th>
				<th >
				@if ($p->pelatihan->program->name=='munaqosyah santri')
					{{ $rata2 = $jumlah }}
				@else
					{{ $rata2 = ($jumlah+ $item->nominal)/2 }}
				@endif
					</th>
			</tr>
			<tr>
				<th></th>
				<td class="nilai6">&nbsp; &nbsp;<b> PRESTASI</b></th>
				<th colspan="3" class="nilai5"></th> 
				<th >
                    @if ($rata2 >= 85)
                        Baik
                    @else
                        Cukup
                    @endif
                </th>
			</tr>
		</table>
			<div id="textbox" style="margin-top: 20px">
				<div class="alignleft" style="margin-left: 180px">Baik : 85 - 95</div>
				<div class="alignright" style="margin-right: 210px">Cukup : 75 - 84</div>
			</div>
	</div>
	@endforeach
</body>
</html>	