<x-table>
    <x-slot:thead>
        <tr>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">No Id</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Nama Pekerja</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Departemen</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Gaji Harian</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Gaji Lemburan</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Gaji Hari Libur</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Bonus Kehadiran</th>
            <th class="p-3 w-100  border dark:border-gray-700 text-center">Aksi</th>
        </tr>
    </x-slot>
    @forelse($services as $s)
        <tr class="border-b dark:border-gray-700">
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
            <td class="py-3 px-2  border dark:border-gray-700 text-center" colspan="8">Tidak ada data untuk ditampilkan.</td>
        </tr>
    @endforelse
</x-table>