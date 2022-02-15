<?php

namespace App\Http\Controllers;
use App\Exports\SeluruhPesertaExport;
use App\Exports\UserExport;
use App\Exports\TemplateTrainerCabangExport;
use App\Exports\TemplateKpaCabangExport;
use App\Exports\ExportDataKPA;
use App\Exports\LembagaDataExport;
use App\Exports\ExportDataTrainer;
use App\Exports\TemplateLembagaExport;
use App\Exports\TemplateDiklatExport;
use App\Exports\CabangExport;
use App\Exports\CabangKpaExport;
use App\Exports\PesertaPendaftaranExport;
use App\Models\Pelatihan;
use App\Models\Macamtrainer;
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

    public function export_template_trainer_cabang_data($cabang_id)
    {
        $macam = Macamtrainer::all();
        return Excel::download(new ExportDataTrainer($cabang_id,$macam),'template-import-tainer-cabang-data.xlsx');
    }

    public function export_template_kpa_cabang()
    {
        return Excel::download(new TemplateKpaCabangExport,'template-import-kpa-cabang.xlsx');
    }

    public function export_template_kpa_cabang_data($cabang_id)
    {
        return Excel::download(new ExportDataKPA($cabang_id),'template-import-kpa-cabang-data.xlsx');
    }

    public function export_template_lembaga_cabang()
    {
        return Excel::download(new TemplateLembagaExport, 'template-import-lembaga-cabang.xlsx');
    }

    public function export_template_lembaga_cabang_data($cabang_id)
    {
        return Excel::download(new LembagaDataExport($cabang_id), 'template-import-lembaga-cabang-data.xlsx');
    }

    public function export_template_diklat($jenis)
    {
        return Excel::download(new TemplateDiklatExport, 'template-level-1.xlsx');
    }
}
