

<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Personalia</x-breadcrumbs-link>
        <x-breadcrumbs-link link="/departemen">Departemen</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Tambah Departemen</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Tambah Departemen</x-page-header>
        
    <form wire:submit.prevent="save">
    <x-card class="min-h-full">    
            <div class="flex flex-col space-y-2 w-full md:w-1/2">    
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
        <x-alert/>
        
        <x-slot name="footer">
            <x-button-primary type="submit" color="primary" class="mt-2">
                <x-fas-save class="h-4 w-4"/>    
                <span> Simpan </span>
            </x-button-primary>
        </x-slot>

    </x-card>
    </form>
</div>