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
                <th rowspan="3" colspan="10">DATA KPA CABANG <br> <span>{{$cabang->name}}</span> <br> <small> Per - {{date('Y')}}</small></th>
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
                <th rowspan="2">NAMA KPA</th>
                <th rowspan="2">KETUA KPA</th>
                <th rowspan="2">WILAYAH</th>
                <th rowspan="2">WA / TELP</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            @foreach ($kpa as $key=> $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->ketua}}</td>
                <td>{{$item->wilayah}}</td>
                <td>{{$item->telp}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>