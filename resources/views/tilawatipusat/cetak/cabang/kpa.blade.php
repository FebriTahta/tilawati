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
                <th rowspan="3" colspan="10">DATA INSTRUKTUR CABANG <br> <small>Seluruh Indonesia Per - 2022</small></th>
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
                <th rowspan="2">NAMA CABANG</th>
                <th rowspan="2">KOTA / KAB</th>
                <th rowspan="2">KPA</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            @foreach ($data as $key=> $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>
                    @if ($item->kabupaten !== null)
                    {{$item->kabupaten->nama}}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @foreach ($item->kpa as $items)
                        <br>- {{$items->name.' ('.$items->telp.')'}}
                    @endforeach
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>