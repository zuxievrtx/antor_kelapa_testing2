<x-table>
    <x-slot:thead>
        <tr>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">No Id</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Nama Pekerja</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Departemen</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Tanggal</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">On Duty</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Off Duty</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Check In</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Check Out</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Late</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Early</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Break Time</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Break Out</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Break In</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Gaji Harian</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Gaji Lembur</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Gaji Minggu</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Weekend</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Aksi</th>
        </tr>
    </x-slot>
    @forelse($salaries as $sal)
        <tr class="border-b dark:border-gray-700">
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
            <td class="py-3 px-2  border dark:border-gray-700"></td>
        </tr>
    @empty
        <tr class="border-b dark:border-gray-700">
            <td class="py-3 px-2  border dark:border-gray-700 text-center" colspan="18">Tidak ada data untuk ditampilkan. Pastikan telah memilih rentang waktu yang akan ditampilkan.</td>
        </tr>
    @endforelse
</x-table>