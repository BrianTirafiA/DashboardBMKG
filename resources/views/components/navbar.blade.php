<nav class="bg-[#F1F5F9]">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0 flex ms-3 justify-center">
                    <img class="h-auto w-auto max-w-[2.5rem] max-h-[2.5rem]" src="{{ asset('assets/logo-bmkg.png') }}" alt="BMKG">
                    <span class="rounded-md px-3 text-sm font-medium">
                        <p> ASSET MANAGEMENT SYSTEM</p>
                        <p> DIREKTORAT DATA DAN KOMPUTASI </p>
                    </span>
                </div>
                <div class="hidden md:block">
                    <div class="ms-52 ml-10 flex items-baseline space-x-4 ">
                        @foreach ($menuItems as $menu)
                            <a href="{{ $menu['link'] }}"
                               class="rounded-md px-3 py-2 text-sm font-medium text-gray-900
                               {{ $menu['active'] ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                {{ $menu['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true" onclick="toggleProfileMenu()">
                                <span class="sr-only">Open user menu</span>
                                <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            </button>
                        </div>
                        <form id="logout-form" method="post" action="/logout" style="display: none;">
                            @csrf
                        </form>
                        <div id="profile-dropdown-menu" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 hidden">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700">Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="-mr-1 flex md:hidden">
                <!-- Mobile menu button -->
                <button type="button" id="mobile-menu-button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 " aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div id="mobile-menu" class="md:hidden hidden overflow-hidden transition-all duration-300 ease-in-out transform opacity-0 scale-95 origin-top">
        <div class="bg-[#F1F5F9] p-4 rounded-lg"> <!-- Card with background color -->
            <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                @foreach ($menuItems as $menu)
                    <a href="{{ $menu['link'] }}"
                       class="block rounded-md px-3 py-2 text-base font-medium
                       {{ $menu['active'] ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        {{ $menu['label'] }}
                    </a>
                @endforeach
            </div>
            <div class="border-t border-gray-700 pb-3 pt-4">
                <div class="flex items-center px-5">
                    <div class="shrink-0">
                        <img class="size-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    </div>
                    <div class="ml-3">
                        <div class="text-base/5 font-medium text-white">Tom Cook</div>
                        <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const openIcon = menuButton.querySelector('svg:nth-child(1)');
            const closeIcon = menuButton.querySelector('svg:nth-child(2)');

            menuButton.addEventListener('click', function () {
                // Toggle mobile menu visibility
                const isHidden = mobileMenu.classList.contains('hidden');

                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    // Use a slight delay to ensure the max-height transition happens smoothly
                    setTimeout(() => {
                        mobileMenu.classList.remove('max-h-0', 'opacity-0', 'scale-95');
                        mobileMenu.classList.add('max-h-screen', 'opacity-100', 'scale-100');
                    }, 10); // Small timeout for smooth transition
                } else {
                    mobileMenu.classList.add('max-h-0', 'opacity-0', 'scale-95');
                    mobileMenu.classList.remove('max-h-screen', 'opacity-100', 'scale-100');
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                    }, 300); // Delay until animation is complete
                }

                // Toggle icons
                openIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');

                // Update aria-expanded attribute
                const expanded = isHidden ? 'true' : 'false';
                menuButton.setAttribute('aria-expanded', expanded);
            });
        });

        function toggleProfileMenu() {
            const menu = document.getElementById('profile-dropdown-menu');
            const isHidden = menu.classList.contains('hidden');

            if (isHidden) {
                menu.classList.remove('hidden');
                setTimeout(() => {
                    menu.classList.remove('opacity-0', 'scale-95');
                    menu.classList.add('opacity-100', 'scale-100');
                }, 10); // Small timeout for smooth transition
            } else {
                menu.classList.add('opacity-0', 'scale-95');
                menu.classList.remove('opacity-100', 'scale-100');
                setTimeout(() => {
                    menu.classList.add('hidden');
                }, 300); // Delay until animation is complete
            }

            const expanded = isHidden ? 'true' : 'false';
            document.getElementById('user-menu-button').setAttribute('aria-expanded', expanded);
        }
    </script>
</nav>
