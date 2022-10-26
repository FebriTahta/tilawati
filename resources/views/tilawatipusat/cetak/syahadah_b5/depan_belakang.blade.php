<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @if ($pelatihan->keterangan == 'santri')
        <style>
            .bg {
                background-image: url("bf_santri.jpg");
                height: 100%; 
                z-index: 1;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                margin: 0;
                padding: 0;
            }
        </style>
    @elseif($pelatihan->keterangan == 'instruktur')
        <style>
            .bg {
                background-image: url("bf_guru.jpg");
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
            
            table.table1{   
                border: 1px solid black;
                border-collapse: collapse;
        
            }

            table th,td{
                border: 1px solid black;
                padding: 3px;
            }
        </style>
    @else
        <style>
            .bg {
                background-image: url("bf_guru.jpg");
                height: 100%; 
                z-index: 1;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                margin: 0;
                padding: 0;
            }

            
            table .table1 tr {
                line-height: 14px;
            }
            
            table.table1{   
                border: 1px solid black;
                border-collapse: collapse;
        
            }

            table th,td{
                border: 1px solid black;
                padding: 5px;
            }
        </style>
    @endif
    @if ($pelatihan->keterangan == 'instruktur')
    <style>
        
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            text-transform: capitalize;
        }
        td.nilaibawahtot{
            border-right: 0;
            border-left: 0;
        }

        .syahadah{
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
        

        th.penilaian{
            border:0px;
        }

        th.pe{
            border: 0;
        }
        .jum{
            text-align: right;
        }
        th.pe3{
            border-right: 0;
        }

        th.pe2{
            border-left: 0;    
        }


        td.nilai{
            border-right: 0;
            border-bottom: 0;
            border-top:0;
        }

        td.nilai2{
            border-right: 0;
            border-left: 0;
            border-bottom: 0;
            border-top: 0;
        }

        td.nilai2x{
            border-right: 0;
            /* border-left: 0; */
            border-bottom: 0;
            border-top: 0;
        }

        td.nilai3{
            border-right: 0;
            border-left: 0;
            border-bottom: 0;
            border-top: 0;
        }

        td.nilai4{
            border-left: 0;
            border-bottom: 0;
            border-top: 0;
        }

        th.nilai5{
            border-right: 0;
        }

        th.nilai6{
            border-right:0 ;
        }

        th.nilai7{
            border-left: 0;
        }
        td.pop{
            border-top: 0;
            border-bottom: 0;
        }

        td.pop2{
            border-top: 0;
            border-bottom: 0;
        }
        .alignleft {
            float: left;
        }
        .alignright {
            float: right;
        }.paksatengah{
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
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            text-transform: capitalize;
        }
        td.nilaibawahtot{
            border-right: 0;
            border-left: 0;
        }

        .syahadah{
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

        th.penilaian{
            border:0px;
        }

        th.pe{
            border: 0;
        }
        .jum{
            text-align: right;
        }
        th.pe3{
            border-right: 0;
        }

        th.pe2{
            border-left: 0;    
        }


        td.nilai{
            border-right: 0;
            border-bottom: 0;
            border-top:0;
        }

        td.nilai2{
            border-right: 0;
            border-left: 0;
            border-bottom: 0;
            border-top: 0;
        }

        td.nilai2x{
            border-right: 0;
            /* border-left: 0; */
            border-bottom: 0;
            border-top: 0;
        }

        td.nilai3{
            border-right: 0;
            border-left: 0;
            border-bottom: 0;
            border-top: 0;
        }

        td.nilai4{
            border-left: 0;
            border-bottom: 0;
            border-top: 0;
        }

        th.nilai5{
            border-right: 0;
        }

        th.nilai6{
            border-right:0 ;
        }

        th.nilai7{
            border-left: 0;
        }
        td.pop{
            border-top: 0;
            border-bottom: 0;
        }

        td.pop2{
            border-top: 0;
            border-bottom: 0;
        }
        .alignleft {
            float: left;
        }
        .alignright {
            float: right;
        }.paksatengah{
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
<?php $total = 0;?>
<body class="bg">
    <center>
        @if ($p->kriteria == 'SEBAGAI INSTRUKTUR LAGU DAN STRATEGI MENGAJAR METODE TILAWATI')
            <div class="cover" style="align-content: center; align-items: center">
                <div>
                    <p style="margin-top: 620px; " class="syahadah">No. Syahadah : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
                </div>
                <table style="width: 675px;margin-left: 28px" class="table1">
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
                        <td>&nbsp; &nbsp;<b> Al-Qur'an</b></td>
                        <th  class="pe3"></th>
                        <th  class="pe3" style="font-size: 8px">Instruktur Lagu</th>
                        <th  class="pe3" style="font-size: 8px">Instruktur Strategi</th>
                        <th  class="pe3"></th>
                        <th >{{ $jumlah = $p->nilai->where("kategori","al-qur'an")->sum('nominal') }}</th>
                    </tr>
                    <?php $i = 2; $x = 1; $z = 5?>
                    @foreach ($p->nilai as $key=> $item)
                        @if ($item !== null)
                            @if ($item->kategori !== 'skill')
                                <tr>
                                    <td class="pop"></td>
                                    <td class="pop2" >&nbsp; &nbsp;<span style="text-transform: capitalize; margin:0; padding:0;">{{ $item->penilaian->name }}</span></td>
                                    <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                    <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->min}}</td>
                                    @if ($key < 1)
                                    <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->min - 1}}</td>
                                    @else
                                    <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->min - $z}}</td>
                                    @endif
                                    <td class="nilai_tot_atas23" style="text-align: center">&nbsp; &nbsp;<b>{{ $item->nominal }}</b></td>
                                    <td style="border-top: 0;border-bottom: 0;"></td>
                                </tr>
                                <?php $z--; ?>
                            @endif
                        @endif
                    @endforeach
                    @foreach ($p->nilai as $key=> $item)
                    @if ($item !== null)
                        @if ($item->kategori == 'skill')
                            <tr>
                                <th>{{ $i++ }}</th>
                                    <td class="nilai6" style="text-transform: uppercase; font-size:9px !important">&nbsp; &nbsp;<b> {{ $item->penilaian->name }}</b></th>
                                    <td  style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                    <td  style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                    <td  style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                    <td class="nilaibawahtot"></td>
                                <th >{{ $item->nominal }}</th>
                                <?php $total += $item->nominal?>
                            </tr>
                        @endif
                    @endif
                    @endforeach

                    <?php 
                        $rata2 = ($jumlah+$total)/4;

                    ?>
                    <tr>
                        <th></th>
                        <td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
                        <th colspan="4" class="nilai5"></th>
                        <th >{{ $rata2 = round($rata2) }}</th>
                    </tr>
                    <tr>
                        <th></th>
                        <td class="nilai6">&nbsp; &nbsp;<b> PRESTASI</b></th>
                        <th colspan="4" class="nilai5"></th> 
                        <th >
                            @if ($rata2 >= 85)
                                Baik
                            @else
                                Cukup
                            @endif
                        </th>
                    </tr>
                </table>
                <div id="textbox" style="margin-top: 20px">
                    <div class="alignleft" style="margin-left: 180px">Baik : 85 - 95</div>
                    <div class="alignright" style="margin-right: 210px">Cukup : 75 - 84</div>
                </div>
            </div>
        @elseif ($p->kriteria == 'SEBAGAI INSTRUKTUR STRATEGI MENGAJAR METODE TILAWATI')
            <div class="cover" style="align-content: center; align-items: center">
                <div>
                    <p style="margin-top: 620px; " class="syahadah">No. Syahadah : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
                </div>
                <table style="width: 675px;margin-left: 28px" class="table1">
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
                        <td>&nbsp; &nbsp;<b> Al-Qur'an</b></td>
                        <th  class="pe3"></th>
                        <th  class="pe3" style="font-size: 8px">Instruktur Lagu</th>
                        <th  class="pe3" style="font-size: 8px">Instruktur Strategi</th>
                        <th  class="pe3"></th>
                        <th >{{ $jumlah = $p->nilai->where("kategori","al-qur'an")->sum('nominal') }}</th>
                    </tr>
                    <?php $i = 2; $x = 1; $z = 5?>
                    @foreach ($p->nilai as $key=> $item)
                        @if ($item !== null)
                            @if ($item->kategori !== 'skill')
                                <tr>
                                    <td class="pop"></td>
                                    <td class="pop2" >&nbsp; &nbsp;<span style="text-transform: capitalize; margin:0; padding:0;">{{ $item->penilaian->name }}</span></td>
                                    <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                    <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->min}}</td>
                                    @if ($key < 1)
                                    <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->min - 1}}</td>
                                    @else
                                    <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->min - $z}}</td>
                                    @endif
                                    <td class="nilai_tot_atas23" style="text-align: center">&nbsp; &nbsp;<b>{{ $item->nominal }}</b></td>
                                    <td style="border-top: 0;border-bottom: 0;"></td>
                                </tr>
                                <?php $z--; ?>
                            @endif
                        @endif
                    @endforeach
                    @foreach ($p->nilai as $key=> $item)
                    @if ($item !== null)
                        @if ($item->kategori == 'skill')
                            <tr>
                                <th>{{ $i++ }}</th>
                                    <td class="nilai6" style="text-transform: uppercase; font-size:9px !important">&nbsp; &nbsp;<b> {{ $item->penilaian->name }}</b></th>
                                    <td  style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                    <td  style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                    <td  style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                    <td class="nilaibawahtot"></td>
                                <th >{{ $item->nominal }}</th>
                                <?php $total += $item->nominal?>
                            </tr>
                        @endif
                    @endif
                    @endforeach
                    
                    <?php 
                        $nilaia = $p->nilai->where('penilaian_id', 37)->sum('nominal');
                        $nilaib = $p->nilai->where('penilaian_id', 39)->sum('nominal');
                        $total 	= $nilaia + $nilaib;
                    ?>
                    <tr>
                        <th></th>
                        <td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
                        <th colspan="4" class="nilai5"></th>
                        <th >{{ $rata2 = round(($jumlah+$total)/3) }}</th>
                    </tr>
                    <tr>
                        <th></th>
                        <td class="nilai6">&nbsp; &nbsp;<b> PRESTASI</b></th>
                        <th colspan="4" class="nilai5"></th> 
                        <th >
                            @if ($rata2 >= 85)
                                Baik
                            @else
                                Cukup
                            @endif
                        </th>
                    </tr>
                </table>
                <div id="textbox" style="margin-top: 20px">
                    <div class="alignleft" style="margin-left: 180px">Baik : 85 - 95</div>
                    <div class="alignright" style="margin-right: 210px">Cukup : 75 - 84</div>
                </div>
            </div>
        @elseif($p->kriteria == 'SEBAGAI INSTRUKTUR LAGU METODE TILAWATI')
            <div class="cover" style="align-content: center; align-items: center">
                <div>
                    <p style="margin-top: 620px; " class="syahadah">No. Syahadah : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
                </div>
                <table style="width: 675px;margin-left: 28px" class="table1">
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
                    <td>&nbsp; &nbsp;<b> Al-Qur'an</b></td>
                    <th  class="pe3"></th>
                    <th  class="pe3" style="font-size: 8px">Instruktur Lagu</th>
                    <th  class="pe3" style="font-size: 8px">Instruktur Strategi</th>
                    <th  class="pe3"></th>
                    <th >{{ $jumlah = $p->nilai->where("kategori","al-qur'an")->sum('nominal') }}</th>
                </tr>
                <?php $i = 2; $x = 1; $z = 5?>
                @foreach ($p->nilai as $key=> $item)
                    @if ($item !== null)
                        @if ($item->kategori !== 'skill')
                            <tr>
                                <td class="pop"></td>
                                <td class="pop2" >&nbsp; &nbsp;<span style="text-transform: capitalize; margin:0; padding:0;">{{ $item->penilaian->name }}</span></td>
                                <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->min}}</td>
                                @if ($key < 1)
                                <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->min - 1}}</td>
                                @else
                                <td class="nilai_tot_atas23" style="text-align: center; margin:0; padding:0;">&nbsp; &nbsp;{{ $item->penilaian->min - $z}}</td>
                                @endif
                                <td class="nilai_tot_atas23" style="text-align: center">&nbsp; &nbsp;<b>{{ $item->nominal }}</b></td>
                                <td style="border-top: 0;border-bottom: 0;"></td>
                            </tr>
                            <?php $z--; ?>
                        @endif
                    @endif
                @endforeach
                @foreach ($p->nilai as $key=> $item)
                @if ($item !== null)
                    @if ($item->kategori == 'skill')
                        <tr>
                            <th>{{ $i++ }}</th>
                                <td class="nilai6" style="text-transform: uppercase; font-size:9px !important">&nbsp; &nbsp;<b> {{ $item->penilaian->name }}</b></th>
                                <td  style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                <td  style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                <td  style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                <td class="nilaibawahtot"></td>
                            <th >{{ $item->nominal }}</th>
                            <?php $total += $item->nominal?>
                        </tr>
                    @endif
                @endif
                @endforeach
                    <?php 
                        $nilaia = $p->nilai->where('penilaian_id', 38)->sum('nominal');
                        $nilaib = $p->nilai->where('penilaian_id', 39)->sum('nominal');
                        $total 	= $nilaia + $nilaib;
                    ?>
                    <tr>
                        <th></th>
                        <td class="nilai6">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
                        <th colspan="4" class="nilai5"></th>
                        <th >{{ $rata2 = round(($jumlah+$total)/3) }}</th>
                    </tr>
                    
                    <tr>
                        <th></th>
                        <td class="nilai6">&nbsp; &nbsp;<b> PRESTASI</b></th>
                        <th colspan="4" class="nilai5"></th> 
                        <th >
                            @if ($rata2 >= 85)
                                Baik
                            @else
                                Cukup
                            @endif
                        </th>
                    </tr>
                </table>
                <div id="textbox" style="margin-top: 20px">
                    <div class="alignleft" style="margin-left: 180px">Baik : 85 - 95</div>
                    <div class="alignright" style="margin-right: 210px">Cukup : 75 - 84</div>
                </div>
            </div>
        @elseif($p->program->name == 'Diklat Munaqisy Cabang')
            <div class="cover" style="align-content: center; align-items: center">
                <div>
                    <p style="margin-top: 620px; " class="syahadah">No. Syahadah : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
                </div>
                <table style="width: 600px;margin-left: 100px" class="table1">
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
                        <td style="border-right: none">&nbsp; &nbsp;<b> Al-Qur'an</b></td>
                        <th colspan="3" class="pe3" style="border-left: none"></th>
                        <th class=nilai2>{{ $jumlah = $p->nilai->where("kategori","al-qur'an")->sum('nominal') }}</th>
                    </tr>
                    @foreach ($p->nilai as $key=> $item)
                        @if ($item !== null)
                            @if ($item->kategori !== 'skill')
                                <tr>
                                    <td class="pop"></td>
                                    <td class="pop2" style="border-right: none">&nbsp; &nbsp;&nbsp;<span style="text-transform: capitalize; ">{{ $item->penilaian->name }}</span></td>
                                    <td class="nilai" style="text-align: center; " >{{$item->penilaian->min}}</td>
                                    <td class="nilai2" style="text-align: center">{{$item->penilaian->max}}</td>
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
                        <th >{{ $jumlah = round($p->nilai->where("kategori","skill")->sum('nominal') / 3) }}</th>
                    </tr>
                    @foreach ($p->nilai as $key=> $item)
                        @if ($item !== null)
                            @if ($item->kategori == 'skill')
                                <tr>
                                    <td class="pop"></td>
                                    <td class="pop2" style="border-right: none">&nbsp; &nbsp;&nbsp;<span style="text-transform: capitalize; ">{{ $item->penilaian->name }}</span></td>
                                    <td class="nilai" style="text-align: center; " >{{$item->penilaian->min}}</td>
                                    <td class="nilai2" style="text-align: center">{{$item->penilaian->max}}</td>
                                    <td class="nilai3" style="text-align: center">{{$item->nominal}}</td>
                                    <th style="border-top: 0;border-bottom: 0;"></th>
                                </tr>
                            @endif
                        @endif
                    @endforeach

                    @if ($p->pelatihan->keterangan == 'guru')
                        <tr>
                            <th></th>
                            <td class="nilai6" style="border-right: none">&nbsp; &nbsp;<b> RATA - RATA NILAI</b></th>
                            <th style="border-left: none" colspan="3" class="nilai5"></th>
                            <th >
                            @if ($p->pelatihan->program->name=='munaqosyah santri')
                                {{ $rata2 = $jumlah }}
                            @elseif($p->program->name == 'Diklat Munaqisy Cabang')
                                @php
                                    $x = $p->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $y = $p->nilai->where("kategori","skill")->sum('nominal');
                                    $z = $p->nilai->where("kategori","skill")->count();
                                    $satu  = $x;
                                    $dua   = round($y / $z);
                                    $rata2 = round(($satu+$dua)/2);
                                @endphp
                                {{round($rata2)}}
                            @else
                                {{ $rata2 = round(($jumlah+ $item->nominal)/2) }}
                            @endif
                                </th>
                        </tr>
                    @else
                    <?php 
                        $rata2 = $jumlah
                    ?>
                    @endif
                    <tr>
                        <th></th>
                        <td class="nilai6" style="border-right: none">&nbsp; &nbsp;<b> PRESTASI</b></th>
                        <th colspan="3" style="border-left: none" class="nilai5"></th> 
                        <th >
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
                <div id="textbox" style="margin-top: 20px">
                    <div class="alignleft" style="margin-left: 180px"><b> Istimewa : 85 - 95</b></div>
                    <div class="alignleft" style="margin-left: 150px"><b style="display-none">Baik : 75 - 84</b></div>
                    <div class="alignright" style="margin-right: 210px"><b>Cukup : 65 - 74</b></div>
                </div>
            </div>
        @else
            <div class="cover" style="align-content: center; align-items: center">
                <div>
                    <p style="margin-top: 620px; " class="syahadah">No. Syahadah : {{ $p->pelatihan->id }}/2022/{{ $p->id }}</p>
                </div>
                <table style="width: 600px;margin-left: 100px" class="table1">
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
                        <td>&nbsp; &nbsp;<b> Al-Qur'an</b></td>
                        <th colspan="3" class="pe3"></th>
                        <th >{{ $jumlah = $p->nilai->where("kategori","al-qur'an")->sum('nominal') }}</th>
                    </tr>
                    <?php $i = 2; $x = 1?>
                    @foreach ($p->nilai as $key=> $item)
                        @if ($item !== null)
                            @if ($item->kategori !== 'skill')
                                <tr>
                                    <td class="pop"></td>
                                    <td class="pop2" >&nbsp; &nbsp;&nbsp;<span style="text-transform: capitalize">{{ $item->penilaian->name }}</span></td>
                                    <td class="nilai" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->max }}</td>
                                    <td class="nilai2" style="text-align: center">&nbsp; &nbsp;{{ $item->penilaian->min }}</td>
                                    <td class="nilai3" style="text-align: center">&nbsp; &nbsp;{{ $item->nominal }}</td>
                                    <td style="border-top: 0;border-bottom: 0;"></td>
                                </tr>
                            @else
                                <tr>
                                    <th>{{ $i++ }}</th>
                                    <td class="nilai6" style="text-transform: uppercase">&nbsp; &nbsp;<b> {{ $item->penilaian->name }}</b></th>
                                    <th colspan="3" class="nilai5"></th>
                                    <th >{{ round($item->nominal) }}</th>
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
                            <th >
                            @if ($p->pelatihan->program->name=='munaqosyah santri')
                                {{ $rata2 = $jumlah }}
                            @elseif($p->program->name == 'Diklat Munaqisy Cabang')
                                @php
                                    $x = $p->nilai->where("kategori","al-qur'an")->sum('nominal');
                                    $y = $p->nilai->where("kategori","skill")->sum('nominal');
                                    $z = $p->nilai->where("kategori","skill")->count();
                                    $satu  = $x;
                                    $dua   = round($y / $z);
                                    $rata2 = round(($satu+$dua)/2);
                                @endphp
                                {{round($rata2)}}
                            @else
                                {{ $rata2 = round(($jumlah+ $item->nominal)/2) }}
                            @endif
                                </th>
                        </tr>
                    @else
                    <?php 
                        $rata2 = $jumlah
                    ?>
                    @endif
                    <tr>
                        <th></th>
                        <td class="nilai6">&nbsp; &nbsp;<b> PRESTASI</b></th>
                        <th colspan="3" class="nilai5"></th> 
                        <th >
                            @if ($rata2 >= 85)
                                Baik
                            @else
                                Cukup
                            @endif
                        </th>
                    </tr>
                </table>
                <div id="textbox" style="margin-top: 20px">
                    <div class="alignleft" style="margin-left: 180px">Baik : 85 - 95</div>
                    <div class="alignright" style="margin-right: 210px">Cukup : 75 - 84</div>
                </div>
            </div>
        @endif
    </center>
</body>
@endforeach
</html>