<html>
    <table>
        <thead>
            <tr>
                <th>cabang</th>
                <th>provinsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <td>{{ $item->name }}</td>
                <td>{{ $item->provinsi->nama }}</td>
            @endforeach
        </tbody>
    </table>
</html>