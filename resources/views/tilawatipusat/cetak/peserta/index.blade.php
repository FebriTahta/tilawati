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
    </thead>
    <tbody>
        @foreach ($peserta as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <th>
                    @if ($item->kabupaten == null)
                        -
                    @else
                        {{ $item->kabupaten->nama }}
                    @endif
                </th>
                <th>{{ $item->pelatihan->program->name }}</th>
                <th>{{ $item->pelatihan->tanggal }}</th>
                <th>{{ $item->pelatihan->cabang->name }}</th>
                <th>{{ $item->telp }}</th>
            </tr>
        @endforeach
    </tbody>
</table>