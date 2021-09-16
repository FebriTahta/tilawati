<table>
    <thead>
        <tr>
            <th>Nama Lengkap Peserta</th>
            <th>Alamat Lengkap</th>
            <th>Kota / Kabupaten</th>
            <th>No WA</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peserta as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->alamat }}</td>
                <td>
                    @if ($item->kabupaten == null)
                        -
                    @else
                        {{ $item->kabupaten->nama }}
                    @endif
                </td>
                <td>{{ $item->telp }}</td>
                <td>{{ $item->tmptlahir }}</td>
                <td>{{ $item->tgllahir }}</td>
            </tr>
        @endforeach
    </tbody>
</table>