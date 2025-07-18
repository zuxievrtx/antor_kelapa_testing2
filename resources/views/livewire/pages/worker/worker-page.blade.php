<div class="flex flex-col space-y-3" x-data="{isImportOpen: false}" >
    <x-breadcrumbs>
        <x-breadcrumbs-link>Personalia</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Pekerja</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Data Pekerja
        @if(auth()->user()->hasAnyPermission(['modify_people', 'add_people']))
        <x-slot:action>     
            @can('add_people') 
            <x-dropdown-link @click="isModalOpen = true"> 
                <x-fas-plus-circle class="h-4 w-4 mr-2"/> 
                <span>Tambah Pekerja </span>
            </x-dropdown-link>
            @endcan

            @can('modify_people')
            <x-dropdown-link @click="isImportOpen = true" > 
                <x-fas-file-import class="h-4 w-4 mr-2"/> 
                <span>Import Excel </span>
            </x-dropdown-link>
            <x-dropdown-link wire:click="exportExcel" > 
                <x-fas-file-excel class="h-4 w-4 mr-2"/> 
                <span>Export Excel </span>
            </x-dropdown-link>
            <x-dropdown-link  wire:click="exportPDF" > 
                <x-fas-file-pdf class="h-4 w-4 mr-2"/> 
                <span>Export PDF</span> 
            </x-dropdown-link>
            @endcan
        </x-slot>
        @endif
    </x-page-header>

    <x-card class="min-h-full">        
        <div class="w-full overflow-x-auto">
            <livewire:pages.worker.worker-table />
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-2/3">
                <x-slot name="header">
                    <h3>{{($isEdit) ? "Edit" : "Tambah"}} Data Pekerja</h3>
                </x-slot>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="flex flex-col space-y-2">    
                        <x-input inline="false" label="No ID*" model="noid"/>  
                        <x-input inline="false" label="Nama Pekerja*" model="name"/>  
                        <x-input inline="false" label="NIK*" model="nik"/>  
                        <x-input-date inline="false" label="Tanggal Lahir*" model="dob"/>  
                        <x-input inline="false" label="No. Telepon" model="telp"/>  
                        <x-input inline="false" label="Alamat" model="address"/>  
                        <x-select inline="false" label="Divisi*" model="division">  
                            <option value=""></option>
                            @foreach($divisions as $div)
                                <option value="{{ $div->id }}">{{ $div->name }}</option>
                            @endforeach
                        </x-select>
                        
                        <x-select inline="false" label="Departemen*" model="department">  
                            <option value=""></option>
                            @foreach($departments as $dep)
                                <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="flex flex-col space-y-2">    
                        <x-select inline="false" label="Status*" model="status">
                            <option value=""></option>
                            @foreach($statuses as $stt)
                                <option value="{{ $stt->id }}">{{ $stt->name }}</option>
                            @endforeach
                        </x-select>
                        <x-select inline="false" label="Jabatan*" model="position"> 
                            <option value=""></option>
                            @foreach($positions as $pos)
                                <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                            @endforeach
                        </x-select> 
                        <x-input-date inline="false" label="Tanggal Masuk" model="start_work_at"/>  
                        <x-input inline="false" label="No. Rekening" model="bank_account"/>  
                        <x-input inline="false" label="Nama Rekening" model="account_name"/> <x-dropzone accept="image/*" 
                            label="Foto" model="filePhoto" fileurl="{{$photo}}" inline="false" height="80">
                            @if($filePhoto)
                                <img src="{{ $filePhoto->temporaryUrl() }}" width="150">    
                            @elseif($photo) 
                                <img src="/storage/user/{{$photo}}" width="150">
                            @endif 
                        </x-dropzone>   
                    </div>
                </div>
            </x-modal>
        </form>

        @include('livewire.pages.worker.worker-transfer')
        @include('livewire.pages.worker.worker-import')

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
