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
			font-size: 16px;
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
			style="height: 180px; width: 900px;margin-left:100px;margin-top:350px"
			class="dalam">
				<tbody>
				<tr class="atas" style="height: 10px;">
				<td class="atas" style="width: 170px; height: 10px;">&nbsp;</td>
				<td class="atas" style="width: 11px; height: 10px;"></td>
				{{-- Output nama dengan gelar --}}
				<td class="atas" style="width: 750px; height: 10px;">{{ $item->nama }}</td>
				<td class="atas" style="width: 52px; height: 10px; ">&nbsp;</td>
				</tr>
				<tr class="atas" style="height: 10px;">
				<td class="atas" style="width: 170px; height: 10px;"></td>
				<td class="atas" style="width: 11px; height: 10px;"></td>
				<td class="atas" style="width: 750px; height: 10px; text-transform: uppercase" >{{ $item->alamat }} {{$item->kota}}</td>
				<td class="atas" style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				<tr class="atas" style="height: 10px;">
				<td class="atas" style="width: 170px; height: 10px; "></td>
				<td class="atas" style="width: 11px; height: 10px;"></td><?php date_default_timezone_set('Asia/Jakarta'); $date=$item->tgllahir;?>
				<td class="atas" style="width: 750px; height: 10px; text-transform: uppercase" >{{ $item->tmplahir }}, {{ Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }}&nbsp;</td>
				<td class="atas" style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				
				<tr class="atas" style="height: 10px;">
				<td class="atas" style="width: 170px; height: 10px;"></td>
				<td class="atas" style="width: 11px; height: 10px;"></td>
				<td class="atas" style="width: 750px; height: 10px; text-transform: uppercase" >{{ $item->kriteria }}</td>
				<td class="atas" style="width: 52px; height: 10px;">&nbsp;</td>
				</tr>
				<tr class="atas" style="height: 37px;">
				<td class="atas" style="width: 170px; height: 37px;">&nbsp;</td>
				<td class="atas" style="width: 11px; height: 37px;">&nbsp;</td>
				<td class="atas" style="width: 750px; height: 37px;">&nbsp;</td>
				<td class="atas" style="width: 52px; height: 37px;">&nbsp;</td>
				</tr>
				</tbody>
			</table>			
			<table 
		
			style="margin-left:113px; margin-top: 4px"
			
			>
				<tbody>
				<tr style="height: 27px;"><?php $tahun = date('Y')?>
				<td class="bawah" style="width: 210px; height: 27px; "><small> </small></td>
				<td class="bawah" style="width: 210px; height: 27px;">&nbsp;</td><?php $lokasicetak = strtolower($item->pelatihan->cabang->kabupaten->nama)?>
				<td class="atas" style="width: 241px; height: 27px; text-transform: lowercase;text-transform: capitalize">{{$lokasicetak}}, {{ Carbon\Carbon::parse($item->pelatihan->tanggal)->isoFormat('D MMMM Y') }}</td>
				</tr>
				<tr style="height: 78px;">
				<td class="bawah" style="width: 210px; height: 70px;">
					<div class="tepi" style="width: 70px; padding: 2px">
						
					</div>
				</td>
				<td class="bawah" style="width: 210px; height: 70px;">&nbsp;</td>
				<td class="bawah" style="width: 241px; height: 70px;">
					
				</td>
				</tr>
				<tr style="height: 5px;">
				<td class="bawah" style="width: 210px; height: 5px;">No. Syahadah : &nbsp;{{ $item->pelatihan_id }}/{{ $tahun }}/{{ $item->id }}</td>
				<td class="bawah" style="width: 210px; height: 5px;">&nbsp;</td>
				<td class="atas" style="width: 241px; height: 5px;"> {{$item->pelatihan->cabang->kepala->name}} </td>
				</tr>
				<tr style="height: 4px;">
				<td class="bawah" style="width: 210px; height: 4px;">&nbsp;</td>
				<td class="bawah" style="width: 185px; height: 4px;">&nbsp;</td>
				<td class="bawah" style="width: 241px; height: 2px; text-transform: capitalize"> 
                    @if ($lokasicetak == 'surabaya')
                        Direktur Eksekutif
                    @else
                        Kacab. {{$lokasicetak}}
                    @endif  
                </td>
				</tr>
				</tbody>
			</table>
		</div>
		@endforeach
</body>
</html>	

