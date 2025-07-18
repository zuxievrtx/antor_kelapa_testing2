<html>

<head>
    <title>Data User</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="6" style="text-align: center; font-size: 16pt; font-weight: bold;">Data User</th>
            </tr>
            <tr>
                <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">No</th>
                <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Nama
                </th>
                <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Alamat
                </th>
                <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Kontak
                </th>
                <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Email
                <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Website
                </th>
                <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Leader
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $c)
                <tr>
                    <td style="border: 1pt solid #000">{{ $loop->iteration }}</td>
                    <td style="border: 1pt solid #000">{{ $c->name }}</td>
                    <td style="border: 1pt solid #000">{{ $c->address }}</td>
                    <td style="border: 1pt solid #000">{{ $c->phone }}</td>
                    <td style="border: 1pt solid #000">{{ $c->email }}</td>
                    <td style="border: 1pt solid #000">{{ $c->website }}</td>
                    <td style="border: 1pt solid #000">{{ $c->leader }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
