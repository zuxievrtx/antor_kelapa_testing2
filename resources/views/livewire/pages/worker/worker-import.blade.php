<div  x-on:close-import.window="isImportOpen = false">
    <x-backdrop show="isImportOpen" onclose="isImportOpen = false"/>
    <div
        x-transition:enter="transition duration-300 ease-in-out transform"
        x-transition:enter-start="-translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition duration-300 ease-in-out transform"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="-translate-y-full"
        x-show="isImportOpen"
        class="fixed left-0 top-0 z-20 w-full h-full flex items-center justify-center"
    >
        <form wire:submit.prevent="importWorker">
            <x-dialog class="md:w-1/2">
                <x-slot name="header">
                    <h3>Import Pekerja</h3>                    
                    <button type="button"  @click="isImportOpen=false" wire:click="resetForm()" >
                        <x-fas-times class="w-4 h-4"/>
                    </button>
                </x-slot>
                <div class="flex flex-col space-y-2 px-4 py-6">    
                    <x-info>
                        Import hanya dari file dengan format sesuai yang ditentukan atau dari hasil backup mesin.

                        <div class="mt-4">
                            <x-button wireclick="downloadFormat()" color="green-500">
                                <x-fas-download class="h-4 w-4"/>    
                                <span> Download Format </span>
                            </x-button>
                        </div>
                    </x-info>
                    <x-input type="file" inline="false" label="File Import*" model="file_import"/>  
                </div>
                <x-slot name="footer">                    
                    <x-button onclick="isImportOpen=false" wireclick="resetForm()" color="red-500">
                        <x-fas-times-circle class="h-4 w-4"/>    
                        <span> Batal </span>
                    </x-button>
                    <x-button-primary type="submit" color="primary">
                        <x-fas-file-import class="h-4 w-4"/>    
                        <span> Import </span>
                    </x-button-primary>
                </x-slot>
            </x-dialog>
        </form>
    </div>
</div>