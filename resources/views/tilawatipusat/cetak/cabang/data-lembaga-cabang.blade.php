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
                <th rowspan="3" colspan="10">DATA LEMBAGA CABANG <br> <small>Seluruh Indonesia Per - 2022</small></th>
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
                <th rowspan="2">NO</th>
                <th rowspan="2">NAMA LEMBAGA</th>
                <th rowspan="2">KEPALA LEMBAGA</th>
                <th rowspan="2">WA / TELP</th>
                <th rowspan="2">JUMLAH GURU</th>
                <th rowspan="2">JUMLAH SANTRI</th>
                <th rowspan="2">ALAMAT</th>
                <th rowspan="2">PENGELOLA</th>
                <th rowspan="2">STATUS</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            @foreach ($lembaga as $key=> $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->kepalalembaga}}</td>
                <td>{{$item->telp}}</td>
                <td>{{$item->jml_guru}}</td>
                <td>{{$item->jml_santri}}</td>
                <td>{{$item->alamat}}</td>
                <td>{{$item->pengelola}}</td>
                <td>{{$item->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>