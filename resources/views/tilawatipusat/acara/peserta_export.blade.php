<table>
    <thead>
        <tr>
            <th>Nama Peserta</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Donatur</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($peserta as $item)
            <tr>
                <td>{{ strtoupper($item->name) }}</td>
                <td>{{ $item->telp }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ strtoupper($item->provinsi->nama) }}</td>
                <td>{{ strtoupper($item->kabupaten->nama) }}</td>
                <td>{{ strtoupper($item->kecamatan->nama) }}</td>
                <td>
                    @if ($item->donatur->data == 1)
                        DONATUR LAZIZ NURUL FALAH
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>