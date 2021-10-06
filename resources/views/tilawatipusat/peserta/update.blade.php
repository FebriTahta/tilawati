@extends('layouts.tilawatipusat_layouts.master')

@section('content')
@component('common-tilawatipusat.breadcrumb')
@slot('title') UPDATE   @endslot
@slot('title_li') PESERTA   @endslot
@endcomponent
<form action="{{route('update.data.peserta')}}" method="POST" enctype="multipart/form-data">@csrf
    <div class="row">
        <div class="form-group col-xl-6">
            <input type="hidden" name="id" value="{{$peserta->id}}">
            <label for="nama">Nama Peserta</label>
            <input type="text" class="form-control" value="{{$peserta->name}}" id="nama" name="name" required>    
        </div>
        <div class="form-group col-12">
            <h5>BIODATA</h5>
        </div>
        <div class="form-group col-12 col-xl-6">
            <label for="tmptlahir"><i class="text-danger">*</i> Tempat Lahir (Kab / Kota)</label>
            <select name="tmptlahir" id="tmptlahir" class="form-control" style="max-height: 40px; color: rgb(0, 0, 0); font-size: 13px;" >
                <option value="">{{$peserta->tmptlahir}}</option>
            </select>
        </div>
        <div class="form-group col-12 col-xl-6">
            <label for="tgllahir"><i class="text-danger">*</i> Tanggal Lahir</label>
            <input type="date" value="{{$peserta->tgllahir}}" name="tgllahir" id="tgllahir" class="form-control" style="max-height: 40px; color: rgb(0, 0, 0); font-size: 13px;" required>
        </div>
        <div class="form-group col-12">
            <h5>ALAMAT LENGKAP</h5>
        </div>
        <div class="form-group col-3 col-xl-3">
            <label for="kode"><i class="text-danger">*</i> Kode</label>
            <input type="text" id="kode" name="kode" value="62" class="form-control" style="max-height: 40px;" readonly required>
        </div>
        <div class="form-group col-9 col-xl-6">
            <label for="phone"><i class="text-danger">*</i> Nomor WA (AKTIF)</label>
            <input type="number" value="{{substr($peserta->telp,2)}}" pattern="[0-9]*" inputmode="numeric" id="phone" onkeypress="return hanyaAngka(event)" name="phone" class="form-control" style="max-height: 40px;" required>
            <code style="" id="kodephone"></code>
        </div>
        <div class="form-group col-12 col-xl-3">
            <label for="pos"><i class="text-danger">*</i> Kode Pos</label>
            <input type="number" value="{{$peserta->pos}}" id="pos" name="pos" class="form-control" style="max-height: 40px;" required>
            <code style="" id="kodepos"></code>
        </div>
        <div class="form-group col-12 col-xl-6">
            <label for="kabupaten_id"><i class="text-danger">*</i> Kabupaten / Kota</label>
            <select name="kabupaten_id" id="kabupaten_id" class="form-control" style="max-height: 40px; color: rgb(0, 0, 0); font-size: 13px;" required>
                <option value="{{$peserta->kabupaten_id}}">{{$peserta->kabupaten->nama}}</option>
            </select>
        </div>
        <div class="form-group  col-12 col-xl-6">
            <label for="kecamatan_id"><i class="text-danger">*</i> Kecamatan</label>
            <select name="kecamatan_id" id="kecamatan_id" class="form-control" style="max-height: 40px; color: rgb(0, 0, 0); font-size: 13px;" required>
                <option value="{{$peserta->kecamatan_id}}">{{$peserta->kecamatan->nama}}</option>
            </select>
        </div>
        <div class="form-group  col-12 col-xl-6">
            <label for="kelurahan_id"><i class="text-danger">*</i> Kelurahan</label>
            <select name="kelurahan_id" id="kelurahan_id" class="form-control" style="max-height: 40px; color: rgb(0, 0, 0); font-size: 13px;" required>
                <option value="{{$peserta->kelurahan_id}}">{{$peserta->kelurahan->nama}}</option>
            </select>
        </div>
        <div class="form-group  col-12 col-xl-12">
            <label for="alamat"><i class="text-danger">*</i> Alamat Sesuai KTP</label>
            <textarea name="alamat" class="form-control" id="" cols="30" rows="5" required>{{$peserta->alamat}}</textarea>
        </div>
        <div class="form-group col-12">
            <button class="btn btn-info" type="submit">UPDATE DATA</button>
        </div>
    </div>
</form>
@endsection

@section('script')
@endsection