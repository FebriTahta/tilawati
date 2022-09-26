<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan_Data_Perkembangan</title>
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
                <th rowspan="3" colspan="9">Laporan Data Perkembangan <br> <small>{{date('d - m - Y')}}</small></th>
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
                <th >NO</th>
                <th >CABANG</th>
                <th >TOTAL DIKLAT</th>
                <th >GURU</th>
                <th >SANTRI</th>
                <th >KPA</th>
                <th >TRAINER</th>
                <th >MUNAQISY</th>
                <th >SUPERVISOR</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            @foreach ($data as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name. '-' .$item->kabupaten->nama}}</td>
                <td>
                    @php
                        $tot[] = $item->pelatihan->count();
                        $tot_diklat = array_sum($tot);
                    @endphp
                    {{$item->pelatihan->count()}}
                </td>
                <td>
                    @php
                        $dataz = [];
                        $pelatihan_guru     = App\Models\Pelatihan::where('cabang_id', $item->id)->where('keterangan', 'guru')->get();

                        foreach ($pelatihan_guru as $key => $value) {
                            # code...
                            $dataz[] = $value->peserta->count();
                        }
                        $guru   = array_sum($dataz);
                        $tot_g[]  = $guru;
                        $tot_guru = array_sum($tot_g); 
                    @endphp
                    {{$guru}}
                </td>
                <td>
                    @php
                        $datax = [];
                        $pelatihan_santri   = App\Models\Pelatihan::where('cabang_id', $item->id)->where('keterangan', 'santri')->get();
                        foreach ($pelatihan_santri as $key => $value) {
                            # code...
                            $datax[] = $value->peserta->count();
                        }
                        $santri = array_sum($datax);
                        $tot_s[]  = $santri;
                        $tot_santri = array_sum($tot_s); 
                    @endphp
                    {{$santri}}
                </td>
                <td>
                    @php
                        $tot_k[] = $item->kpa->count();
                        $tot_kpa = array_sum($tot_k);
                    @endphp
                    {{$item->kpa->count()}}
                </td>
                <td>
                    @php
                    $trainer = App\Models\Trainer::where('cabang_id', $item->id)->whereHas('macamtrainer', function($q){
                            $q->where('jenis','Instruktur Strategi')->orWhere('jenis','Instruktur Lagu');
                        })->count();    
                    $tot_t[] = $trainer;
                    $tot_trainer = array_sum($tot_t);
                    @endphp
                    {{$trainer}}
                </td>
                <td>
                    @php
                        $munaqisy = $item->munaqisy->count();
                        $trainer_munaqisy = App\Models\Trainer::where('cabang_id', $item->id)->whereHas('macamtrainer', function($q){
                            $q->where('jenis','Munaqisy');
                        })->count();
                        $total_munaqisy = $munaqisy + $trainer_munaqisy;
                        $tot_m[] = $total_munaqisy;
                        $tot_munaqisy = array_sum($tot_m);
                    @endphp
                    {{$total_munaqisy}}
                </td>
                <td>
                    @php
                        $supervisor = $item->supervisor->count();
                        $trainer_supervisor = App\Models\Trainer::where('cabang_id', $item->id)->whereHas('macamtrainer', function($q){
                            $q->where('jenis','Supervisor');
                        })->count();
                        $total_supervisor = $supervisor + $trainer_supervisor;
                        $tot_sup[] = $total_supervisor;
                        $tot_supervisor = array_sum($tot_sup);
                    @endphp
                    {{$total_supervisor}}
                </td>
            </tr>
            @endforeach
            <tr></tr>
            <tr>
                <td>-</td>
                <td>TOTAL KESELURUHAN</td>
                <td>{{number_format(($tot_diklat),0,',','.')}}</td>
                <td>{{number_format(($tot_guru),0,',','.')}}</td>
                <td>{{$tot_santri}}</td>
                <td>{{number_format(($tot_kpa),0,',','.')}}</td>
                <td>{{number_format(($tot_trainer),0,',','.')}}</td>
                <td>{{number_format(($tot_munaqisy),0,',','.')}}</td>
                <td>{{number_format(($tot_supervisor),0,',','.')}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>