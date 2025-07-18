<div  x-data="{isTransferOpen: false}" x-on:open-transfer.window="isTransferOpen = true"
    x-on:close-transfer.window="isTransferOpen = false"
>
    <x-backdrop show="isTransferOpen" onclose="isTransferOpen = false"/>
    <div
        x-transition:enter="transition duration-300 ease-in-out transform"
        x-transition:enter-start="-translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition duration-300 ease-in-out transform"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="-translate-y-full"
        x-show="isTransferOpen"
        class="fixed left-0 top-0 z-20 w-full h-full flex items-center justify-center"
    >
        <form wire:submit.prevent="transferDepartment">
            <x-dialog class="md:w-1/2">
                <x-slot name="header">
                    <h3>Transfer Departemen</h3>                    
                    <button type="button"  @click="isTransferOpen=false" wire:click="resetForm()" >
                        <x-fas-times class="w-4 h-4"/>
                    </button>
                </x-slot>
                <div class="flex flex-col space-y-2 px-4 py-6">    
                    <x-select inline="false" label="Pilih Departemen*" model="department">  
                        <option value=""></option>
                        @foreach($departments as $dep)
                            <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                        @endforeach
                    </x-select>
                </div>
                <x-slot name="footer">                    
                    <x-button onclick="isTransferOpen=false" wireclick="resetForm()" color="red-500">
                        <x-fas-times-circle class="h-4 w-4"/>    
                        <span> Batal </span>
                    </x-button>
                    <x-button type="submit" color="primary">
                        <x-fas-arrow-right-arrow-left class="h-4 w-4"/>    
                        <span> Transfer </span>
                    </x-button>
                </x-slot>
            </x-dialog>
        </form>
        </div>
    </div>
</div>