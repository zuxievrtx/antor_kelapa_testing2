<table>
    <thead>
        <tr>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Tingkat</th>
            <th>Jenis Kelamin</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>No. HP</th>
            <th>Tahun PKL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $student->nis }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->classRoom->name }}</td>
            <td>{{ $student->classRoom->major->name }}</td>
            <td>{{ $student->classRoom->grade }}</td>
            <td>{{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->address }}</td>
            <td>{{ $student->hp }}</td>
            <td>{{ $student->year }}</td>
        </tr>
        @endforeach
    </tbody>
</table>