<table>
    <thead>
        <tr>
            <th>Nama Peserta</th>
            <th>Asal</th>
            <th>Diklat</th>
            <th>Tanggal</th>
            <th>Penyelenggara</th>
            <th>phone</th>
        </tr>
    </thead >
    <tbody style="text-transform: uppercase; font-size: 12px">
        @foreach ($peserta as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>
                    @if ($item->kabupaten == null)
                        -
                    @else
                        {{ $item->kabupaten->nama }}
                    @endif
                </td>
                <td>{{ $item->pelatihan->program->name }}</td>
                <td>{{ $item->pelatihan->tanggal }}</td>
                <td>{{ $item->pelatihan->cabang->name }}</td>
                <td>{{ $item->telp }}</td>
            </tr>
        @endforeach
    </tbody>
</table>