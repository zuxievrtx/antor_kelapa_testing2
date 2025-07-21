<div>
    <x-page-header> Data Kelas
        <x-slot:action>
            <x-dropdown-link @click="isModalOpen = true">
                <x-fas-plus-circle class="h-4 w-4 mr-2" />
                <span>Tambah Kelas</span>
            </x-dropdown-link>
        </x-slot>
    </x-page-header>
    
    <x-card class="mt-8">
        <livewire:pages.class-room.class-room-table>
        <x-alert />
        <x-confirm-delete>Yakin akan menghapus data kelas?</x-confirm-delete>
    </x-card>

    {{-- Form Modal --}}
    <form wire:submit.prevent="save">
        <x-modal class="md:w-1/2">
            <x-slot name="header">
                {{ $isEdit ? 'Edit' : 'Tambah' }} Data Kelas
            </x-slot>

            <div>
                <x-page-header>Data Kelas</x-page-header>

                <x-card class="min-h-full">
                    <div class="grid grid-cols-1 gap-4">
                        <x-select inline="false" label="Jurusan*" model="major_id">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($majors as $major)
                                <option {{ $isEdit && $this->major_id == $major->id ? 'selected' : '' }}
                                    value="{{ $major->id }}">{{ $major->name }} ({{ $major->short_name }})</option>
                            @endforeach
                        </x-select>
                        <x-input inline="false" label="Nama Kelas*" model="name" placeholder="Contoh: A, B, C" />
                        <x-select inline="false" label="Tingkat*" model="grade">
                            <option value="">Pilih Tingkat</option>
                            <option {{ $isEdit && $this->grade == 1 ? 'selected' : '' }} value="1">1</option>
                            <option {{ $isEdit && $this->grade == 2 ? 'selected' : '' }} value="2">2</option>
                            <option {{ $isEdit && $this->grade == 3 ? 'selected' : '' }} value="3">3</option>
                        </x-select>
                    </div>
                </x-card>
            </div>
        </x-modal>
    </form>
    {{-- End Form Modal --}}
</div>