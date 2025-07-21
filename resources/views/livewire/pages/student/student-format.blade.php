<table>
    <thead>
        <tr>
            <th>nis</th>
            <th>nama</th>
            <th>kelas</th>
            <th>jenis_kelamin</th>
            <th>alamat</th>
            <th>hp</th>
            <th>tahun</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>2024001</td>
            <td>Contoh Siswa</td>
            <td>A</td>
            <td>L</td>
            <td>Jl. Contoh No. 123</td>
            <td>081234567890</td>
            <td>2024</td>
        </tr>
    </tbody>
</table>

<br><br>

<table>
    <thead>
        <tr>
            <th colspan="3">Daftar Kelas yang Tersedia</th>
        </tr>
        <tr>
            <th>Nama Kelas</th>
            <th>Jurusan</th>
            <th>Tingkat</th>
        </tr>
    </thead>
    <tbody>
        @foreach($classRooms as $classRoom)
        <tr>
            <td>{{ $classRoom->name }}</td>
            <td>{{ $classRoom->major->name }} ({{ $classRoom->major->short_name }})</td>
            <td>{{ $classRoom->grade }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br><br>

<table>
    <thead>
        <tr>
            <th colspan="2">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>jenis_kelamin</td>
            <td>L = Laki-laki, P = Perempuan</td>
        </tr>
        <tr>
            <td>kelas</td>
            <td>Gunakan nama kelas yang sesuai dengan daftar di atas</td>
        </tr>
        <tr>
            <td>tahun</td>
            <td>Tahun pelaksanaan PKL (contoh: 2024)</td>
        </tr>
        <tr>
            <td>alamat & hp</td>
            <td>Boleh dikosongkan</td>
        </tr>
    </tbody>
</table>