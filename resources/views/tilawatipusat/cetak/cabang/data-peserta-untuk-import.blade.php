<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .notel {
        mso-number-format: "\@";
        }
    </style>
</head>
<body>
    {{-- <table>
        <thead style="font-weight: bold; text-transform: uppercase">
            <tr>
                <th rowspan="3" colspan="10">DATA PESERTA DIKLAT CABANG {{strtoupper($pelatihan->cabang->name)}}<br> <small>Seluruh Indonesia Per - 2022 | {{$pelatihan->program->name}} | {{$pelatihan->id}}</small></th>
            </tr>
        </thead>
    </table> --}}
    {{-- spasi --}}
    {{-- <table>
        <thead>
            <tr></tr>
        </thead>
    </table> --}}
    {{-- spasi --}}
    <table>
        <thead style="font-weight: bold; border: black">
            <tr style="border: black; text-transform: uppercase">
                {{-- <th rowspan="2">ID</th> --}}
                @if ($pelatihan->program->name == "Diklat Munaqisy Cabang" || $pelatihan->program->name == "Training Of Trainer Guru Al-Qur'an")
                <th>ASAL CABANG</th>
                @endif
                <th >NAMA PESERTA</th>
                <th >ALAMAT </th>
                <th >KOTA</th>
                <th >WA / TELP</th>
                <th >TEMPAT LAHIR</th>
                <th >TANGGAL LAHIR</th>
                <th >LEMBAGA</th>
                {{-- <th >JILID</th> --}}
                <th >KRITERIA</th>
                <th >BERSYAHADAH</th>
                @foreach ($pelatihan->program->penilaian as $item)
                <th >{{$item->name}}</th>
                @endforeach
                
            </tr>
        </thead >
        <tbody>
            @if ($pelatihan->program->name == "Diklat Munaqisy Cabang" || $pelatihan->program->name == "Training Of Trainer Guru Al-Qur'an")
                @foreach ($peserta as $item)
                <tr>
                    <td>{{$item->asal_cabang}}</td>
                    <td>{{$item->name}}</td>
                    <td style="text-transform: uppercase">
                        {{strtoupper($item->alamat)}}
                    </td>
                    <td>
                        @if ($item->kabupaten !== null)
                            {{substr($item->kabupaten->nama,4)}}
                        @else
                        -   {{$item->kota2}}
                        @endif
                    </td>
                    <td>{{$item->telp}}</td>
                    <td>
                        @if ($item->tmptlahir2 !== null)
                            {{$item->tmptlahir2}}
                        @else
                            @if (substr($item->tmptlahir, 0, 4) == 'KOTA' || substr($item->tmptlahir, 0, 4) == 'KAB.')
                                {{substr($item->tmptlahir, 5)}}
                            @else
                                {{$item->tmptlahir}}    
                            @endif
                        @endif
                    </td>
                    <td>
                        {{-- {{$item->tgllahir}} --}}
                        {{Carbon\Carbon::parse($item->tgllahir)->isoFormat('D MMMM Y')}}
                    </td>
                    <td>-</td>
                    {{-- <td>{{$item->jilid}}</td> --}}
                    <td>{{$item->kriteria}}</td>
                    <td>{{$item->bersyahadah}}</td>
                    @foreach ($item->nilai as $n)
                    <td>{{$n->nominal}}</td>
                    @endforeach
                </tr>
                @endforeach
            
            @else
                @foreach ($peserta as $item)
                <tr>
                    {{-- <td>{{$item->id}}</td> --}}
                    <td>{{$item->name}}</td>
                    <td style="text-transform: uppercase">
                        {{strtoupper($item->alamat)}}
                    </td>
                    <td>
                        @if ($item->kabupaten !== null)
                            {{substr($item->kabupaten->nama,4)}}
                        @else
                        -   {{$item->kota2}}
                        @endif
                    </td>
                    <td>{{$item->telp}}</td>
                    <td>
                        @if ($item->tmptlahir2 !== null)
                            {{$item->tmptlahir2}}
                        @else
                            @if (substr($item->tmptlahir, 0, 4) == 'KOTA' || substr($item->tmptlahir, 0, 4) == 'KAB.')
                                {{substr($item->tmptlahir, 5)}}
                            @else
                                {{$item->tmptlahir}}    
                            @endif
                        @endif
                    </td>
                    <td>
                        {{-- {{$item->tgllahir}} --}}
                        {{Carbon\Carbon::parse($item->tgllahir)->isoFormat('D MMMM Y')}}
                    </td>
                    <td>-</td>
                    <td>{{$item->jilid}}</td>
                    <td>{{$item->kriteria}}</td>
                    <td>{{$item->bersyahadah}}</td>
                    @foreach ($item->nilai as $n)
                    <td>{{$n->nominal}}</td>
                    @endforeach
                </tr>
                @endforeach
            @endif
            
        </tbody>
    </table>
</body>
</html>