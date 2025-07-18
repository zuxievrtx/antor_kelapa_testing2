<div class="flex justify-end space-x-1"> 
    @can('modify_people')
    <x-button-circle color="purple-500" wireclick="$dispatchTo('pages.worker.worker-page', 'transfer', { id: {{$value}} })">
        <x-fas-arrow-right-arrow-left class="h-3 w-3 text-white" />
    </x-button-circle>   
    @endcan

    @can('edit_people')
    <x-button-circle wireclick="$dispatchTo('pages.worker.worker-page', 'edit', { id: {{$value}} })">
        <x-fas-edit class="h-3 w-3 text-white" />
    </x-button-circle>    
    @endcan

    @can('delete_people')
    <x-button-circle color="red-500"  onclick="isConfirmOpen=true" 
        wireclick="$dispatchTo('pages.worker.worker-page', 'confirm', { id: {{$value}} })">
        <x-fas-trash class="h-3 w-3 text-white" />
    </x-button-circle>
    @endcan
</div>