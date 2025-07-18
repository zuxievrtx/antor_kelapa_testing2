<div class="flex justify-end space-x-1">
    {{-- @if (!$row->hasRole('superadmin')) --}}
    {{-- @can('edit_people') --}}
    <x-button-circle wire:click="$dispatchTo('pages.instructor.instructor-page', 'edit', { id: {{ $value }} })">
        <x-fas-edit class="h-3 w-3 text-white" />
    </x-button-circle>
    {{-- @endcan --}}

    {{-- @can('delete_people') --}}
    <x-button-circle color="red-500" onclick="isConfirmOpen=true"
        wire:click="$dispatchTo('pages.instructor.instructor-page', 'confirm', { id: {{ $value }} })">
        <x-fas-trash class="h-3 w-3 text-white" />
    </x-button-circle>
    {{-- @endcan --}}
    {{-- @endif --}}
</div>
