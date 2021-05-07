
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	<style>
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
			<table style="height: 180px; width: 720px;margin-left:10px;margin-top:292px" class="dalam">
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
			<table style="margin-left:30px;">
				<tbody>
				<tr style="height: 27px;">
				<td style="width: 241px; height: 27px;">&nbsp;</td>
				<td style="width: 208px; height: 27px;">&nbsp;</td>
				<td style="width: 241px; height: 27px;">Surabaya, 06 May 2021</td>
				</tr>
				<tr style="height: 78px;">
				<td style="width: 241px; height: 78px;"><small>No. Syahadah : &nbsp;{{ $item->pelatihan_id }}/2021/{{ $item->id }} </small></td>
				<td style="width: 208px; height: 78px;">&nbsp;</td>
				<td style="width: 241px; height: 78px;"><img src="assets/images/pu2.png" alt=""></td>
				</tr>
				<tr style="height: 5px;">
				<td style="width: 241px; height: 5px;">&nbsp;</td>
				<td style="width: 208px; height: 5px;">&nbsp;</td>
				<td style="width: 241px; height: 5px;">Dr. KH. Umar Jaeni M.Pd</td>
				</tr>
				<tr style="height: 4px;">
				<td style="width: 241px; height: 4px;">&nbsp;</td>
				<td style="width: 208px; height: 4px;">&nbsp;</td>
				<td style="width: 241px; height: 2px;">Direktur Eksekutif</td>
				</tr>
				</tbody>
			</table>
		</div>
		@endforeach
</body>
</html>	

