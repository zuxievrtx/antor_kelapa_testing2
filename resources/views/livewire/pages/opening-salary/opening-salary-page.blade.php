<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Gaji</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Gaji Awal</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Gaji Awal
        <x-slot:action>      
            <x-dropdown-link @click="isModalOpen = true"> 
                <x-fas-plus-circle class="h-4 w-4 mr-2"/> 
                <span>Tambah Gaji Awal</span>
            </x-dropdown-link>
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">        
        <div class="w-full overflow-x-auto">
            <livewire:pages.opening_salary.opening_salary-table />
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/3">
                <x-slot name="header">
                    <h3>{{($isEdit) ? "Edit" : "Tambah"}} Gaji Awal</h3>
                </x-slot>
                <div class="flex flex-col space-y-2">    
                    <x-input-date label="Tanggal*" model="date"/> 
                    <x-select label="Pekerja*" model="worker" >
                        <option value=""></option>
                        @foreach($workers as $wk)
                            <option value="{{$wk->id}}"> {{ $wk->name }} </option>
                        @endforeach
                    </x-select>    
                    <x-input-mask label="Nominal*" model="amount"/>    
                </div>
            </x-modal>
        </form>

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
