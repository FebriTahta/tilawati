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
		td.nilaibawahtot{
			border-right: 0;
			border-left: 0;
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

		td.nilai2x{
			border-right: 0;
			/* border-left: 0; */
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

		td.nilai2x{
			border-right: 0;
			/* border-left: 0; */
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
		<?php $total = 0;?>
		{{-- @if ($p->pelatihan->keterangan == 'instruktur') --}}
			@if ($p->kriteria == 'SEBAGAI INSTRUKTUR LAGU DAN STRATEGI MENGAJAR METODE TILAWATI')
			<div style="page-break-inside: avoid">
				<div>
					<p @if ($p->pelatihan->keterangan == 'instruktur') style="margin-top: 160px;margin-left: 358px" @else style="margin-top: 160px;margin-left: 358px" @endif class="syahadah">No. Syahadah : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
				</div>
				<table 
				@if ($p->pelatihan->keterangan == 'instruktur')
				style="width: 850px; margin-left:85px"
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
					<?php $i = 2; $x = 1; $z = 5?>
					@foreach ($p->nilai as $key=> $item)
						@if ($item !== null)
							@if ($item->kategori !== 'skill')
								<tr>
									<td class="pop"></td>
									<td class="pop2" >&nbsp; &nbsp;&nbsp;<span style="text-transform: capitalize">{{ $item->penilaian->name }}</span></td>
									<td class="nilai" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
									<td class="nilai2" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min}}</td>
									<td class="nilai3" style="text-align: center">&nbsp; &nbsp;{{ $item->nominal }}</td>
									<td style="border-top: 0;border-bottom: 0;"></td>
								</tr>
								<?php $z--; ?>
							@else
								<tr>
									<th>{{ $i++ }}</th>
									<td class="nilai6" style="text-transform: uppercase">&nbsp; &nbsp;<b> {{ $item->penilaian->name }}</b></th>
									{{-- <th colspan="3" class="nilai5"></th> --}}
									<td class="nilaibawahtot" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
									<td class="nilaibawahtot" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
									<td class="nilaibawahtot"></td>
									<th >{{ $item->nominal }}</th>
									<?php $total += $item->nominal?>
								</tr>
								<?$x++?>
							@endif
						@else
							{{--  --}}
						@endif
					@endforeach
					
					<?php 
						$rata2 = $jumlah;

					?>
					<tr>
						<th></th>
						<td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
						<th colspan="3" class="nilai5"></th>
						<th >{{ $rata2 = ($jumlah+$total)/4 }}</th>
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
			@elseif ($p->kriteria == 'SEBAGAI INSTRUKTUR STRATEGI MENGAJAR METODE TILAWATI')
			<div style="page-break-inside: avoid">
				<div>
					<p @if ($p->pelatihan->keterangan == 'instruktur') style="margin-top: 160px;margin-left: 358px" @else style="margin-top: 160px;margin-left: 358px" @endif class="syahadah">No. Syahadah : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
				</div>
				<table 
				@if ($p->pelatihan->keterangan == 'instruktur')
				style="width: 850px; margin-left:85px"
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
					<?php $i = 2; $x = 1; $z = 5?>
					@foreach ($p->nilai as $key=> $item)
						@if ($item !== null)
							@if ($item->kategori !== 'skill')
								<tr>
									<td class="pop"></td>
									<td class="pop2" >&nbsp; &nbsp;&nbsp;<span style="text-transform: capitalize">{{ $item->penilaian->name }}</span></td>
									<td class="nilai" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
									@if ($key < 1)
									<td class="nilai2" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min - 1}}</td>
									@else
									<td class="nilai2" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min - $z}}</td>
									@endif
									<td class="nilai3" style="text-align: center">&nbsp; &nbsp;{{ $item->nominal }}</td>
									<td style="border-top: 0;border-bottom: 0;"></td>
								</tr>
								<?php $z--; ?>
							@else
								<tr>
									<th>{{ $i++ }}</th>
									<td class="nilai6" style="text-transform: uppercase">&nbsp; &nbsp;<b> {{ $item->penilaian->name }}</b></th>
									{{-- <th colspan="3" class="nilai5"></th> --}}
									<td class="nilaibawahtot" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
									<td class="nilaibawahtot" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
									<td class="nilaibawahtot"></td>
									<th >{{ $item->nominal }}</th>
									<?php $total += $item->nominal?>
								</tr>
								<?$x++?>
							@endif
						@else
							{{--  --}}
						@endif
					@endforeach
					
					<?php 
						$nilaia = $p->nilai->where('penilaian_id', 37)->sum('nominal');
						$nilaib = $p->nilai->where('penilaian_id', 39)->sum('nominal');
						$total 	= $nilaia + $nilaib;
					?>
					<tr>
						<th></th>
						<td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
						<th colspan="3" class="nilai5"></th>
						<th >{{ $rata2 = round(($jumlah+$total)/3, 2) }}</th>
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
			@elseif($p->kriteria == 'SEBAGAI INSTRUKTUR LAGU METODE TILAWATI')
			<div style="page-break-inside: avoid">
				<div>
					<p @if ($p->pelatihan->keterangan == 'instruktur') style="margin-top: 160px;margin-left: 358px" @else style="margin-top: 160px;margin-left: 358px" @endif class="syahadah">No. Syahadah : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
				</div>
				<table 
				@if ($p->pelatihan->keterangan == 'instruktur')
				style="width: 850px; margin-left:85px"
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
					<?php $i = 2; $x = 1; $z = 5?>
					@foreach ($p->nilai as $key=> $item)
						@if ($item !== null)
							@if ($item->kategori !== 'skill')
								<tr>
									<td class="pop"></td>
									<td class="pop2" >&nbsp; &nbsp;&nbsp;<span style="text-transform: capitalize">{{ $item->penilaian->name }}</span></td>
									<td class="nilai" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
									<td class="nilai2" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min}}</td>
									<td class="nilai3" style="text-align: center">&nbsp; &nbsp;{{ $item->nominal }}</td>
									<td style="border-top: 0;border-bottom: 0;"></td>
								</tr>
								<?php $z--; ?>
							@else
								<tr>
									<?php $tot[$key] = $item->nominal?>
									
									<th>{{ $i++ }}</th>
									<td class="nilai6" style="text-transform: uppercase">&nbsp; &nbsp;<b> {{ $item->penilaian->name }}</b></th>
									{{-- <th colspan="3" class="nilai5"></th> --}}
									<td class="nilaibawahtot" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
									<td class="nilaibawahtot" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
									<td class="nilaibawahtot"></td>
									<th >{{ $item->nominal }}</th>
									
								</tr>
								<?$x++?>
							@endif
						@else
							{{--  --}}
						@endif
					@endforeach
					<?php 
						$nilaia = $p->nilai->where('penilaian_id', 38)->sum('nominal');
						$nilaib = $p->nilai->where('penilaian_id', 39)->sum('nominal');
						$total 	= $nilaia + $nilaib;
					?>
					<tr>
						<th></th>
						<td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
						<th colspan="3" class="nilai5"></th>
						<th >{{ $rata2 = round(($jumlah+$total)/3, 2) }}</th>
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
			@elseif($p->program->name == 'Diklat Munaqisy Cabang')

			{{-- munaqisy cabang --}}
			<div style="page-break-inside: avoid; font-size: 11px">
				<div>
					<p style="margin-top: 160px;margin-left: 358px" class="syahadah">No. Syahadah : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
				</div>
				<table 
				style="width: 782px; margin-left:154px"
				class="table1">
					<tr>
							<th rowspan="2">No.</th>
							<th rowspan="3" style="border-right: none; text-align: right">Bidang Penilaian</th>
							<th colspan="2" ></th>
							<th rowspan="2" style="text-align: center">Jumlah</th>
					</tr>
					<tr>     
						<th style="border-left: none; border-top:none;"></th>
						<th class="pe">MAX</th>
						<th class="pe">MIN</th>
						
					</tr>
					<tr>
						<th>1</th>
						<td style="border-right: none">&nbsp; &nbsp;<b> Al-Qur'an</b></td>
						<th colspan="3" class="pe3" style="border-left: none"></th>
						<th class=nilai2x></th>
					</tr>
					@foreach ($p->nilai as $key=> $item)
						@if ($item !== null)
							@if ($item->kategori !== 'skill')
								<tr>
									<td class="pop"></td>
									<td class="pop2" style="border-right: none">&nbsp; &nbsp;&nbsp;<span style="text-transform: capitalize; ">{{ $item->penilaian->name }}</span></td>
									<td class="nilai" style="text-align: center; border-left: none" >&nbsp; &nbsp;</td>
									<td class="nilai2x" style="text-align: center">{{$item->penilaian->max}}</td>
									<td class="nilai3" style="text-align: center">{{$item->penilaian->min}}</td>
									<th style="border-top: 0;border-bottom: 0;">{{ $item->nominal }}</th>
								</tr>
							@endif
						@endif
					@endforeach
					<tr>
						<th>2</th>
						<td style="border-right: none">&nbsp; &nbsp;<b> Praktek Munaqisy </b></td>
						<th colspan="3" style="border-left: none"></th>
						<th ></th>
					</tr>
					@foreach ($p->nilai as $key=> $item)
						@if ($item !== null)
							@if ($item->kategori == 'skill')
								<tr>
									<td class="pop"></td>
									<td class="pop2" style="border-right: none">&nbsp; &nbsp;&nbsp;<span style="text-transform: capitalize; ">{{ $item->penilaian->name }}</span></td>
									<td class="nilai" style="text-align: center; border-left: none" >&nbsp; &nbsp;</td>
									<td class="nilai2x" style="text-align: center">{{$item->penilaian->max}}</td>
									<td class="nilai3" style="text-align: center">{{$item->penilaian->min}}</td>
									<th style="border-top: 0;border-bottom: 0;">{{$item->nominal}}</th>
								</tr>
							@endif
						@endif
					@endforeach

					@if ($p->pelatihan->keterangan == 'guru')
						<tr>
							<th></th>
							<td class="nilai6" style="border-right: none">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
							<th style="border-left: none" colspan="3" class="nilai5"></th>
							<th >
							@if ($p->pelatihan->program->name=='munaqosyah santri')
								{{ $rata2 = $jumlah }}
							@elseif($p->program->name == 'Diklat Munaqisy Cabang')
								@php
									$x = $p->nilai->where("kategori","al-qur'an")->sum('nominal');
									$y = $p->nilai->where("kategori","skill")->sum('nominal');
									$z = $p->nilai->where("kategori","skill")->count();
									$satu  = $x;
									$dua   = round($y / $z);
									$rata2 = round(($satu+$dua)/2);
								@endphp
								{{$rata2}}
							@else
								{{ $rata2 = ($jumlah+ $item->nominal)/2 }}
							@endif
								</th>
						</tr>
					@else
					<?php 
						$rata2 = $jumlah
					?>
					@endif
					<tr>
						<th></th>
						<td class="nilai6" style="border-right: none">&nbsp; &nbsp;<b> PRESTASI</b></th>
						<th colspan="3" style="border-left: none" class="nilai5"></th> 
						<th >
							@if ($rata2 >= 85)
								Istimewa
							@elseif($rata2 > 74 && $rata2 < 85)
								Baik
							@else
								Cukup
							@endif
						</th>
					</tr>
				</table>
				<div id="textbox" style="margin-top: 20px">
					<div class="alignleft" style="margin-left: 180px"><b> Istimewa : 85 - 95</b></div>
					<div class="alignleft" style="margin-left: 150px"><b>Baik : 75 - 84</b></div>
					<div class="alignright" style="margin-right: 210px"><b>Cukup : 65 - 74</b></div>
				</div>
			</div>
			@else
			<div style="page-break-inside: avoid">
				<div>
					<p style="margin-top: 160px;margin-left: 358px" class="syahadah">No. Syahadah : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
				</div>
				<table 
				style="width: 782px; margin-left:154px"
				class="table1">
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
					<?php $i = 2; $x = 1?>
					@foreach ($p->nilai as $key=> $item)
						@if ($item !== null)
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
								<?$x++?>
							@endif
						@else
							{{--  --}}
						@endif
					@endforeach
					@if ($p->pelatihan->keterangan == 'guru')
						<tr>
							<th></th>
							<td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
							<th colspan="3" class="nilai5"></th>
							<th >
							@if ($p->pelatihan->program->name=='munaqosyah santri')
								{{ $rata2 = $jumlah }}
							@elseif($p->program->name == 'Diklat Munaqisy Cabang')
								@php
									$x = $p->nilai->where("kategori","al-qur'an")->sum('nominal');
									$y = $p->nilai->where("kategori","skill")->sum('nominal');
									$z = $p->nilai->where("kategori","skill")->count();
									$satu  = $x;
									$dua   = round($y / $z);
									$rata2 = round(($satu+$dua)/2);
								@endphp
								{{$rata2}}
							@else
								{{ $rata2 = ($jumlah+ $item->nominal)/2 }}
							@endif
								</th>
						</tr>
					@else
					<?php 
						$rata2 = $jumlah
					?>
					@endif
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
			@endif
		{{-- @else --}}
		{{-- Selain TOT --}}
		{{-- @endif --}}
	@endforeach
</body>
</html>	