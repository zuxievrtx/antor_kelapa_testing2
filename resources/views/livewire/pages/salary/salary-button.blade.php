<div class="block md:hidden">
    <x-dropdown contentClasses="p-2 bg-white dark:bg-gray-700" width="w-full">
        <x-slot name="trigger">
            <div class="flex justify-end">
                <x-button-primary> 
                    <span> Action </span>
                    <x-fas-angle-down class="h-4 w-4"/>   
                </x-button-primary>
            </div>
        </x-slot>
        <x-slot name="content">
            <x-dropdown-link class="px-4" wire:click="calculate"> 
                <x-fas-calculator class="h-4 w-4 mr-2"/> 
                <span>Kalkulasi</span>
            </x-dropdown-link>
            <x-dropdown-link class="px-4"> 
                <x-fas-print class="h-4 w-4 mr-2"/> 
                <span>Cetak Slip Gaji</span>
            </x-dropdown-link>
            <x-dropdown-link class="px-4"> 
                <x-fas-circle-plus class="h-4 w-4 mr-2"/> 
                <span>Input Manual</span>
            </x-dropdown-link>
        </x-slot>
    </x-dropdown>
</div>
<div class="hidden md:flex col-span-3 flex-col justify-end md:flex-row gap-2 items-stretch md:items-end">
    <x-button class="px-4" color="purple" wireclick="calculate"> 
        <x-fas-calculator class="h-4 w-4 mr-2"/> 
        <span>Kalkulasi</span>
    </x-button>
    <x-button class="px-4"> 
        <x-fas-print class="h-4 w-4 mr-2"/> 
        <span>Cetak Slip Gaji</span>
    </x-button>
    <x-button class="px-4" color="green"> 
        <x-fas-circle-plus class="h-4 w-4 mr-2"/> 
        <span>Input Manual</span>
    </x-button>
</div>