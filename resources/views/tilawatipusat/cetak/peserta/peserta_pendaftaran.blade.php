<style>
    .notel {
    mso-number-format: "\@";
    }
</style>
<?php 
    use PhpOffice\PhpSpreadsheet\Shared\Date;
?>
<table>
    <thead>
        <tr>
            <th>Nama Lengkap Peserta</th>
            <th>Diklat</th>
            <th>Alamat Lengkap</th>
            <th>Kota / Kabupaten</th>
            <th>No WA</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
        </tr>
    </thead>
    <tbody style="text-transform: uppercase; font-size: 12px">
        @foreach ($peserta as $item)
            <tr> 
                <td>{{ strtoupper($item->name) }}</td>
                <td>{{ strtoupper($item->program->name) }}</td>
                <td>{{ strtoupper($item->alamat) }}</td>
                <td>
                    @if ($item->kabupaten == null)
                        -
                    @else
                        {{ $item->kabupaten->nama }}
                    @endif
                </td>
                <?php $phone=substr($item->telp,2,15)?>
                @if (substr($item->telp,0,2)==62)
                    <td class="notel">{{"0".$phone}}</td>
                @elseif (substr($item->telp,0,1)==0)
                    <td class="notel">{{$item->telp}}</td>
                @endif
                
                
                <td>{{ $item->tmptlahir }}</td>
                
                <td>{{ 
                Date::dateTimeToExcel($item->tgllahir),
                }}</td>
            </tr>
        @endforeach
    </tbody>
</table>