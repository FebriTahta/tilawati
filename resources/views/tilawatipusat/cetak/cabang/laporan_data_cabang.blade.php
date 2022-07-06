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
                    
                    foreach ($programs as $key => $value) {
                        # code...
                        $total      = $item->pelatihan->where('program_id',$value->id)->count();
                        $peserta    = App\Models\Peserta::where('cabang_id', $item->id)->where('program_id',$value->id)->count();
                        $keterangan = App\Models\Pelatihan::where('program_id',$value->id)->select('keterangan')->first();
                        $hasil[]    = "<pre>$total diklat   $value->name  ($peserta $keterangan->keterangan)</pre>";
                    }
                    return $string=implode("<br>",$hasil);    
                    @endphp
                    {{$string}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>