<html>
    <head>
        <title>Data Worker</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="6" style="text-align: center; font-size: 16pt; font-weight: bold;">Data Worker</th>
                </tr>
                <tr>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">No</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Nama Pekerja</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">NIK</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Tanggal Lahir</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Telepon</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Alamat</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Departemen</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Divisi</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Status</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Jabatan</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Tanggal Masuk</th>
                </tr>
            </thead>
            <tbody>
            @foreach($workers as $worker)
                <tr>
                    <td style="border: 1pt solid #000">{{ $loop->iteration }}</td>
                    <td style="border: 1pt solid #000">{{ $worker->name }}</td>
                    <td style="border: 1pt solid #000">{{ $worker->nik }}</td>
                    <td style="border: 1pt solid #000">{{ $worker->dob }}</td>
                    <td style="border: 1pt solid #000">{{ $worker->telp }}</td>
                    <td style="border: 1pt solid #000">{{ $worker->address }}</td>
                    <td style="border: 1pt solid #000">{{ ($worker->division) ? $worker->division->name : '' }}</td>
                    <td style="border: 1pt solid #000">{{ ($worker->department) ? $worker->department->name : '' }}</td>
                    <td style="border: 1pt solid #000">{{ ($worker->status) ? $worker->status->name : '' }}</td>
                    <td style="border: 1pt solid #000">{{ ($worker->position) ? $worker->position->name : '' }}</td>
                    <td style="border: 1pt solid #000">{{ $worker->start_work_at }}</td>
                </tr>
            @endforeach
            </tbody>
    </table>
    </body>
</html>