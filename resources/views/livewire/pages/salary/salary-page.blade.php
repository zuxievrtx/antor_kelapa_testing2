<div class="flex flex-col space-y-3" x-data="{isImportOpen: false}" >
    <x-breadcrumbs>
        <x-breadcrumbs-link>Gaji</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Data Gaji</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Data Gaji</x-page-header>


    <x-card class="min-h-full">      
        <div class="flex flex-row items-end border-b pb-3">
            <div class="flex-1 grid grid-cols-1 gap-4 md:grid-cols-4">
                <div class="flex flex-col">
                    <div>Rentang Waktu:</div>
                    <div class="flex flex-row items-center">
                        <div class="pr-2">Dari: </div>
                        <x-input-date inline="true" label="" model="date_start" :live="true"/>  
                        <div class="px-2">s/d </div>
                        <x-input-date inline="true" label="" model="date_end" :live="true"/>  
                    </div>
                </div>
                @include('livewire.pages.salary.salary-button')
            </div>
        </div>

        <div class="w-full overflow-x-auto mt-4">
            <livewire:pages.salary.salary-table :date_start='$date_start' :date_end='$date_end' :key='time()'/>
        </div>

    </x-card>
</div>
