<div class="flex justify-end space-x-1">
    @can('edit_department')
    <x-button-circle wireclick="$dispatchTo('pages.worker.list-department-page', 'edit', { id: {{$value}} })">
        <x-fas-edit class="h-3 w-3 text-white" />
    </x-button-circle>
    @endcan

    @can('delete_department')
    <x-button-circle color="red-500"  onclick="isConfirmOpen=true" 
        wireclick="$dispatchTo('pages.worker.list-department-page', 'confirm', { id: {{$value}} })">
        <x-fas-trash class="h-3 w-3 text-white" />
    </x-button-circle>
    @endcan
</div>