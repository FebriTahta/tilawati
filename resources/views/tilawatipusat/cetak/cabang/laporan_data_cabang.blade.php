<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan_Data_Cabang</title>
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
                <th rowspan="3" colspan="5">Laporan Data Cabang <br> <small>{{date('d - m - Y')}}</small></th>
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
                <th >NAMA CABANG</th>
                <th >TOTAL DIKLAT</th>
                <th >PROGRAM DIKLAT</th>
                <th >GURU</th>
                <th >SANTRI</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            @foreach ($data as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->pelatihan->count()}}</td>
                <td>
                    @php
                    $dataz = [];
                    foreach ($item->pelatihan as $key => $value) {
                        # code...
                        $datax  = App\Models\Program::where('id',$value->program_id)->first();                        
                        $dataz[$key] = $datax->id;
                    }
                    $programs = App\Models\Program::whereIn('id',$dataz)->distinct()->get();
                    
                    
                    @endphp
                    @foreach ($programs as $p)
                        {{$item->pelatihan->where('program_id', $p->id)->count()}} - {{$p->name}} <br>
                    @endforeach
                </td>
                <td>
                    @foreach ($pelatihan_guru as $key => $value)
                        @php
                            $pelatihan_guru     = App\Models\Pelatihan::where('cabang_id', $item->id)->where('keterangan', 'guru')->get();
                            $datax[] = $value->peserta->count();
                        @endphp
                    @endforeach
                    {{array_sum($datax)}}
                </td>
                <td>
                    @foreach ($pelatihan_santri as $key => $value)
                        @php
                            $pelatihan_santri   = Pelatihan::where('cabang_id', $item->id)->where('keterangan', 'santri')->get();
                            $datay[] = $value->peserta->count();
                        @endphp
                    @endforeach
                    {{array_sum($datay)}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>