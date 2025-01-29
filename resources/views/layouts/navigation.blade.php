<nav class="fixed bottom-0 bg-white flex items-center md:max-w-sm w-full mx-auto">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        <i class="fas fa-home"></i><span>Home</span>
    </x-nav-link>
    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')">
        <i class="fas fa-calendar-alt"></i><span>Kegiatan</span>
    </x-nav-link>
    <a href="" class="flex flex-1 flex-col items-center px-3 py-4 hover:bg-emerald-500 hover:text-white"><i class="fas fa-tasks"></i>Penilaian</span></a>
    <x-nav-link :href="route('profile.index')" :active="request()->routeIs('profile.*') | request()->routeIs('dataDiri.*') | request()->routeIs('eduhistory.*') | request()->routeIs('$orgHistories.*') |request()->routeIs('achievement.*')">
        <i class="fas fa-id-card"></i><span>Profile</span>
    </x-nav-link>
</nav>
