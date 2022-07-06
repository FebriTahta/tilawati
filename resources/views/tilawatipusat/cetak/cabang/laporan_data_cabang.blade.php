<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan_Data_Cabang</title>
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
                <th rowspan="3" colspan="5">Laporan Data Cabang <br> <small>{{date('d - m - Y')}} {{$data->first()}}</small></th>
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
            <tr style="border: black; text-transform: uppercase; font-weight: bold">
                <th rowspan="2">NO</th>
                <th rowspan="2">NAMA CABANG</th>
                <th rowspan="2">TOTAL DIKLAT</th>
                <th rowspan="2">PROGRAM DIKLAT</th>
                <th rowspan="2">GURU</th>
                <th rowspan="2">SANTRI</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            @foreach ($data as $key => $item)
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
            @endforeach
        </tbody>
    </table>
</body>
</html>