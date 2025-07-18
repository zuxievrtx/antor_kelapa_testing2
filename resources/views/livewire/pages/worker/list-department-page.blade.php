<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Departemen</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">List Departemen</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header dropdownWidth="64"> List Departemen
        <x-slot:filter>
            <div class="w-80">   
                <x-select model="department_id" live="true">
                    <option value="0">Pilih Departemen</option> 
                    @foreach($departments as $dep)
                        <option value="{{$dep->id}}"> {{ $dep->name }} </option>
                    @endforeach
                </x-select>
            </div>
        </x-slot>

        @can('add_department')
        <x-slot:action>      
            <x-dropdown-link @click="isModalOpen = true"> 
                <x-fas-plus-circle class="h-4 w-4 mr-2"/> 
                <span>Tambah Departemen </span>
            </x-dropdown-link>
        </x-slot>
        @endcan
    </x-page-header>

    <x-card class="min-h-full">        
        <div class="w-full overflow-x-auto">
            <livewire:pages.worker.list-department-table :department="$department_id" :key="time()"/>
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/3">
                <x-slot name="header">
                    <h3>{{($isEdit) ? "Edit" : "Tambah"}} Pekerja</h3>
                </x-slot>
                <div class="flex flex-col space-y-2">    
                    <x-select label="Pekerja*" model="worker" >
                        <option value=""></option>
                        @foreach($workers as $wk)
                            <option value="{{$wk->id}}"> {{ $wk->name }} </option>
                        @endforeach
                    </x-select>     
                    <x-select label="Departemen*" model="department" >
                        <option value=""></option>
                        @foreach($departments as $dep)
                            <option value="{{$dep->id}}"> {{ $dep->name }} </option>
                        @endforeach
                    </x-select>    
                    <x-select label="Divisi*" model="division" >
                        <option value=""></option>
                        @foreach($divisions as $div)
                            <option value="{{$div->id}}"> {{ $div->name }} </option>
                        @endforeach
                    </x-select>   
                </div>
            </x-modal>
        </form>

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
