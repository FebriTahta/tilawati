<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @if ($pelatihan->keterangan == 'santri')
        {{-- PROFILE PESERTA --}}
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
                /* background-image: url("bf_santri.jpg"); */
                height: 100%;
                z-index: 1;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                margin: 0;
                padding: 0;
            }

            table .table1 tr {
                line-height: 12px;
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
    @elseif($pelatihan->keterangan == 'instruktur')
        {{-- PROFILE PESERTA --}}
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
                line-height: 12px;
            }

            .table1 {
                border: 1px solid black;
                border-collapse: collapse;

            }

            .table1 th,
            td {
                border: 1px solid black;
                padding: 2px;
            }
        </style>
    @else
        {{-- PROFILE PESERTA --}}
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
    @endif
    @if ($pelatihan->keterangan == 'instruktur')
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
    @else
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
    @endif

</head>

@foreach ($peserta as $p)

    @php
        date_default_timezone_set('Asia/Jakarta');
        $date = $p->tgllahir;
        $peserta_id = Crypt::encrypt($p->id);
        $qrcode = base64_encode(QrCode::size(300)->generate('https://syahadah.nurulfalah.org/syahadah-peserta/' . $peserta_id));
        
        $total = 0;
    @endphp

    <body class="bg">
        <div style="position: relative; margin: auto;z-index: -1000;">
            <img src="opsi5.jpg" style="position: absolute; width: 100%; z-index: -1000;" />
        </div>
        {{-- PROFILE PESERTA --}}
        <table class="tb_profile" style="padding-top: 225px; margin-left: 83px; border: none; font-size: 8pt">
            <tr>
                <td style="width: 25%; border: none; padding: 0;">Nama </td>
                <td style="width: 5%; border: none; padding: 0;"> : </td>
                <td style="border: none; padding: 0; font-size: 8pt"> {{ $p->name }}</td>
            </tr>
            <tr>
                <td style="width: 25%; border: none; padding: 0;">Alamat </td>
                <td style="width: 5%; border: none; padding: 0;"> : </td>
                <td style="width: 70%; border: none; padding: 0;font-size: 8pt">
                    @if ($p->kabupaten !== null)
                        @if (substr($p->kabupaten->nama, 0, 8) == 'KOTA ADM')
                            {{ $p->alamat . ' ' . substr($p->kabupaten->nama, 10) }}
                        @else
                            {{ $p->alamat . ' ' . substr($p->kabupaten->nama, 5) }}
                        @endif
                    @else
                        {{ $p->alamat }}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="width: 25%; border: none; padding: 0;">Tempat Tanggal Lahir </td>
                <td style="width: 5%; border: none; padding: 0;"> : </td>
                <td style="width: 70%; text-transform: uppercase; border: none; padding: 0;font-size: 8pt">
                    @if ($p->tmptlahir2 == null)
                        @if (substr($p->tmptlahir, 0, 4) == 'KOTA')
                            {{ substr($p->tmptlahir, 5) }}
                        @elseif(substr($p->tmptlahir, 4, 4) == 'ADM')
                            {{ substr($p->tmptlahir, 10) }}
                        @elseif(substr($p->tmptlahir, 0, 4) == 'KAB.')
                            {{ substr($p->tmptlahir, 5) }}
                        @else
                            {{ $p->tmptlahir }}
                        @endif
                    @endif

                    @if ($p->tmptlahir2 !== null)
                        @if (substr($p->tmptlahir2, 0, 4) == 'KOTA')
                            {{ substr($p->tmptlahir2, 5) }}
                        @elseif(substr($p->tmptlahir2, 4, 4) == 'ADM')
                            {{ substr($p->tmptlahir2, 10) }}
                        @elseif(substr($p->tmptlahir2, 0, 4) == 'KAB.')
                            {{ substr($p->tmptlahir2, 5) }}
                        @else
                            {{ $p->tmptlahir2 }}
                        @endif
                    @endif

                    , {{ Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }}
                </td>
            </tr>
            <tr>
                <td style="width: 25%; border: none; padding: 0;">Dinyatakan </td>
                <td style="width: 5%; border: none; padding: 0;"> : </td>
                <td style="width: 70%; border: none; padding: 0;font-size: 8pt"> {{ $p->kriteria }}</td>
            </tr>

        </table>



        <center>
            @if ($p->kriteria == 'SEBAGAI INSTRUKTUR LAGU DAN STRATEGI MENGAJAR METODE TILAWATI')
                <div class="cover" style="align-content: center; align-items: center">
                    <div>
                        <p style="margin-top: 155px; font-size: 12px; font-weight: bold" class="syahadah">No. Syahadah :
                            {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
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
                            <th>{{ $jumlah = $p->nilai->where('kategori', "al-qur'an")->sum('nominal') }}</th>
                        </tr>
                        <?php $i = 2;
                        $x = 1;
                        $z = 5; ?>
                        @foreach ($p->nilai as $key => $item)
                            @if ($item !== null)
                                @if ($item->kategori !== 'skill')
                                    <tr>
                                        <td class="pop"></td>
                                        <td class="pop2">&nbsp; &nbsp;<span
                                                style="text-transform: capitalize; margin:0; padding:0;">{{ $item->penilaian->name }}</span>
                                        </td>
                                        <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">
                                            &nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                        <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">
                                            &nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                        @if ($key < 1)
                                            <td class="nilai_tot_atas23"
                                                style="text-align: center; margin:0; padding:0;">&nbsp;
                                                &nbsp;{{ $item->penilaian->min - 1 }}</td>
                                        @else
                                            <td class="nilai_tot_atas23"
                                                style="text-align: center; margin:0; padding:0;">&nbsp;
                                                &nbsp;{{ $item->penilaian->min - $z }}</td>
                                        @endif
                                        <td class="nilai_tot_atas23" style="text-align: center">&nbsp;
                                            &nbsp;<b>{{ $item->nominal }}</b></td>
                                        <td style="border-top: 0;border-bottom: 0;"></td>
                                    </tr>
                                    <?php $z--; ?>
                                @endif
                            @endif
                        @endforeach
                        @foreach ($p->nilai as $key => $item)
                            @if ($item !== null)
                                @if ($item->kategori == 'skill')
                                    <tr>
                                        <th>{{ $i++ }}</th>
                                        <td class="nilai6" style="text-transform: uppercase; font-size:9px !important">
                                            @if ($item->penilaian->name == 'praktek menatar strategi mengajar')
                                                &nbsp; &nbsp; <b>PRAKTEK MENATAR STRATEGI &nbsp; &nbsp; &nbsp; &nbsp;
                                                    &nbsp; &nbsp;
                                                    &nbsp; &nbsp; &nbsp; MENGAJAR</b>
                                            @else
                                                &nbsp; &nbsp; <b>{{ $item->penilaian->name }}</b>
                                            @endif
                                            </th>
                                        <td style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                        <td style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                        <td style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                        <td class="nilaibawahtot"></td>
                                        <th>{{ $item->nominal }}</th>
                                        <?php $total += $item->nominal; ?>
                                    </tr>
                                @endif
                            @endif
                        @endforeach

                        <?php
                        $rata2 = ($jumlah + $total) / 4;
                        
                        ?>
                        <tr>
                            <th></th>
                            <td class="nilai6">&nbsp; &nbsp;<b>RATA - RATA NILAI</b></th>
                            <th colspan="4" class="nilai5"></th>
                            <th>{{ $rata2 = round($rata2) }}</th>
                        </tr>
                        <tr>
                            <th></th>
                            <td class="nilai6">&nbsp; &nbsp;<b>PRESTASI</b></th>
                            <th colspan="4" class="nilai5"></th>
                            <th>
                                @if ($rata2 >= 85)
                                    Baik
                                @else
                                    Cukup
                                @endif
                            </th>
                        </tr>
                    </table>
                    <div class="keterangan" style="margin-left: -465px;font-size: 12px; margin-top: 5px">Keterangan :
                    </div>
                    <div style="font-size: 12px;margin-left: -370px; margin-top: 5px">Baik = 85 - 95, Cukup = 75 -84
                    </div>
                    <div class="qrcode" style="margin-left: -430pxpx; margin-top: 10px;">
                        <img src="{!! 'data:image/png;base64,' . $qrcode !!}" alt="" style="max-width: 100px;">
                    </div>
                    <div style="margin-left: 400px; margin-top: -550px">Surabaya,
                        {{ Carbon\Carbon::parse($pelatihan->updated_at)->isoFormat('D MMMM Y') }}</div>
                    <div style="margin-left: 400px; margin-top: 55px; line-height: 15px"><u>{{ $direktur }}</u>
                        <br> <span style="font-size: 10px">{{ $kepala }}</span></div>
                </div>
            @elseif ($p->kriteria == 'SEBAGAI INSTRUKTUR STRATEGI MENGAJAR METODE TILAWATI')
                <div class="cover" style="align-content: center; align-items: center">
                    <div>
                        <p style="margin-top: 155px; font-size: 12px; font-weight: bold" class="syahadah">No. Syahadah :
                            {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
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
                            <th>{{ $jumlah = $p->nilai->where('kategori', "al-qur'an")->sum('nominal') }}</th>
                        </tr>
                        <?php $i = 2;
                        $x = 1;
                        $z = 5; ?>
                        @foreach ($p->nilai as $key => $item)
                            @if ($item !== null)
                                @if ($item->kategori !== 'skill')
                                    <tr>
                                        <td class="pop"></td>
                                        <td class="pop2">&nbsp; &nbsp;<span
                                                style="text-transform: capitalize; margin:0; padding:0;">{{ $item->penilaian->name }}</span>
                                        </td>
                                        <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">
                                            &nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                        <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">
                                            &nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                        @if ($key < 1)
                                            <td class="nilai_tot_atas23"
                                                style="text-align: center; margin:0; padding:0;">&nbsp;
                                                &nbsp;{{ $item->penilaian->min - 1 }}</td>
                                        @else
                                            <td class="nilai_tot_atas23"
                                                style="text-align: center; margin:0; padding:0;">&nbsp;
                                                &nbsp;{{ $item->penilaian->min - $z }}</td>
                                        @endif
                                        <td class="nilai_tot_atas23" style="text-align: center">&nbsp;
                                            &nbsp;<b>{{ $item->nominal }}</b></td>
                                        <td style="border-top: 0;border-bottom: 0;"></td>
                                    </tr>
                                    <?php $z--; ?>
                                @endif
                            @endif
                        @endforeach
                        @foreach ($p->nilai as $key => $item)
                            @if ($item !== null)
                                @if ($item->kategori == 'skill')
                                    <tr>
                                        <th>{{ $i++ }}</th>
                                        <td class="nilai6"
                                            style="text-transform: uppercase; font-size:9px !important">
                                            @if ($item->penilaian->name == 'praktek menatar strategi mengajar')
                                                &nbsp; &nbsp; <b>PRAKTEK MENATAR STRATEGI &nbsp; &nbsp; &nbsp; &nbsp;
                                                    &nbsp; &nbsp;
                                                    &nbsp; &nbsp; &nbsp; MENGAJAR</b>
                                            @else
                                                &nbsp; &nbsp; <b>{{ $item->penilaian->name }}</b>
                                            @endif
                                            </th>
                                        <td style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                        <td style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                        <td style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                        <td class="nilaibawahtot"></td>
                                        <th>{{ $item->nominal }}</th>
                                        <?php $total += $item->nominal; ?>
                                    </tr>
                                @endif
                            @endif
                        @endforeach

                        <?php
                        $nilaia = $p->nilai->where('penilaian_id', 37)->sum('nominal');
                        $nilaib = $p->nilai->where('penilaian_id', 39)->sum('nominal');
                        $total = $nilaia + $nilaib;
                        ?>
                        <tr>
                            <th></th>
                            <td class="nilai6">&nbsp; &nbsp;<b>RATA - RATA NILAI</b></th>
                            <th colspan="4" class="nilai5"></th>
                            <th>{{ $rata2 = round(($jumlah + $total) / 3) }}</th>
                        </tr>
                        <tr>
                            <th></th>
                            <td class="nilai6">&nbsp; &nbsp;<b>PRESTASI</b></th>
                            <th colspan="4" class="nilai5"></th>
                            <th>
                                @if ($rata2 >= 85)
                                    Baik
                                @else
                                    Cukup
                                @endif
                            </th>
                        </tr>
                    </table>
                    <div class="keterangan" style="margin-left: -465px;font-size: 12px; margin-top: 5px">Keterangan :
                    </div>
                    <div style="font-size: 12px;margin-left: -370px; margin-top: 5px">Baik = 85 - 95, Cukup = 75 -84
                    </div>
                    <div class="qrcode" style="margin-left: -430pxpx; margin-top: 10px;">
                        <img src="{!! 'data:image/png;base64,' . $qrcode !!}" alt="" style="max-width: 100px;">
                    </div>
                    <div style="margin-left: 400px; margin-top: -550px">Surabaya,
                        {{ Carbon\Carbon::parse($pelatihan->updated_at)->isoFormat('D MMMM Y') }}</div>
                    <div style="margin-left: 400px; margin-top: 55px; line-height: 15px"><u>{{ $direktur }}</u>
                        <br> <span style="font-size: 10px">{{ $kepala }}</span></div>
                </div>
            @elseif($p->kriteria == 'SEBAGAI INSTRUKTUR LAGU METODE TILAWATI')
                <div class="cover" style="align-content: center; align-items: center">
                    <div>
                        <p style="margin-top: 155px; font-size: 12px; font-weight: bold" class="syahadah">No. Syahadah
                            : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
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
                            <th>{{ $jumlah = $p->nilai->where('kategori', "al-qur'an")->sum('nominal') }}</th>
                        </tr>
                        <?php $i = 2;
                        $x = 1;
                        $z = 5; ?>
                        @foreach ($p->nilai as $key => $item)
                            @if ($item !== null)
                                @if ($item->kategori !== 'skill')
                                    <tr>
                                        <td class="pop"></td>
                                        <td class="pop2">&nbsp; &nbsp;<span
                                                style="text-transform: capitalize; margin:0; padding:0;">{{ $item->penilaian->name }}</span>
                                        </td>
                                        <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">
                                            &nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                        <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">
                                            &nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                        @if ($key < 1)
                                            <td class="nilai_tot_atas23"
                                                style="text-align: center; margin:0; padding:0;">&nbsp;
                                                &nbsp;{{ $item->penilaian->min - 1 }}</td>
                                        @else
                                            <td class="nilai_tot_atas23"
                                                style="text-align: center; margin:0; padding:0;">&nbsp;
                                                &nbsp;{{ $item->penilaian->min - $z }}</td>
                                        @endif
                                        <td class="nilai_tot_atas23" style="text-align: center">&nbsp;
                                            &nbsp;<b>{{ $item->nominal }}</b></td>
                                        <td style="border-top: 0;border-bottom: 0;"></td>
                                    </tr>
                                    <?php $z--; ?>
                                @endif
                            @endif
                        @endforeach
                        @foreach ($p->nilai as $key => $item)
                            @if ($item !== null)
                                @if ($item->kategori == 'skill')
                                    <tr>
                                        <th>{{ $i++ }}</th>
                                        <td class="nilai6"
                                            style="text-transform: uppercase; font-size:9px !important">
                                            @if ($item->penilaian->name == 'praktek menatar strategi mengajar')
                                                &nbsp; &nbsp; <b>PRAKTEK MENATAR STRATEGI &nbsp; &nbsp; &nbsp; &nbsp;
                                                    &nbsp; &nbsp;
                                                    &nbsp; &nbsp; &nbsp; MENGAJAR</b>
                                            @else
                                                &nbsp; &nbsp; <b>{{ $item->penilaian->name }}</b>
                                            @endif
                                            </th>
                                        <td style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                        <td style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                        <td style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                        <td class="nilaibawahtot"></td>
                                        <th>{{ $item->nominal }}</th>
                                        <?php $total += $item->nominal; ?>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        <?php
                        $nilaia = $p->nilai->where('penilaian_id', 38)->sum('nominal');
                        $nilaib = $p->nilai->where('penilaian_id', 39)->sum('nominal');
                        $total = $nilaia + $nilaib;
                        ?>
                        <tr>
                            <th></th>
                            <td class="nilai6">&nbsp; &nbsp;<b>RATA - RATA NILAI</b></th>
                            <th colspan="4" class="nilai5"></th>
                            <th>{{ $rata2 = round(($jumlah + $total) / 3) }}</th>
                        </tr>

                        <tr>
                            <th></th>
                            <td class="nilai6">&nbsp; &nbsp;<b>PRESTASI</b></th>
                            <th colspan="4" class="nilai5"></th>
                            <th>
                                @if ($rata2 >= 85)
                                    Baik
                                @else
                                    Cukup
                                @endif
                            </th>
                        </tr>
                    </table>
                    <div class="keterangan" style="margin-left: -465px;font-size: 12px; margin-top: 5px">Keterangan :
                    </div>
                    <div style="font-size: 12px;margin-left: -370px; margin-top: 10px">Baik = 85 - 95, Cukup = 75 -84
                    </div>
                    <div class="qrcode" style="margin-left: -430pxpx; margin-top: 5px;">
                        <img src="{!! 'data:image/png;base64,' . $qrcode !!}" alt="" style="max-width: 100px;">
                    </div>
                    <div style="margin-left: 400px; margin-top: -550px">Surabaya,
                        {{ Carbon\Carbon::parse($pelatihan->updated_at)->isoFormat('D MMMM Y') }}</div>
                    <div style="margin-left: 400px; margin-top: 55px; line-height: 15px"><u>{{ $direktur }}</u>
                        <br> <span style="font-size: 10px">{{ $kepala }}</span></div>
                </div>
            @elseif($p->kriteria == 'SEBAGAI SANTRI KHATAM AL QURAN 30 JUZ')
                <div class="cover" style="align-content: center; align-items: center">
                    <div>
                        <p style="margin-top: 155px; font-size: 12px; font-weight: bold" class="syahadah">No. Syahadah
                            : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
                    </div>
                    <table style="width: 615px;margin-left: 85px; font-size: 11px" class="table1">
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Bidang Penilaian</th>
                            <th colspan="3" class="penilaian">Penilaian</th>
                            <th rowspan="2" style="text-align: center">Jumlah</th>
                        </tr>
                        <tr>
                            <th class="pe">Max</th>
                            <th class="pe">Min</th>
                            <th class="pe">Nilai</th>

                        </tr>
                        <tr>
                            <th>1</th>
                            <td>&nbsp; &nbsp;<b> AL-QUR'AN</b></td>
                            <th colspan="3" class="pe3"></th>
                            <th>{{ $jumlah = $p->nilai->where('kategori', "al-qur'an")->sum('nominal') }}</th>
                        </tr>
                        <?php $i = 2;
                        $x = 1; ?>
                        @foreach ($p->nilai as $key => $item)
                            @if ($item !== null)
                                @if ($item->kategori !== 'skill')
                                    <tr>
                                        <td class="pop"></td>
                                        <td class="pop2">&nbsp; &nbsp;&nbsp;<span
                                                style="text-transform: capitalize">{{ $item->penilaian->name }}</span>
                                        </td>
                                        <td class="nilai" style="text-align: center">&nbsp;
                                            &nbsp;{{ $item->penilaian->max }}</td>
                                        <td class="nilai2" style="text-align: center">&nbsp;
                                            &nbsp;{{ $item->penilaian->min }}</td>
                                        <td class="nilai3" style="text-align: center">&nbsp;
                                            &nbsp;{{ $item->nominal }}</td>
                                        <td style="border-top: 0;border-bottom: 0;"></td>
                                    </tr>
                                @else
                                    <tr>
                                        <th>{{ $i++ }}</th>
                                        <td class="nilai6" style="text-transform: uppercase">&nbsp; &nbsp;<b>
                                                {{ $item->penilaian->name }}</b></th>
                                        <th colspan="3" class="nilai5"></th>
                                        <th>{{ round($item->nominal) }}</th>
                                    </tr>
                                    <?$x++?>
                                @endif
                            @else
                                {{--  --}}
                            @endif
                        @endforeach
                        @if ($p->pelatihan->keterangan == 'guru')
                            <tr>
                                <th></th>
                                <td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
                                <th colspan="3" class="nilai5"></th>
                                <th>
                                    @if ($p->pelatihan->program->name == 'munaqosyah santri')
                                        {{ $rata2 = $jumlah }}
                                    @elseif($p->program->name == 'Diklat Munaqisy Cabang')
                                        @php
                                            $x = $p->nilai->where('kategori', "al-qur'an")->sum('nominal');
                                            $y = $p->nilai->where('kategori', 'skill')->sum('nominal');
                                            $z = $p->nilai->where('kategori', 'skill')->count();
                                            $satu = $x;
                                            $dua = round($y / $z);
                                            $rata2 = round(($satu + $dua) / 2);
                                        @endphp
                                        {{ round($rata2) }}
                                    @else
                                        {{ $rata2 = round(($jumlah + $item->nominal) / 2) }}
                                    @endif
                                </th>
                            </tr>
                        @else
                            <?php
                            $rata2 = $jumlah;
                            ?>
                        @endif
                        <tr>
                            <th></th>
                            <td class="nilai6">&nbsp; &nbsp;<b> PRESTASI</b></th>
                            <th colspan="3" class="nilai5"></th>
                            <th>
                                @if ($rata2 >= 85)
                                    Baik
                                @else
                                    Cukup
                                @endif
                            </th>
                        </tr>
                    </table>
                </div>
                <div class="keterangan" style="margin-left: -465px;font-size: 12px; margin-top: 5px">Keterangan :
                </div>
                <div style="font-size: 12px;margin-left: -370px; margin-top: 5px">Baik = 85 - 95, Cukup = 75 -84 </div>
                <div class="qrcode" style="margin-left: -430pxpx; margin-top: 80px;">
                    <img src="{!! 'data:image/png;base64,' . $qrcode !!}" alt="" style="max-width: 100px;">
                </div>
                <div style="margin-left: 400px; margin-top: -555px">Surabaya,
                    {{ Carbon\Carbon::parse($pelatihan->updated_at)->isoFormat('D MMMM Y') }}</div>
                <div style="margin-left: 400px; margin-top: 60px; line-height: 15px"><u>{{ $direktur }}</u> <br>
                    <span style="font-size: 10px">{{ $kepala }}</span>
                </div>
            @elseif($p->program->name == 'Diklat Munaqisy Cabang')
                <div class="cover" style="align-content: center; align-items: center">
                    <div>
                        <p style="margin-top: 155px; font-size: 12px; font-weight: bold" class="syahadah">No. Syahadah
                            : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
                    </div>
                    <table style="width: 615px;margin-left: 85px; font-size: 11px" class="table1">
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2" style="text-align: center;">Bidang Penilaian</th>
                            <th colspan="3" style="border-bottom:none"></th>
                            <th rowspan="2" style="text-align: center">Jumlah</th>
                        </tr>
                        <tr>
                            <th class="pe">MIN</th>
                            <th class="pe">MAX</th>
                            <th class="pe">NILAI</th>

                        </tr>
                        <tr>
                            <th>1</th>
                            <td style="border-right: none">&nbsp; &nbsp;<b> AL-QUR'AN</b></td>
                            <th colspan="3" class="pe3" style="border-left: none"></th>
                            <th class=nilai2>{{ $jumlah = $p->nilai->where('kategori', "al-qur'an")->sum('nominal') }}
                            </th>
                        </tr>
                        @foreach ($p->nilai as $key => $item)
                            @if ($item !== null)
                                @if ($item->kategori !== 'skill')
                                    <tr>
                                        <td class="pop"></td>
                                        <td class="pop2" style="border-right: none">&nbsp; &nbsp;&nbsp;<span
                                                style="text-transform: capitalize; ">{{ $item->penilaian->name }}</span>
                                        </td>
                                        <td class="nilai" style="text-align: center; ">{{ $item->penilaian->min }}
                                        </td>
                                        <td class="nilai2" style="text-align: center">{{ $item->penilaian->max }}
                                        </td>
                                        <td class="nilai3" style="text-align: center">{{ $item->nominal }}</td>
                                        <th style="border-top: 0;border-bottom: 0;"></th>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        <tr>
                            <th>2</th>
                            <td style="border-right: none">&nbsp; &nbsp;<b> Praktek Munaqisy </b></td>
                            <th colspan="3" style="border-left: none"></th>
                            <th>{{ $jumlah = round($p->nilai->where('kategori', 'skill')->sum('nominal') / 3) }}</th>
                        </tr>
                        @foreach ($p->nilai as $key => $item)
                            @if ($item !== null)
                                @if ($item->kategori == 'skill')
                                    <tr>
                                        <td class="pop"></td>
                                        <td class="pop2" style="border-right: none">&nbsp; &nbsp;&nbsp;<span
                                                style="text-transform: capitalize; ">{{ $item->penilaian->name }}</span>
                                        </td>
                                        <td class="nilai" style="text-align: center; ">{{ $item->penilaian->min }}
                                        </td>
                                        <td class="nilai2" style="text-align: center">{{ $item->penilaian->max }}
                                        </td>
                                        <td class="nilai3" style="text-align: center">{{ $item->nominal }}</td>
                                        <th style="border-top: 0;border-bottom: 0;"></th>
                                    </tr>
                                @endif
                            @endif
                        @endforeach

                        @if ($p->pelatihan->keterangan == 'guru')
                            <tr>
                                <th></th>
                                <td class="nilai6" style="border-right: none">&nbsp; &nbsp;<b> RATA - RATA NILAI</b>
                                    </th>
                                <th style="border-left: none" colspan="3" class="nilai5"></th>
                                <th>
                                    @if ($p->pelatihan->program->name == 'munaqosyah santri')
                                        {{ $rata2 = $jumlah }}
                                    @elseif($p->program->name == 'Diklat Munaqisy Cabang')
                                        @php
                                            $x = $p->nilai->where('kategori', "al-qur'an")->sum('nominal');
                                            $y = $p->nilai->where('kategori', 'skill')->sum('nominal');
                                            $z = $p->nilai->where('kategori', 'skill')->count();
                                            $satu = $x;
                                            $dua = round($y / $z);
                                            $rata2 = round(($satu + $dua) / 2);
                                        @endphp
                                        {{ round($rata2) }}
                                    @else
                                        {{ $rata2 = round(($jumlah + $item->nominal) / 2) }}
                                    @endif
                                </th>
                            </tr>
                        @else
                            <?php
                            $rata2 = $jumlah;
                            ?>
                        @endif
                        <tr>
                            <th></th>
                            <td class="nilai6" style="border-right: none">&nbsp; &nbsp;<b> PRESTASI</b></th>
                            <th colspan="3" style="border-left: none" class="nilai5"></th>
                            <th>
                                @if ($rata2 >= 85)
                                    Istimewa
                                @elseif($rata2 > 74 && $rata2 < 85)
                                    Baik
                                @else
                                    Cukup
                                @endif
                            </th>
                        </tr>
                    </table>
                </div>
                <div class="keterangan" style="margin-left: -465px;font-size: 12px; margin-top: 5px">Keterangan :
                </div>
                <div style="font-size: 12px;margin-left: -370px; margin-top: 5px">Baik = 85 - 95, Cukup = 75 -84 </div>
                <div class="qrcode" style="margin-left: -430pxpx; margin-top: 80px;">
                    <img src="{!! 'data:image/png;base64,' . $qrcode !!}" alt="" style="max-width: 100px;">
                </div>
                <div style="margin-left: 400px; margin-top: -555px">Surabaya,
                    {{ Carbon\Carbon::parse($pelatihan->updated_at)->isoFormat('D MMMM Y') }}</div>
                <div style="margin-left: 400px; margin-top: 60px; line-height: 15px"><u>{{ $direktur }}</u> <br>
                    <span style="font-size: 10px">{{ $kepala }}</span>
                </div>
            @else
                <div class="cover" style="align-content: center; align-items: center">
                    <div>
                        <p style="margin-top: 155px; font-size: 12px; font-weight: bold" class="syahadah">No. Syahadah
                            : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
                    </div>
                    <table style="width: 615px;margin-left: 85px; font-size: 11px" class="table1">
                        <tr>
                            <th rowspan="2">No.</th>
                            <th rowspan="2">Bidang Penilaian</th>
                            <th colspan="3" class="penilaian">Penilaian</th>
                            <th rowspan="2" style="text-align: center">Jumlah</th>
                        </tr>
                        <tr>
                            <th class="pe">Max</th>
                            <th class="pe">Min</th>
                            <th class="pe">Nilai</th>

                        </tr>
                        <tr>
                            <th>1</th>
                            <td>&nbsp; &nbsp;<b> AL-QUR'AN</b></td>
                            <th colspan="3" class="pe3"></th>
                            <th>{{ $jumlah = $p->nilai->where('kategori', "al-qur'an")->sum('nominal') }}</th>
                        </tr>
                        <?php $i = 2;
                        $x = 1; ?>
                        @foreach ($p->nilai as $key => $item)
                            @if ($item !== null)
                                @if ($item->kategori !== 'skill')
                                    <tr>
                                        <td class="pop"></td>
                                        <td class="pop2">&nbsp; &nbsp;&nbsp;<span
                                                style="text-transform: capitalize">{{ $item->penilaian->name }}</span>
                                        </td>
                                        <td class="nilai" style="text-align: center">&nbsp;
                                            &nbsp;{{ $item->penilaian->max }}</td>
                                        <td class="nilai2" style="text-align: center">&nbsp;
                                            &nbsp;{{ $item->penilaian->min }}</td>
                                        <td class="nilai3" style="text-align: center">&nbsp;
                                            &nbsp;{{ $item->nominal }}</td>
                                        <td style="border-top: 0;border-bottom: 0;"></td>
                                    </tr>
                                @else
                                    <tr>
                                        <th>{{ $i++ }}</th>
                                        <td class="nilai6" style="text-transform: uppercase">&nbsp; &nbsp;<b>
                                                {{ $item->penilaian->name }}</b></th>
                                        <th colspan="3" class="nilai5"></th>
                                        <th>{{ round($item->nominal) }}</th>
                                    </tr>
                                    <?$x++?>
                                @endif
                            @else
                                {{--  --}}
                            @endif
                        @endforeach
                        @if ($p->pelatihan->keterangan == 'guru')
                            <tr>
                                <th></th>
                                <td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
                                <th colspan="3" class="nilai5"></th>
                                <th>
                                    @if ($p->pelatihan->program->name == 'munaqosyah santri')
                                        {{ $rata2 = $jumlah }}
                                    @elseif($p->program->name == 'Diklat Munaqisy Cabang')
                                        @php
                                            $x = $p->nilai->where('kategori', "al-qur'an")->sum('nominal');
                                            $y = $p->nilai->where('kategori', 'skill')->sum('nominal');
                                            $z = $p->nilai->where('kategori', 'skill')->count();
                                            $satu = $x;
                                            $dua = round($y / $z);
                                            $rata2 = round(($satu + $dua) / 2);
                                        @endphp
                                        {{ round($rata2) }}
                                    @else
                                        {{ $rata2 = round(($jumlah + $item->nominal) / 2) }}
                                    @endif
                                </th>
                            </tr>
                        @else
                            <?php
                            $rata2 = $jumlah;
                            ?>
                        @endif
                        <tr>
                            <th></th>
                            <td class="nilai6">&nbsp; &nbsp;<b> PRESTASI</b></th>
                            <th colspan="3" class="nilai5"></th>
                            <th>
                                @if ($rata2 >= 85)
                                    Baik
                                @else
                                    Cukup
                                @endif
                            </th>
                        </tr>
                    </table>
                </div>
                <div class="keterangan" style="margin-left: -465px;font-size: 12px; margin-top: 5px">Keterangan :
                </div>
                <div style="font-size: 12px;margin-left: -370px; margin-top: 5px">Baik = 85 - 95, Cukup = 75 -84 </div>
                <div class="qrcode" style="margin-left: -430pxpx; margin-top: 37px;">
                    <img src="{!! 'data:image/png;base64,' . $qrcode !!}" alt="" style="max-width: 100px;">
                </div>
                <div style="margin-left: 400px; margin-top: -555px">Surabaya,
                    {{ Carbon\Carbon::parse($pelatihan->updated_at)->isoFormat('D MMMM Y') }}</div>
                @if (\File::exists(public_path("img_ttd/".$p->cabang->ttd)))
                    <img style="margin-left: 400px; width:100px; margin-top: 10px" src="img_ttd/{{$p->cabang->ttd}}" alt="">
                    <div style="margin-left: 400px;line-height: 15px"><u>{{ $direktur }}</u> <br>
                        <span style="font-size: 10px">{{ $kepala }}</span>
                    </div>
                @else
                    <div style="margin-left: 400px;line-height: 15px; margin-top: 60px"><u>{{ $direktur }}</u> <br>
                        <span style="font-size: 10px">{{ $kepala }}</span>
                    </div>
                @endif
                
            @endif
        </center>
    </body>
@endforeach

</html>
