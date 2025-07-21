<div class="flex gap-2">
    <x-button-primary size="sm" wire:click="$dispatch('edit', {{ $row->id }})">
        <x-fas-edit class="h-4 w-4 mr-1" />Edit
    </x-button-primary>
    <x-button-danger size="sm" wire:click="$dispatch('confirm', {{ $row->id }})">
        <x-fas-trash class="h-4 w-4 mr-1" />Hapus
    </x-button-danger>
</div>