<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Pengaturan Group</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Pengaturan Group
        <x-slot:action>      
            <x-dropdown-link @click="isModalOpen = true"> 
                <x-fas-plus-circle class="h-4 w-4 mr-2"/> 
                <span>Tambah Group </span>
            </x-dropdown-link>
        </x-slot>
    </x-page-header>

    <x-card class="min-h-full">        
        <div class="w-full overflow-x-auto">
            <livewire:pages.role.role-table />
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/3">
                <x-slot name="header">
                    <h3>{{($isEdit) ? "Edit" : "Tambah"}} Pengaturan Group</h3>
                </x-slot>
                <div class="flex flex-col space-y-2">    
                    <x-input inline="false" label="Nama Group*" model="name"/>  
                    <x-input inline="false" label="Deskripsi Group*" model="description"/>   
                </div>
            </x-modal>
        </form>

        @include('livewire.pages.role.role-setting')

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
