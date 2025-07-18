<div  x-data="{isSettingOpen: false}" x-on:open-setting.window="isSettingOpen = true"
    x-on:close-setting.window="isSettingOpen = false"
>
    <x-backdrop show="isSettingOpen" onclose="isSettingOpen = false"/>
    <div
        x-transition:enter="transition duration-300 ease-in-out transform"
        x-transition:enter-start="-translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition duration-300 ease-in-out transform"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="-translate-y-full"
        x-show="isSettingOpen"
        class="fixed left-0 top-0 z-20 w-full h-full flex items-center justify-center"
    >
        <form wire:submit.prevent="changeSetting">
            <x-dialog class="md:w-1/2">
                <x-slot name="header">
                    <h3>Pengaturan Izin Group</h3>                    
                    <button type="button"  @click="isSettingOpen=false" wire:click="resetForm()" >
                        <x-fas-times class="w-4 h-4"/>
                    </button>
                </x-slot>
                <x-table>
                    <x-slot:thead>
                        <tr>
                            <th class="p-3 text-center" rowspan="2">NAMA MODUL</th>
                            <th class="p-3 text-center" colspan="5">IZIN</th>
                        </tr>
                        <tr>
                            <th class="p-3 text-center">LIHAT</th>
                            <th class="p-3 text-center">TAMBAH</th>
                            <th class="p-3 text-center">EDIT</th>
                            <th class="p-3 text-center">HAPUS</th>
                            <th class="p-3 text-center">LAINYA</th>
                        </tr>
                    </x-slot>
                    <tr class="border-b dark:border-gray-700">
                        <td class="p-3">JASA</td>
                        @foreach($permissionData['service'] as $p)
                        <td class="p-3">
                            <div class="flex justify-center"><x-checkbox value="{{ $p }}" model="permissions" /></div>
                        </td>
                        @endforeach
                    </tr>      

                    <tr class="border-b dark:border-gray-700">
                        <td class="p-3">PERSONIL</td>
                        @foreach($permissionData['people'] as $p)
                        <td class="p-3">
                            <div class="flex justify-center"><x-checkbox value="{{ $p }}" model="permissions" /></div>
                        </td>
                        @endforeach
                    </tr>
                    
                    <tr class="border-b dark:border-gray-700">
                        <td class="p-3">DEPARTEMEN</td>
                        @foreach($permissionData['department'] as $p)
                        <td class="p-3">
                            <div class="flex justify-center"><x-checkbox value="{{ $p }}" model="permissions" /></div>
                        </td>
                        @endforeach
                    </tr>
                    
                    <tr class="border-b dark:border-gray-700">
                        <td class="p-3">GAJI</td>
                        @foreach($permissionData['salary'] as $p)
                        <td class="p-3">
                            <div class="flex justify-center"><x-checkbox value="{{ $p }}" model="permissions" /></div>
                        </td>
                        @endforeach
                    </tr>
                    
                    <tr class="border-b dark:border-gray-700">
                        <td class="p-3">PINJAMAN</td>
                        @foreach($permissionData['loan'] as $p)
                        <td class="p-3">
                            <div class="flex justify-center"><x-checkbox value="{{ $p }}" model="permissions" /></div>
                        </td>
                        @endforeach
                    </tr>
                    
                    <tr class="border-b dark:border-gray-700">
                        <td class="p-3">PENGATURAN JADWAL KERJA</td>
                        @foreach($permissionData['schedule'] as $p)
                        <td class="p-3">
                            <div class="flex justify-center"><x-checkbox value="{{ $p }}" model="permissions" /></div>
                        </td>
                        @endforeach
                    </tr>
                    
                    <tr class="border-b dark:border-gray-700">
                        <td class="p-3">LAPORAN</td>
                        @foreach($permissionData['report'] as $p)
                        <td class="p-3">
                            <div class="flex justify-center"><x-checkbox value="{{ $p }}" model="permissions" /></div>
                        </td>
                        @endforeach
                    </tr>
                </x-table>
                                
                <x-slot name="footer">                    
                    <x-button onclick="isSettingOpen=false" wireclick="resetForm()" color="red-500">
                        <x-fas-times-circle class="h-4 w-4"/>    
                        <span> Batal </span>
                    </x-button>
                    <x-button type="submit" color="primary">
                        <x-fas-save class="h-4 w-4"/>    
                        <span> Simpan </span>
                    </x-button>
                </x-slot>
            </x-dialog>
        </form>
    </div>
</div>