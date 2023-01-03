<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        table .tb_profile {
            border: none !important;
        }

        .tanggalan {
            position: absolute;
            left: 65%;
            bottom: 64%;
            z-index: 9999;
            font-size: 12px;
            width: 70%;
        }

        .kepala {
            position: absolute;
            left: 65%;
            bottom: 58%;
            z-index: 9999;
            font-size: 10px;
            width: 70%;
        }

        .nama_kepala {
            position: absolute;
            left: 65%;
            bottom: 59%;
            margin-bottom: 5px;
            z-index: 9999;
            font-size: 10px;
            width: 70%;
        }
    </style>
    <style>
        .bg {
            /* background-image: url("bf_guru.jpg"); */
            height: 100%;
            z-index: 1;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            padding: 0;
        }


        table .table1 tr {
            line-height: 11px;
        }

        .table1 {
            border: 1px solid black;
            border-collapse: collapse;

        }

        .table1 th,
        td {
            border: 1px solid black;
            padding: 3px;
        }
    </style>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            text-transform: capitalize;
        }

        td.nilaibawahtot {
            border-right: 0;
            border-left: 0;
        }

        .syahadah {
            font-size: 14px;
        }

        .page-break {
            page-break-after: always;
            page-break-inside: avoid;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
        }


        th.penilaian {
            border: 0px;
        }

        th.pe {
            border: 0;
        }

        .jum {
            text-align: right;
        }

        th.pe3 {
            border-right: 0;
        }

        th.pe2 {
            border-left: 0;
        }


        td.nilai {
            border-right: 0;
            border-bottom: 0;
            border-top: 0;
        }

        td.nilai2 {
            border-right: 0;
            border-left: 0;
            border-bottom: 0;
            border-top: 0;
        }

        td.nilai2x {
            border-right: 0;
            /* border-left: 0; */
            border-bottom: 0;
            border-top: 0;
        }

        td.nilai3 {
            border-right: 0;
            border-left: 0;
            border-bottom: 0;
            border-top: 0;
        }

        td.nilai4 {
            border-left: 0;
            border-bottom: 0;
            border-top: 0;
        }

        th.nilai5 {
            border-right: 0;
        }

        th.nilai6 {
            border-right: 0;
        }

        th.nilai7 {
            border-left: 0;
        }

        td.pop {
            border-top: 0;
            border-bottom: 0;
        }

        td.pop2 {
            border-top: 0;
            border-bottom: 0;
        }

        .alignleft {
            float: left;
        }

        .alignright {
            float: right;
        }

        .paksatengah {
            margin-right: 19px;
        }

        .nilai_tot_atas1 {
            border-bottom: 0;
        }

        .nilai_tot_atas23 {
            border-bottom: 0;
            border-top: 0;
        }

        .nilai_tot_atas4 {
            border-top: 0;
        }
    </style>

</head>



    
    <body class="bg">
        <div style="position: relative; margin: auto;z-index: -1000;">
            <img src="opsi5.jpg" style="position: absolute; width: 100%; z-index: -1000;" />
        </div>
        {{-- PROFILE PESERTA --}}
        <table class="tb_profile" style="padding-top: 225px; margin-left: 83px; border: none; font-size: 8pt">
            <tr>
                <td style="width: 25%; border: none; padding: 0;">Nama </td>
                <td style="width: 5%; border: none; padding: 0;"> : </td>
                <td style="border: none; padding: 0; font-size: 8pt"> ...</td>
            </tr>
            <tr>
                <td style="width: 25%; border: none; padding: 0;">Alamat </td>
                <td style="width: 5%; border: none; padding: 0;"> : </td>
                <td style="width: 70%; border: none; padding: 0;font-size: 8pt">
                    ...
                </td>
            </tr>
            <tr>
                <td style="width: 25%; border: none; padding: 0;">Tempat Tanggal Lahir </td>
                <td style="width: 5%; border: none; padding: 0;"> : </td>
                <td style="width: 70%; text-transform: uppercase; border: none; padding: 0;font-size: 8pt">
                    ...
                </td>
            </tr>
            <tr>
                <td style="width: 25%; border: none; padding: 0;">Dinyatakan </td>
                <td style="width: 5%; border: none; padding: 0;"> : </td>
                <td style="width: 70%; border: none; padding: 0;font-size: 8pt"> ... </td>
            </tr>

        </table>



        <center>
            
                <div class="cover" style="align-content: center; align-items: center">
                    <div>
                        <p style="margin-top: 155px; font-size: 12px; font-weight: bold" class="syahadah">No. Syahadah :
                            .../{{date('Y')}}/...</p>
                    </div>
                    <table style="width: 615px;margin-left: 85px; font-size: 11px" class="table1">
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Bidang Penilaian</th>
                            <th colspan="4">Penilaian</th>
                            <th rowspan="2" style="text-align: center">Jumlah</th>
                        </tr>
                        <tr>
                            <th class="pe">Max</th>
                            <th colspan="2">Min</th>
                            <th class="pe">Nilai</th>

                        </tr>
                        <tr>
                            <th>1</th>
                            <td>&nbsp; &nbsp;<b>AL-QUR'AN</b></td>
                            <th class="pe3"></th>
                            <th class="pe3" style="font-size: 8px">Instruktur Lagu</th>
                            <th class="pe3" style="font-size: 8px">Instruktur Strategi</th>
                            <th class="pe3"></th>
                            <th>...</th>
                        </tr>
                        <tr>
                            <td class="pop"></td>
                            <td class="pop2">&nbsp; &nbsp;<span
                                    style="text-transform: capitalize; margin:0; padding:0;">...</span>
                            </td>
                            <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">
                                &nbsp; &nbsp;...</td>
                            <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">
                                &nbsp; &nbsp;...</td>
                            
                                <td class="nilai_tot_atas23"
                                    style="text-align: center; margin:0; padding:0;">&nbsp;
                                    &nbsp;...</td>
                           
                            <td class="nilai_tot_atas23" style="text-align: center">&nbsp;
                                &nbsp;<b>...</b></td>
                            <td style="border-top: 0;border-bottom: 0;"></td>
                        </tr>
                        <tr>
                            <th>...</th>
                            <td class="nilai6" style="text-transform: uppercase; font-size:9px !important">
                                ...
                                </th>
                            <td style="text-align: center">&nbsp; &nbsp;...</td>
                            <td style="text-align: center">&nbsp; &nbsp;...</td>
                            <td style="text-align: center">&nbsp; &nbsp;...</td>
                            <td class="nilaibawahtot"></td>
                            <th>...</th>
                        </tr>
                        <tr>
                            <th></th>
                            <td class="nilai6">&nbsp; &nbsp;<b>RATA - RATA NILAI</b></th>
                            <th colspan="4" class="nilai5"></th>
                            <th>...</th>
                        </tr>
                        <tr>
                            <th></th>
                            <td class="nilai6">&nbsp; &nbsp;<b>PRESTASI</b></th>
                            <th colspan="4" class="nilai5"></th>
                            <th>
                               ...
                            </th>
                        </tr>
                    </table>
                    <div class="keterangan" style="margin-left: -465px;font-size: 12px; margin-top: 5px">Keterangan :
                    </div>
                    <div style="font-size: 12px;margin-left: -370px; margin-top: 5px">Baik = 85 - 95, Cukup = 75 -84
                    </div>
                    <div class="qrcode" style="margin-left: -430pxpx; margin-top: 10px;">
                        <img src="" alt="" style="max-width: 100px;">
                    </div>
                    
                    <div style="margin-left: 400px; padding-top: 70px; line-height: 15px">Surabaya, <u>Ex : hari ini</u></div>
                        @if (\File::exists(public_path("img_ttd/".$cabang->ttd)))
                        <img style="margin-left: 400px; width:100px; margin-top: 10px" src="img_ttd/{{$cabang->ttd}}" alt="">
                        <div style="margin-left: 400px;line-height: 15px"><u>Ex : DR. KH. Umar Jaeni, M.Pd</u> <br>
                            <span style="font-size: 10px">Direktur Eksekutif</span>
                        </div>
                    @else
                        <div style="margin-left: 400px;line-height: 15px; margin-top: 60px"><u>Ex : DR. KH. Umar Jaeni, M.Pd</u> <br>
                            <span style="font-size: 10px">Direktur Eksekutif</span>
                        </div>
                    @endif
                </div>
        </center>
    </body>


</html>
