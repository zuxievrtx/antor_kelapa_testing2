

<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pinjaman</x-breadcrumbs-link>
        <x-breadcrumbs-link link="/tabungan">Tabungan</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Tambah Tabungan</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header> Tambah Tabungan</x-page-header>
        
    <form wire:submit.prevent="save">
    <x-card class="min-h-full">    
        <div class="flex flex-col space-y-2 w-full md:w-1/2">  
            <x-input-date inline="false" label="Tanggal*" model="saving_date"/>    
            <x-select inline="false" label="Pekerja*" model="worker" >
                <option value=""></option>
                @foreach($workers as $wk)
                    <option value="{{$wk->id}}"> {{ $wk->name }} </option>
                @endforeach
            </x-select>    
            <x-input-mask inline="false" label="Jumlah Tabungan*" model="amount"/>   
            <x-textarea inline="false" label="Keterangan" model="description"/>    
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