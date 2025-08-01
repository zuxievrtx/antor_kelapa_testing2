@props(['label'=>'', 'model'=>'', 'value'=>''])
<div class="flex items-center mb-4">
    <input type="checkbox" value="{{$value}}" wire:model.lazy="{{$model}}" id="{{$model}}_{{$value}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    @if(isset($label))
        <label for="{{$model}}_{{$value}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
            {{ $label }}
        </label>
    @endif
</div>
