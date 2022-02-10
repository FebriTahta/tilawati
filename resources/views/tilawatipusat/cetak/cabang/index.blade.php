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
                <th rowspan="3" colspan="10">DATA CABANG <br> <small>Seluruh Indonesia Per - 2022</small></th>
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
                <th rowspan="2">NAMA KEPALA CABANG</th>
                <th rowspan="2">Kadivre</th>
                <th rowspan="2">Alamat Sekretariat</th>
                <th rowspan="2">Kota</th>
                <th rowspan="2">Provinsi</th>
                <th rowspan="2">Wilayah</th>
                <th rowspan="2">Telpon</th>
                <th rowspan="2">Email</th>
            </tr>
        </thead >
        <tbody style="text-transform: uppercase; font-size: 12px">
            @foreach ($data as $key=> $item)
            <tr>
                <td>{{$key}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>