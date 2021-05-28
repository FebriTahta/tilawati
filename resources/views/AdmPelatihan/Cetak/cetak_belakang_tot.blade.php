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
	</style>
	@foreach($peserta as $key=> $p)
<div class="container page-break" style="margin-top: 110px">
	<center>
		<p>No. Syahadah : {{ $p->pelatihan->id }} / 2021 / {{ $p->id }}</p>
	</center>
		<table style="width: 600px" class="table1 center">
			<tr>
					<th rowspan="2">No.</th>
					<th rowspan="2">Bidang Peniliaan</th>
					<th colspan="4" class="penilaian">Peniliaan</th>
			</tr>
			<tr>     
				<th class="pe">Max</th>
				<th class="pe">Min</th>
				<th class="pe">Nilai</th>
				<th class="pe">Jumlah</th>
			</tr>
			<tr>
				<th>1</th>
				<td>&nbsp; &nbsp;<b> QURAN</b></td>
				<th colspan="3" class="pe3"></th><?php $jumlah = $p->fs+$p->tj+$p->gm+$p->sl?>
				<th class="pe2">{{ $jumlah }}</th>
			</tr>
			<tr>
				<td class="pop"></td>
				<td class="pop2">&nbsp; &nbsp; &nbsp; &nbsp;a. Fashohah</td>
				<td class="nilai">&nbsp; &nbsp;28</td>
				<td class="nilai2">&nbsp; &nbsp;26</td>
				<td class="nilai3">&nbsp; &nbsp;{{ $p->fs }}</td>
				<td class="nilai4"></td>
			</tr>
			<tr>
				<td class="pop"></td>
				<td class="pop2">&nbsp; &nbsp; &nbsp; &nbsp;b. tajwid</td>
				<td class="nilai">&nbsp; &nbsp;45</td>
				<td class="nilai2">&nbsp; &nbsp;42</td>
				<td class="nilai3">&nbsp; &nbsp;{{ $p->tj }}</td>
				<td class="nilai4"></td>
			</tr>
			<tr>
				<td class="pop"></td>
				<td class="pop2">&nbsp; &nbsp; &nbsp; &nbsp;c. Ghorib musyikilat</td>
				<td class="nilai">&nbsp; &nbsp;10</td>
				<td class="nilai2">&nbsp; &nbsp;10</td>
				<td class="nilai3">&nbsp; &nbsp;{{ $p->gm }}</td>
				<td class="nilai4"></td>
			</tr>
			<tr>
				<td class="pop"></td>
				<td class="pop2">&nbsp; &nbsp; &nbsp; &nbsp;d. Suara Lagu</td>
				<td class="nilai">&nbsp; &nbsp;7</td>
				<td class="nilai2">&nbsp; &nbsp;7</td>
				<td class="nilai3">&nbsp; &nbsp;{{ $p->sl }}</td>
				<td class="nilai4"></td>
			</tr>
			<tr>
				<th>2</th>
				<td class="nilai6">&nbsp; &nbsp;<b> Praktek Menatar Strategi Mengajar</b></th>
                <td class="pops">&nbsp; &nbsp;95</td>
                <td class="pops2">&nbsp; &nbsp;65</td>
                <td class="pops3">&nbsp; &nbsp;</td>
				<th class="nilai7">{{ $p->im }}</th>
			</tr>
            <tr>
				<th>3</th>
				<td class="nilai6">&nbsp; &nbsp;<b> Praktek Menatar Lagu</b></th>
                <td class="pops">&nbsp; &nbsp;95</td>
                <td class="pops2">&nbsp; &nbsp;65</td>
                <td class="pops3">&nbsp; &nbsp;</td>
				<th class="nilai7">{{ $p->il }}</th>
			</tr>
            <tr>
				<th>4</th>
				<td class="nilai6">&nbsp; &nbsp;<b> Praktek Keinstrukturan</b></th>
                <td class="pops">&nbsp; &nbsp;95</td>
                <td class="pops2">&nbsp; &nbsp;65</td>
                <td class="pops3">&nbsp; &nbsp;</td>
				<th class="nilai7">{{ $p->i }}</th>
			</tr>
            
			<tr>
				<th></th>
				<td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
				<th colspan="3" class="nilai5"></th><?php $rata2 = ($jumlah + $p->im + $p->il + $p->i)/4?>
				<th class="nilai7">{{ $rata2 }}</th>
			</tr>
			<tr>
				<th></th>
				<td class="nilai6">&nbsp; &nbsp;<b> PRESTASI</b></th>
				<th colspan="3" class="nilai5"></th> 
				<th class="nilai7">
                    @if ($rata2 >= 85)
                        Baik
                    @else
                        Cukup
                    @endif
                </th>
			</tr>
		</table>
			<div id="textbox" style="margin-top: 20px">
				<div class="alignleft" style="margin-left: 180px"><b> Baik : 85 - 95 </b></div>
				<div class="alignright" style="margin-right: 180px"></b> Cukup : 65 - 84 </b></div>
			</div>
</div>

	@endforeach
</body>
</html>