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
    <table>
        <thead style="font-weight: bold; text-transform: uppercase">
            <tr>
                <th rowspan="3" colspan="10">DATA PESERTA DIKLAT CABANG {{strtoupper($pelatihan->cabang->name)}}<br> <small>Seluruh Indonesia Per - 2022 | {{$pelatihan->program->name}} | {{$pelatihan->id}}</small></th>
            </tr>
        </thead>
    </table>
    {{-- spasi --}}
    <table>
        <thead>
            <tr></tr>
        </thead>
    </table>
    {{-- spasi --}}
    <table>
        <thead style="font-weight: bold; border: black">
            <tr style="border: black; text-transform: uppercase">
                <th rowspan="2">ID</th>
                <th rowspan="2">NAMA PESERTA</th>
                <th rowspan="2">ALAMAT </th>
                <th rowspan="2">KOTA</th>
                <th rowspan="2">WA / TELP</th>
                <th rowspan="2">TEMPAT LAHIR</th>
                <th rowspan="2">TANGGAL LAHIR</th>
                <th rowspan="2">LEMBAGA</th>
                <th rowspan="2">JILID</th>
                <th rowspan="2">KRITERIA</th>
                <th rowspan="2">BERSYAHADAH</th>
                
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            @foreach ($peserta as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{strtoupper($item->alamat)}}
                    @if ($item->kecamatan !== null)
                        {{$item->kecamatan->nama}}
                    @endif

                    @if ($item->kelurahan !== null)
                        {{$item->kelurahan->nama}}
                    @endif
                </td>
                <td>
                    @if ($item->kabupaten !== null)
                        {{substr($item->kabupaten->nama,4)}}
                    @else
                    -   {{substr($item->kota2)}}
                    @endif
                </td>
                <td>{{$item->telp}}</td>
                <td>
                    @if (substr($item->tmptlahir, 0, 4) == 'KOTA' || substr($item->tmptlahir, 0, 4) == 'KAB.')
                        {{substr($item->tmptlahir, 5)}}
                    @else
                        {{substr($item->tmptlahir)}}    
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
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>