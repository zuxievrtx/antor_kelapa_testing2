<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pinjaman</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">List Tabungan</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header dropdownWidth="64"> List Tabungan
        @can('add_loan')
        <x-slot:button>      
            <x-button-primary @click="isModalOpen = true"> 
                <x-fas-plus-circle class="h-4 w-4 mr-2"/> 
                <span>Tambah </span>
            </x-button-primary>
        </x-slot>
        @endcan
    </x-page-header>

    <x-card class="min-h-full">        
        <div class="w-full overflow-x-auto">
            <livewire:pages.saving.saving-table />
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/3">
                <x-slot name="header">
                    <h3>{{($isEdit) ? "Edit" : "Tambah"}} Tabungan</h3>
                </x-slot>
                <div class="flex flex-col space-y-2">  
                    <x-input-date inline="false" label="Tanggal*" model="saving_date"/>    
                    <x-select inline="false" label="Pekerja*" model="worker" >
                        <option value=""></option>
                        @foreach($workers as $wk)
                            <option value="{{$wk->id}}"> {{ $wk->name }} </option>
                        @endforeach
                    </x-select>     
                    <x-input-mask inline="false" label="Jumlah Tabungan*" model="amount"/>   
                    <x-textarea inline="false" label="Keterangan" model="description"/>    
                </div>
            </x-modal>
        </form>

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
