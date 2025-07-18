<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pengaturan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Jadwal Kerja</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-card class="min-h-full">      
        <div class="flex flex-row items-end">
            <div class="flex-1 grid grid-cols-1 gap-4 md:grid-cols-4">
                <x-select inline="false" label="Departemen" model="department" :live="true">  
                    <option value="0">Semua Departemen</option>
                    @foreach($departments as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                    @endforeach
                </x-select>
                <x-select inline="false" label="Karyawan" model="worker" :live="true">  
                    <option value="">Pilih Karyawan</option>
                    @foreach($workers as $w)
                        <option value="{{ $w->noid }}">{{ $w->name }}</option>
                    @endforeach
                </x-select>
                <div></div>
                <div class="flex flex-col pr-4">
                    <div>Rentang Waktu:</div>
                    <div class="flex flex-row items-center">
                        <div class="pr-2">Dari: </div>
                        <x-input-date inline="true" label="" model="date_start" :live="true"/>  
                        <div class="px-2">s/d </div>
                        <x-input-date inline="true" label="" model="date_end" :live="true"/>  
                    </div>
                </div>
            </div>

            @if($worker and $date_start and $date_end)
                <x-button @click="isModalOpen = true" class="w-24"> 
                    <x-fas-pencil class="h-4 w-4 mr-2"/> 
                    <span>Edit</span>
                </x-button>
            @else
                <x-button class="w-24" color="blue-300"> 
                    <x-fas-pencil class="h-4 w-4 mr-2"/> 
                    <span>Edit</span>
                </x-button>
            @endif
        </div>
        <div class="w-full overflow-x-auto mt-4">
            @include('livewire.pages.schedule.schedule-table')
        </div>
    
        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/2">
                <x-slot name="header">
                    <h3>Edit Jadwal</h3>
                </x-slot>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="flex flex-col space-y-2">
                        <x-select inline="false" label="Jam Kerja*" model="workhour" :live="true">  
                            <option value=""></option>
                            @foreach($workhours as $w)
                                <option value="{{ $w->id }}">{{ $w->name }} ({{substr($w->cin_time, 0 , 5)}} - {{substr($w->cout_time, 0 , 5)}})</option>
                            @endforeach
                        </x-select>
                        <x-checkbox value="1" model="holiday" label="Dihitung tanggal merah"/>
                        <x-checkbox value="True" model="is_overtime" label="Dihitung lembur" :live="true"/>
                        @if($is_overtime)
                            <x-input inline="true" label="Lama Lembur (menit)*:" model="overtime"/>  
                        @endif
                    </div>
                    <div class="flex flex-col space-y-2">
                        Pilih hari jam kerja yang akan diterapkan:
                        <div class="border dark:border-gray-700 p-2 overflow-y-auto h-60">  

                            @foreach($arrayDateInput as $date)
                                @php
                                    $d = Carbon\Carbon::parse($date);
                                @endphp
                                <x-checkbox value="{{$d->format('Y-m-d')}}" model="selectedDate" 
                                    label="{{ $d->format('d/m/Y') }} - {{ $d->translatedFormat('l') }}" 
                                /> 
                            @endforeach
                        </div>
                    </div>
                </div>

            </x-modal>
        </form>

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
