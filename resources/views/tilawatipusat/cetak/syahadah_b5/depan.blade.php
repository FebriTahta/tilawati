<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sertifikat</title>
    <style>
        body, html {
          height: 100%;
          /* width: 100%; */
          margin: 0;
          font-family: Arial, Helvetica, sans-serif;
        }

        .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        }

        .awalan {
            position: absolute;
            left: 15%;
            top: 35%;
            z-index: 9999;
            font-size: 21px;
            width: 70%;
        }
        

        .akhiran {
            position: absolute;
            left: 15%;
            top: 55%;
            z-index: 9999;
            font-size: 21px;
            width: 70%;
        }

        .tanggalan {
            position: absolute;
            left: 65%;
            bottom: 27%;
            z-index: 9999;
            font-size: 18px;
            width: 70%;
        }

        .kepala {
            position: absolute;
            left: 65%;
            bottom: 10%;
            z-index: 9999;
            font-size: 16px;
            width: 70%;
        }

        .nama_kepala {
            position: absolute;
            left: 65%;
            bottom: 13%;
            z-index: 9999;
            font-size: 18px;
            width: 70%;
        }

        .no_sertifikat {
            position: absolute;
            left: 12%;
            bottom: 10%;
            z-index: 9999;
            font-size: 18px;
            width: 70%;
            margin-bottom:2px;
        }

        .qrcode {
            position: absolute;
            left: 12%;
            bottom: 14%;
            z-index: 9999;
            font-size: 18px;
            width: 70%;
        }
        .page-break {
			page-break-after: always;
			page-break-inside: avoid;
		}
    </style>

    @if ($pelatihan->keterangan == 'guru' || $pelatihan->keterangan == 'instruktur')
        <style>
            .bg {
            background-image: url("s_guru.jpg");
            height: 100%; 
            z-index: 1;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        table {
            top: 38%;
            margin-top: 5px;
            left: 11%;
            z-index: 9999;
            font-size: 16px;
            width: 70%;
            position: absolute;
        }

        table td, table td * {
            vertical-align: top;
        }
        </style>
    @else
        <style>
            .bg {
            background-image: url("s_santri.jpg");
            height: 100%; 
            z-index: 1;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        table {
            top: 40%;
            margin-top: 5px;
            left: 11%;
            z-index: 9999;
            font-size: 16px;
            width: 70%;
            position: absolute;
        }

        table td, table td * {
            vertical-align: top;
        }
        </style>
    @endif
        
</head>
    @foreach ($peserta as $item)
        @php
            date_default_timezone_set('Asia/Jakarta'); $date=$item->tgllahir;
            $peserta_id = Crypt::encrypt($item->id);
            $qrcode = base64_encode(QrCode::size(300)->generate('https://syahadah.nurulfalah.org/syahadah-peserta/'.$peserta_id));
        @endphp
        
        <body class="bg">
            <div class="awalan" style="margin-top:25px"></div>
            <table style="margin-left: 9px">
                <tr style="margin-bottom: 20px; line-height: 25px">
                    <td style="width: 25%">Nama</td>
                    <td style="width: 2%">:</td>
                    <td>{{$item->name}}</td>
                </tr>
                <tr style="margin-bottom: 20px; line-height: 25px">
                    <td style="width: 25%">Alamat</td>
                    <td style="width: 2%">:</td>
                    <td style="width: 90%">{{$item->alamat}}</td>
                </tr>
                <tr style="margin-bottom: 20px; line-height: 25px">
                    <td style="width: 25%">Tempat Tanggal Lahir</td>
                    <td style="width: 2%">:</td>
                    <td style="width: 90%; text-transform: uppercase">
                        @if ($item->tmptlahir2 == null)
							@if (substr($item->tmptlahir, 0, 4) == 'KOTA')
								{{substr($item->tmptlahir, 5)}}
							@elseif(substr($item->tmptlahir, 4, 4) == "ADM")
								{{substr($item->tmptlahir, 10)}}
							@elseif(substr($item->tmptlahir, 0, 4) == 'KAB.')
								{{substr($item->tmptlahir, 5)}}
							@else
								{{$item->tmptlahir}}
							@endif
						@endif

						@if ($item->tmptlahir2 !== null)
							@if (substr($item->tmptlahir2, 0, 4) == 'KOTA')
								{{substr($item->tmptlahir2, 5)}}
							@elseif(substr($item->tmptlahir2, 4, 4) == "ADM")
								{{substr($item->tmptlahir2, 10)}}
							@elseif(substr($item->tmptlahir2, 0, 4) == 'KAB.')
								{{substr($item->tmptlahir2, 5)}}
							@else
								{{$item->tmptlahir2}}
							@endif
						@endif
						
						, {{ Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }}
                    </td>
                </tr>
                <tr style="margin-bottom: 20px; line-height: 25px">
                    <td style="width: 25%">Dinyatakan</td>
                    <td style="width: 2%">:</td>
                    <td style="width: 90%">{{$item->kriteria}}</td>
                </tr>
            </table>

            <div class="akhiran" style="margin-top: 20px"></div>
            <div class="qrcode">
                <img src="{!! 'data:image/png;base64,'.$qrcode !!}" alt="" style="max-width: 110px;">
            </div>
            <div class="no_sertifikat" style="font-weight: bold"><u>{{$item->pelatihan_id.'/'.date('Y').'/'.$item->id}}</u></div>
            <div class="tanggalan" style="margin-left: 10px">Surabaya, {{Carbon\Carbon::parse($pelatihan->updated_at)->isoFormat('D MMMM Y')}}</div>
            <div class="nama_kepala" style="margin-left: 10px"><u>{{$direktur}}</u></div>
            <div class="kepala" style="margin-left: 10px">{{$kepala}}</div>
            @if ($pelatihan->keterangan == 'guru' || $pelatihan->keterangan == 'instruktur')
            <img src="s_guru.jpg" style="height: 100%; z-index: 1" alt="">
            @else
            <img src="s_santri.jpg" style="height: 100%; z-index: 1" alt="">
            @endif
        </body>
    @endforeach
</html>