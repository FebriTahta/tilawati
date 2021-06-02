<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	<style>
		body{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12px;
		}
		.syahadah{
			font-size: 12px;
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
			/* border-left: 0;     */
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
		}
		.center {
            text-align-last: center;
        }
		td.pops{
			border-right: 0;
		}
		td.pops2{
			border-left: 0;
			border-right: 0;
		}
		td.pops3{
			border-left: 0;
		}
		.column {
			float: left;
			width: 50%;
		}
		.row:after {
			content: "";
			clear: both;
		}.bawah{
			margin-left: 180px;
			width: 550px;
		}
	</style>
	@foreach($peserta as $key=> $p)
<div class="container page-break" style="margin-top: 147px">
	<center>
		<span class="syahadah">No. Syahadah : {{ $p->pelatihan->id }} / 2021 / {{ $p->id }}</span>
	</center>
		<table style="width: 600px;" class="table1 center">
			<tr>
					<th style="text-align: center">No.</th>
					<th style="text-align: center">Bidang Penilaian</th>
					<th style="text-align: center">Nilai</th>
			</tr>
			<tr>
				<th>1</th>
				<td>&nbsp; &nbsp;<b> Al-Qur'an</b></td>
				<th ></th>
			</tr>
			<tr>
				<td class="pop"></td>
				<td class="pop2">&nbsp; &nbsp; &nbsp; &nbsp;a. Fashohah</td>
				<td style="border-top: 0;border-bottom: 0;text-align: center">27</td>
			</tr>
			<tr>
				<td class="pop"></td>
				<td class="pop2">&nbsp; &nbsp; &nbsp; &nbsp;b. Tajwid</td>
				<td style="border-top: 0;border-bottom: 0;text-align: center">45</td>
			</tr>
			<tr>
				<td class="pop"></td>
				<td class="pop2">&nbsp; &nbsp; &nbsp; &nbsp;c. Ghorib musyikilat</td>
				<td style="border-top: 0;border-bottom: 0;text-align: center">10</td>
			</tr>
			<tr>
				<td class="pop"></td>
				<td class="pop2">&nbsp; &nbsp; &nbsp; &nbsp;d. Suara Lagu</td>
				<td style="border-top: 0;border-bottom: 0;text-align: center">7</td>
			</tr>
			<tr>
				<th>2</th>
				<td class="nilai6">&nbsp; &nbsp;<b> Praktek Munaqisy</b></th>
				<th ></th>
			</tr>
			<tr>
				<td class="pop"></td>
				<td class="pop2">&nbsp; &nbsp; &nbsp; &nbsp;a. Kebenaran Menilai</td>
				<td style="border-top: 0;border-bottom: 0;text-align: center">69</td>
			</tr>
			<tr>
				<td class="pop"></td>
				<td class="pop2">&nbsp; &nbsp; &nbsp; &nbsp;b. Alasan Menilai</td>
				<td style="border-top: 0;border-bottom: 0;text-align: center">69</td>
			</tr>
			<tr>
				<td class="pop"></td>
				<td class="pop2">&nbsp; &nbsp; &nbsp; &nbsp;c. Wawasan Tajwid</td>
				<td style="border-top: 0;border-bottom: 0;text-align: center">69</td>
			</tr>
			<tr>
				<th></th>
				<td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
				<th >75</th>
			</tr>
			<tr>
				<th></th>
				<td class="nilai6">&nbsp; &nbsp;<b> PRESTASI</b></th>
				<th >
                   Baik
                </th>
			</tr>
		</table>
		<div class="bawah">
			<div class="row" style="margin-top: 20px">
				<div class="column"> Istimewa : 85 - 95 </div>
				<div class="column"> Baik : 75 - 84 </div>
				<div class="alignleft" style="margin-left: 250px"> Cukup : 65 - 75 </div>
			</div>
		</div>
</div>

	@endforeach
</body>
</html>	