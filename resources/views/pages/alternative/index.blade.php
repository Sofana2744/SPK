<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Open the modal using ID.showModal() method -->

    @include('components.flash-messages')

    <button class="btn btn-success btn-sm rounded btn-outline" onclick="my_modal_create.showModal()">Create new
        alternative</button>


    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    @foreach ($dataCriteria as $item)
                        <th>{{ $item->name }}</th>
                    @endforeach
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $row->name }}</td>
                        @foreach ($row->subAlternative as $item)
                            <th>{{ $item->value }}</th>
                        @endforeach
                        <td>
                            <button onclick="edit_{{ $row->id }}.showModal()"
                                class="btn btn-outline btn-xs btn-info">
                                <span class="material-symbols-outlined">
                                    edit_note
                                </span>
                            </button>
                            <button onclick="delete_{{ $row->id }}.showModal()"
                                class="btn btn-outline btn-xs btn-error">
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </button>
                        </td>
                    </tr>
                @endforeach
                <tr class="bg-cyan-500 text-white">
                    <td colspan="2">Nilai Minimal</td>
                    @php
                        $dataMin = [];
                        $dataMax = [];
                    @endphp
                    @foreach ($dataCriteria as $row)
                        @php
                            $min = $dataSubAlternative->where('criteria_id', $row->id)->min('value');
                            array_push($dataMin, $min);
                        @endphp
                        <td>{{ $min }}</td>
                    @endforeach
                    <td></td>
                </tr>
                <tr class="bg-teal-500 text-white">
                    <td colspan="2">Nilai Maksimal</td>
                    @foreach ($dataCriteria as $row)
                        @php
                            $max = $dataSubAlternative->where('criteria_id', $row->id)->max('value');
                            array_push($dataMax, $max);
                        @endphp
                        <td>{{ $max }}</td>
                    @endforeach
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <hr class="border-2 border-black mt-12">

    @if (count($data) > 1)
    <h1 class="text-black mt-28 text-lg font-bold">Table Normalisasi Alternative</h1>
    <div class="overflow-x-auto">
        <table class="table">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    @foreach ($dataCriteria as $item)
                        <th>{{ $item->name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $row)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $row->name }}</td>
                        @php
                            $index = 0;
                        @endphp
                        
                        @foreach ($row->subAlternative as $item)
                            @if($dataMax[$index] - $dataMin[$index] == 0) 
                            <th>0</th>
                            @else
                            <th>{{ ($item->value - $dataMin[$index]) / ($dataMax[$index] - $dataMin[$index]) }}</th>
                            @endif
                            @php
                                $index++;
                            @endphp
                        @endforeach

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
        
    @endif
    {{-- modal create --}}
    @include('pages.alternative.create')
    @include('pages.alternative.update')
    @include('pages.alternative.delete')

</x-layout>
