<html>
    <head>
        <title>Data Jasa</title>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th colspan="8" style="text-align: center; font-size: 16pt; font-weight: bold;">Data Jasa</th>
                </tr>
                <tr>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">No</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Id</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Nama Worker</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Gaji Harian</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Gaji Lemburan</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Gaji Hari Libur</th>
                    <th style="text-align: center; font-weight: bold; border: 1pt solid #000; background-color: gray">Bonus Kehadiran</th>
                </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
                <tr>
                    <td style="border: 1pt solid #000">{{ $loop->iteration }}</td>
                    <td style="border: 1pt solid #000">{{ $service->worker_id }}</td>
                    <td style="border: 1pt solid #000">{{ $service->worker ? $service->worker->name : ''}}</td>
                    <td style="border: 1pt solid #000">{{ $service->daily_salary }}</td>
                    <td style="border: 1pt solid #000">{{ $service->overtime_salary }}</td>
                    <td style="border: 1pt solid #000">{{ $service->holiday_salary }}</td>
                    <td style="border: 1pt solid #000">{{ $service->attendance_bonus }}</td>
                </tr>
            @endforeach
            </tbody>
    </table>
    </body>
</html>