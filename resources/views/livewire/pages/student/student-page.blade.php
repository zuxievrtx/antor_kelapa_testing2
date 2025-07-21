<div>
    <x-page-header> Data Siswa
        <x-slot:action>
            <x-dropdown-link @click="isModalOpen = true">
                <x-fas-plus-circle class="h-4 w-4 mr-2" />
                <span>Tambah Siswa</span>
            </x-dropdown-link>
            <x-dropdown-link wire:click="export">
                <x-fas-download class="h-4 w-4 mr-2" />
                <span>Export Data</span>
            </x-dropdown-link>
            <x-dropdown-link wire:click="downloadFormat">
                <x-fas-file-excel class="h-4 w-4 mr-2" />
                <span>Download Format</span>
            </x-dropdown-link>
            <x-dropdown-link @click="$wire.set('showImport', true)">
                <x-fas-upload class="h-4 w-4 mr-2" />
                <span>Import Data</span>
            </x-dropdown-link>
        </x-slot>
    </x-page-header>
    
    <x-card class="mt-8">
        <livewire:pages.student.student-table>
        <x-alert />
        <x-confirm-delete>Yakin akan menghapus data siswa?</x-confirm-delete>
    </x-card>

    {{-- Import Modal --}}
    @if(isset($showImport) && $showImport)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Import Data Siswa</h3>
            <form wire:submit.prevent="import">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih File Excel</label>
                    <input type="file" wire:model="file" accept=".xlsx,.xls,.csv" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    @error('file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Import</button>
                    <button type="button" wire:click="$set('showImport', false)" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Form Modal --}}
    <form wire:submit.prevent="save">
        <x-modal class="md:w-3/4">
            <x-slot name="header">
                {{ $isEdit ? 'Edit' : 'Tambah' }} Data Siswa
            </x-slot>

            <div>
                <x-page-header>Data Siswa</x-page-header>

                <x-card class="min-h-full">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input inline="false" label="NIS*" model="nis" />
                        <x-input inline="false" label="Nama*" model="name" />
                        
                        <x-select inline="false" label="Kelas*" model="class_id">
                            <option value="">Pilih Kelas</option>
                            @foreach ($classRooms as $classRoom)
                                <option {{ $isEdit && $this->class_id == $classRoom->id ? 'selected' : '' }}
                                    value="{{ $classRoom->id }}">{{ $classRoom->major->short_name }} - {{ $classRoom->name }} (Tingkat {{ $classRoom->grade }})</option>
                            @endforeach
                        </x-select>

                        <x-select inline="false" label="Jenis Kelamin*" model="gender">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option {{ $isEdit && $this->gender == 'L' ? 'selected' : '' }} value="L">Laki-laki</option>
                            <option {{ $isEdit && $this->gender == 'P' ? 'selected' : '' }} value="P">Perempuan</option>
                        </x-select>

                        <x-input inline="false" label="Tahun PKL*" model="year" type="number" min="2020" max="{{ date('Y') + 5 }}" />
                        
                        <x-input inline="false" label="No. HP" model="hp" />
                        
                        <div class="md:col-span-2">
                            <x-input inline="false" label="Alamat" model="address" />
                        </div>
                        
                        @if($isEdit)
                            <div class="md:col-span-2">
                                <x-input inline="false" label="Email" model="email" type="email" readonly />
                            </div>
                        @endif
                    </div>
                </x-card>
            </div>
        </x-modal>
    </form>
    {{-- End Form Modal --}}
</div>