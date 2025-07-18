<div class="flex flex-col space-y-3" x-data="{isImportOpen: false}" >
    <x-breadcrumbs>
        <x-breadcrumbs-link>Gaji</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">List Jasa</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Data Jasa
        @if(auth()->user()->hasAnyPermission(['modify_service', 'add_service']))
        <x-slot:action>     
            @can('modify_service')
            <x-dropdown-link wire:click="exportExcel" > 
                <x-fas-file-excel class="h-4 w-4 mr-2"/> 
                <span>Export Excel </span>
            </x-dropdown-link>
            
            <x-dropdown-link @click="isImportOpen = true" > 
                <x-fas-file-import class="h-4 w-4 mr-2"/> 
                <span>Import Excel </span>
            </x-dropdown-link>
            @endcan
        </x-slot>
        @endif
    </x-page-header>

    <x-card class="min-h-full">        
        <div class="w-full overflow-x-auto">
            <livewire:pages.service.service-table />
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/3">
                <x-slot name="header">
                    <h3>{{($isEdit) ? "Edit" : "Tambah"}} Data Jasa</h3>
                </x-slot>
                <div class="flex flex-col space-y-2">    
                    <x-input type="number" label="Gaji Harian (menit)*" model="daily_salary"/>  
                    <x-input type="number" label="Gaji Lemburan (menit)*" model="overtime_salary"/>  
                    <x-input type="number" label="Gaji Libur (menit)*" model="holiday_salary"/>  
                    <x-input type="number" label="Bonus Kehadiran*" model="attendance_bonus"/>  
                </div>
            </x-modal>
        </form>

        @include('livewire.pages.service.service-import')

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert />
    </x-card>
</div>
