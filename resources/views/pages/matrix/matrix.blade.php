<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Open the modal using ID.showModal() method -->

    @include('components.flash-messages')
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    @foreach ($criteria as $row)
                        <th>{{ $row->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @php
                    $index = 0;
                    $i = 0;
                @endphp
                @foreach ($criteria as $row)
                    @php
                        $index++;
                        $iterasi = 0;
                    @endphp
                    <tr>
                        <th>{{ $row->name }}</th>
                        @foreach ($criteria as $row2)
                            @php
                                $iterasi++;
                            @endphp
                            @if ($iterasi == $index || $data[$i] == null)
                                <td>1</td>
                                @php
                                  $i++;
                                @endphp
                            @else
                                <td>{{ $data[$i] }}</td>
                                                                @php
                                  $i++;
                                @endphp
                            @endif
                        @endforeach

                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>



</x-layout>
