<div class="flex justify-end space-x-1"> 
    @can('edit_service')
    <x-button-circle wireclick="$dispatchTo('pages.service.service-page', 'edit', { id: {{$value}} })">
        <x-fas-edit class="h-3 w-3 text-white" />
    </x-button-circle>
    @endcan
</div>