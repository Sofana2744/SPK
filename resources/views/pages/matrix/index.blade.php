<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    @include('components.flash-messages')

    <!-- Open the modal using ID.showModal() method -->
<form action="{{ url('matrix/proses') }}" method="post">
@csrf
<div class="flex flex-wrap justify-around">
      @php
        $i = 0;
      @endphp
        @foreach ($criteria as $row)
        @php
          $i++;
          $t = 0;
        @endphp
            @foreach ($criteria as $item)
            @php
              $t++;
              if($i>=$t)
              {
                continue; 
              }
            @endphp
                @if ($row->name == $item->name)
                    <div class="join m-2 hidden">
                        <button class="btn join-item rounded-l-full w-32">{{ $row->name }}</button>
                        <input class="input input-bordered join-item w-24" value="1" name="{{ str_replace(' ', '',$row->name.'_'.$item->name) }}"/>
                        <button class="btn join-item rounded-r-full w-32">{{ $item->name }}</button>
                    </div>
                    @php
                    @endphp
                @else

                    <div class="join m-2">
                        <button class="btn join-item rounded-l-full w-32">{{ $row->name }}</button>
                        <input class="input input-bordered join-item w-24"  name="{{ str_replace(' ', '',$row->name.'_'.$item->name) }}" />
                        <input class="input input-bordered join-item w-24" name="{{ str_replace(' ', '',$item->name.'_'.$row->name) }}"/>
                        <button class="btn join-item rounded-r-full w-32">{{ $item->name }}</button>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
<button type="submit">dawdawd</button>
</form>
    





</x-layout>
