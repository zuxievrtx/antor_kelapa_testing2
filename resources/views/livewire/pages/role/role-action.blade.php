<div class="flex justify-end space-x-1"> 
    @if($value!=1)
    <x-button-circle title="Ubah Peraturan" color="purple-500" wireclick="$dispatchTo('pages.role.role-page', 'setting', { id: {{$value}} })">
        <x-fas-cog class="h-3 w-3 text-white" />
    </x-button-circle>
    <x-button-circle wireclick="$dispatchTo('pages.role.role-page', 'edit', { id: {{$value}} })">
        <x-fas-edit class="h-3 w-3 text-white" />
    </x-button-circle>
    <x-button-circle color="red-500"  onclick="isConfirmOpen=true" 
        wireclick="$dispatchTo('pages.role.role-page', 'confirm', { id: {{$value}} })">
        <x-fas-trash class="h-3 w-3 text-white" />
    </x-button-circle>
    @endif
</div>