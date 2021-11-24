<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .tepi { border: 1px dashed rgb(99, 99, 99); 
        }
        .tepi2 { border: 2px dashed black; 
        }
        .right {
            border: 3px solid #747474;
            padding: 10px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
@foreach ($peserta as $pes)
<div class="wrapper" style="page-break-inside: avoid">
    <table style="width: 100%" class="right">
        <tr>
            <td style="width: 10%">Penerima</td>
            <td style="width: 2%"> : </td>
            <td><b>{{$pes->name}}</b></td>
        </tr>
        <tr>
            <td style="width: 10%">Alamat</td>
            <td style="width: 2%"> : </td>
            <td style="text-transform: uppercase">
                <b>
                    @if ($pes->alamatx == null)
                    <span style="color: red">{{$pes->alamat}} - {{$pes->kelurahan->nama}} - {{$pes->kecamatan->nama}} </span>
                    @else
                    {{$pes->alamatx}} 
                    @endif
                </b>
            </td>
        </tr>
        <tr>
            <td style="width: 10%">Kota</td>
            <td style="width: 2%"> : </td>
            <td><b>{{$pes->kabupaten->nama}}</b></td>
        </tr> 
        <tr>
            <td style="width: 10%">Phone</td>
            <td style="width: 2%"> : </td>
            <td><b>{{$pes->telp}}</b></td>
        </tr>
        <tr style="font-size: 14px">
            <td colspan="3"><hr style="border: dashed black"></td>            
        </tr>
        <tr style="font-size: 12px; text-align: right">
            <td colspan="3">Dari.</td>
        </tr>
        <tr style="font-size: 12px; text-align: right">
            <td style="width: 100%" colspan="3">Pesantren Al Qur'an Nurul Falah Surabaya (Tilawati Pusat)</td>
        </tr>
        <tr style="font-size: 12px; text-align: right">
            <td colspan="3">Jl. Ketintang Timur PTT VB, Pesantren Nurul Falah</td>
        </tr>
        <tr style="font-size: 12px; text-align: right">
            <td colspan="3">(031) 8281278</td>
        </tr>
    </table>
</div><br>
@endforeach
</body>
</html>