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
                <th rowspan="3" colspan="8">TEMPLATE <br> <small>Per - {{date('Y')}}</small></th>
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
                <th rowspan="2">NAMA</th>
                <th rowspan="2">ALAMAT</th>
                <th rowspan="2">ASAL KOTA</th>
                <th rowspan="2">TEMPAT LAHIR</th>
                <th rowspan="2">TANGGAL LAHIR</th>
                <th rowspan="2">TELEPHONE</th>
                <th rowspan="2">ASAL LEMBAGA (boleh kosong)</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            <tr>
                <td>1</td>
                <td>Nama Lengkap + Gelar</td>
                <td>ALAMAT LENGKAP</td>
                <td>SURABAYA (tidak disingkat)</td>
                <td>MALANG (tidak disingkat)</td>
                <td>UBAH COLUMN "C" INI KE FORMAT TEXT AGAR FORMAT NOMOR TELP SESUAI</td>
                <td>BAITUR RAHMAN (boleh kosong)</td>
            </tr>
        </tbody>
    </table>
</body>
</html>