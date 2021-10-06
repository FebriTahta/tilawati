@extends('layouts.tilawatipusat_layouts.master')

@section('content')
@component('common-tilawatipusat.breadcrumb')
@slot('title') UPDATE   @endslot
@slot('title_li') PESERTA   @endslot
@endcomponent
<div class="row">
    <div class="form-group col-xl-6">
        <label for="nama">Nama Peserta</label>
        <input type="text" class="form-control" id="nama" name="name" required>    
    </div>    
</div>    
@endsection

@section('script')
@endsection