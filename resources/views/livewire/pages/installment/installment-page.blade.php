<div class="flex flex-col space-y-3">
    <x-breadcrumbs>
        <x-breadcrumbs-link>Pinjaman</x-breadcrumbs-link>
        <x-breadcrumbs-link current="true">Angsuran</x-breadcrumbs-link>
    </x-breadcrumbs>

    <x-page-header dropdownWidth="64">Angsuran Pinjaman
        @can('add_loan')
        <x-slot:button>     
            <x-button-primary @click="isModalOpen = true"> 
                <x-fas-plus-circle class="h-4 w-4 mr-2"/> 
                <span>Tambah </span>
            </x-button-primary>
        </x-slot>
        @endcan
    </x-page-header>

    <x-card class="min-h-full">        
        @if($workername)
            <div class="text-xl border-b pb-4 mb-4 ">Nama Pekerja: {{ $workername }}</div>
        @endif

        <div class="w-full overflow-x-auto">
            <livewire:pages.installment.installment-table  :loanid='$loanid' key="{{ time() }}"/>
        </div>

        <form wire:submit.prevent="save">
            <x-modal class="md:w-1/3">
                <x-slot name="header">
                    <h3>{{($isEdit) ? "Edit" : "Tambah"}} Angsuran</h3>
                </x-slot>
                <div class="flex flex-col space-y-2">     
                    <x-input-date inline="false" label="Tanggal*" model="date"/>   
                    
                    @if(!$loandata) 
                    <x-select inline="false" label="Pekerja*" model="worker" live="true" >
                        <option value=""></option>
                        @foreach($workers as $wk)
                            <option value="{{$wk->id}}"> {{ $wk->name }} </option>
                        @endforeach
                    </x-select>       
                       
                    <x-select inline="false" label="Tanggal Pinjaman*" model="loan"  live="true" >
                        <option value=""></option>
                        @foreach($loans as $l)
                            <option value="{{$l->id}}"> {{ Carbon\Carbon::parse($l->transaction_date)->isoFormat('DD MMMM YYYY') }} </option>
                        @endforeach
                    </x-select>   
                    @endif

                    <x-input-mask inline="false" label="Jumlah Pinjaman*" model="total_loan" readonly/>   
                    <x-input-mask inline="false" label="Jumlah Angsuran*" model="amount"  live="true"/>   
                    <x-input-mask inline="false" label="Sisa Angsuran*" model="remaining" readonly/>     
                </div>
            </x-modal>
        </form>

        <x-confirm-delete>Yakin akan menghapus data?</x-confirm-delete>
        <x-alert/>
    </x-card>
</div>
