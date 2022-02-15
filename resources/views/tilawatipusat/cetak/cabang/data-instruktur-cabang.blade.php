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
                <th rowspan="3" colspan="8">DATA INSTRUKTUR CABANG <br> <small>Per - 2022</small></th>
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
                <th rowspan="2">NAMA TRAINER</th>
                <th rowspan="2">WA / TELP</th>
                <th rowspan="2">ALAMAT</th>
                <th rowspan="2">INSTRUKTUR</th>
                {{-- @foreach ($macam as $item)
                <th rowspan="2">{{$item->jenis}}</th>
                @endforeach --}}
                <th></th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            @foreach ($trainer as $key=> $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->telp}}</td>
                <td>{{$item->alamat}}</td>
                <td>
                @foreach ($item->macamtrainer as $x)
                    <br>{{$x->jenis}}
                @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>