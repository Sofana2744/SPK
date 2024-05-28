<div class="absolute top-0 right-0 z-10 p-12">
    @if ($message = Session::get('success'))
        <div x-data="{ tampil: true }">

            <div x-init="setTimeout(() => tampil = false, 3000)" x-show="tampil" role="alert" class="alert shadow-lg">
                <span class="material-symbols-outlined text-teal-500">
                    add_task
                </span>
                <div>
                    <h3 class="font-bold">New message!</h3>
                    <div class="text-xs">{{ $message }}</div>
                </div>
                <button class="btn btn-sm">good👍</button>
            </div>

        </div>
    @endif

    @if ($message = Session::get('update'))
        <div x-data="{ tampil: true }">

            <div x-init="setTimeout(() => tampil = false, 3000)" x-show="tampil" role="alert" class="alert shadow-lg">
                <span class="material-symbols-outlined text-info">
                    published_with_changes
                </span>
                <div>
                    <h3 class="font-bold">New message!</h3>
                    <div class="text-xs">{{ $message }}</div>
                </div>
                <button class="btn btn-sm">good👍</button>
            </div>

        </div>
    @endif

    @if ($message = Session::get('delete'))
        <div x-data="{ tampil: true }">

            <div x-init="setTimeout(() => tampil = false, 3000)" x-show="" role="alert" class="alert shadow-lg">
                <span class="material-symbols-outlined text-error">
                    remove_done
                </span>
                <div>
                    <h3 class="font-bold">New message!</h3>
                    <div class="text-xs">{{ $message }}</div>
                </div>
                <button class="btn btn-sm">good👍</button>
            </div>

        </div>
    @endif

</div>
