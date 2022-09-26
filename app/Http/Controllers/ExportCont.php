<?php

namespace App\Http\Controllers;
use App\Exports\SeluruhPesertaExport;
use App\Exports\ExportDataBroadcast;
use App\Exports\UserExport;
use App\Exports\ExportDataPeserta;
use App\Exports\ExportDataPesertaFull;
use App\Exports\TemplateTrainerCabangExport;
use App\Exports\TemplateKpaCabangExport;
use App\Exports\CabangDataExport;
use App\Exports\ApicabangtilawatiExport;
use App\Exports\ApicabangnfExport;
use App\Exports\ExportDataKPA;
use App\Exports\LembagaDataExport;
use App\Exports\ExportDataTrainer;
use App\Exports\ExportDataMunaqisy;
use App\Exports\TemplateLembagaExport;
use App\Exports\TemplateDiklatExport;
use App\Exports\ExportDataPesertaUntukImport;
use App\Exports\CabangExport;
use App\Exports\CabangKpaExport;
use App\Exports\PesertaPendaftaranExport;
use App\Exports\ExportLaporanDataCabang;
use App\Exports\ExportLaporanDataPerkembangan;
use App\Exports\TemplateMunaqisyExport;
use App\Exports\ExportDataTrainerAll;
use App\Exports\ExportLaporanDataCabangPeriode;
use App\Exports\LembagaDataExportSearchProvinsi;
use App\Exports\ExportDataSupervisor;
use App\Models\Pelatihan;
use App\Models\Macamtrainer;
use App\Models\Provinsi;
use Excel;
use Redirect;
use Illuminate\Http\Request;

class ExportCont extends Controller
{
    public function export_seluruh_peserta(Request $request)
    {
        $from = $request->from;
        $till = $request->till;
        if ($from != '' && $till == '' || $from == '' && $till != '') {
            # code...
            return Redirect::back()->withFail('Pastikan kedua parameter pencarian diisi jika ingin mensortir');
        }else{
            return Excel::download(new SeluruhPesertaExport($from,$till),'peserta-dari_'.$from.'_sampai_'.$till.'.xlsx');
        }
        
    }

    public function export_broadcast_peserta(Request $request)
    {
        $from = $request->from;
        $till = $request->till;
        if ($from != '' && $till == '' || $from == '' && $till != '') {
            # code...
            return Redirect::back()->withFail('Pastikan kedua parameter pencarian diisi jika ingin mensortir');
        }else{
            return Excel::download(new ExportDataBroadcast($from,$till),'peserta-dari_'.$from.'_sampai_'.$till.'.xlsx');
        }
    }

    public function export_peserta_pendaftaran(Request $request)
    {
        $pelatihan_id = $request->id;
        $data = Pelatihan::find($pelatihan_id);
        return Excel::download(new PesertaPendaftaranExport($pelatihan_id),'data-peserta-pendaftaran'.$data->program->name.'-'.$data->tanggal.'.xlsx');
    }

    public function export_user()
    {
        return Excel::download(new UserExport,'data-user.xls');
    }

    public function export_data_cabang(Request $request)
    {
        return Excel::download(new CabangExport,'data-instruktur-cabang.xlsx');
    }

    public function export_kpa_cabang()
    {
        return Excel::download(new CabangKpaExport,'data-kpa-cabang.xlsx');
    }

    public function export_template_trainer_cabang()
    {
        return Excel::download(new TemplateTrainerCabangExport,'template-import-tainer-cabang.xlsx');
    }

    public function export_data_trainer_all()
    {
        return Excel::download(new ExportDataTrainerAll, 'data-trainer-all.xlsx');
    }

    public function export_template_trainer_cabang_data($cabang_id)
    {
        $macam = Macamtrainer::all();
        return Excel::download(new ExportDataTrainer($cabang_id,$macam),'tainer-cabang-data.xlsx');
    }

    public function export_template_munaqisy_cabang_data($cabang_id)
    {
        return Excel::download(new ExportDataMunaqisy($cabang_id),'munaqisy-cabang-data.xlsx');
    }

    public function export_template_supervisor_cabang_data($cabang_id)
    {
        return Excel::download(new ExportDataSupervisor($cabang_id), 'supervisor-cabang-data.xlsx');
    }

    public function export_data_peserta($pelatihan_id)
    {
        return Excel::download(new ExportDataPeserta($pelatihan_id), 'data-peserta.xlsx');
    }

    public function export_data_peserta_full($pelatihan_id)
    {
        return Excel::download(new ExportDataPesertaFull($pelatihan_id), 'data-peserta.xlsx');
    }

    public function export_data_peserta_untuk_import($pelatihan_id)
    {
        return Excel::download(new ExportDataPesertaUntukImport($pelatihan_id), 'data-peserta.xlsx');
    }

    public function export_template_kpa_cabang()
    {
        return Excel::download(new TemplateKpaCabangExport,'template-import-kpa-cabang.xlsx');
    }

    public function export_template_kpa_cabang_data($cabang_id)
    {
        return Excel::download(new ExportDataKPA($cabang_id),'kpa-cabang-data.xlsx');
    }

    public function export_template_lembaga_cabang()
    {
        return Excel::download(new TemplateLembagaExport, 'template-import-lembaga-cabang.xlsx');
    }

    public function export_template_munaqisy_cabang()
    {
        return Excel::download(new TemplateMunaqisyExport, 'template-import-munaqisy-&-supervisor-cabang.xlsx');
    }

    public function export_template_lembaga_cabang_data($cabang_id)
    {
        return Excel::download(new LembagaDataExport($cabang_id), 'lembaga-cabang-data.xlsx');
    }

    public function export_template_diklat($jenis)
    {
        return Excel::download(new TemplateDiklatExport, 'template-level-1.xlsx');
    }

    public function download_data_cabang()
    {
        return Excel::download(new CabangDataExport,'data-cabang-'.date('Y').'.xlsx');
    }

    public function download_api_perwakilan_cabang()
    {
        return Excel::download(new ApicabangtilawatiExport,'data-perwakilan-tilawati-'.date('Y').'.xlsx');
    }

    public function download_api_cabang_nf()
    {
        return Excel::download(new ApicabangnfExport,'data-cabang-nf-'.date('Y').'.xlsx');
    }

    public function export_lembaga_search_provinsi(Request $request)
    {
        $provinsi_id = $request->prov_id;
        $provinsi    = Provinsi::find($provinsi_id);
        return Excel::download(new LembagaDataExportSearchProvinsi($provinsi_id),'Lembaga-'.$provinsi->nama.'.xlsx');
    }

    public function export_laporan_data_cabang(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
    
        if ($dari == null) {
            # code...
            return Excel::download(new ExportLaporanDataCabang(),'Laporan_Data_Lembaga_Periode_'.date('d_m_Y').'.xlsx');
        }else {
            # code...
            return Excel::download(new ExportLaporanDataCabangPeriode($dari,$sampai),'Laporan_Data_Lembaga_Periode_'.$dari.'_sampai_'.$sampai.'.xlsx');
        }
    }

    public function export_laporan_data_perkembangan(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;

        if ($dari == null) {
            # code...
            return Excel::download(new ExportLaporanDataPerkembangan(),'Laporan_Data_Perkembangan_Periode_'.date('d_m_Y').'.xlsx');
        }else {
            # code...
        }
    }
}
