<div class="bg-base-100 w-full">
    <nav class="navbar mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="navbar-start">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost lg:hidden" onclick="goBack()">
                    <!-- Tambahkan atribut onclick untuk memanggil fungsi goBack() -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li class="mx-2"><a href="/criteria" class="{{ request()->is('criteria') ? 'bg-gray-900 text-cyan-500' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Criteria</a></li>
                     <li class="mx-2"><a href="/alternative" class="{{ request()->is('alternative') ? 'bg-gray-900 text-cyan-500' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Alternative</a></li>
                    <li class="mx-2"><a href="/matrix" class="{{ request()->is('matrix') ? 'bg-gray-900 text-cyan-500' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">Matrix</a></li>
                </ul>
            </div>
            <a href="/" class="btn btn-ghost text-xl">AHP|MAUT</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li class="mr-5"> <x-nav-link href="/criteria" :active="request()->is('criteria')">Criteria</x-nav-link></li>
                <li class="mr-5"> <x-nav-link href="/alternative" :active="request()->is('alternative')">Alternative</x-nav-link></li>
                <li class="mr-5"> <x-nav-link href="/matrix" :active="request()->is('matrix')">Matrix</x-nav-link></li>


            </ul>
        </div>
        <div class="navbar-end">
            <a class="btn" onclick="goBack()">Kembali</a> <!-- Tambahkan onclick="goBack()" di sini juga -->
        </div>
    </nav>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>
