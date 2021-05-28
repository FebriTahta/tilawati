
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
		.td {
			font-size: 20px;
			font-family: Arial, Helvetica, sans-serif;
		}
		.dalam{
			/* text-transform: uppercase; */
		}
	</style>
		@foreach ($peserta as $item)
		<div class="print">
			<table style="height: 180px; width: 720px;margin-left:134px;margin-top:292px" class="dalam">
				<tbody>
				<tr style="height: 10px;">
				<td style="width: 249px; height: 10px;">NAMA&nbsp;</td>
				<td style="width: 11px; height: 10px;">:</td>
				<td style="width: 562px; height: 10px;">{{ $item->name }}</td>
				<td style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				<tr style="height: 10px;">
				<td style="width: 249px; height: 10px;">ALAMAT&nbsp;</td>
				<td style="width: 11px; height: 10px;">:</td>
				<?php
					$num_char = 57;
					$text = $item->alamat;
					?>
				<td style="width: 562px; height: 10px;">{{ substr($text, 0, $num_char) }}</td>
				<td style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				<tr style="height: 10px;">
				<td style="width: 249px; height: 10px;">TEMPAT TANGGAL LAHIR&nbsp;</td>
				<td style="width: 11px; height: 10px;">:</td><?php $tgl_lahir = ($item->tgllahir - 25569) * 86400?>
				<td style="width: 562px; height: 10px;">{{ $item->tmptlahir }}, {{ gmdate('d F Y',$tgl_lahir) }}&nbsp;</td>
				<td style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				<tr style="height: 9px;">
				<td style="width: 249px; height: 10px;">DINYATAKAN</td>
				<td style="width: 11px; height: 10px;">:</td>
				<td style="width: 562px; height: 10px;">{{ $item->kriteria }}</td>
				<td style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				<tr style="height: 37px;">
				<td style="width: 249px; height: 37px;">&nbsp;</td>
				<td style="width: 11px; height: 37px;">&nbsp;</td>
				<td style="width: 562px; height: 37px;">&nbsp;</td>
				<td style="width: 52px; height: 37px;">&nbsp;</td>
				</tr>
				</tbody>
			</table>
			<div style="margin-top: 15px"></div>
			<table style="margin-left:134px;">
				<tbody>
				<tr style="height: 27px;"><?php $tahun = date('Y')?>
				<td style="width: 241px; height: 27px; font-weight: bold"><small>No. Syahadah : &nbsp;{{ $item->pelatihan_id }}/{{ $tahun }}/{{ $item->id }} </small></td>
				<td style="width: 208px; height: 27px;">&nbsp;</td><?php $sekarang = date('d F Y')?>
				<td style="width: 241px; height: 27px; font-weight: bold">Surabaya, {{ $sekarang }}</td>
				</tr>
				<tr style="height: 78px;">
				<td style="width: 241px; height: 78px;"><img src="images/{{ $item->id }}qrcode.png" alt="" width="70px" height="70px"></td>
				<td style="width: 208px; height: 78px;">&nbsp;</td>
				<td style="width: 241px; height: 78px;"><img src="assets/images/pu2.png" alt="" width="140px" height="70px"></td>
				</tr>
				<tr style="height: 5px;">
				<td style="width: 241px; height: 5px;">&nbsp;</td>
				<td style="width: 208px; height: 5px;">&nbsp;</td>
				<td style="width: 241px; height: 5px; font-weight: bold">{{ $direktur }}</td>
				</tr>
				<tr style="height: 4px;">
				<td style="width: 241px; height: 4px;">&nbsp;</td>
				<td style="width: 208px; height: 4px;">&nbsp;</td>
				<td style="width: 241px; height: 2px;">{{ $jabatan }}</td>
				</tr>
				</tbody>
			</table>
		</div>
		@endforeach
</body>
</html>	

