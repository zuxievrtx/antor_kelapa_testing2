<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Jam Kerja</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Pengaturan Jam Kerja
        <x-slot:action>      
            <x-dropdown-link @click="isModalOpen = true"> 
                <x-fas-plus-circle class="h-4 w-4 mr-2"/> 
                <span>Tambah Jam Kerja </span>
            </x-dropdown-link>
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">        
        <div class="w-full overflow-x-auto">
            <livewire:pages.work-hour.work-hour-table />
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/2">
                <x-slot name="header">
                    <h3>{{($isEdit) ? "Edit" : "Tambah"}} Jam Kerja</h3>
                </x-slot>
                <div class="flex flex-col space-y-2">    
                    <x-input inline="false" label="Nama Jam Kerja*" model="name"/>                         
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <x-input type="time" inline="false" label="Jam Masuk*" model="cin_time"/> 
                        <x-input type="time" inline="false" label="Mulai C/In*" model="cin_start"/> 
                        <x-input type="time" inline="false" label="Akhir C/In*" model="cin_end"/> 
                    </div>                        
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <x-input type="time" inline="false" label="Jam Pulang*" model="cout_time"/> 
                        <x-input type="time" inline="false" label="Mulai C/Out*" model="cout_start"/> 
                        <x-input type="time" inline="false" label="Akhir C/Out*" model="cout_end"/> 
                    </div> 
                        
                    <div class="mt-4">Pilih jam kerja yang akan diterapkan: </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-4 md:grid-cols-7"> 
                        @foreach($dayOptions as $day)
                            <x-checkbox value="{{ $day }}" model="selectedDays" label="{{ $day }}" />
                        @endforeach
                    </div>
                </div>
            </x-modal>
        </form>

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
