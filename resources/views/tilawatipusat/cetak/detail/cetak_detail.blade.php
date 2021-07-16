<!DOCTYPE html>
<html>
  <head>
    <style>
    body {
		background-image: url('public/assets/images/a4.jpg');
        height: 842px;
        width: 595px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
    }
    #bg{
      background-image: url('/assets/images/a4.jpg');
          /* The image used */
    }
    </style>
    <style>
      .invoice-box {
        margin: auto;
        /* border: 1px solid #eee; */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 14px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: rgb(99, 99, 99);
      }

      .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
      }

      .invoice-box table td {
        vertical-align: top;
      }

      .invoice-box table tr td:nth-child(2) {
        text-align: right;
      }

      .invoice-box table tr.top table td {
        padding-bottom: 10px;
      }

      .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
      }

      .invoice-box table tr.information table td {
        padding-bottom: 10px;
      }

      .invoice-box table tr.heading td {
        /* background: #eee; */
        /* border-bottom: 1px solid #ddd; */
        font-weight: bold;
      }

      .invoice-box table tr.details td {
        padding-bottom: 10px;
      }

      .invoice-box table tr.item td {
        /* border-bottom: 1px solid #eee; */
      }

      .invoice-box table tr.item.last td {
        border-bottom: none;
      }

      .invoice-box table tr.total td:nth-child(2) {
        /* border-top: 2px solid #eee; */
        font-weight: bold;
      }

      @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
          width: 100%;
          display: block;
          text-align: center;
        }

        .invoice-box table tr.information table td {
          width: 100%;
          display: block;
          text-align: center;
        }
      }

      /** RTL **/
      .invoice-box.rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      }

      .invoice-box.rtl table {
        text-align: right;
      }

      .invoice-box.rtl table tr td:nth-child(2) {
        text-align: left;
      }
      .text-besar{
        text-transform: uppercase;
      }
      tr:nth-child(even) {
        background-color: #dddddd;
      }
      header{
        position: fixed;
        top: 0px;
        left: 0px;
        right: 0px;
        text-align: center;
        line-height: 50px;
        background-color: darkcyan;
        margin-bottom: 100px;
      }
    </style>
  </head>
  <body>
    
	<div style="position: fixed; left: 0px; top: 0px; right: 0px; bottom: 0px; text-align: center;z-index: -1000; ">
		<img src="assets/images/surat_a4.jpg" style="width: 100%; margin-top: 2%;">
	</div>
 
	  <div style="margin-top: 150px">
    <div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
        <tr class="information">
          <td colspan="2">
            <table>
              <tr>
                <td>
                  <span class="text-besar">{{ $pelatihan->program->name }}</span><br />
                  <span style="text-transform: capitalize">{{ $pelatihan->cabang->name }} - {{ strtolower($pelatihan->cabang->kabupaten->nama) }}</span><br />
                  <?php date_default_timezone_set('Asia/Jakarta'); $date=$pelatihan->tanggal;?>
                  {{ Carbon\Carbon::parse($date)->isoFormat('D MMMM Y') }}
                </td>
      
                <td><?php $totpes = $peserta->count() ?>
                  Total Peserta :  {{ $totpes }}<br />
                  Peserta Bersyahadah : {{ $totpes }}<br />
                  Peserta Belum Bersyahadah : 0<br />
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <hr />
      <table cellpadding="0" cellspacing="0" style=" margin-top: 50px">
        <tr class="information">
          <td colspan="2">
            <table>
              <tr>
                <td>
                  <span>Berikut adalah daftar peserta yang telah bersyahadah</span><br />
                  Sebagai Guru Al qur'an metode tilawati<br />
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="100%" style="page-break-inside:auto; border: 1px solid black;
      border-collapse: collapse; border-right:none; border-left:none; margin-bottom:250px;">
        <thead class="text-besar" style="text-align: left; border: 1px solid black;border-left: none; border-right: none; background-color: rgb(226, 255, 179); padding-top: 100px">
            <tr>
                <th style="width: 5%;text-align: left;">No</th>
                <th style="width: 70%;text-align: left;">Nama Peserta</th>
                <th style="width: 10%;text-align: left;">Nilai</th>
                <th style="width: 15%;text-align: left;">Predikat</th>
            </tr>
        </thead>
        <tbody style="text-align: left; ;border-left: none; border-right: none;">
          @foreach ($peserta as $key=>$item)
          <?php 
            $total  = $item->nilai->where("kategori","al-qur'an")->sum('nominal');
            $total2 = $item->nilai->where("kategori","skill")->sum('nominal');
            $total3 = $item->nilai->where("kategori","skill")->count();
            $rata2 = ($total + $total2)/($total3+1);
          ?>
          <tr>
            <td style="width: 5%;text-align: left;">{{ $key+1 }}</td>
            <td style="width: 70%;text-align: left; text-transform: capitalize">{{ strtolower($item->name) }}</td>
            <td style="width: 10%;text-align: left;">
             {{  $rata2 }}
            </td>
            <td style="width: 15%;text-align: left;">
              @if ($rata2 > 84) 
                Baik
              @elseif($rata2 < 84 && $rata2 < 75)
              @else
                Cukup
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
		</div>
	</div>
  </body>
</html>