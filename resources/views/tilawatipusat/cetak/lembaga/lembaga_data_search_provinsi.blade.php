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
                <th rowspan="3" colspan="10">DATA LEMBAGA {{strtoupper($provinsi->nama)}} <br> <small>Per - {{date('Y')}}</small></th>
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
                <th rowspan="2" style="font-weight: bold">KODE</th>
                <th rowspan="2" style="font-weight: bold">NAMA LEMBAGA</th>
                <th rowspan="2" style="font-weight: bold">KEPALA LEMBAGA</th>
                <th rowspan="2" style="font-weight: bold">PHONE NUMBER</th>
                <th rowspan="2" style="font-weight: bold">JENJANG</th>
                <th rowspan="2" style="font-weight: bold">PENGELOLA</th>
                <th rowspan="2" style="font-weight: bold">JUMLAH GURU</th>
                <th rowspan="2" style="font-weight: bold">JUMLAH SANTRI</th>
                <th rowspan="2" style="font-weight: bold">STATUS</th>
                <th rowspan="2" style="font-weight: bold">ASAL CABANG</th>
                <th rowspan="2" style="font-weight: bold">KOTA / KABUPATEN</th>
                <th rowspan="2" style="font-weight: bold">ALAMAT</th>
            </tr>
            <tr></tr>
        </thead >
        <tbody>
            <tr></tr>
            @foreach ($data as $item)
                <tr>
                    <td>{{$item->kode}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->kepalalembaga}}</td>
                    <td>{{$item->telp}}</td>
                    <td>{{$item->jenjang}}</td>
                    <td>{{$item->pengelola}}</td>
                    <td>{{$item->jml_guru}}</td>
                    <td>{{$item->jml_santri}}</td>
                    <td>{{$item->status}}</td>
                    <td>{{$item->cabang->name}}</td>
                    <td>{{$item->kabupaten->nama}}</td>
                    <td>{{$item->alamat}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>