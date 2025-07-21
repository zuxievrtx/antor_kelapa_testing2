<div>
    <x-page-header> Data Jurusan
        <x-slot:action>
            <x-dropdown-link @click="isModalOpen = true">
                <x-fas-plus-circle class="h-4 w-4 mr-2" />
                <span>Tambah Jurusan</span>
            </x-dropdown-link>
        </x-slot>
    </x-page-header>
    
    <x-card class="mt-8">
        <livewire:pages.major.major-table>
        <x-alert />
        <x-confirm-delete>Yakin akan menghapus data jurusan?</x-confirm-delete>
    </x-card>

    {{-- Form Modal --}}
    <form wire:submit.prevent="save">
        <x-modal class="md:w-1/2">
            <x-slot name="header">
                {{ $isEdit ? 'Edit' : 'Tambah' }} Data Jurusan
            </x-slot>

            <div>
                <x-page-header>Data Jurusan</x-page-header>

                <x-card class="min-h-full">
                    <div class="grid grid-cols-1 gap-4">
                        <x-input inline="false" label="Nama Jurusan*" model="name" />
                        <x-input inline="false" label="Singkatan*" model="short_name" placeholder="Contoh: RPL, TKJ" />
                    </div>
                </x-card>
            </div>
        </x-modal>
    </form>
    {{-- End Form Modal --}}
</div>