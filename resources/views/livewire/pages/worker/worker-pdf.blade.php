<html>
    <head>
        <title>Data Worker</title>
        <style>
            @page{
                size: A4 landscape;
            }
            table{
                width: 100%;
                border-collapse: collapse;
            }
            th, td{
                padding: 5px;
            }
        </style>
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
                </tr>
            @endforeach
            </tbody>
    </table>
    </body>
</html>