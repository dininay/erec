<table>
    <thead>
        <tr>
            <th>ID Apply</th>
            <th>User ID</th>
            <th>Register ID</th>
            <th>Email</th>
            <th>Nama Lengkap</th>
            <!-- Tambahkan kolom lain sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->apply_id }}</td>
            <td>{{ $item->user_id }}</td>
            <td>{{ $item->reg_id }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->name }}</td>
            <!-- Tambahkan kolom lain sesuai kebutuhan -->
        </tr>
        @endforeach
    </tbody>
</table>
