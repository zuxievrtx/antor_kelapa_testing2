<div x-data="{ isImportOpen: false }">

    <x-page-header> Data Dudi
        {{-- @if (auth()->user()->hasAnyPermission(['modify_people', 'add_people'])) --}}
        <x-slot:action>
            {{-- @can('add_people') --}}
            <x-dropdown-link @click="isModalOpen = true">
                <x-fas-plus-circle class="h-4 w-4 mr-2" />
                <span>Tambah User </span>
            </x-dropdown-link>
            {{-- @endcan --}}

            {{-- @can('modify_people') --}}
            <x-dropdown-link @click="isImportOpen = true">
                <x-fas-file-excel class="h-4 w-4 mr-2" />
                <span>Import Data</span>

            </x-dropdown-link>
            <x-dropdown-link wire:click="exportToXLSX">
                <x-fas-file-excel class="h-4 w-4 mr-2" />
                <span>Export Excel </span>
            </x-dropdown-link>
            <x-dropdown-link wire:click="exportToPDF">
                <x-fas-file-pdf class="h-4 w-4 mr-2" />
                <span>Export PDF</span>
            </x-dropdown-link>
            {{-- @endcan --}}
        </x-slot>
        {{-- @endif --}}
    </x-page-header>
    <x-card class="mt-8">
        <livewire:pages.company.company-table>
            <x-alert />
            <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
            {{-- Import Modal --}}
            @include('livewire.pages.company.company-import')
            {{-- End Import Modal --}}
    </x-card>


    {{-- Form Modal --}}
    <form wire:submit.prevent="save">
        <x-modal class="md:w-1/2">
            <x-slot name="header">
                {{ $isEdit ? 'Edit' : 'Tambah' }} Data Dudi
            </x-slot>

            <div>
                <x-page-header> Data Dudi</x-page-header>

                <x-card class="min-h-full">
                    <div class="grid grid-cols-1 gap-4">
                        <x-input inline="false" label="Nama*" model="name" />
                        <x-input inline="false" label="Alamat*" model="address" />
                        <x-input inline="false" label="Kontak" model="phone" />
                        <x-input inline="false" label="Email" model="email" />
                        <x-input inline="false" label="Website" model="website" />
                        <x-input inline="false" label="Leader" model="leader" />
                    </div>

                </x-card>

            </div>

        </x-modal>
    </form>
    {{-- End Form Modal --}}
</div>
