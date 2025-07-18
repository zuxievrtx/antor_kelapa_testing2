<x-table>
    <x-slot:thead>
        <tr>
            <th class="p-3 w-100  border dark:border-gray-700"></th>
            @for($t=1; $t<=24; $t++)
                <th class="py-3 px-2 text-center  border dark:border-gray-700">{{ $t }}</th>
            @endfor
        </tr>
    </x-slot>
    @if($date_start and $date_end)  
        @foreach($arrayDate as $date)
            <tr class="border-b dark:border-gray-700">
                <td class="py-3 px-2  border dark:border-gray-700">{{ $date['label'] }}</td>
                @for($t=1; $t<=24; $t++)
                    @if(($t > (int)$date['start']) and ((int)$date['end'] < (int)$date['start'])) @continue 
                    @elseif($t > (int)$date['start'] and $t <= (int)$date['end']) @continue 
                    @elseif($t>1 and ($t <= (int)$yesterday['end'] ) and ((int)$yesterday['end'] <= (int)$yesterday['start'])) @continue 
                    @endif

                    @php
                        if($t== (int)$date['start'] and (int)$date['end'] <= (int)$date['start']){
                            $colspan = 25 - (int)$date['start'];
                        }elseif($t== (int)$date['start']){
                            $colspan = (int)$date['end'] + 1 - (int)$date['start']; 
                        }elseif($t==1 and ((int)$yesterday['end'] < (int)$yesterday['start'])){
                            $colspan = (int)$yesterday['end'];
                        }else{
                            $colspan = 0;
                        }

                    @endphp
                    <td class="py-3  border dark:border-gray-700 text-center" colspan="{{$colspan}}"> 
                        @if($t== (int)$date['start'] and (int)$date['end'] < (int)$date['start']) <div class="flex h-8 bg-primary justify-between p-2 text-white"> <span>{{$date['start']}}</span> <x-fas-arrow-right class="w-4 h-4"/> </div>
                        @elseif($t == (int)$date['start']) <div class="flex h-8 bg-primary justify-between p-2 text-white"> <span>{{$date['start']}}</span> <span>{{$date['end']}}</span> </div> 
                        @elseif($t==1 and ((int)$yesterday['end'] < (int)$yesterday['start'])) <div class="flex h-8 bg-primary justify-between p-2 text-white"> <x-fas-arrow-right class="w-4 h-4"/> <span>{{$yesterday['end']}}</span> </div> 
                        @endif
                    </td>
                @endfor
            </tr>
            @php  $yesterday = $date @endphp
        @endforeach
    
    @else
        <tr class="border-b dark:border-gray-700">
            <td class="py-3 px-2  border dark:border-gray-700 text-center" colspan="25">Tidak ada data tanggal untuk ditampilkan</td>
        </tr>
    @endif
</x-table>