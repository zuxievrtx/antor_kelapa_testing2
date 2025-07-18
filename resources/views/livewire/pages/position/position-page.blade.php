<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Jabatan</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Pengaturan Jabatan           
        <x-slot:button>      
            <x-button-primary @click="isModalOpen = true"> 
                <x-fas-plus-circle class="h-4 w-4 mr-2"/> 
                <span>Tambah</span>
            </x-button-primary>
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">        
        <div class="w-full overflow-x-auto">
            <livewire:pages.position.position-table />
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/3">
                <x-slot name="header">
                    <h3>{{($isEdit) ? "Edit" : "Tambah"}} Pengaturan Jabatan</h3>
                </x-slot>
                <div class="flex flex-col space-y-2">    
                    <x-input inline="false" label="Kode*" model="code"/> 
                    <x-input inline="false" label="Nama Jabatan*" model="name"/>    
                </div>
            </x-modal>
        </form>

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
