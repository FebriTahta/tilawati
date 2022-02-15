
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	<style>
		body{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 16px;
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
	</style>
		@foreach ($peserta as $item)
		<div class="print">
			<table style="height: 180px; width: 720px;margin-left:109px;margin-top:280px" class="dalam">
				<tbody>
				<tr class="atas" style="height: 10px;">
				<td class="atas" style="width: 200px; height: 10px;">Nama&nbsp;</td>
				<td class="atas" style="width: 11px; height: 10px;">:</td>
				<td class="atas" style="width: 562px; height: 10px; font-weight: bold">{{ $item->name }}</td>
				<td class="atas" style="width: 52px; height: 10px; ">&nbsp;</td>
				</tr>
				<tr class="atas" style="height: 10px;">
				<td class="atas" style="width: 200px; height: 10px;">Alamat&nbsp;</td>
				<td class="atas" style="width: 11px; height: 10px;">:</td>
				<?php
					$num_char = 57;
					$text = $item->alamat;
					?>
				<td class="atas" style="width: 562px; height: 10px; font-weight: bold" >{{ substr($text, 0, $num_char) }}</td>
				<td class="atas" style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				<tr class="atas" style="height: 10px;">
				<td class="atas" style="width: 200px; height: 10px;">Tempat Tanggal Lahir&nbsp;</td>
				<td class="atas" style="width: 11px; height: 10px;">:</td><?php $tgl_lahir = ($item->tgllahir - 25569) * 86400?>
				@if ($item->tmptlahir !== null && $item->tmptlahir2 == null)
				<td class="atas" style="width: 562px; height: 10px; font-weight: bold" >{{ $item->tmptlahir }}, {{ gmdate('d F Y',$tgl_lahir) }}&nbsp;</td>
				@else
				<td class="atas" style="width: 562px; height: 10px; font-weight: bold" >{{ $item->tmptlahir2 }}, {{ gmdate('d F Y',$tgl_lahir) }}&nbsp;</td>
				@endif
				<td class="atas" style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				<tr class="atas" style="height: 9px;">
				<td class="atas" style="width: 200px; height: 10px;">Asal Lembaga</td>
				<td class="atas" style="width: 11px; height: 10px;">:</td>
				<td class="atas" style="width: 562px; height: 10px; font-weight: bold" >KHOIRUL HUDA</td>
				<td class="atas" style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				<tr class="atas" style="height: 9px;">
				<td class="atas" style="width: 200px; height: 10px;">Dinyatakan</td>
				<td class="atas" style="width: 11px; height: 10px;">:</td>
				<td class="atas" style="width: 562px; height: 10px; font-weight: bold" >{{ $item->kriteria }}</td>
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
			<table style="margin-left:109px; margin-top: 14px">
				<tbody>
				<tr style="height: 27px;"><?php $tahun = date('Y')?>
				<td class="bawah" style="width: 210px; height: 27px; "><small> </small></td>
				<td class="bawah" style="width: 210px; height: 27px;">&nbsp;</td><?php $sekarang = date('d F Y')?>
				<td class="atas" style="width: 241px; height: 27px; ">Surabaya, 18 Juni 2022</td>
				</tr>
				<tr style="height: 78px;">
					<td class="bawah" style="width: 210px; height: 70px;"><img src="{{ asset('images/ $item->id ') }}qrcode.png}}" alt="" width="70px" height="70px"></td>
					<td class="bawah" style="width: 210px; height: 70px;">&nbsp;</td>
					<td class="bawah" style="width: 241px; height: 70px;">
						@if ($cabang=='KOTA SURABAYA')
						<img src="{{ asset('assets/images/pu2.png') }}" alt="" width="140px" height="70px">
						@endif
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
				<td class="bawah" style="width: 241px; height: 2px;">{{ $kepala }}</td>
				</tr>
				</tbody>
			</table>
		</div>
		@endforeach
</body>
</html>	

