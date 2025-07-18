<div>

    <x-page-header> Data Instruktur
        {{-- @if (auth()->user()->hasAnyPermission(['modify_people', 'add_people'])) --}}
        <x-slot:action>
            {{-- @can('add_people') --}}
            <x-dropdown-link @click="isModalOpen = true">
                <x-fas-plus-circle class="h-4 w-4 mr-2" />
                <span>Tambah User </span>
            </x-dropdown-link>
            {{-- @endcan --}}

            {{-- @can('modify_people') --}}
            {{-- @endcan --}}
        </x-slot>
        {{-- @endif --}}
    </x-page-header>
    <x-card class="mt-8">
        <livewire:pages.instructor.instructor-table>
            <x-alert />
            <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
    </x-card>


    {{-- Form Modal --}}
    <form wire:submit.prevent="save">
        <x-modal class="md:w-3/4">
            <x-slot name="header">
                {{ $isEdit ? 'Edit' : 'Tambah' }} Data Instruktur
            </x-slot>

            <div>
                <x-page-header> Data Instruktur</x-page-header>

                <x-card class="min-h-full">
                    <div class="grid grid-cols-1 gap-4">
                        <x-input inline="false" label="Nama*" model="name" />
                        <x-select inline="false" label="Perusahaan" model="company_id">
                            @foreach ($companies as $c)
                                <option value="">Pilih</option>
                                <option {{ $isEdit && $this->company_id == $c->id ? 'selected' : '' }}
                                    value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input inline="false" label="Kontak" model="hp" />
                        <x-input inline="false" label="Email" model="email" />
                    </div>

                </x-card>

            </div>

        </x-modal>
    </form>
    {{-- End Form Modal --}}
</div>
