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
				<tr class="atas">
                    <td class="atas" style="width: 170px; height: 23px;">&nbsp;</td>
                    <td class="atas" style="width: 11px; height: 23px;"></td>
                    <td class="atas" style="width: 750px; height: 23px;">{{ $item->name }}</td>
                    <td class="atas" style="width: 52px; height: 23px; ">&nbsp;</td>
				</tr>
				<tr class="atas">
                    <td class="atas" style="width: 170px; height: 23px;"></td>
                    <td class="atas" style="width: 11px; height: 23px;"></td>
                    <td class="atas" style="width: 750px; height: 23px; text-transform: uppercase" >{{ $item->alamat }} 
						
						@if (substr($item->kota, 0, 4) == 'KOTA')
								{{substr($item->kota, 5)}}
						@elseif(substr($item->kota, 0, 4) == 'ADM.')
								{{substr($item->kota, 10)}}
						@elseif(substr($item->kota, 0, 4) == 'KAB.')
								{{substr($item->kota, 5)}}
						@else
								{{substr($item->kota, 5)}}
						@endif
					
					</td>
                    <td class="atas" style="width: 52px; height: 23px;">&nbsp;</td>
				</tr>
				<tr class="atas">
                    <td class="atas" style="width: 170px; height: 23px; "></td>
                    <td class="atas" style="width: 11px; height: 23px;"></td><?php date_default_timezone_set('Asia/Jakarta'); $date=$item->tgllahir;?>
                    <td class="atas" style="width: 750px; height: 23px; text-transform: uppercase" >
						@if ($item->tmptlahir2 == null)
							@if (substr($item->tmptlahir, 0, 4) == 'KOTA')
								{{substr($item->tmptlahir, 5)}}
							@elseif(substr($item->tmptlahir, 0, 4) == 'ADM.')
								{{substr($item->tmptlahir, 10)}}
							@elseif(substr($item->tmptlahir, 0, 4) == 'KAB.')
								{{substr($item->tmptlahir, 5)}}
							@else
								{{$item->tmptlahir}}
							@endif
						@endif

						@if ($item->tmptlahir2 !== null)
							@if (substr($item->tmptlahir2, 0, 4) == 'KOTA')
							{{substr($item->tmptlahir2, 5)}}
							@elseif(substr($item->tmptlahir2, 0, 4) == 'ADM.')
								{{substr($item->tmptlahir2, 10)}}
							@elseif(substr($item->tmptlahir2, 0, 4) == 'KAB.')
								{{substr($item->tmptlahir2, 5)}}
							@else
								{{$item->tmptlahir2}}
							@endif
						@endif
						
						, {{ Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }}&nbsp;</td>
                    <td class="atas" style="width: 52px; height: 23px;">&nbsp;</td>
				</tr>
				
				<tr class="atas">
                    <td class="atas" style="width: 170px; height: 23px;"></td>
                    <td class="atas" style="width: 11px; height: 23px;"></td>
                    <td class="atas" style="width: 750px; height: 23px; text-transform: uppercase" >{{ $item->kriteria }}</td>
                    <td class="atas" style="width: 52px; height: 23px;">&nbsp;</td>
				</tr>
				<tr class="atas">
                    <td class="atas" style="width: 170px; height: 37px;">&nbsp;</td>
                    <td class="atas" style="width: 11px; height: 37px;">&nbsp;</td>
                    <td class="atas" style="width: 750px; height: 37px;">&nbsp;</td>
                    <td class="atas" style="width: 52px; height: 37px;">&nbsp;</td>
				</tr>
				</tbody>
			</table>			
			<table 
		
			style="margin-left:113px; margin-top: 20px"
			
			>
				<tbody>
				<tr style="height: 27px;"><?php $tahun = date('Y')?>
				<td class="bawah" style="width: 210px; height: 27px; "><small> </small></td>
				<td class="bawah" style="width: 210px; height: 27px;">&nbsp;</td>
				<td class="atas" style="width: 241px; height: 27px; text-transform: lowercase;text-transform: capitalize">Surabaya, {{ Carbon\Carbon::parse($item->pelatihan->tanggal)->isoFormat('D MMMM Y') }}</td>
				</tr>
				<tr style="height: 78px;">
				<td class="bawah" style="width: 210px; height: 70px;">
					<div class="tepi" style="width: 70px; padding: 2px">
						<img src="images/{{ $item->slug }}.png" alt="" width="70px" height="70px">
					</div>
				</td>
				<td class="bawah" style="width: 210px; height: 70px;">&nbsp;</td>
				<td class="bawah" style="width: 241px; height: 70px;">
					
				</td>
				</tr>
				<tr style="height: 5px;">
				<td class="bawah" style="width: 210px; height: 5px;">No. Syahadah : &nbsp;{{ $item->pelatihan_id }}/{{ $tahun }}/{{ $item->id }}</td>
				<td class="bawah" style="width: 210px; height: 5px;">&nbsp;</td>
				<td class="atas" style="width: 241px; height: 5px;"> 
                    @if ($item->pelatihan->cabang->name == 'Cahaya Amanah' || $item->pelatihan->cabang->name == 'Tilawati Pusat' || $item->pelatihan->cabang->status == "RPQ")
                    Dr. KH. Umar Jaeni ,M.Pd
                    @else
                    {{$item->pelatihan->cabang->kepalacabang}}
                    @endif
                </td>
				</tr>
				<tr style="height: 4px;">
				<td class="bawah" style="width: 210px; height: 4px;">&nbsp;</td>
				<td class="bawah" style="width: 185px; height: 4px;">&nbsp;</td>
				<td class="bawah" style="width: 241px; height: 2px; text-transform: capitalize"> 
                    @if ($item->pelatihan->cabang->name == 'Cahaya Amanah' || $item->pelatihan->cabang->name == 'Tilawati Pusat' || $item->pelatihan->cabang->status == "RPQ")
                    Direktur Eksekutif
                    @else
					<?	$kabupaten 	= substr($item->pelatihan->cabang->kabupaten->nama, 5); $kab = strtolower($kabupaten);
						$provinsi 	= strtolower($item->pelatihan->cabang->kabupaten->provinsi->nama); 
					$data_kabupaten = App\Models\Kabupaten::where('id', $item->pelatihan->cabang->kabupaten->id)->first();
					$jum_cabang		= $data_kabupaten->cabang->count();
					?>
						@if ($jum_cabang > 1)
							@if (substr($item->pelatihan->cabang->kabupaten->nama,5,3)=='ADM')
							{{ 'Kacab. ' .strtoupper(substr($provinsi,0,3)).' '.ucfirst(substr($provinsi,4))}}
							@else
							{{ 'Kacab. '.ucfirst($item->pelatihan->cabang->name).' '.ucfirst($kab) }}
							@endif
						@else
							@if (substr($item->pelatihan->cabang->kabupaten->nama,5,3)=='ADM')
							{{ 'Kacab. ' .strtoupper(substr($provinsi,0,3)).' '.ucfirst(substr($provinsi,4))}}	
							@else
							{{ 'Kacab. '.ucfirst($kab).' '.ucfirst($provinsi)}}
							@endif
						@endif

                    @endif
                </td>
				</tr>
				</tbody>
			</table>
		</div>
		@endforeach
</body>
</html>	

