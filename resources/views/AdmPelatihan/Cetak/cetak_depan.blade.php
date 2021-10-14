<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	<style>
		body{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 15px;
		}
		.page-break {
			page-break-after: always;
			page-break-inside: avoid;
		}
		.atas {
			font-size: 15px;
			font-family: Arial, Helvetica, sans-serif;
		}
		.bawah {
			font-size: 12px;
			font-family: Arial, Helvetica, sans-serif;
		}
		.dalam{
			/* text-transform: uppercase; */
		}
		/* .tepi { border: 1px solid; 
		} */
	</style>
		@foreach ($peserta as $item)
		<div class="print">
			<table 
			@if ($pelatihan->keterangan == 'guru')
			style="height: 180px; width: 900px;margin-left:113px;margin-top:290px"
			@else
			style="height: 180px; width: 720px;margin-left:116px;margin-top:290px"
			@endif class="dalam">
				<tbody>
				<tr class="atas" style="height: 10px;">
				<td class="atas" style="width: 200px; height: 10px;">Nama&nbsp;</td>
				<td class="atas" style="width: 11px; height: 10px;">:</td>
				{{-- Output nama dengan gelar --}}
				<td class="atas" style="width: 562px; height: 10px; font-weight: bold;">{{ $item->name }}</td>
				<td class="atas" style="width: 52px; height: 10px; ">&nbsp;</td>
				</tr>
				<tr class="atas" style="height: 10px;">
				<td class="atas" style="width: 200px; height: 10px;">Alamat&nbsp;</td>
				<td class="atas" style="width: 11px; height: 10px;">:</td>
				<?php
					$num_char = 100;
					$text = $item->alamat.' '.substr($item->kabupaten->nama,5);
					?>
				<td class="atas" style="width: 562px; height: 10px; font-weight: bold;text-transform: uppercase" >{{ substr($text, 0, $num_char) }}</td>
				<td class="atas" style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				<tr class="atas" style="height: 10px;">
				<td class="atas" style="width: 200px; height: 10px; ">Tempat Tanggal Lahir&nbsp;</td>
				<td class="atas" style="width: 11px; height: 10px;">:</td><?php date_default_timezone_set('Asia/Jakarta'); $date=$item->tgllahir;?>
				<td class="atas" style="width: 562px; height: 10px; font-weight: bold;text-transform: uppercase" >{{ $item->tmptlahir }}, {{ Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }}&nbsp;</td>
				<td class="atas" style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				@if ($pelatihan->keterangan == 'santri')
				<tr class="atas" style="height: 10px;">
					<td class="atas" style="width: 200px; height: 10px;">Asal Lembaga</td>
					<td class="atas" style="width: 11px; height: 10px;">:</td>
					{{-- <td class="atas" style="width: 562px; height: 10px; font-weight: bold;text-transform: uppercase" >{{ $item->lembaga->name }}</td> --}}
					<td class="atas" style="width: 562px; height: 10px; font-weight: bold;text-transform: uppercase" >Baitul Ghufron</td>
					<td class="atas" style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				@endif
				<tr class="atas" style="height: 10px;">
				<td class="atas" style="width: 200px; height: 10px;">Dinyatakan</td>
				<td class="atas" style="width: 11px; height: 10px;">:</td>
				<td class="atas" style="width: 562px; height: 10px; font-weight: bold;text-transform: uppercase" >{{ $item->kriteria }}</td>
				<td class="atas" style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				<tr class="atas" style="height: 37px;">
				<td class="atas" style="width: 200px; height: 37px;">&nbsp;</td>
				<td class="atas" style="width: 11px; height: 37px;">&nbsp;</td>
				<td class="atas" style="width: 562px; height: 37px;">&nbsp;</td>
				<td class="atas" style="width: 52px; height: 37px;">&nbsp;</td>
				</tr>
				</tbody>
			</table>			
			<table 
			@if ($pelatihan->keterangan=='guru')
			style="margin-left:113px; margin-top: 4px"
			@else
			style="margin-left:116px; margin-top: 10px"
			@endif
			>
				<tbody>
				<tr style="height: 27px;"><?php $tahun = date('Y')?>
				<td class="bawah" style="width: 210px; height: 27px; "><small> </small></td>
				<td class="bawah" style="width: 210px; height: 27px;">&nbsp;</td><?php $lokasicetak = strtolower(substr($item->pelatihan->cabang->kabupaten->nama, 4))?>
				<td class="atas" style="width: 241px; height: 27px; text-transform: lowercase;text-transform: capitalize">{{ $lokasicetak }}, {{ Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
				</tr>
				<tr style="height: 78px;">
				<td class="bawah" style="width: 210px; height: 70px;">
					<div class="tepi" style="width: 70px; padding: 2px">
						<img src="images/{{ $item->slug }}.png" alt="" width="70px" height="70px">
					</div>
				</td>
				<td class="bawah" style="width: 210px; height: 70px;">&nbsp;</td>
				<td class="bawah" style="width: 241px; height: 70px;">
					{{-- @if ($cabang=='KOTA SURABAYA')
					<img src="assets/images/pu2.png" alt="" width="140px" height="70px">
					@endif --}}
				</td>
				</tr>
				<tr style="height: 5px;">
				<td class="bawah" style="width: 210px; height: 5px;">No. Syahadah : &nbsp;{{ $item->pelatihan_id }}/{{ $tahun }}/{{ $item->id }}</td>
				<td class="bawah" style="width: 210px; height: 5px;">&nbsp;</td>
				<td class="atas" style="width: 241px; height: 5px; font-weight: bold">{{ $direktur }}</td>
				</tr>
				<tr style="height: 4px;">
				<td class="bawah" style="width: 210px; height: 4px;">&nbsp;</td>
				<td class="bawah" style="width: 185px; height: 4px;">&nbsp;</td>
				<td class="bawah" style="width: 241px; height: 2px; text-transform: capitalize">{{ $kepala }}</td>
				</tr>
				</tbody>
			</table>
		</div>
		@endforeach
</body>
</html>	

