<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <!-- Open the modal using ID.showModal() method -->

    @include('components.flash-messages')

    <button class="btn btn-success btn-sm rounded btn-outline" onclick="my_modal_create.showModal()">Create new
        criteria</button>


    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
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
            </tbody>
        </table>
    </div>

    {{-- modal create --}}
    @include('pages.criteria.create')
    @include('pages.criteria.update')
    @include('pages.criteria.delete')


</x-layout>
